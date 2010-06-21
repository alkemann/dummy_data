<h2><?=$model?></h2>
<h4>Feilds and their generators</h4>
<dl>
<?php foreach ($fields->data() as $field => $generator) : 
	if ($field == '_id' || $field == 'id') continue;
?>
	<dt><?=$field?></dt>
	<dd><?=$generator?> &nbsp;</dd>
<?php endforeach; ?>
</dl>
<h4>Actions</h4>
<ul>
<li style="display:inline;"><?=$this->html->link('Fill one', array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'fill',
	'args' => array(str_replace('\\','-',$model), 1)
))?></li>

<li style="display:inline;"><?=$this->html->link('Fill ten', array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'fill',
	'args' => array(str_replace('\\','-',$model), 10)
))?></li>
</ul>
<h4>Example generation</h4>
<dl>
<?php foreach ($example as $field => $value) :  
	if ($field == '_id' || $field == 'id') continue;
?>
<dt><?=$field?></dt>
<dd><?=$value?> &nbsp;</dd>
<?php endforeach; ?>
</dl>
<?php
#dd($data);
?>

