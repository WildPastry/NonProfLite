console.log('ts connected...');
// image hover
$(document).on("mouseenter", ".tile", function () {
    $(this).find(".tile-colour").toggle();
});
$(document).on("mouseleave", ".tile", function () {
    $(this).find(".tile-colour").toggle();
});
