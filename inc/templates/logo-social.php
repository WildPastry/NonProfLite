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

// social media
$facebookIcon = get_theme_mod('facebook_icon_setting');
$twitterIcon = get_theme_mod('twitter_icon_setting');
$instagramIcon = get_theme_mod('instagram_icon_setting');
$pinterestIcon = get_theme_mod('pinterest_icon_setting');
$youtubeIcon = get_theme_mod('youtube_icon_setting');

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
			<a href="http://localhost/practice-work/pit-rescue/cart/" class="cartIcon"></a>
			<a id="fbIcon" target="_blank" href="<?php echo $facebookIcon ?>" class="facebook hideIcon"></a>
			<a id="twIcon" target="_blank" href="<?php echo $twitterIcon ?>" class="twitter hideIcon"></a>
			<a id="inIcon" target="_blank" href="<?php echo $instagramIcon ?>" class="instagram hideIcon"></a>
			<a id="piIcon" target="_blank" href="<?php echo $pinterestIcon ?>" class="pinterest hideIcon"></a>
			<a id="yoIcon" target="_blank" href="<?php echo $youtubeIcon ?>" class="youtube hideIcon"></a>
		</div> <!-- social -->

	</div>
</div> <!-- header -->