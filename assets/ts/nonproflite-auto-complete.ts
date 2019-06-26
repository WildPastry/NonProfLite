console.log('ts auto complete connected...');

// variables
var input: any = document.getElementById('locationInput');
var latValue: any = document.getElementById('latValue');
var lngValue: any = document.getElementById('lngValue');
var latLngValues: any[] | number[] = [];

var myLat = -43.5321;
var myLng = 172.6362;

console.log(myLat);
console.log(myLng);

console.log(latValue);
console.log(lngValue);

// autocomplete
function init() {
	latLngValues = [];
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.setFields(['geometry', 'name']);
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		myLat = place.geometry.location.lat();
		myLng = place.geometry.location.lng();
		console.log(myLat);
		console.log(myLng);
		console.log(input.value);
		console.log(latValue);
		console.log(lngValue);
		latLngValues.push(myLat);
		latLngValues.push(myLng);
		console.log(latLngValues);
		var myFinalLat = parseFloat(latLngValues[0]);
		var myFinalLng = parseFloat(latLngValues[1]);

		console.log(myFinalLat);
		console.log(myFinalLng);

		console.log(latLngValues);
		latValue.value = + myFinalLat;
		lngValue.value = + myFinalLng;
	});
}
google.maps.event.addDomListener(window, 'load', init);
