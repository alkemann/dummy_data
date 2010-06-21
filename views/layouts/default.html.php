<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Application > <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('debug', 'lithium')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
<style> 
#header li {display: inline;}
</style>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1>Dummy Data Generator</h1>
			<ul>
				<li><?=$this->html->link('List Models', '/dummy_data');?></li>
			</ul>
			<hr>
		</div>
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
	</div>
<?php display_debugging(); ?>
</body>
</html>
