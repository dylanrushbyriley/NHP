<?php
/**
 * Get option and check the key exists in it.
 *
 * @since 1.0.0
 * * * * * * * * * * * * * * * */


 /**
 * @var loginpress_array get_option
 * @since 1.0.0
 */
$loginpress_array = (array) get_option( 'loginpress_customization' );

function loginpress_get_option_key( $loginpress_key, $loginpress_array ) {

	if ( array_key_exists( $loginpress_key, $loginpress_array ) ) {

		return $loginpress_array[ $loginpress_key ];
	}
}

function loginpress_bg_option( $loginpress_key, $loginpress_array ) {

	if ( array_key_exists( $loginpress_key, $loginpress_array ) ) {

		return $loginpress_array[ $loginpress_key ];
	} else {
    return true;
  }
}

function loginpress_check_px( $value ) {

  if ( strpos( $value, "px" ) ) {
    return $value;
  } else {
		if ( ! empty( $value ) ) {
			return $value . 'px';
		}
  }
}


$loginpress_logo_img 						= loginpress_get_option_key( 'setting_logo', $loginpress_array );
$loginpress_get_logo_width 			= loginpress_get_option_key( 'customize_logo_width', $loginpress_array );
$loginpress_logo_width          = loginpress_check_px( $loginpress_get_logo_width );
$loginpress_get_logo_height 		= loginpress_get_option_key( 'customize_logo_height', $loginpress_array );
$loginpress_logo_height         = loginpress_check_px( $loginpress_get_logo_height );
$loginpress_get_logo_padding 		= loginpress_get_option_key( 'customize_logo_padding', $loginpress_array );
$loginpress_logo_padding        = loginpress_check_px( $loginpress_get_logo_padding );
$loginpress_btn_bg 							= loginpress_get_option_key( 'custom_button_color', $loginpress_array );
$loginpress_btn_border 					= loginpress_get_option_key( 'button_border_color', $loginpress_array );
$loginpress_btn_shadow 					= loginpress_get_option_key( 'custom_button_shadow', $loginpress_array );
$loginpress_btn_color 					= loginpress_get_option_key( 'button_text_color', $loginpress_array );
$loginpress_btn_hover_bg 				= loginpress_get_option_key( 'button_hover_color', $loginpress_array );
$loginpress_btn_hover_border 	  = loginpress_get_option_key( 'button_hover_border', $loginpress_array );
$loginpress_background_img			= loginpress_get_option_key( 'setting_background', $loginpress_array );
$loginpress_background_color		= loginpress_get_option_key( 'setting_background_color', $loginpress_array );
$loginpress_background_repeat	  = loginpress_get_option_key( 'background_repeat_radio', $loginpress_array );
$loginpress_background_postion	= loginpress_get_option_key( 'background_position', $loginpress_array );
$loginpress_background_image_size = loginpress_get_option_key( 'background_image_size', $loginpress_array );
$loginpress_form_background_img = loginpress_get_option_key( 'setting_form_background', $loginpress_array );
$loginpress_form_background_clr = loginpress_get_option_key( 'form_background_color', $loginpress_array );
$loginpress_forget_form_bg_img  = loginpress_get_option_key( 'forget_form_background', $loginpress_array );
$loginpress_forget_form_bg_clr  = loginpress_get_option_key( 'forget_form_background_color', $loginpress_array );
$loginpress_form_width 			 	  = loginpress_get_option_key( 'customize_form_width', $loginpress_array );
$loginpress_get_form_height 		= loginpress_get_option_key( 'customize_form_height', $loginpress_array );
$loginpress_form_height         = loginpress_check_px( $loginpress_get_form_height );
$loginpress_form_padding 			  = loginpress_get_option_key( 'customize_form_padding', $loginpress_array );
$loginpress_form_border 			 	= loginpress_get_option_key( 'customize_form_border', $loginpress_array );
$loginpress_form_field_width 	  = loginpress_get_option_key( 'textfield_width', $loginpress_array );
$loginpress_form_field_margin 	= loginpress_get_option_key( 'textfield_margin', $loginpress_array );
$loginpress_form_field_bg 			= loginpress_get_option_key( 'textfield_background_color', $loginpress_array );
$loginpress_form_field_color 	  = loginpress_get_option_key( 'textfield_color', $loginpress_array );
$loginpress_form_field_label 	  = loginpress_get_option_key( 'textfield_label_color', $loginpress_array );
$loginpress_welcome_bg_color		= loginpress_get_option_key( 'message_background_color', $loginpress_array );
$loginpress_welcome_bg_border   = loginpress_get_option_key( 'message_background_border', $loginpress_array );
$loginpress_footer_display			= loginpress_get_option_key( 'footer_display_text', $loginpress_array );
$loginpress_footer_decoration   = loginpress_get_option_key( 'login_footer_text_decoration', $loginpress_array );
$loginpress_footer_text_color   = loginpress_get_option_key( 'login_footer_color', $loginpress_array );
$loginpress_footer_text_hover   = loginpress_get_option_key( 'login_footer_color_hover', $loginpress_array );
$loginpress_get_footer_font_size= loginpress_get_option_key( 'login_footer_font_size', $loginpress_array );
$loginpress_footer_font_size    = loginpress_check_px( $loginpress_get_footer_font_size );
$loginpress_footer_bg_color 		= loginpress_get_option_key( 'login_footer_bg_color', $loginpress_array );
$loginpress_footer_links_font_size = loginpress_get_option_key( 'login_footer_links_text_size', $loginpress_array );
$loginpress_footer_links_hover_size = loginpress_get_option_key( 'login_footer_links_hover_size', $loginpress_array );
$loginpress_header_text_color   = loginpress_get_option_key( 'login_head_color', $loginpress_array );
$loginpress_header_text_hover   = loginpress_get_option_key( 'login_head_color_hover', $loginpress_array );
$loginpress_header_font_size 	  = loginpress_get_option_key( 'login_head_font_size', $loginpress_array );
$loginpress_header_bg_color 		= loginpress_get_option_key( 'login_head_bg_color', $loginpress_array );
$loginpress_back_display			 	= loginpress_get_option_key( 'back_display_text', $loginpress_array );
$loginpress_back_decoration  	  = loginpress_get_option_key( 'login_back_text_decoration', $loginpress_array );
$loginpress_back_text_color  	  = loginpress_get_option_key( 'login_back_color', $loginpress_array );
$loginpress_back_text_hover  	  = loginpress_get_option_key( 'login_back_color_hover', $loginpress_array );
$loginpress_get_back_font_size 	= loginpress_get_option_key( 'login_back_font_size', $loginpress_array );
$loginpress_back_font_size      = loginpress_check_px( $loginpress_get_back_font_size );
$loginpress_back_bg_color 			= loginpress_get_option_key( 'login_back_bg_color', $loginpress_array );
$loginpress_footer_link_color	  = loginpress_get_option_key( 'login_footer_text_color', $loginpress_array );
$loginpress_footer_link_hover	  = loginpress_get_option_key( 'login_footer_text_hover', $loginpress_array );
$loginpress_footer_link_bg_clr	= loginpress_get_option_key( 'login_footer_backgroung_hover', $loginpress_array );
$loginpress_custom_css 			 	  = loginpress_get_option_key( 'loginpress_custom_css', $loginpress_array );
$loginpress_custom_js 				 	= loginpress_get_option_key( 'loginpress_custom_js', $loginpress_array );

