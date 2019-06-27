<?php
/**
 * slideshow
 * @package nonproflite
 */

// get slideshow count
$slide = get_theme_mod('add_slide_setting');
$slideCount = $slide + 1;
?>

<!-- feature slideshow -->
<div class="container-fluid-feature">

	<div id="homePageSlider" class="carousel slide carousel-slide" data-ride="carousel">

		<!-- slideshow indicators -->
		<ol id="indicators" class="carousel-indicators">
			<?php for ($i = 1; $i < $slideCount; $i++) {
				if ($i == 1) {
					echo '<li data-target="#homePageSlider" data-slide-to="' . $slideCount . '" class="active"></li>';
				} else {
					echo '<li data-target="#homePageSlider" data-slide-to="' . $slideCount . '"></li>';
				}
			}
			?>
		</ol>

		<!-- inner slideshow loop -->
		<div class="carousel-inner fullImgWrap">

			<?php
			$default_slide = get_template_directory_uri() . '/assets/img/default-slide.jpg';

			// theme mod loop
			for ($i = 1; $i < $slideCount; $i++) {
				$all_slides = array(
					$featured_slide = get_theme_mod('featured_slide_' . $i . '_setting'),
				);
				if ($featured_slide == "") : $featured_slide = $default_slide;
				endif;

				// display loop
				if ($i == 1) {
					echo '<div class="carousel-item active fullImg embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				} else {
					echo '<div class="carousel-item fullImg embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				}
			}
			?>

		</div> <!-- inner slideshow -->

		<!-- slideshow controls -->
		<a class="carousel-control-prev" href="#homePageSlider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#homePageSlider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

</div> <!-- feature slideshow -->