// This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.

        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {
              types: ['geocode'],
              componentRestrictions: {country: "au"}
            });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() { 
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              country: 'AU',
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }

function beforeSubmit()
{
  for(var component in componentForm) {
    document.getElementById(component).disabled = false;
  }

  return true;
} 

function requiredTxtAddress() {
  
  var txtaddress = document.getElementById('autocomplete');

  if(txtaddress.value == "") {
    alert('Please enter your address.');
    txtaddress.focus();
    return false;
  }

  beforeSubmit();

  return true;

}

function requiredTxtEmail()
{
  var txtemail = document.getElementById('txtEmail');

  if(txtemail.value == "") {
    alert("Please enter valid email address");
    return false;
  } else {
    if(/^\w+([\.-]?\ w+)*@\w+([\.-]?\ w+)*(\.\w{2,3})+$/.test(txtemail.value)) {
      return true;
    } else {
      alert("You have entered an invalid email address!");
      return false;  
    }
  }
  return true;
}

function requiredDataSet(SelectDataSet)
{
  var dataset = document.getElementById(SelectDataSet);

  if(dataset.value == "none") {
    alert("Please select data set.");
    dataset.focus();
    return false;
  }

  return true;
}