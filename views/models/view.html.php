<h2><?=$model?></h2>
<h4>Feilds and their generators</h4>
<dl>
<?php foreach ($fields->data() as $field => $generator) : ?>
	<dt><?=$field?></dt>
	<dd><?=$generator?> &nbsp;</dd>
<?php endforeach; ?>
</dl>
<h4>Example generation</h4>
<dl>
<?php foreach ($example as $field => $value) : ?>
<dt><?=$field?></dt>
<dd><?=$value?> &nbsp;</dd>
<?php endforeach; ?>
</dl>
<?php
#dd($data);
?>

