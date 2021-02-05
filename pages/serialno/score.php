<?php
$site_url = "http://{$_SERVER['HTTP_HOST']}";
?>
<div class="container">    
      <fieldset>
        <h3>You Scored <?= (int)$queue - (int)$total_results ?> out of <?= (int)$queue ?></h3>
        <p><small>Time: <?= $minutes ?> min <?= $seconds ?> sec (avg <?= $avg ?> sec)</small></p>
        <?php if(!empty($results)): ?>
            <p>Incorrect Address were</p>
            <?php foreach($results as $key => $result): ?>
            	<small>
    	        	<strong>You entered: </strong> <?= $result['post_serial'] ?>
    	        	<br />
    	        	<strong>Correct Serial Number: </strong> <?= $result['text_serial'] ?>
    	        	<br />
                    <audio id='audo_<?=$key?>'>
                        <source src="/files/wav/<?= $result['wav'] ?>" type='audio/wav'>
                        <p>Your user agent does not support the HTML5 Audio element.</p>
                    </audio>
    	        	Click <a href="javascript: void(0)" class="here" onclick="javascript: document.getElementById('audo_<?=$key?>').play()"><strong>here</strong></a> to listen to the file again
                    &nbsp;|&nbsp;
                    Click <a href="<?= $site_url ?>/create_text_serialno.php?id=<?= $key ?>" class="here" target="__blank"><strong>here</strong></a> to Challenge the Results    	        	
            	</small>
            	<br /><br />
        	<?php endforeach;?>
        <?php else: ?>
            <p>Congratulation! You have no errors.</p>
        <?php endif;?>
        <form action="" method="post" id="RunTestAgain">
            <input type="hidden" name="mode" value="serialno">
            <input type="hidden" name="queue" value="0">
	    <input type="hidden" name="dataset" value="<?= $mode ?>">
    	    <a href="javascript: document.getElementById('RunTestAgain').submit()" class="here"><small>Run Tests Again</small></a>
            &nbsp;
            <a href="<?= $site_url ?>" class="here"><small>Back to Main Menu</small></a>
        </form>
            
      </fieldset>
</div>      
