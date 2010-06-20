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
	 	$model = $data[0];
		if (!class_exists($model)) return null;
		$data = static::inspect(null, $model::first()->data());
		$doc = new Document(array('data' => $data));
		return $doc;
	}

	private static function inspect($field, $value) {
		if (is_array($value)) {
			$ret = array();
			foreach ($value as $f => $v) {
				$ret[$f] = static::inspect($f,$v);
			}	
			return $ret;
		} else {
			return static::inspectField($field, $value);
		}
	}

	public static function inspectField($fieldname, $fieldvalue = null) {
		return Type::matchName($fieldname);
	}

	public static function fill(array $fields) {
		$ret = array();
		foreach ($fields as $field => $generator) {
			if (is_array($generator)) {
				$ret[$field] = static::fill($generator);
			} else {
				$options = array();
				$generator = explode('->', $generator);
				$ret[$field] = Data::generate($generator[0], $generator[1], $options);
			}
		}
		return $ret;
	}
}
?>
