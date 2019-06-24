console.log('ts admin connected...');

/* social media icons */
var fbIcon = document.getElementById('fbIcon');
var twIcon = document.getElementById('twIcon');
var inIcon = document.getElementById('inIcon');
var piIcon = document.getElementById('piIcon');
var yoIcon = document.getElementById('yoIcon');
// console.log(fbIcon);
// console.log(twIcon);
// console.log(inIcon);
// console.log(piIcon);
// console.log(yoIcon);

// var fbLink = fbIcon.href;
// console.log(fbLink);

// var myButton = document.getElementById('sub-accordion-section-social_media_icons');
// console.log(myButton);
var fbLink = fbIcon.getAttribute('href');
console.log(fbLink);

if (fbLink === "") {
	console.log('blank');
	// fbIcon.removeClass('showIcon');
	fbIcon.className += ' hideIcon';
} else {
	console.log('link working with refresh');
	fbIcon.className += ' showIcon';
	// fbIcon.removeClass('hideIcon');
	// fbIcon.addClass('showIcon');
}

console.log(fbLink);
/* display social media function */
