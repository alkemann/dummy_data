<h2>Filling</h2>
<h3><?=$model?></h3>
<h4 style="color:<?=($success)?'green':'red';?>">
 <?=($success)?'SUCCESS':'FAIL';?>
</h4>
<h3>Generated data (read back from data source)</h3>
<ul>
<?php 
$modelArr = explode('\\',$model);
#$plugin = reset($modelArr);
$controller = end($modelArr);
$controller = strtolower(\lithium\util\Inflector::pluralize($controller));
foreach ($created->data() as $doc) {
	echo '<li>'.$this->html->link($doc['_id'], array(
#		'plugin' => $plugin,
		'controller' => $controller,
		'action' => 'view',
		'args' => array($doc['_id'])
	)).'</li>';
	echo '<ul>';
	foreach ($doc as $field => $value) : 
		if ($field == 'id' || $field == '_id') continue;
	?>
		<li>
			<dl><dt><?=$field?></dt><dd><?=$value?></dd></dl>
		</li>
<?php endforeach; 
	echo '</ul>';
}?>
</ul>
