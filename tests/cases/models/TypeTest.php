<?php 

namespace dummy_data\tests\cases\models;

use dummy_data\models\Type;

class TypeTest extends \lithium\test\Unit {

	public function testMatchName() {
		$result = Type::matchName('ballooooon');
		$this->assertNull($result);
		$result = Type::matchName('name');
		$this->assertIdentical($result, 'Name->a_name');
		$result = Type::matchName('firstname');
		$this->assertIdentical($result, 'Name->firstname');
		$result = Type::matchName('surname');
		$this->assertIdentical($result, 'Name->surname');
		$result = Type::matchName('username');
		$this->assertIdentical($result, 'Web->username');
		$result = Type::matchName('email');
		$this->assertIdentical($result, 'Web->email');
		$result = Type::matchName('website');
		$this->assertIdentical($result, 'Web->url');
		$result = Type::matchName('title');
		$this->assertIdentical($result, 'English->title');
	}
}
?>
