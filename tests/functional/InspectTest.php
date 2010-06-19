<?php 

namespace dummy_data\tests\functional;

use \dummy_data\tests\mocks\models\MockModel;
use \dummy_data\tests\mocks\models\MockPost;

class InspectTest extends \lithium\test\Unit {

	public function testInspect() {
		
		#$apost = MockPost::first()->data();
		#dt($apost->data());
		
		$model = MockModel::create(array(
			'\dummy_data\tests\mocks\models\MockPost'
		));
		
		$result = $model->data();
		dt($result);

	#	$result = $model->generate(1);
	#	dt($result);


	}
}
