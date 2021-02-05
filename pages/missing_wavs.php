<?php
//
?>
<div class="container">
	<fieldset>
		<h3>Missing Wav Files</h3>
		<?php foreach($missingwav as $val): ?>
			<h4><?= $val['name'] ?></h4>
			<?php if(isset($val['missing'])): ?>
				<ol>
				<?php foreach($val['missing'] as $v): ?>
					<li>
						<small><strong>ID:</strong> <?= $v['id'] ?></small><br />
						<small><strong>Wav:</strong> <?= $v['missing_wav'] ?></small>
					</li>
				<?php endforeach; ?>
				</ol>
			<?php else: ?>
				<small>--None--</small>
			<?php endif; ?>
		<?php endforeach;?>
	</fieldset>
</div>	
