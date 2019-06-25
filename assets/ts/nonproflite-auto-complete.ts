console.log('ts auto complete connected...');

// variables
var input: any = document.getElementById('locationInput');
console.log(input);
console.log(input.value);

// autocomplete
function init() {
	// var options = {
	// 	types: ['(cities)']
	// };
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.setFields(
		['geometry', 'name']);
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		myLat = place.geometry.location.lat();
		myLng = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', init);