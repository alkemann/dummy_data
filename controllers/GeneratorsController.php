<?php

namespace dummy_data\controllers;

use \dummy_data\models\Data;

class GeneratorsController extends \lithium\action\Controller {

	public function index() {
		$classes = Data::listClasses();
		return compact('classes');
	}

	public function view($class) {
		$methods = Data::listMethods($method);
		return compact('methods');
	}
}
?>
