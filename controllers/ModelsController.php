<?php

namespace dummy_data\controllers;

use \dummy_data\models\Model;

class ModelsController extends \lithium\action\Controller {

	public function index() {
		$models	= Model::all(array('library' => 'app'));
		return compact('models');
	}

	public function view($modelParam) {
		$model = str_replace('-','\\',$modelParam);
		$fields = Model::first($model);
		if (empty($fields)) $this->redirect(array(
			'plugin' => 'dummy_data',
			'controller' => 'models',
			'action' => 'fill',
			'args' => array($modelParam)
		));
		$example = Model::fill($fields->data());
		return compact('model','fields','example');
	}

	public function fill($modelParam = null) {
		$success = null; $count = 0; $generators = null; $created = null;
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
		} elseif (!empty($this->request->data)) {
			$modelName = $this->request->data['model']; unset($this->request->data['model']);
			$count = $this->request->data['count']; unset($this->request->data['count']);
			unset($this->request->data['refresh']);
			$fields = $this->request->data;
			$ids = array();
			unset($fields['_id']);
			$success = true;
			for ($i = $count; $i > 0; $i--) {
				$record = $modelName::create(Model::fill($fields));
				if (!$record->save()) {
					$success = false;
					break;
				}
				$ids[] = $record->_id;
			}
			if ($success) {
				$limit = sizeof($ids);
				$created = $modelName::all(array(
					'conditions' => array('_id' => $ids),
					'limit' => $limit
				));
			}
				
		} else {
			$modelName = str_replace('-','\\',$modelParam);
			$fields = Model::create(array($modelName))->data();
			$examples = Model::fill($fields);
			$generators = \dummy_data\models\Data::listGenerators();
		}
		return compact(
			'modelName','modelParam','fields','examples','generators','success','created'
		);
	}
}
