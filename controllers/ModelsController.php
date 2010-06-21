<?php

namespace dummy_data\controllers;

use \dummy_data\models\Model;

class ModelsController extends \lithium\action\Controller {

	public function index() {
		$model = Model::first('Post');
		$models	= Model::all(array('library' => 'app'));
		return compact('models');
	}

	public function view($model) {
		$model = str_replace('-','\\',$model);
		$fields = Model::create(array($model));
		$example = Model::fill($fields->data());
		return compact('model','fields','example');
	}
}
