<?php
// pr($logs);
?>
<div class="container">
	<fieldset>
		<h3>Tests Logs</h3>
		<?php foreach($logs as $log): ?>
			<div class="loglist">
				<p>				
					Email: <strong class="text-maroon"><?= $log['email'] ?></strong> <br />
					IP: <?= $log['ip'] ?> <br />
					Test: <strong><?= ($log['mode'] == 'address')?"Address":"Serial Number"; ?></strong><br />
					Score: <strong><?= $log['score'] ?></strong> <br />					
				</p>
				<?php if(!empty($log['results'])): ?>
				<ol>
					<?php foreach($log['results'] as $result): ?>
						<li>
							<strong class="text-red">Answer:</strong> <?= ($log['mode'] == 'address')?$result['post_address']:$result['post_serial']; ?><br />
							<strong class="text-green">Correct:</strong> <?= ($log['mode'] == 'address')?$result['text_address']:$result['text_serial']; ?><br />
							<strong>Wav:</strong> <?= $result['wav'] ?><br />
							<strong class="text-blue">Played:</strong> <?= $result['played'] ?>
						</li>
					<?php endforeach; ?>
				</ol>
				<?php else: ?>
				<p>--NONE--</p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		<br />
		<p><a href="<?= $site_url; ?>/logs.php" class="btn btn-primary here"><< Back </a></p>
	</fieldset>
</div>
<br /><br />