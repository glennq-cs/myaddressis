<?php

?>  
<div class="container">    
    <fieldset>
        <h3>Test Address</h3>
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
        	<button class="btn btn-primary next">BEGIN</button>  
        </form>
    </fieldset>

    <br />
	<fieldset>
        <h3>Test Serial numbers</h3>
        <form action="" method="POST" onSubmit="javascript: return requiredDataSet('serialnoDataSet');">
        	<input type="hidden" name="mode" value="serialno">
            <input type="hidden" name="queue" value="0">
        	<p>Test using serial numbers.</p>
            <select id="serialnoDataSet" name="dataset" required="true">
                <option value="none">--Select Data Set--</option>
                <?php foreach($config['serial_no'] as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach;?>
            </select>
        	<button class="btn btn-primary next">BEGIN</button>          
        </form>
    </fieldset>

    <br />
	<fieldset>
        <h3>Practice mode</h3>        	
        <form action="" method="POST" onsubmit="javascript: return requiredDataSet('practiceModeDataset')">
        	<input type="hidden" name="mode" value="practice" />
        	<input type="hidden" name="queue" value="0">
            <label style="font-size: 16px">Data Set: </label>
            <select id="addressDataSet" name="dataset" required="true">
                <option value="none">--Select Data Set--</option>
                <?php foreach($config['data_sets'] as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach;?>
            </select>
        	<button class="btn btn-primary next">BEGIN</button>          
        </form>
    </fieldset>
</div>