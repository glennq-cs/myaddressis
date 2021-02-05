<?php
//
?>
<div class="container">    
      <fieldset>
        <form action="" method="POST" name="dataset" onsubmit="javascript: return requiredDataSet('addressDataSet')">
        	<input type="hidden" name="mode" value="address">
            <input type="hidden" name="queue" value="0">
        	<label style="font-size: 16px">Data Set: </label>
        	<select id="addressDataSet" name="dataset" required="true">
        		<option value="none">--Select Data Set--</option>
        		<?php foreach($config['data_sets'] as $key => $val): ?>
        		<option value="<?= $key ?>"><?= $val ?></option>
        		<?php endforeach;?>
        	</select>
        	<br /><br />
        	<button class="btn btn-primary">Run Tests Again</button>
        	<a href="<?= $site_url ?>" class="btn btn-primary here">Back to Main Menu</a>
        </form>
      </fieldset>
</div>      