$loginpress_display_bg 	        = loginpress_bg_option( 'loginpress_display_bg', $loginpress_array );
$loginpress_theme_tem           = get_option( 'customize_presets_settings', 'default1' );

// ob_start();
?>
<style type="text/css">
*{
	box-sizing: border-box;
}
#login::after{
  <?php if ( ( $loginpress_theme_tem == 'default6' || $loginpress_theme_tem == 'default10' ) && ! empty( $loginpress_background_img ) && $loginpress_display_bg ) : ?>
	background-image: url(<?php echo $loginpress_background_img; ?>);

  <?php elseif (  ( $loginpress_theme_tem == 'default6' || $loginpress_theme_tem == 'default10' ) &&  isset( $loginpress_display_bg ) && ! $loginpress_display_bg ) : ?>
	background-image: url();
	<?php endif; ?>
  <?php if( in_array( $loginpress_theme_tem, array( 'default6', 'default10' ) ) ) : ?>
    <?php if ( ! empty( $loginpress_background_color ) ) : ?>
  	background-color: <?php echo $loginpress_background_color; ?>;
  	<?php endif; ?>
    <?php if ( ! empty( $loginpress_background_repeat ) ) : ?>
  	background-repeat: <?php echo $loginpress_background_repeat; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_postion ) ) : ?>
  	background-position: <?php echo $loginpress_background_postion; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_image_size ) ) : ?>
  	background-size: <?php echo $loginpress_background_image_size; ?>;
  	<?php endif; ?>
	<?php endif; ?>
}

