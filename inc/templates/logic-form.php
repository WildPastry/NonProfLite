<?php
/**
 * form-logic
 * @package nonproflite
 */

// set up contact form
if ($_POST) {
	$errors = array();
	if (wp_verify_nonce($_POST['_wpnonce'], 'wp_enquiery_form')) {

		if (!$_POST['enquiriesName']) {
			array_push($errors, 'Your name is required');
		}

		if (!$_POST['enquiriesEmail']) {
			array_push($errors, 'Your email is required');
		}

		if (!$_POST['enquiriesMessage']) {
			array_push($errors, 'A message is required');
		}

		if (empty($errors)) {
			$args = array(
				'post_content' => $_POST['enquiriesMessage'],
				'post_title' => $_POST['enquiriesName'],
				'post_type' => 'enquiries',
				'meta_input' => array(
					'email' => $_POST['enquiriesEmail']
				)
			);
			wp_insert_post($args);
		}
	} else {
		array_push($errors, 'Something went wrong with submitting the form');
	}
}