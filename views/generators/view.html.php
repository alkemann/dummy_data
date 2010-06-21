<h2><?=$class?></h2>
<dl>
<dt>&lt;Generator method></dt><dd>&lt;Example></dd>
<?php foreach ($methods as $full => $method) : ?>
	<dt><?=$method?></dt>
	<dd><?=$examples[$method]?></dd>
<?php endforeach?>
</dl>
