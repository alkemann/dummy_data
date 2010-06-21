<?php
/**
 * Routes for the Dummy Data plugin
 */

use \lithium\net\http\Router;

Router::connect('/dummy_data', array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'index'
));
Router::connect('/dummy_data/view/{:args}', array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'view'
));

