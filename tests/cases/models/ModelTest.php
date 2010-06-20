<?php

namespace dummy_data\tests\cases\models;

use \dummy_data\models\Model;

class ModelTest extends \lithium\test\Unit {

	public function testCreateEmpty() {
		$result = Model::create();
		$this->assertNull($result);
	}

	public function testCreateOne() {
		$result = Model::create(array('\dummy_data\tests\mocks\models\MockPost'));
		$this->assertFalse(empty($result));
		$this->assertTrue($result instanceof \lithium\data\entity\Document);
		$result = $result->data();
		$this->assertEqual($result['title'], 'English->title');
	}

	public function testCreateMultiple() {
		$result = Model::create(array(
			'\dummy_data\tests\mocks\models\MockPost',
			'\dummy_data\tests\mocks\models\MockComment'
		));
		$this->assertFalse(empty($result));
		$this->assertTrue($result[0] instanceof \lithium\data\entity\Document);
		$this->assertTrue($result[1] instanceof \lithium\data\entity\Document);
		$this->assertEqual($result[1]->website, 'Web->url');
	}

	public function testCreateMissingModel() {
		 $result = Model::create(array('/non/existing/namespace/Post'));
		 $this->assertNull($result);
	}
}
?>
