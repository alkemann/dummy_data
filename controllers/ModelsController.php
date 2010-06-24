<?php

namespace dummy_data\controllers;

use \dummy_data\models\Model;

class ModelsController extends \lithium\action\Controller {

	private $indexAction = array(
		'plugin' => 'dummy_data',
		'controller' => 'models',
		'action' => 'index',
	);

	/**
	 * List all views in the app
	 */
	public function index() {
		$models	= Model::all(array('library' => 'app'));
		return compact('models');
	}

	/**
	 * Inspect a model, either session stored field with generators is presented, 
	 * or what default guess will be.
	 */
	public function view($modelParam = null) {
		if (is_null($modelParam)) $this->redirect($this->indexAction);
		$model = str_replace('-','\\',$modelParam);
		$fields = Model::first($model);
		if (empty($fields))
			$fields = Model::create(array($model));
		if (empty($fields)) 
			$this->redirect($this->indexAction);
 		$fields = $fields->data();	
		$example = Model::fill($fields);
		return compact('model','fields','example','modelParam');
	}

	/**
	 * Present a form for selecting generators, recieve posted form for generation
	 */
	public function fill($modelParam = null) {
		if (is_null($modelParam)) $this->redirect($this->indexAction);
		$success = null; $count = 0; $generators = null; $created = null;
		// if form is posted with the refresh key, means the Refresh examples button was pressed
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
		// if form is posted without refresh, means a fill action is requested
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
		// No data posted means enter view, retrieve any existing info and present them
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