#login{
  <?php if ( $loginpress_theme_tem == 'default17' && ! empty( $loginpress_background_img ) && $loginpress_display_bg ) : ?>
	background-image: url(<?php echo $loginpress_background_img; ?>);
  <?php elseif ( $loginpress_theme_tem == 'default17' &&  isset( $loginpress_display_bg ) && ! $loginpress_display_bg ) : ?>
	background-image: url();
	<?php endif; ?>

  <?php if( $loginpress_theme_tem == 'default17' ) : ?>
    <?php if ( ! empty( $loginpress_background_color ) ) : ?>
  	background-color: <?php echo $loginpress_background_color; ?>;
  	<?php endif; ?>
    <?php if ( ! empty( $loginpress_background_repeat ) ) : ?>
  	background-repeat: <?php echo $loginpress_background_repeat; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_postion ) ) : ?>
  	background-position: <?php echo $loginpress_background_postion; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_image_size ) ) : ?>
  	background-size: <?php echo $loginpress_background_image_size; ?>;
    <?php endif; ?>
	<?php endif; ?>
}
body.login:after{
  <?php if ( $loginpress_theme_tem == 'default8' && ! empty( $loginpress_background_img ) && $loginpress_display_bg ) : ?>
	background-image: url(<?php echo $loginpress_background_img; ?>);
  <?php elseif ( $loginpress_theme_tem == 'default8' &&  isset( $loginpress_display_bg ) && ! $loginpress_display_bg ) : ?>
	background-image: url();
	<?php endif; ?>

  <?php if( $loginpress_theme_tem == 'default8' ) : ?>
    <?php if ( ! empty( $loginpress_background_color ) ) : ?>
  	background-color: <?php echo $loginpress_background_color; ?>;
  	<?php endif; ?>
    <?php if ( ! empty( $loginpress_background_repeat ) ) : ?>
  	background-repeat: <?php echo $loginpress_background_repeat; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_postion ) ) : ?>
  	background-position: <?php echo $loginpress_background_postion; ?>;
  	<?php endif; ?>
  	<?php if ( ! empty( $loginpress_background_image_size ) ) : ?>
  	background-size: <?php echo $loginpress_background_image_size; ?>;
    <?php endif; ?>
	<?php endif; ?>
}
body.login {

  <?php if ( in_array( $loginpress_theme_tem, array( 'default6', 'default8', 'default10', 'default17' ) ) && ! empty( $loginpress_background_img ) && $loginpress_display_bg ) : ?>
	background-image: url();
  <?php elseif ( in_array( $loginpress_theme_tem, array( 'default6', 'default8', 'default10', 'default17' ) ) &&  isset( $loginpress_display_bg ) && ! $loginpress_display_bg ) : ?>
	background-image: url();
	<?php endif; ?>

	<?php if ( ! in_array( $loginpress_theme_tem, array( 'default6', 'default8', 'default10', 'default17' ) )  && ! empty( $loginpress_background_img ) && $loginpress_display_bg ) : ?>
	background-image: url(<?php echo $loginpress_background_img; ?>);
  <?php elseif ( ! in_array( $loginpress_theme_tem, array( 'default6', 'default8', 'default10', 'default17' ) ) && isset( $loginpress_display_bg ) && ! $loginpress_display_bg ) : ?>
	background-image: url();
	<?php endif; ?>

	<?php if ( ! empty( $loginpress_background_color ) ) : ?>
	background-color: <?php echo $loginpress_background_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_background_repeat ) ) : ?>
	background-repeat: <?php echo $loginpress_background_repeat; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_background_postion ) ) : ?>
	background-position: <?php echo $loginpress_background_postion; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_background_image_size ) ) : ?>
	background-size: <?php echo $loginpress_background_image_size; ?>;
	<?php endif; ?>
  position: relative;
}

.interim-login.login h1 a{
  <?php if ( ! empty( $loginpress_logo_width ) ) : ?>
  width: <?php echo $loginpress_logo_width; ?>;
  <?php else : ?>
	width: 84px;
	<?php endif; ?>
}

