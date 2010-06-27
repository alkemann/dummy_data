<?php 

namespace dummy_data\tests\functional;

use \dummy_data\tests\mocks\models\MockModel;

class InspectTest extends \lithium\test\Unit {

	public function testInspect() {
		$model = MockModel::create(array(
			'\dummy_data\tests\mocks\models\MockPost'
		));
		
		$result = $model->data();
		$expected = array(
			'title' => 'English->title',
			'author' => array(
				'name' => 'Name->a_name',
				'username' => 'Web->username',
				'email' => 'Web->email',
			),
			'created' => 'Time->datetime',
			'body' => null
		);
		$this->assertEqual($expected, $result);
	}

	public function testInspectSchema() {
		$model = MockModel::create(array(
			'\dummy_data\tests\mocks\models\MockComment'
		));
		
		$result = $model->data();
		$expected = array(
			'name' => 'Name->a_name',
			'created' => 'Time->datetime',
			'website' => 'Web->url',
			'body' => 'English->quote'
		);
		$this->assertEqual($expected, $result);
	}
}
?>
