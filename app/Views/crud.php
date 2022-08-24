<?php
foreach ($css_files as $file) : ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1><?= $table; ?></h1>
			<div style='height:20px;'></div>
			<div style="padding: 10px">
				<?php echo $output; ?>
			</div>
			<?php foreach ($js_files as $file) : ?>
				<script src="<?php echo $file; ?>"></script>
			<?php endforeach; ?>
		</div>
	</div>
</div>