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
				'name' => 'Name->name',
				'username' => 'Web->username',
				'email' => 'Web->email',
			),
			'created' => 'Time->datetime',
			'body' => 'Lorem->sentence'
		);
		$this->assertEqual($result, $expected);
	}
}
?>