.login h1 a {
	<?php if ( ! empty( $loginpress_logo_img ) ) : ?>
	background-image: url( <?php echo $loginpress_logo_img; ?> );
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_logo_width ) ) : ?>
	width: <?php echo $loginpress_logo_width; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_logo_height ) ) : ?>
	height: <?php echo $loginpress_logo_height; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_logo_width ) || ! empty( $loginpress_logo_height ) ) : ?>
	background-size: cover; <?php //echo $loginpress_logo_width; ?> <?php //echo $loginpress_logo_height; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_logo_padding ) ) : ?>
	padding-bottom: <?php echo $loginpress_logo_padding; ?>;
	<?php endif; ?>

}

.wp-core-ui #login  .button-primary{
	<?php if ( ! empty( $loginpress_btn_bg ) ) : ?>
	background: <?php echo $loginpress_btn_bg; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_btn_border ) ) : ?>
	border-color: <?php echo $loginpress_btn_border; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_btn_shadow ) ) : ?>
	box-shadow: 0px 1px 0px <?php echo $loginpress_btn_shadow; ?> inset, 0px 1px 0px rgba(0, 0, 0, 0.15);
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_btn_color ) ) : ?>
	color: <?php echo $loginpress_btn_color; ?>;
	<?php endif; ?>
}

.wp-core-ui #login  .button-primary:hover{
	<?php if ( ! empty( $loginpress_btn_hover_bg ) ) : ?>
	background: <?php echo $loginpress_btn_hover_bg; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_btn_hover_border ) ) : ?>
	border-color: <?php echo $loginpress_btn_hover_border; ?>;
	<?php endif; ?>
}
.wp-core-ui #login .button-primary{
  box-shadow: none;
}
#loginform {
	<?php if ( ! empty( $loginpress_form_background_img ) ) : ?>
	background-image: url(<?php echo $loginpress_form_background_img; ?>);
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_background_clr ) ) : ?>
	background-color: <?php echo $loginpress_form_background_clr; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_height ) ) : ?>
	min-height: <?php echo $loginpress_form_height; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_padding ) ) : ?>
	padding: <?php echo $loginpress_form_padding; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_border ) ) : ?>
	border: <?php echo $loginpress_form_border; ?>;
	<?php endif; ?>
}

#login {
	<?php if ( ! empty( $loginpress_form_width ) ) : ?>
	max-width: <?php echo $loginpress_form_width; ?>;
	<?php else : ?>
	<?php endif; ?>
}
.login label {
	<?php if ( ! empty( $loginpress_form_field_label ) ) : ?>
	color: <?php echo $loginpress_form_field_label; ?>;
	<?php endif; ?>
}

.login form .input, .login input[type="text"] {
	<?php if ( ! empty( $loginpress_form_field_width ) ) : ?>
	width: <?php echo $loginpress_form_field_width; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_field_margin ) ) : ?>
	margin: <?php echo $loginpress_form_field_margin; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_field_bg ) ) : ?>
	background: <?php echo $loginpress_form_field_bg; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_form_field_color ) ) : ?>
	color: <?php echo $loginpress_form_field_color; ?>;
	<?php endif; ?>
}

#lostpasswordform {
	<?php if ( ! empty( $loginpress_forget_form_bg_img ) ) : ?>
	background-image: url(<?php echo $loginpress_forget_form_bg_img; ?>);
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_forget_form_bg_clr ) ) : ?>
	background-color: <?php echo $loginpress_forget_form_bg_clr; ?>;
	<?php endif; ?>
  <?php if ( ! empty( $loginpress_form_padding ) ) : ?>
	padding: <?php echo $loginpress_form_padding; ?>;
	<?php endif; ?>
}

#registerform {
  <?php if ( ! empty( $loginpress_form_padding ) ) : ?>
	padding: <?php echo $loginpress_form_padding; ?>;
	<?php endif; ?>
}


.login .custom-message {

  <?php if ( ! empty( $loginpress_welcome_bg_border ) ) : ?>
  border: <?php echo $loginpress_welcome_bg_border; ?>;
  <?php else : ?>
  border-left: 4px solid #00a0d2;
  <?php endif; ?>

	<?php if ( ! empty( $loginpress_welcome_bg_color ) ) : ?>
	background-color: <?php echo $loginpress_welcome_bg_color; ?>;
  <?php else : ?>
  background-color: #fff;
	<?php endif; ?>

  padding: 12px;
  margin-left: 0;
  margin-bottom: 20px;
  -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

.login #nav {
	<?php if ( ! empty( $loginpress_footer_bg_color ) ) : ?>
	background-color: <?php echo $loginpress_footer_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_footer_display ) ) : ?>
	display: <?php echo $loginpress_footer_display; ?>
	<?php endif; ?>
}

