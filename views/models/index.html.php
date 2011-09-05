<h2>List models</h2>
<ul>
<?php
foreach ($models as $model) {
	echo '<li>'.$this->html->link($model, array(
		'action' => 'fill',
		'args' => array(str_replace('\\','-',$model))
	)).'</li>';
}
?>
</ul>