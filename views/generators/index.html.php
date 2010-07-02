<h2>Generators</h2>
<ul>
<?php foreach ($classes as $class => $subclasses) : ?>
	<li><?=$this->html->link($class, array('controller' => 'generators', 'action' => 'view', 'args' => array($class)))?></li>
	<?php if (!empty($subclasses)) : ?>
	<ul>
		<?php foreach ($subclasses as $subclass) : ?>
			<li><?=$this->html->link($subclass, array('controller' => 'generators', 'action' => 'view', 'args' => array($subclass)))?></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
<?php endforeach; ?>
</ul>