<h2><?=$model?></h2>
<?=$this->html->link('Fill it', array(
	'action' => 'fill',
	'args' => array($modelParam)
)); ?>
<h4>Feilds and their generators</h4>
<dl>
<?php
foreach ($fields as $field => $generator) :
	if ($field == '_id' || $field == 'id') continue;
?>
	<dt><?=$field?></dt>
	<dd>
		<?=$generator?><br />
		<small>example:  <?=$example[$field]?></small>
	</dd>
<?php endforeach; ?>
</dl>