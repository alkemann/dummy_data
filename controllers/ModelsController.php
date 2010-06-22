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
		$generators = \dummy_data\models\Data::listGenerators();
		return compact('model','fields','example','generators');
	}

	public function fill() {
		if (!empty($this->request->data) && isset($this->request->data['refresh'])) {
			$modelName = $this->request->data['model']; unset($this->request->data['model']);
			$count = $this->request->data['count']; unset($this->request->data['count']);
			unset($this->request->data['refresh']);
			$fields = $this->request->data;
			foreach ($fields as $field => $gen) {
				$g = explode('->', $gen);
				$class = $g[0]; $method = $g[1];
				$examples[$field] = \dummy_data\models\Data::generate($class, $method);
			}
			$generators = \dummy_data\models\Data::listGenerators();
			return compact('modelName','examples','count','generators','fields');
		} elseif (empty($this->request->data)) {
			$ids = array();
			$success = true;
			$created = null;
			$modelName = str_replace('-','\\',$model);
			$fields = Model::create(array($model))->data();
			unset($fields['_id']);
			for ($i = $count; $i > 0; $i--) {
				$record = $modelName::create(Model::fill($fields));
				if (!$record->save()) {
					$success = false;
					break;
			}
				$ids[] = $record->_id;
			}
			if ($success)
				$created = $modelName::all(array(
					'conditions' => array('_id' => $ids),
					'limit' => $count
				));	
			return compact('created','success','modelName','count');
		} else {
		
			$this->redirect('Models::index');
		}
	}
}
