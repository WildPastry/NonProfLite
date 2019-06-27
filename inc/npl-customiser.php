<?php
/**
 * customiser
 * @package nonproflite
 */

function npl_customize_register($wp_customize)
{
	// remove default options –––––––––––––––––––––––––––––––––––––––––––––––
	// $wp_customize->remove_section('installed_themes'); // Themes // 0
	// $wp_customize->remove_section('title_tagline'); // Site Identity // 20
	// $wp_customize->remove_section('colors'); // Colours // 40
	$wp_customize->remove_section('header_image'); // Header Image // 60
	$wp_customize->remove_section('background_image'); // Background Image // 80
	$wp_customize->remove_section('static_front_page'); // Home Page Settings // 120
	$wp_customize->remove_section('custom_css'); // Additional CSS // 200
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create homepage panel ––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_panel('homepage_panel', array(
		'title'      => 'Home Page Content', 'nonproflite',
		'priority'   => 120,
		'description' => 'Edit the home page content'
	));
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create colours panel –––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_panel('site_colours_panel', array(
		'title'      => 'Site Colours', 'nonproflite',
		'priority'   => 15,
		'description' => 'Edit the site colours'
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create page content panel –––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_panel('page_content_panel', array(
		'title'      => 'General Page Content', 'nonproflite',
		'priority'   => 140,
		'description' => 'Edit general page content'
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// slideshow –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// slideshow section added to homepage panel
	$wp_customize->add_section('featured_slide_section', array(
		'title'      => 'Slideshow', 'non-prof-lite',
		'description' => 'Insert images for the home page slideshow',
		'priority'   => 15,
		'panel' => 'homepage_panel'
	));

	// enable or disable slideshow
	$wp_customize->add_setting('enable_featured_slide_setting', array(
		'default'   => '',
		'priority'   => 5,
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'enable_featured_slide_control',
		array(
			'label'      => 'Enable or Disable Slideshow', 'nonproflite',
			'section'    => 'featured_slide_section',
			'type'           => 'radio',
			'choices'        => array(
				'enable'   => 'Enable',
				'disable'  => 'Disable'
			),
			'settings'   => 'enable_featured_slide_setting',
		)
	));

	// type of slideshow
	$wp_customize->add_setting('type_slide_setting', array(
		'default'   => 'slide',
		'priority'   => 10,
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'type_slide_control',
		array(
			'label'      => 'Type of Slideshow', 'nonproflite',
			'section'    => 'featured_slide_section',
			'type'           => 'radio',
			'choices'        => array(
				'slide'   => 'Slide',
				'fade'  => 'Fade'
			),
			'settings'   => 'type_slide_setting',
		)
	));

	// add or remove slides
	$wp_customize->add_setting('add_slide_setting', array(
		'default'   => '3',
		'priority'  => 15,
		'transport' => 'refresh',
	));

	// slideshow count
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'add_slide_control',
		array(
			'label'      => 'Number of slides', 'nonproflite',
			'section'    => 'featured_slide_section',
			'type'       => 'select',
			'default'   => '3',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10
			),
			'settings'   => 'add_slide_setting',
		)
	));

	// get slideshow count
	$slide = get_theme_mod('add_slide_setting');

	// slideshow loop
	for ($i = 1; $i <= $slide; $i++) {
		$wp_customize->add_setting('featured_slide_' . $i . '_setting', array(
			'default'   => get_template_directory_uri() . '/assets/img/default-slide.jpg',
			'priority'  => 20,
			'transport' => 'refresh',
		));

		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'featured_slide_' . $i . '_control',
			array(
				'label'      => 'Slideshow Image ' . $i, 'non-prof-lite',
				'section'    => 'featured_slide_section',
				'settings'   => 'featured_slide_' . $i . '_setting'
			)
		));
	}
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// featured image ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('featured_image_section', array(
		'title'      => 'Featured Image', 'non-prof-lite',
		'description' => 'Insert a feature image for the home page',
		'priority'   => 20,
		'panel' => 'homepage_panel'
	));

	$wp_customize->add_setting('featured_image_setting', array(
		'default'   => get_template_directory_uri() . '/assets/img/default-home-feature.jpg',
		'priority'   => 10,
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'featured_image_control',
		array(
			'label'      => 'Featured Image', 'nonproflite',
			'description' => 'You must disable the slideshow before this feature will take effect',
			'section'    => 'featured_image_section',
			'settings'   => 'featured_image_setting',
		)
	));

	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// colours –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// background
	$wp_customize->add_section('background_colour_section', array(
		'title'      => 'Site Background', 'nonproflite',
		'priority'   => 5,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('background_colour_setting', array(
		'default'   => '#fff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'background_colour_control',
		array(
			'label'      => 'Set the background colour', 'nonproflite',
			'description' => 'Using this option you can change the background colour of your site',
			'section'    => 'background_colour_section',
			'settings'   => 'background_colour_setting',
		)
	));

	// feature background
	$wp_customize->add_setting('feature_background_colour_setting', array(
		'default'   => '#ffc5e3',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'feature_background_colour_control',
		array(
			'label'      => 'Set the feature background colour', 'nonproflite',
			'description' => 'Using this option you can change the feature background colour of your site',
			'section'    => 'background_colour_section',
			'settings'   => 'feature_background_colour_setting',
		)
	));

	// text
	$wp_customize->add_section('text_colour_section', array(
		'title'      => 'Text', 'nonproflite',
		'priority'   => 10,
		'panel' => 'site_colours_panel'
	));

	// heading text
	$wp_customize->add_setting('heading_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'heading_colour_control',
		array(
			'label'      => 'Set the heading text colour', 'nonproflite',
			'description' => 'Using this option you can change the heading colour throughout your entire site',
			'section'    => 'text_colour_section',
			'settings'   => 'heading_colour_setting',
		)
	));

	// paragraph text
	$wp_customize->add_setting('paragraph_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'paragraph_colour_control',
		array(
			'label'      => 'Set the body text colour', 'nonproflite',
			'description' => 'Using this option you can change the body text colour throughout your entire site',
			'section'    => 'text_colour_section',
			'settings'   => 'paragraph_colour_setting',
		)
	));

	// menu/footer/header colours
	$wp_customize->add_section('menu-footer_colour_section', array(
		'title'      => 'Header / Menu / Footer', 'nonproflite',
		'priority'   => 15,
		'panel' => 'site_colours_panel'
	));

	// menu/footer/header background colours
	$wp_customize->add_setting('menu-footer-bg_colour_setting', array(
		'default'   => '#b74f87',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'menu-footer-bg_colour_control',
		array(
			'label'      => 'Set the menu and footer background colour', 'nonproflite',
			'description' => 'Using this option you can change the background colour of the menu and footer throughout your entire site',
			'section'    => 'menu-footer_colour_section',
			'settings'   => 'menu-footer-bg_colour_setting',
		)
	));

	// menu/footer/header text colours
	$wp_customize->add_setting('menu-footer-text_colour_setting', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'menu-footer-text_colour_control',
		array(
			'label'      => 'Set the menu and footer text colour', 'nonproflite',
			'description' => 'Using this option you can change the text colour of the menu and footer throughout your entire site',
			'section'    => 'menu-footer_colour_section',
			'settings'   => 'menu-footer-text_colour_setting',
		)
	));

	// header bg colour
	$wp_customize->add_setting('header_bg_setting', array(
		'default'   => '#f284bc',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'header_bg_setting',
		array(
			'label'      => 'Set the header background colour', 'nonproflite',
			'description' => 'Using this option you can change the background colour of the header throughout your entire site',
			'section'    => 'menu-footer_colour_section',
			'settings'   => 'header_bg_setting',
		)
	));

	// button colours
	$wp_customize->add_section('buttons_colour_section', array(
		'title'      => 'Buttons', 'nonproflite',
		'priority'   => 25,
		'panel' => 'site_colours_panel'
	));

	// button backgrounds
	$wp_customize->add_setting('buttons_bg_colour_setting', array(
		'default'   => '#00b2ff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'buttons_bg_colour_control',
		array(
			'label'      => 'Set the background colour of the buttons', 'nonproflite',
			'description' => 'Using this option you can change the background colour of all the buttons on your site',
			'section'    => 'buttons_colour_section',
			'settings'   => 'buttons_bg_colour_setting',
		)
	));

	// button text
	$wp_customize->add_setting('buttons_text_colour_setting', array(
		'default'   => '#fff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'buttons_text_colour_control',
		array(
			'label'      => 'Set the text colour of the buttons', 'nonproflite',
			'description' => 'Using this option you can change the text colour of all the buttons on your site',
			'section'    => 'buttons_colour_section',
			'settings'   => 'buttons_text_colour_setting',
		)
	));

	// button hover
	$wp_customize->add_setting('buttons_hover_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'buttons_hover_colour_control',
		array(
			'label'      => 'Set the hover colour of the buttons', 'nonproflite',
			'description' => 'Using this option you can change the background colour when you hover over the buttons on your site',
			'section'    => 'buttons_colour_section',
			'settings'   => 'buttons_hover_colour_setting',
		)
	));

	// social media colours
	$wp_customize->add_section('social_colour_section', array(
		'title'      => 'Social Media Icons', 'nonproflite',
		'priority'   => 30,
		'panel' => 'site_colours_panel'
	));

	// social media backgrounds
	$wp_customize->add_setting('social_bg_colour_setting', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'social_bg_colour_control',
		array(
			'label'      => 'Set the colour of the social media icons', 'nonproflite',
			'description' => 'Using this option you can change the colour of the social media icons on your site',
			'section'    => 'social_colour_section',
			'settings'   => 'social_bg_colour_setting',
		)
	));

	// social media hover
	$wp_customize->add_setting('social_hover_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'social_hover_colour_control',
		array(
			'label'      => 'Set the hover colour of the social media icons', 'nonproflite',
			'description' => 'Using this option you can change the hover colour of the social media icons on your site',
			'section'    => 'social_colour_section',
			'settings'   => 'social_hover_colour_setting',
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// fonts –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('custom_font_section', array(
		'title'      => 'Site Fonts', 'nonproflite',
		'priority'   => 20
	));

	$wp_customize->add_setting('custom_font_setting', array(
		'transport' => 'refresh'
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_font_control',
		array(
			'label'      => 'Set the site font', 'nonproflite',
			'description' => 'Using this option you can change the font throughout your entire site',
			'section'    => 'custom_font_section',
			'settings'   => 'custom_font_setting',
			'type'    => 'select',
			'choices' => array(
				'default' => 'Fira Sans',
				'merriweather' => 'Merriweather',
				'quicksand' => 'Quicksand'
			)
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// custom intro ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('custom_intro_section', array(
		'title'      => 'Custom Intro Text', 'nonproflite',
		'panel' => 'homepage_panel',
		'priority'   => 25
	));

	$wp_customize->add_setting('custom_intro_setting', array(
		'default'   => 'Welcome to CHCH Bull Breed Rescue',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_intro_control',
		array(
			'label'      => 'Change the custom intro heading', 'nonproflite',
			'section'    => 'custom_intro_section',
			'settings'   => 'custom_intro_setting',
		)
	));

	// custom intro paragraph
	$wp_customize->add_setting('custom_intro_para_setting', array(
		'default'   => 'Staffys, Pitbulls, Bullys and their crosses are often over looked because of their looks and media hype. Bull breed dogs are NOT killers. They are loving, loyal, gentle souls that just need the right owner and lots of love.<br><br>

		Christchurch Bull Breed Rescue provides temporary shelter, food, medical attention, and comfort to neglected and rejected dogs. We seek out new homes for these dogs and try to educate the public about the humane care of dogs. We consider the unique needs of all the dogs in our care and work compassionately to prepare a safe, appropriately socialised dog for a wonderful new life.<br><br>

		Through our de-sexing program we try to help prevent dogs ending up in shelters, we do this by de-sexing the dogs in our community producing unwanted litters. Our aim is to reduce the population of unwanted, neglected, and abused bull breed dogs by preventing at risk dogs from producing litters. We approach owners, work with locals and councils to find at risk dogs, as well as helping lower income families ensure they are not adding to the problem by offering payment plans and heavily discounted procedures.<br><br>

		Owning a dog is commonly rated in the top five things to do in life and is very rewarding. If you are thinking about getting a dog or would even like to come view them, just get in touch!',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_intro_para_control',
		array(
			'label'      => 'Change the custom intro text', 'nonproflite',
			'section'    => 'custom_intro_section',
			'settings'   => 'custom_intro_para_setting',
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// custom headings –––––––––––––––––––––––––––––––––––––––––––––––––––––
	// about
	$wp_customize->add_section('custom_headings_section', array(
		'title'      => 'Custom Headings', 'nonproflite',
		'panel' => 'page_content_panel',
		'priority'   => 5
	));

	$wp_customize->add_setting('custom_about_headings_setting', array(
		'default'   => 'All News',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_about_headings_control',
		array(
			'label'      => '"About Page" posts heading', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_about_headings_setting',
		)
	));

	// about info heading
	$wp_customize->add_setting('custom_aboutInfo_headings_setting', array(
		'default'   => 'Pitbull Breed Information',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_aboutInfo_headings_control',
		array(
			'label'      => '"About Page" special information heading', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_aboutInfo_headings_setting',
		)
	));

	// about info text
	$wp_customize->add_setting('custom_aboutInfo_text_setting', array(
		'default'   => 'The Pit Bull Terrier is a companion and family dog breed. Originally bred to “bait” bulls, the breed evolved into farm dogs, and later moved into the house to become “nanny dogs” because they were so gentle around children.',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_aboutInfo_text_control',
		array(
			'label'      => '"About Page" special information text', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_aboutInfo_text_setting',
		)
	));

	// how to help
	$wp_customize->add_setting('custom_help_headings_setting', array(
		'default'   => 'All Dogs',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_help_headings_control',
		array(
			'label'      => '"How To Help Page" posts heading', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_help_headings_setting',
		)
	));

	// front page one
	$wp_customize->add_setting('custom_frontOne_headings_setting', array(
		'default'   => 'Latest News',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_frontOne_headings_control',
		array(
			'label'      => '"Home Page" first posts heading', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_frontOne_headings_setting',
		)
	));

	// front page two
	$wp_customize->add_setting('custom_frontTwo_headings_setting', array(
		'default'   => 'Latest Dogs for Adoption',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_frontTwo_headings_control',
		array(
			'label'      => '"Home Page" second posts heading', 'nonproflite',
			'section'    => 'custom_headings_section',
			'settings'   => 'custom_frontTwo_headings_setting',
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// social media ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('social_media_icons', array(
		'title' => 'Social Media Icons', 'nonproflite',
		'description' => 'Using this option you can add your social media links'
	));

	// facebook
	$wp_customize->add_setting('facebook_icon_setting', array(
		'default' => '',
		'transport' => 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'facebook_icon_control',
			array(
				'label' => 'Facebook', 'nonproflite',
				'section' => 'social_media_icons',
				'settings' => 'facebook_icon_setting',
				'type' => 'input'
			)
		)
	);

	// twitter
	$wp_customize->add_setting('twitter_icon_setting', array(
		'default' => '',
		'transport' => 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'twitter_icon_control',
			array(
				'label' => 'Twitter', 'nonproflite',
				'section' => 'social_media_icons',
				'settings' => 'twitter_icon_setting',
				'type' => 'input',
				'default' => 'default'
			)
		)
	);

	// instagram
	$wp_customize->add_setting('instagram_icon_setting', array(
		'default' => '',
		'transport' => 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'instagram_icon_control',
			array(
				'label' => 'Instagram', 'nonproflite',
				'section' => 'social_media_icons',
				'settings' => 'instagram_icon_setting',
				'type' => 'input'
			)
		)
	);

	// pinterest
	$wp_customize->add_setting('pinterest_icon_setting', array(
		'default' => '',
		'transport' => 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'pinterest_icon_control',
			array(
				'label' => 'Pinterst', 'nonproflite',
				'section' => 'social_media_icons',
				'settings' => 'pinterest_icon_setting',
				'type' => 'input'
			)
		)
	);

	// youtube
	$wp_customize->add_setting('youtube_icon_setting', array(
		'default' => '',
		'transport' => 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'youtube_icon_control',
			array(
				'label' => 'Youtube', 'nonproflite',
				'section' => 'social_media_icons',
				'settings' => 'youtube_icon_setting',
				'type' => 'input'
			)
		)
	);
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// featured posts ––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// $wp_customize->add_section('front_page_section', array(
	//   'title'      => 'Front Page Info', 'nonproflite'),
	//   'priority'   => 25,
	// ));

	$wp_customize->add_setting('featured-post-setting', array(
		'default'   => ' ',
		'transport' => 'refresh',
	));

	$args = array(
		'posts_per_page' => -1
	);

	$allPosts = get_posts($args);

	$options = array();
	$options[''] = 'Please select a post';
	foreach ($allPosts as $singlePost) {
		$options[$singlePost->ID] = $singlePost->post_title;
	}

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'featured-post-control', array(
		'label'      => 'Featured Post', 'nonproflite',
		'section'    => 'static_front_page',
		'settings'   => 'featured-post-setting',
		'type'       => 'select',
		'choices' => $options
	)));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

} // end of customiser function
add_action('customize_register', 'npl_customize_register');

// css for colours panel –––––––––––––––––––––––––––––––––––––––––––––––––
function nonproflite_customize_css()
{
	?>
	<style type="text/css">
		/* background */
		body {
			background:
				<?php echo get_theme_mod('background_colour_setting', '#fff');
				?>;
		}

		.container-background {
			background-color: <?php echo get_theme_mod('feature_background_colour_setting', '#ffc5e3');
												?>;
		}

		/* paragraph text */
		p,
		li,
		.text-muted {
			color:
				<?php echo get_theme_mod('paragraph_colour_setting', '#2b2b2b');
				?> !important;
		}

		/* headings text */
		h1,
		h2,
		h3,
		h4,
		h5 {
			color:
				<?php echo get_theme_mod('heading_colour_setting', '#2b2b2b');
				?>;
		}

		/* font */
		* {
			font-family:
				<?php echo get_theme_mod('custom_font_setting', 'Fira Sans');
				?>;
		}

		/* menu and footer */
		.menuModule li,
		footer {
			background:
				<?php echo get_theme_mod('menu-footer-bg_colour_setting', '#b74f87');
				?>;
		}

		.menuModule a,
		footer p,
		footer a {
			color:
				<?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
				?> !important;
		}

		.menuModule a:hover {
			border-bottom: 2px solid <?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
																?>;
			border-top: 2px solid <?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
														?>;
		}

		/* header  */
		.headerWrap {
			background:
				<?php echo get_theme_mod('header_bg_setting', '#f284bc');
				?>;
		}

		/* buttons */
		.button,
		.product_type_simple,
		.wc-forward {
			background:
				<?php echo get_theme_mod('buttons_bg_colour_setting', '#00b2ff');
				?> !important;
		}

		.button a,
		.product_type_simple,
		.wc-forward {
			color:
				<?php echo get_theme_mod('buttons_text_colour_setting', '#ffffff');
				?> !important;
		}

		.button a:hover,
		.product_type_simple:hover,
		.wc-forward:hover {
			background:
				<?php echo get_theme_mod('buttons_hover_colour_setting', '#2b2b2b');
				?> !important;
		}

		/* social media */
		.facebook,
		.twitter,
		.instagram,
		.pinterest,
		.youtube {
			color:
				<?php echo get_theme_mod('social_bg_colour_setting', '#ffffff');
				?> !important;
		}

		.facebook:hover,
		.twitter:hover,
		.instagram:hover,
		.pinterest:hover,
		.youtube:hover {
			color:
				<?php echo get_theme_mod('social_hover_colour_setting', '#2b2b2b');
				?> !important;
		}
	</style>
<?php
} // end of css for colours panel
add_action('wp_head', 'nonproflite_customize_css');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
