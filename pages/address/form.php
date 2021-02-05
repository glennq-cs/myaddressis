<?php
// pr($addresses);
?>  
  <div class="container">    
    <fieldset>
      <h3>Tests #<?= $queue ?> - <span class="text-red"><?= $dataname; ?></span></h3>

      <p><small>Keyboard shortcut:<br>
      [Enter]to play [Tab]Type Start of Address, Highlight Correct Address [Tab][Enter]</small>
      </p>

      <button id="audioPlayer" 
        class="btn btn-primary" 
        onclick="
          javascript: document.getElementById('audo').play();
            var p = document.getElementById('played');
            p.value = parseInt(p.value) + 1;
        "
        tabindex=1
      >
        Play Audio
      </button>
      <audio id='audo'>
        <source src="/files/wav/<?= $addresses[$queue][1] ?>" type='audio/wav'>
        <p>Your user agent does not support the HTML5 Audio element.</p>
      </audio>
      
      <br />
      <form action="" method="POST" onSubmit="javascript: return requiredTxtAddress();">
        <input type="hidden" value="<?= $queue ?>" name="queue" />
        <input name="played" value="0" id="played" type="hidden"/>        
        <p>Press Play and enter the Address below then press Return or next</p>
        <div id="locationField">
          <input id="autocomplete" placeholder="Enter your address"
            onFocus="geolocate()" type="text" onkeypress="if(event.keyCode == 13){return false;}" 
            name="full_address" required="true"
            tabindex=2 >
          </input>
        </div>

        <table id="address">
          <tr>
            <td class="label">Street address</td>
              <td class="slimField">
                <input class="field" id="street_number" disabled="true" name="street_number"></input>
              </td>
              <td class="wideField" colspan="2">
                <input class="field" id="route" disabled="true" name="route"></input>
              </td>
          </tr>
          <tr>
            <td class="label">City</td>
            <!-- Note: Selection of address components in this example is typical.
              You may need to adjust it for the locations relevant to your app. See
              https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
            -->
            <td class="wideField" colspan="3">
              <input class="field" id="locality" disabled="true" name="city"></input>
            </td>
          </tr>
          <tr>
            <td class="label">State</td>
              <td class="slimField">
                <input class="field" id="administrative_area_level_1" disabled="true" name="state"></input>
              </td>
              <td class="label">Zip code</td>
              <td class="wideField">
                <input class="field" id="postal_code" disabled="true" name="zip_code"></input>
              </td>
          </tr>
          <tr>
            <td class="label">Country</td>
            <td class="wideField" colspan="3">
              <input class="field" id="country" disabled="true" name="country"></input>
            </td>
          </tr>
        </table>
        <br/>
        <input type="hidden" value="<?= $minutes ?>" id="minutes" name="minutes"/>
        <input type="hidden" value="<?= $seconds ?>" id="seconds" name="seconds"/>
          
        <button class="btn btn-primary next" tabindex=3>Next >></button>

        <?php if($queue > 1): ?>
          <button class="btn btn-primary next" name="finish" value="done" style="margin-right: 10px" tabindex=4>Finish</button>
        <?php endif; ?>
         
      </form>
      <h3 class="pull-left">ID #<?= $addresses[$queue][0] ?></h3>
    </fieldset>
  </div>
  <br /><br /><br />

<script type="text/javascript">
  var minutesTxt = document.getElementById("minutes");
  var secondsTxt = document.getElementById("seconds");
  var totalMinutes = minutesTxt.value;
  var totalSeconds = secondsTxt.value;
  setInterval(setTime, 1000);

  function setTime()
  {
    ++totalSeconds;
    secondsTxt.value = pad(totalSeconds%60);
    var minutes = pad(parseInt(totalSeconds/60));
    minutesTxt.value = parseInt(minutes) + parseInt(totalMinutes);      
  }
    function pad(val)
  {
    var valString = val + "";
    if(valString.length < 2)
    {
      return "0" + valString;
    }
    else
    {
      return valString;
    }
  }

  // focus
  document.getElementById("audioPlayer").focus();
</script>  