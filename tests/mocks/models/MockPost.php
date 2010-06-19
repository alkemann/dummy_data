<?php

namespace dummy_data\tests\mocks\models;

use \lithium\data\entity\Document;

class MockPost extends \lithium\data\Model {

	public $meta = array(
		'connection' => null,
		'source' => null
	);

	public static function find($type, array $options = array()) {
		$doc = new Document();
		$doc->title = 'Test title';
		$doc->author = new Document();
		$doc->author->name = 'Alexander Morland';
		$doc->author->username = 'alkemann';
		$doc->author->email = 'alek@example.org';
		$doc->created = '2010-06-19 21:47:55';
		$doc->body = 'Lorem ipsum';
		return $doc;
	}
}
?>
