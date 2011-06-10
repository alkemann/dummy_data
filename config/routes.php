<?php
/**
 * Routes for the Dummy Data plugin
 */

use \lithium\net\http\Router;

Router::connect('/dummy/{:controller}/{:action}/{:args}', array(
		'library' => 'dummy_data',
		'controller' => 'models',
		'action' => 'index'
	), 
	array('persist' => array('library', 'controller'))
);

/**/
