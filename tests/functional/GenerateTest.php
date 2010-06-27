<?php

namespace dummy_data\tests\functional;

use \dummy_data\tests\mocks\models\MockModel;

class GenerateTest extends \lithium\test\Unit {

	private $model = '\dummy_data\tests\mocks\models\MockPost';

	public function skip() {
		$inspected = MockModel::create(array($this->model));
		$this->skipIf(is_null($inspected), 'MockModel not working or '.$this->model.' doesnt exist, run InspectTest');
		$data = $inspected->data();
		$this->skipIf(empty($data), 'Inspect not working, run InspectTest');
	}

	public function testGeneration() {
		$fields = MockModel::create(array($this->model))->data();
		$result = MockModel::fill($fields);
		$this->assertTrue(is_array($result) && !empty($result));
		$this->assertTrue(isset($result['title']) && !empty($result['title']));
		$this->assertTrue(isset($result['created']) && !empty($result['created']));
		$this->assertTrue(isset($result['author']['name']) && !empty($result['author']['name']));
		$this->assertTrue(isset($result['author']['email']) && !empty($result['author']['email']));
		$this->assertTrue(isset($result['author']['username']) && !empty($result['author']['username']));
	}
}
