<?php
/**
 * feature
 * @package nonproflite
 */

// get feature image
$defaultImg = get_template_directory_uri() . '/assets/img/default-feature.jpg';
$featureImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

?>

<!-- feature image -->
<div class="container-fluid-feature">

	<!-- feature image -->
	<div class="fullImgWrap">
		<?php /* start feature if */ if (has_post_thumbnail()) : ?>
			<?php echo '<div class="fullImg" style="background-image: url(' . $featureImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>';
		else :
			echo '<div class="fullImg" style="background-image: url(' . $defaultImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>';
			?>
		<?php /* end feature if */ endif; ?>
	</div> <!-- feature image -->

</div> <!-- feature image -->