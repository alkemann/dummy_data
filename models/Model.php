<?php

namespace dummy_data\models;

use \lithium\data\entity\Document;
use \dummy_data\models\Type;

class Model extends \lithium\data\Model {

	public $meta = array(
		'connection' => null,
		'source' => null
	);

	public static function create(array $data = array(), array $options = array()) {
	 	$model = $data[0];
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
}
?>
