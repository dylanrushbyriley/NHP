<?php

	// $multi_values = ! is_array( get_option( 'customize_presets_settings' ) ) ? explode( ',', get_option( 'customize_presets_settings' ) ) : get_option( 'customize_presets_settings' );
	//
	$selected_preset = get_option( 'customize_presets_settings', true );

// $selected_preset = 'default1';
	?>

	<?php
	if ( $selected_preset == 'default1' ) {
		include_once LOGINPRESS_ROOT_PATH . 'css/themes/default-1.php';
		echo first_presets();
	} else {
		do_action( 'loginpress_add_pro_theme', $selected_preset );
	}
		?>
