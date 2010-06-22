<h2><?=$model?></h2>
<h4>Feilds and their generators</h4>

<?php 
echo $this->form->create(null, array('url' => array(
	'plugin' => 'dummy_data',
	'controller' => 'models',
	'action' => 'fill'
)));
?>
<dl>
<?php 
foreach ($fields->data() as $field => $generator) : 
	if ($field == '_id' || $field == 'id') continue;
?>
	<dt><?=$field?></dt>
	<dd><?=$this->special->select($field, $generators)?></dd>
<?php endforeach; ?>
<dt>Generate how many new records?</dt><dd>
<?php 
echo $this->form->hidden('model', array('value' => $model));
echo $this->special->radio('count', array('value' => 1,'id' => 'count1', 'label' => 'One', 'checked' => true));
echo $this->special->radio('count', array('value' => 10,'id' => 'count1', 'label' => 'Ten'));
echo $this->special->radio('count', array('value' => 50,'id' => 'count1', 'label' => 'Fifty'));
?>
</dl>
<?php
echo $this->form->submit('Generate and save new records');
echo $this->form->submit('Refresh examples', array('name' => 'refresh'));
echo $this->form->end();
?>
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

#dd($generators);
?>

