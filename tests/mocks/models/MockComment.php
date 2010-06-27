<?php

namespace dummy_data\tests\mocks\models;

use \lithium\data\entity\Document;

class MockComment extends \lithium\data\Model {

	protected $_schema = array(
		'name' => array('type' => 'varchar'),
		'created' => array('type' => 'datetime'),
		'website' => array('type' => 'varchar'),
		'body' => array('type' => 'text')
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
