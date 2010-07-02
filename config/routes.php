<?php
/**
 * Routes for the Dummy Data plugin
 */

use \lithium\net\http\Router;

Router::connect('/dummy_data/{:controller}/{:action}/{:args}', array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'index'
), array('persist' => array('plugin','controller')));
?>