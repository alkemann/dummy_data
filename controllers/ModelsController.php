<?php

namespace dummy_data\controllers;

use \dummy_data\models\Model;

class ModelsController extends \lithium\action\Controller {

	/**
	 * List all views in the app
	 */
	public function index() {
		$models	= Model::all(array('library' => 'app'));
		return compact('models');
	}

	/**
	 * Present a form for selecting generators, recieve posted form for generation
	 */
	public function fill($modelParam = null) {
		if (is_null($modelParam)) $this->redirect(array('action' => 'index'));
		$success = null; $count = 0; $generators = null; $created = null;
		if (!empty($this->request->data) && !isset($this->request->data['refresh'])) {
			$modelName = $this->request->data['model']; unset($this->request->data['model']);
			$count = $this->request->data['count']; unset($this->request->data['count']);
			unset($this->request->data['refresh']);
			$success = true;
                        $created = array();
                        $fields = Model::create(array($modelName))->generators;
			for ($i = $count; $i > 0; $i--) {
				$record = $modelName::create(Model::fill($fields));
				if (!$record->save()) {
					$success = false;
					break;
				}
				$created[] = $record;
			}
			if ($success) {
				/*$limit = sizeof($ids);
				$created = $modelName::all(array(
					'conditions' => array('_id' => $ids),
					'limit' => $limit
				));*/
			}

		} else {
		// No data posted means enter view, retrieve any existing info and present them
			$modelName = str_replace('-','\\',$modelParam);
			$fields = Model::create(array($modelName))->generators;
			$examples = Model::fill($fields);
			$generators = \dummy_data\models\Data::listGenerators();
		}
		return compact(
			'modelName','modelParam','fields','examples','generators','success','created'
		);
	}
}