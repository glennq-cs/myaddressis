<?php
// pr($addresses);
?>  
  <div class="container">    
    <fieldset>
      <h3>Tests #<?= $queue ?></h3>      
      <br />

      <form action="" method="POST" onSubmit="javascript: return requiredTxtAddress();">
        <input type="hidden" value="<?= $queue ?>" name="queue" >
        <p>Press Play</p>
        <p><strong>Address:</strong> <?= $addresses[$queue][4] ?>
        <p><strong>Wav file:</strong> <?= $addresses[$queue][1] ?>  
        <div></div>        
        <a href="<?= $site_url ?>" class="btn btn-primary next here" style="color: #666" tabindex=3>Exit</a>
        <button class="btn btn-primary next" style="margin-right: 10px" tabindex=2>Next >></button>
      </form>
        <audio id='audo'>
          <source src="/files/wav/<?= $addresses[$queue][1] ?>" type='audio/wav'>
          <p>Your user agent does not support the HTML5 Audio element.</p>
        </audio>
        <button id="audioPlayer" 
          class="btn btn-primary next here"
          onclick="javascript: document.getElementById('audo').play()" 
          tabindex=1
          style="margin-right: 10px"
        >
          Play
        </button>
      
      <h3 class="pull-left">ID #<?= $addresses[$queue][0] ?></h3>
    </fieldset>
  </div>
  <br /><br /><br />

<script type="text/javascript">
  // focus
  document.getElementById("audioPlayer").focus();
</script>  