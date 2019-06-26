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
		padding: 20px 0;
		width: 80px;
			}
			.form-table td {
				padding: 15px 0;
		}
			#mapKeyInput, #locationInput {
				width: 360px;
		}
	</style>';
}
add_action('admin_head', 'admin_styles');
