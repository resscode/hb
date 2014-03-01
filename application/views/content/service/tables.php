<?php foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<?php echo $topMenu; ?>
<div class="container">
    <h1><?php echo $title; ?></h1>
    <?php echo $output; ?>
</div> 
