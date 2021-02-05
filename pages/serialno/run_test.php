<?php
//
?>
<div class="container">    
      <fieldset>
        <form action="" method="POST" onSubmit="javascript: return requiredTxtAddress();">
        	<input type="hidden" name="mode" value="serialno">
            <input type="hidden" name="queue" value="0">
        	<p>Test using serial numbers.</p>
        	<br />
        	<button class="btn btn-primary">Run Tests Again</button>
        	<a href="<?= $site_url ?>" class="btn btn-primary here">Back to Main Menu</a>
        </form>
      </fieldset>
</div>      
