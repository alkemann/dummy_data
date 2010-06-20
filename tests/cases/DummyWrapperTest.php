<?php
/**
 *
 *
 */

namespace dummy_data\tests\cases;

use php_faker\DummyWrapper;


class DummyWrapperTest extends \lithium\test\Unit {

	public function setUp() {
		
	}

	public function testLoaded() {
		$result = DummyWrapper::listClasses();
		$this->assertFalse(is_null($result));
	}

	public function testListClasses() {
		$result = DummyWrapper::listClasses();
		$this->assertTrue(is_array($result));
		$this->assertTrue(isset($result['Address']));
	}

	public function testListMethod() {
		$result = DummyWrapper::listMethods('Address');
		$this->assertTrue(is_array($result));
	}

	public function testNumberGenerators() {
		$methods = DummyWrapper::listNumberGenerators();
		$this->skipIf(!isset($methods['Number']) || empty($methods['Number']), 'Number generators not present');
		$result = array();
		foreach ($methods['Number'] as $generator) {
			$result[$generator] = DummyWrapper::generate('Number', $generator );
			$this->assertTrue(is_numeric($result[$generator]));
		}
	}

	public function testTimeGenerators() {
		$methods = DummyWrapper::listTimeGenerators();
		$this->skipIf(!isset($methods['Time']) || empty($methods['Time']), 'Time generators not present');
		$result = array();
		foreach ($methods['Time'] as $generator) {
			$result[$generator] = (string) DummyWrapper::generate('Time', $generator );
		}
		$this->assertPattern('#^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$#', $result['date']);
		$this->assertPattern('#^[012]\d:[0-6]\d:[0-6]\d#', $result['clock']);
		$this->assertPattern('#^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[ ][012]\d:[0-6]\d:[0-6]\d$#', $result['datetime']); 
		$this->assertPattern('#^\d{8,10}$#', $result['timestamp']); 
		$this->assertPattern('#^(19|20)\d\d$#', $result['year']); 
		$this->assertPattern('#^([1-9]|1[012])$#', $result['month']); 
		$this->assertPattern('#^([1-9]|[12][0-9]|3[01])$#', $result['day']); 
	}

	public function testStringGeneratorNames() {
		$methods = DummyWrapper::listStringGenerators();
		$this->skipIf(!isset($methods['Name']) || empty($methods['Name']), 'Name generators not present');
		$result = array();
		foreach ($methods['Name'] as $generator) {
			$result[$generator] = (string) DummyWrapper::generate('Name', $generator );
			$this->assertFalse(empty($result[$generator]));
			$this->assertTrue(is_string($result[$generator]));
		}
	}

}

?>
