<?php
// pr($addresses);
?>  
  	<div class="container">    
      <fieldset>
        <form action="" method="POST" onSubmit="javascript: return requiredTxtEmail();">
          <input type="hidden" name="minutes" value="<?= $minutes ?>"/>
          <input type="hidden" name="seconds" value="<?= $seconds ?>"/>
        	<h5>
        		Please enter your email address: <input type="text" id="txtEmail" name="email" placeholder="Enter email address" required="true">
        		<input type="hidden" value="done" name="finish" />
        	</h5>
          <button class="btn btn-primary next" name="finish" value="done">Show Results</button>
        </form>
    </fieldset>
  </div>