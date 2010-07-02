<h2>Filling</h2>
<h3><?=$modelName?></h3>
<?php if (!is_null($success)) { ?>
<h4 style="color:<?=($success)?'green':'red';?>">
 <?=($success)?'SUCCESS':'FAIL';?>
</h4>
<h3>Generated data (read back from data source)</h3>
<ul>
<?php
$modelArr = explode('\\',$modelName);
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
<?php } else {

echo $this->form->create(null, array('url' => array(
	'action' => 'fill',
	'args' => array($modelParam)
)));
?>
<dl>
<dt>Generate how many new records?</dt><dd>
<?php
echo $this->form->hidden('model', array('value' => $modelName));
echo $this->special->radio('count', array(
	'value' => 1,'id' => 'count1', 'label' => 'One', 'checked' => true
));
echo $this->special->radio('count', array('value' => 5,'id' => 'count1', 'label' => 'Five'));
echo $this->special->radio('count', array('value' => 10,'id' => 'count1', 'label' => 'Ten'));
?></dd>
<dt>&nbsp;</dt><dd>
<?=$this->form->submit('Generate and save new records'); ?>
<?=$this->form->submit('Refresh examples', array('name' => 'refresh')); ?>
<hr>
</dd>
<?php
foreach ($fields as $field => $generator) :
	if ($field == '_id' || $field == 'id') continue;
?>
	<dt><?=$field?></dt>
	<dd>
		<?=$this->special->select($field, $generators, array('value' => $generator))?>
		<span>example: <?=$examples[$field]?></span>
		<hr>
	</dd>
<?php endforeach; ?>
</dl>
<?php
echo $this->form->end();

} ?>