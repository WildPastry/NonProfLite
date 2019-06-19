<?php
/**
 * header
 * @package nonproflite
 */

// get site title
$blog_title = get_bloginfo('name');

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

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="Non-Prof Lite - Custom Wordpress Theme">
	<meta name="description" content="Non-Prof Lite - Non-Prof Lite is a user-friendly and free WordPress theme">
	<meta name="keywords" content="one-column, flexible-header, accessibility-ready, custom-colors, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, slideshow, map-support">
	<title><?php echo $blog_title ?> | <?php the_title(); ?></title>
	<?php wp_head(); ?>
</head> <!-- head -->

<body <?php body_class(); ?>>

	<!-- logo -->
	<div class="logoWrap">
		<a title="<?php the_title(); ?>" href="<?php echo $url; ?>">
			<img src="<?php echo $custom_logo; ?>" />
		</a>
	</div> <!-- logo -->

	<!-- master container -->
	<div class="container-fluid-master">