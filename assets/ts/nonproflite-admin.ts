console.log('ts admin connected...');

/* social media icons */
var fbIcon = document.getElementById('fbIcon');
var twIcon = document.getElementById('twIcon');
var inIcon = document.getElementById('inIcon');
var piIcon = document.getElementById('piIcon');
var yoIcon = document.getElementById('yoIcon');

// getting href links
var fbLink = fbIcon.getAttribute('href');
var twLink = twIcon.getAttribute('href');
var inLink = inIcon.getAttribute('href');
var piLink = piIcon.getAttribute('href');
var yoLink = yoIcon.getAttribute('href');

// loop to show icons once link entered
if (fbLink === "") {
	fbIcon.className += ' hideIcon';
} else {
	fbIcon.className += ' showIcon';
}
if (twLink === "") {
	twIcon.className += ' hideIcon';
} else {
	twIcon.className += ' showIcon';
}
if (inLink === "") {
	inIcon.className += ' hideIcon';
} else {
	inIcon.className += ' showIcon';
}
if (piLink === "") {
	piIcon.className += ' hideIcon';
} else {
	piIcon.className += ' showIcon';
}
if (yoLink === "") {
	yoIcon.className += ' hideIcon';
} else {
	yoIcon.className += ' showIcon';
}
