<?php
/**
 * admin styles
 * @package nonproflite
 */

// change admin styles
function admin_styles()
{
	echo '<style>
	.form-table th {
		width: 40px;
			}
	</style>';
}
add_action('admin_head', 'admin_styles');
