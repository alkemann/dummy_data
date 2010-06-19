<?php

namespace dummy_data\tests\mocks\functional;

use \lithium\util\Inflector;

class MockSource extends \lithium\data\Source {

	protected $_classes = array(
		'record' => '\lithium\data\model\Record',
		'recordSet' => '\lithium\data\collection\RecordSet'
	);

	private $_mockPosts = array(
		'id' => array('type' => 'int', 'length' => '10', 'null' => false, 'default' => NULL),
		'username' => array(
			'type' => 'varchar', 'length' => '255', 'null' => false, 'default' => NULL
		),
		'title' => array(
			'type' => 'varchar', 'length' => '255', 'null' => true, 'default' => NULL
		),
		'body' => array(
			'type' => 'text', 'length' => NULL, 'null' => true, 'default' => NULL
		),
		'created' => array(
			'type' => 'datetime', 'length' => NULL, 'null' => true, 'default' => NULL
		),
		'status' => array(
			'type' => 'tinyint', 'length' => '1', 'null' => false, 'default' => '0'
		)
	);




	public function connect() {
		return true;
	}

	public function disconnect() {
		return true;
	}

	public function entities($class = null) {
		return array('mock_posts', 'mock_comments', 'mock_tags', 'posts_tags');
	}

	public function item($model, array $data = array(), array $options = array()) {
		$class = $this->_classes['record'];
		return new $class(compact('model', 'data') + $options);
	}

	public function describe($entity, $meta = array()) {
		$var = "_" . Inflector::camelize($entity, false);
		if ($this->{$var}) {
			return $this->{$var};
		}
		return array();
	}

	public function create($query, array $options = array()) {
		return compact('query', 'options');
	}

	public function read($query, array $options = array()) {
		return compact('query', 'options');
	}

	public function update($query, array $options = array()) {
		return compact('query', 'options');
	}

	public function delete($query, array $options = array()) {
		return compact('query', 'options');
	}

	public function schema($query, $resource = null, $context = null) {

	}

	public function result($type, $resource, $context) {

	}

}

?>
