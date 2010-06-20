<?php

namespace dummy_data\tests\mocks\models;

use \lithium\data\entity\Document;

class MockComment extends \lithium\data\Model {

	public $meta = array(
		'connection' => null,
		'source' => null
	);

	public static function find($type, array $options = array()) {
		$doc = new Document();
		$doc->name = 'Alexander Morland';
		$doc->created = '2010-06-19 21:47:55';
		$doc->website = 'http://example.org';
		$doc->body = 'Lorem ipsum';
		return $doc;
	}
}
?>
