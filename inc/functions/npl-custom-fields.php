<?php
/**
 * custom fields
 * @package nonproflite
 */

// create meta boxes ––––––––––––––––––––––––––––––––––––––––––––––––––––
function create_custom_meta_boxes()
{
	global $metaboxes;

	if (!empty($metaboxes)) {
		foreach ($metaboxes as $metaboxID => $metabox) {
			add_meta_box(
				$metaboxID,
				$metabox['title'],
				'output_custom_meta_box',
				$metabox['post_type'],
				'normal',
				'high',
				$metabox
			);
		};
	}
}
add_action('admin_init', 'create_custom_meta_boxes');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