.login #nav a{
	<?php if ( ! empty( $loginpress_footer_decoration ) ) : ?>
	text-decoration: <?php echo $loginpress_footer_decoration; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_footer_text_color ) ) : ?>
	color: <?php echo $loginpress_footer_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_footer_font_size ) ) : ?>
	font-size: <?php echo $loginpress_footer_font_size . ';'; ?>;
	<?php endif; ?>

}

.login #nav a:hover{
	<?php if ( ! empty( $loginpress_footer_text_hover ) ) : ?>
	color: <?php echo $loginpress_footer_text_hover; ?>;
	<?php endif; ?>
}

.login #backtoblog{
	<?php if ( ! empty( $loginpress_back_bg_color ) ) : ?>
	background-color: <?php echo $loginpress_back_bg_color; ?>;
	<?php endif; ?>
}

.login #backtoblog a{
	<?php if ( ! empty( $loginpress_back_decoration ) ) : ?>
	text-decoration: <?php echo $loginpress_back_decoration; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_back_text_color ) ) : ?>
	color: <?php echo $loginpress_back_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_back_font_size ) ) : ?>
	font-size: <?php echo $loginpress_back_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_back_display ) ) : ?>
	display: <?php echo $loginpress_back_display; ?>
	<?php endif; ?>
}

.login #backtoblog a:hover{
	<?php if ( ! empty( $loginpress_back_text_hover ) ) : ?>
	color: <?php echo $loginpress_back_text_hover; ?>;
	<?php endif; ?>
}

.loginHead {
	<?php if ( ! empty( $loginpress_header_bg_color ) ) : ?>
	background: <?php echo $loginpress_header_bg_color; ?>;
	<?php endif; ?>
}

.loginHead p a {
	<?php if ( ! empty( $loginpress_header_text_color ) ) : ?>
	color: <?php echo $loginpress_header_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_header_font_size ) ) : ?>
	font-size: <?php echo $loginpress_header_font_size; ?>;
	<?php endif; ?>
}

.loginHead p a:hover {
	<?php if ( ! empty( $loginpress_header_text_hover ) ) : ?>
	color: <?php echo $loginpress_header_text_hover; ?>;
	<?php endif; ?>
}

.loginFooter p a {
	margin: 0 5px;
	<?php if ( ! empty( $loginpress_footer_link_color ) ) : ?>
	color: <?php echo $loginpress_footer_link_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_footer_links_font_size ) ) : ?>
	font-size: <?php echo $loginpress_footer_links_font_size; ?>;
	<?php endif; ?>
}

.loginFooter p a:hover {
	<?php if ( ! empty( $loginpress_footer_link_hover ) ) : ?>
	color: <?php echo $loginpress_footer_link_hover; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $loginpress_footer_links_hover_size ) ) : ?>
	font-size: <?php echo $loginpress_footer_links_hover_size; ?>;
	<?php endif; ?>
}

.loginInner {
	<?php if ( ! empty( $loginpress_footer_link_bg_clr ) ) : ?>
	background: <?php echo $loginpress_footer_link_bg_clr; ?>;
	<?php endif; ?>
}

<?php if ( ! empty( $loginpress_custom_css ) ) : ?>
<?php echo $loginpress_custom_css; ?>
<?php endif; ?>

.wp-core-ui .button-primary{
text-shadow: none;
}

input:-webkit-autofill{
  transition: all 100000s ease-in-out 0s !important;
  transition-property: background-color, color !important;
}
.loginpress-show-love{
  float: right;
  font-style: italic;
  padding-right: 20px;
  padding-bottom: 10px;
  position: absolute;
  bottom: 3px;
  right: 0;
  z-index: 10;
}
.loginpress-show-love a{
  text-decoration: none;
}
</style>

<?php // $content = ob_get_clean(); ?>

<?php if ( ! empty( $loginpress_custom_js ) ) : ?>
<script>
<?php echo $loginpress_custom_js; ?>
</script>
<?php endif; ?>
