console.log('ts connected...');
// animsition
// $(".animsition").animsition({
// 	inDuration: 1500,
// 	outDuration: 800
// });
// image hover
$(document).on("mouseenter", ".tile", function () {
    $(this).find(".tile-colour").toggle();
});
$(document).on("mouseleave", ".tile", function () {
    $(this).find(".tile-colour").toggle();
});
