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

	public static function create(array $data = array(), array $options = array()) {
		if (empty($data)) return null;
		if (sizeof($data) > 1) {
			$ret = array();
			foreach ($data as $model) {
				$ret[] = static::create(array($model), $options);
			}
			return $ret;
		}
	 	$model = $data[0];
		$model = substr($model,0,1) == '\\'?$model:'\\'.$model;
		if (!class_exists($model)) return null;
		$schema = $model::schema();
		if (is_null($schema) || empty($schema) ) {
			$data = static::inspect(null, $model::first()->data(), $model);
		} else {
			$data = array();
			foreach ($schema as $field => $settings) {
				$gen = Type::matchName($field);
				if (!$gen) $gen = Type::matchType($settings);
				$data[$field] = $gen;
			}
		}
		$doc = new Document(array('data' => $data));
		return $doc;
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
			} elseif (is_array($generator)) {
				$ret[$field] = static::fill($generator);
			} else {
				$options = array();
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
				$name = $options['conditions']['_id'];
				return null;
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
