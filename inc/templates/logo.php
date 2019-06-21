<?php
/**
 * logo
 * @package nonproflite
 */

// custom logo
$custom_logo_size = get_theme_mod('custom_logo');
$custom_logo = wp_get_attachment_image_src($custom_logo_size, $defaults);
$default_logo = get_template_directory_uri() . '/assets/img/default-logo.jpg';
if ($custom_logo == "") : $custom_logo = $default_logo;
else : $custom_logo = $custom_logo[0];
endif;

// home url
$url = home_url();

?>

<!-- header -->
<div class="headerWrap">
	<div class="headerWrapFlex">

		<!-- logo -->
		<div class="logoWrap">
			<a title="<?php the_title(); ?>" href="<?php echo $url; ?>">
				<img src="<?php echo $custom_logo; ?>" />
			</a>
		</div> <!-- logo -->

		<!-- social -->
		<div class="socialWrap">
		<!-- <a href="#" class="donate">DONATE</a> -->
			<a href="#" class="heart"></a>
			<a href="#" class="twitter"></a>
			<a href="#" class="facebook"></a>
			<a href="#" class="instagram"></a>
			<a href="#" class="youtube"></a>
		</div> <!-- social -->

	</div>
</div> <!-- header -->