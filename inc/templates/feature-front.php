<?php
/**
 * feature front
 * @package nonproflite
 */

// get feature image
$defaultImg = get_template_directory_uri() . '/assets/img/default-home-feature.jpg';
$featureImg = get_theme_mod('featured_image_setting');

// set default if image is empty
if ($featureImg == "") : $featureImg = $defaultImg;
endif;
?>

<!-- feature image -->
<div class="container-fluid-feature">

	<!-- feature image -->
	<div class="fullImgWrap">
			<?php echo '<div class="fullImg" style="background-image: url(' . $featureImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>';
			?>
	</div> <!-- feature image -->

</div> <!-- feature image -->