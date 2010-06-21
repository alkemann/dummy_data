<h2>List models</h2>
<ul>
<?php
foreach ($models as $model) {
	echo '<li>'.$this->html->link($model, array(
		'plugin' => 'dummy_data',
		'controller' => 'models', 
		'action' => 'view', 
		'args' => array(str_replace('\\','-',$model))
	)).'</li>';
}
?>
</ul>
