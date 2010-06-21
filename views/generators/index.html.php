<h2>Generators</h2>
<ul>
<?php foreach ($classes as $class => $subclasses) : ?>
	<li><?=$class?></li>
	<?php if (!empty($subclasses)) : ?>
	<ul>
		<?php foreach ($subclasses as $subclass) : ?>
			<li><?=$subclass?></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
<?php endforeach; ?>
</ul>

<?php
dd($classes);
