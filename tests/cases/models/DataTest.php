<?php
/**
 *
 *
 */

namespace dummy_data\tests\cases\models;

use \dummy_data\models\Data;


class DataTest extends \lithium\test\Unit {

	public function setUp() {
		
	}

	public function testLoaded() {
		$result = Data::listClasses();
		$this->assertFalse(is_null($result));
	}

	public function testListClasses() {
		$result = Data::listClasses();
		$this->assertTrue(is_array($result));
		$this->assertTrue(isset($result['Address']));
	}

	public function testListMethod() {
		$result = Data::listMethods('Address');
		$this->assertTrue(is_array($result));
	}

	public function testNumberGenerators() {
		$methods = Data::listNumberGenerators();
		$this->skipIf(!isset($methods['Number']) || empty($methods['Number']), 'Number generators not present');
		$result = array();
		foreach ($methods['Number'] as $generator) {
			$result[$generator] = Data::generate('Number', $generator );
			$this->assertTrue(is_numeric($result[$generator]));
		}
	}

	public function testTimeGenerators() {
		$methods = Data::listTimeGenerators();
		$this->skipIf(!isset($methods['Time']) || empty($methods['Time']), 'Time generators not present');
		$result = array();
		foreach ($methods['Time'] as $generator) {
			$result[$generator] = (string) Data::generate('Time', $generator );
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
		$methods = Data::listStringGenerators();
		$this->skipIf(!isset($methods['Name']) || empty($methods['Name']), 'Name generators not present');
		$result = array();
		foreach ($methods['Name'] as $generator) {
			$result[$generator] = (string) Data::generate('Name', $generator );
			$this->assertFalse(empty($result[$generator]));
			$this->assertTrue(is_string($result[$generator]));
		}
	}
}

?>
