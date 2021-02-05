<?php
// pr($stats);
?>
<div class="container">
	<fieldset>
		<h3>Statistics</h3>
		<table class="stats">
			<thead>
				<tr>
					<th>Filename</th>
					<th>Correct</th>
					<th>Wrong</th>
					<th>Total Plays</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($stats as $key => $stat): ?>
				<tr>
					<td><?= $key ?></td>
					<td class="text-center"><?= $stat['correct']?></td>
					<td class="text-center"><?= $stat['wrong']?></td>
					<td class="text-center"><?= $stat['wrong'] + $stat['correct'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
		</table>
	</fieldset>
</div>	
