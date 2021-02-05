<?php
// pr($logs); exit;
?>
<div class="container">
	<fieldset>
		<h3>Tests Logs</h3>
		<ol class="listdate">
			<?php foreach($logs as $val): ?>
				<li>
					<a href="<?= $site_url; ?>/logs.php?logs=<?= $val['filename'] ?>" class="listdate"><?= $val['date'] ?></a>
				</li>
			<?php endforeach;?>
		</ol>
	</fieldset>
</div>	
