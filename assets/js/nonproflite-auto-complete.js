console.log('ts auto complete connected...');
// variables
var input = document.getElementById('locationInput');
console.log(input);
console.log(input.value);
var myLat = -43.5321;
var myLng = 172.6362;
console.log(myLat);
console.log(myLng);
// autocomplete
function init() {
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setFields(['geometry', 'name']);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        myLat = place.geometry.location.lat();
        myLng = place.geometry.location.lng();
    });
    console.log(myLat);
    console.log(myLng);
    console.log(input.value);
}
google.maps.event.addDomListener(window, 'load', init);
