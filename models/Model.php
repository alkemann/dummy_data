<?php

namespace dummy_data\models;

use \lithium\data\entity\Document;
use \dummy_data\models\Type;
use \dummy_data\models\Data;


class Model extends \lithium\data\Model {

	public $meta = array(
		'connection' => null,
		'source' => null
	);

	public static function create(array $fields = array(), array $options = array()) {
		if (empty($fields)) return null;
		if (sizeof($fields) > 1) {
			$ret = array();
			foreach ($fields as $model) {
				$ret[] = static::create(array($model), $options);
			}
			return $ret;
		}
	 	$model = $fields[0];
		$model = substr($model,0,1) == '\\'?$model:'\\'.$model;
		if (!class_exists($model)) return null;
		$schema = $model::schema();
		if (is_null($schema) || empty($schema) ) {
			$fields = static::inspect(null, $model::first()->data(), $model);
		} else {
			$fields = array();
			foreach ($schema as $field => $settings) {
				$gen = null;
                                if (isset($settings['generator']))
                                    $gen = $settings['generator'];
                                    if ($settings['generator'] === false) {
                                        continue;
                                    }
                                if ($gen === null) $gen = Type::matchName($field);
				if ($gen === null) $gen = Type::matchType($settings);
				$fields[$field] = $gen;
			}
		}
		$entity = new $model();
                $entity->generators = $fields;
		return $entity;
	}

	private static function inspect($field, $value, $model) {
		if (is_array($value)) {
			$ret = array();
			foreach ($value as $f => $v) {
				$ret[$f] = static::inspect($f,$v, $model);
			}	
			return $ret;
		} else {
			return Type::matchName($field);
		}
	}

	public static function fill(array $fields) {
		$ret = array();
		foreach ($fields as $field => $generator) {
			if ($generator == null) {
			 $ret[$field] = null;
			//} elseif (is_array($generator)) {
			//	$ret[$field] = static::fill($generator);
			} else {
				$options = array();
                                if (is_array($generator)) {
                                    $options = $generator;
                                    $generator = $options['type'];
                                    unset($options['type']);
                                }
				list($class, $method) = explode('->', $generator);
				$ret[$field] = Data::generate($class, $method, $options);
			}
		}
		return $ret;
	}

	public static function find($type, array $options = array()) {
		$models = array();
		switch ($type) {
			case 'first' :
				$name = $options['conditions']['model'];
                                return $name::$schema;
			break;
			case 'all' :
			default:
				$all =  \lithium\core\Libraries::locate('models', null, $options);
				foreach ($all as $one) {
					if (substr($one,0,10) != 'dummy_data') 
						$models[] = $one;
				}
			break;
		}
		return $models;
	}
}
?>
