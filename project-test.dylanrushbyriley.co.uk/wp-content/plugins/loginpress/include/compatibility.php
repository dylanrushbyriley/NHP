<?php

/**
 * This is a LoginPress Compatibility to make it compatible for older versions.
 *
 * @since 1.0.22
 */


/**
 * Run a compatibility check on 1.0.21 and change the settings.
 * 
 */
add_action( 'init', 'loginpress_upgrade_1_0_22', 1 );


/**
 * loginpress_upgrade_1_0_22 remove 'login_with_email' from loginpress setting and update 'login_order'
 * 
 * @since   1.0.22
 * @return  array update loginpress_setting
 */
function loginpress_upgrade_1_0_22() {

  $loginpress_setting = get_option( 'loginpress_setting' );
  $login_with_email = isset( $loginpress_setting['login_with_email'] ) ? $loginpress_setting['login_with_email'] : '';

  if ( isset( $loginpress_setting['login_with_email'] ) ) {

    if( 'on' == $login_with_email ) {

      $loginpress_setting['login_order'] = 'email';
      unset( $loginpress_setting['login_with_email'] );
      update_option( 'loginpress_setting', $loginpress_setting );
    } else if ( 'off' == $login_with_email ) {

      $loginpress_setting['login_order'] = 'default';
      unset( $loginpress_setting['login_with_email'] );
      update_option( 'loginpress_setting', $loginpress_setting );
    }
  }
}
?>
