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

	public function fill($model, $count = 1) {
		$ids = array();
		$success = true;
		$created = null;
		$model = str_replace('-','\\',$model);
		$fields = Model::create(array($model))->data();
		unset($fields['_id']);
		for ($i = $count; $i > 0; $i--) {
			$record = $model::create(Model::fill($fields));
			if (!$record->save()) {
				$success = false;
				break;
		}
			$ids[] = $record->_id;
		}
		if ($success)
			$created = $model::all(array(
				'conditions' => array('_id' => $ids),
				'limit' => $count
			));
		return compact('created','success','model','count');
	}
}
