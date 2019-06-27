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

// define meta boxes ––––––––––––––––––––––––––––––––––––––––––––––––––––
$metaboxes = array(
	// enquiries
	'enquiries' => array(
		'title' => 'Enquiries',
		'post_type' => 'enquiries',
		'fields' => array(
			'email' => array(
				'title' => 'Email',
				'type' => 'text'
			),
		)
	)
);
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// display meta box data ––––––––––––––––––––––––––––––––––––––––––––––––
function output_custom_meta_box($post, $metabox)
{
	$singleFields = $metabox['args']['fields'];

	$customValues = get_post_custom($post->ID);

	echo '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '">';

	if ($singleFields) {
		foreach ($singleFields as $customField => $singleField) {

			if (isset($singleField['condition'])) {
				$condition = 'class="conditionalField" data-condition="' . $singleField['condition'] . '"';
			} else {
				$condition = '';
			}

			switch ($singleField['type']) {
				case 'text':
					echo '<div id="' . $customField . '" ' . $condition . ' >';
					echo '<label for="' . $customField . '">' . $singleField['title'] . '</label>';
					echo '<input type="text" name="' . $customField . '" class="inputField" value="' . $customValues[$customField][0] . '">';
					echo '</div>';
					break;
				case 'number':
					echo '<label for="' . $customField . '">' . $singleField['title'] . '</label>';
					echo '<input type="number" name="' . $customField . '" class="inputField" value="' . $customValues[$customField][0] . '">';
					break;
				case 'textarea':
					echo $customValues[$customField][0];
					echo '<br>';
					echo '<label for="' . $customField . '">' . $singleField['title'] . '</label>';
					echo '<textarea class="inputField" name="' . $customField . '" rows="' . $singleField['rows'] . '"></textarea>';
					break;
				case 'select':
					echo $customValues[$customField][0];
					echo '<br>';
					echo '<label for="' . $customField . '">' . $singleField['title'] . '</label>';
					echo '<select name="' . $customField . '" class="inputField customSelect">';
					echo '<option class="customSelect"> -- Please Enter a value -- </option>';
					foreach ($singleField['choices'] as $choice) {
						echo '<option class="customSelect" value="' . $choice . '">' . $choice . '</option>';
					}
					echo '</select>';
					break;
				default:
					echo $customValues[$customField][0];
					echo '<br>';
					echo '<label for="' . $customField . '">' . $singleField['title'] . '</label>';
					echo '<input type="text" name="' . $customField . '" class="inputField">';
					break;
			}
		}
	}
}
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// save meta box data –––––––––––––––––––––––––––––––––––––––––––––––––––
function save_custom_metaboxes($postID)
{
	global $metaboxes;

	if (!wp_verify_nonce($_POST['post_format_meta_box_nonce'], basename(__FILE__))) {
		return $postID;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $postID;
	}

	if ($_POST['post_type'] == 'page') {
		if (!current_user_can('edit_page', $postID)) {
			return $postID;
		}
	} elseif (!current_user_can('edit_post', $postID)) {
		return $postID;
	}

	$postType = get_post_type();

	foreach ($metaboxes as $metaboxID => $metabox) {
		if ($metabox['post_type'] == $postType) {
			$singleFields = $metabox['fields'];
			foreach ($singleFields as $customField => $singleField) {
				$oldValue = get_post_meta($postID, $customField, true);
				$newValue = $_POST[$customField];

				if ($newValue && $newValue != $oldValue) {
					update_post_meta($postID, $customField, $newValue);
				} elseif ($newValue == '' || !isset($_POST[$customField])) {
					delete_post_meta($postID, $customField, $oldValue);
				}
			}
		}
	}
}
add_action('save_post', 'save_custom_metaboxes');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
