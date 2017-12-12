<?php
/**
 * This is an Add-ons page. Purpose of this page is to show a list of all the add-ons available to extend the functionality of LoginPress.
 *
 * @package LoginPress
 * @since 1.0.19
 *
 */

if ( ! class_exists( 'LoginPress_Addons' ) ) :

	class LoginPress_Addons {

		/**
		* Get the plugins list.
		*
		* @since  1.0.19
		* @access protected
		* @var    array
		*/
		protected $plugins_list;

		/* * * * * * * * * *
		* Class constructor
		* * * * * * * * * */
		function __construct() {

		  $this->plugins_list = get_plugins();
		  // add_filter( 'plugins_api', array( $this, 'get_addon_info' ), 100, 3 );
		  // $this->get_addons_link();
		}

		/**
		 * [get_addons_name from server]
		 * @return [array] [description]
		 */
		function get_addons_name() {

		  $raw_response = wp_remote_post( 'https://wpbrigade.com/loginpress-api/api.php');

		  if ( is_wp_error( $raw_response ) || $raw_response['response']['code'] != 200 ) {
			return false;
		  }

		  $addons = unserialize( $raw_response['body'] );

		  // echo '<pre>'; print_r( $addons ); echo '</pre>';
		  // $nonces = array();
		  // foreach ( $addons as $addon ) {
		  //   $nonces[ $addon['key'] ] = wp_create_nonce( "install-plugin_{$addon['key']}" );
		  // }
		  // echo '<pre>'; print_r( $nonces ); echo '</pre>';

		  return $addons;
		}

		function get_addons_link() {

			$addons = $this->get_addons_name();

			foreach ( $addons as $addon ) {

				$action = 'install-plugin';
				$slug   = $addon['key'];
				$link   = wp_nonce_url( add_query_arg( array( 'action' => $action, 'plugin' => $slug, 'lgp' => 1 ), admin_url( 'update.php' ) ), $action . '_' . $slug );
			}
		}


		/**
		* Check plugin status
		*
		* @return array
		* @since 1.0.19
		*/
		public function check_plugin_status( $slug, $extension ) {

		  if ( is_plugin_active( $slug ) ) {

			echo sprintf( esc_html__( '%1$s Already Installed %2$s', 'loginpress' ), '<button class="button-primary">', '</button>' );

		  } else if ( array_key_exists( $slug, $this->plugins_list ) ) {

			$link = wp_nonce_url( add_query_arg( array( 'action' => 'activate', 'plugin' => $slug ), admin_url( 'plugins.php' ) ),  'activate-plugin_' . $slug ) ;
			echo sprintf( esc_html__( '%1$s Activate Plugin %2$s', 'loginpress' ), '<a href="' .  $link . '" class="button-primary">', '</a>' );

		  } else if ( is_plugin_inactive( $slug ) ) {

			$action = 'install-plugin';
			$_slug   = $extension['key'];
			$link   = wp_nonce_url( add_query_arg( array( 'action' => $action, 'plugin' => $_slug, 'lgp' => 1 ), admin_url( 'update.php' ) ), $action . '_' . $_slug );
			echo sprintf( esc_html__( '%1$s Install %2$s', 'loginpress' ), '<a  href="' . $link . '" class="button-primary">', '</a>' ); }
		}
	} // Enf of Class.
endif;


	$obj_loginpress_addons	= new LoginPress_Addons();
	// $loginpress_addons = $obj_loginpress_addons->addons();
	$loginpress_addons = $obj_loginpress_addons->get_addons_name();

?>

<!-- Style for Add-ons Page -->
  <style media="screen">
	.loginpress-extension h3 {
		box-sizing: border-box;
		height: 110px;
		margin: 0;
		padding: 20px 10px 0 135px;
		border-bottom: 1px solid #e2e5e8;
		background: #f9fafa no-repeat left 5px top 5px;
		background-size: 115px 100px;
	}

	.loginpress-extension {
		float: none;
		box-sizing: border-box;
		width: calc(50% - 12px);
		margin: 10px 20px 10px 0;
		border: 1px solid #e2e5e8;
		display: inline-block;
		height: auto;
		vertical-align: top;
		background: #fff;
		min-height: 260px;
		position: relative;
  	}

  .loginpress-extension .button-primary{
		border:0;
		text-shadow:none;
		background:#32373c;
		padding:8px 18px;
		height:auto;
		font-size:15px;
		cursor: pointer;
		position:absolute;
		right:-1px;
		bottom:-1px;
		box-shadow:none;
		border-radius:0;
  	}
  .loginpress-extension .button-primary:visited, .loginpress-extension .button-primary:active,.loginpress-extension .button-primary:hover,.loginpress-extension .button-primary:focus{
	background: #595959;
	box-shadow: none;
	outline: none;
  }
  .loginpress-extension button.button-primary{
	background: #f9fafa;
	border-radius: 0;
	box-shadow: none;
	color: #444;
	position: absolute;
	right: 0px;
	bottom: 0px;
	border: 0;
	border-left: 1px solid #e2e5e8;
	border-top: 1px solid #e2e5e8;
	cursor: default;
  }
  .loginpress-extension button.button-primary:visited,.loginpress-extension button.button-primary:active,.loginpress-extension button.button-primary:hover,.loginpress-extension button.button-primary:focus{
	background: #f9fafa;
	color: #444;
	border: 0;
	border-left: 1px solid #e2e5e8;
	border-top: 1px solid #e2e5e8;
	outline: none;
	box-shadow: none;
  }
  .logoinpress_addons_thumbnails{

	max-width: 100px;
	position: absolute;
	top: 5px;
	left: 10px;
	max-height: 95px;
	height: auto;
	width: auto;
  }
  .loginpress-extension .logoinpress_addons_links{
	position: relative;
  }
  .loginpress-extension p {
	margin: 0;
	padding: 10px;
  }
  .loginpress-addons-loading-errors {
	padding-top: 15px;
  }
  .loginpress-addons-loading-errors img {
	float: left;
	padding-right: 10px;
  }
	.loginpress-addons-wrap{
		max-width: 1050px;
	}
	.loginpress-extension h3 {
    box-sizing: border-box;
    /* height: 110px; */
    margin: 0;
    padding: 0 10px 0 10px;
    border-bottom: 2px solid #e2e5e8;
    background-size: 115px 100px;
    height: 100px;
     color: #000000;
}
a.logoinpress_addons_links {
    display: inline-block;
    width: 100%;
    line-height: 90px;
    padding-bottom: 5px;
    height: auto;
		text-decoration: none;
}
.logoinpress_addons_thumbnails {
    max-width: 100px;
    position: absolute;
    top: 5px;
    left: 10px;
    max-height: 75px;
    height: auto;
    width: auto;
    position: static;
    vertical-align: middle;
    margin-right: 20px;
}
.loginpress-extension{
	border-width: 2px;
}
.loginpress-extension:nth-child(even){
	margin-right: 0;
}
@media only screen and (max-width: 600px) {
	.loginpress-extension{
		width:100%;
	}
}

  </style>

	<div class="wrap loginpress-addons-wrap">

		<h2 class='opt-title'>
		  <?php esc_html_e( 'Extend the functionality of LoginPress with these awesome Add-ons', 'loginpress' ); ?>
		</h2>

		<div class="tabwrapper">
		  <?php if ( is_array( $loginpress_addons ) ) :
			foreach ( $loginpress_addons as $name => $extension ) : ?>
			  <div class="loginpress-extension">
				<a target="_blank" href="https://wpbrigade.com/wordpress/plugins/loginpress-pro/?utm_source=loginpress-lite&utm_medium=addons-coming-soon&utm_campaign=pro-upgrade" class="logoinpress_addons_links">

				  <h3><img src=<?php echo plugins_url( '../img/thumbnail/gray-loginpress.png', __FILE__ );?> class="logoinpress_addons_thumbnails"/><span><?php echo $extension['title']; ?></span></h3>
				</a>

				<p><?php echo $extension['details']; ?></p>
				<p>
				  <?php //$obj_loginpress_addons->check_plugin_status( $extension['key'], $extension ); ?>
				  <a target="_blank" href="https://wpbrigade.com/wordpress/plugins/loginpress-pro/?utm_source=loginpress-lite&utm_medium=addons-coming-soon&utm_campaign=pro-upgrade" class="button-primary">Coming Soon</a>
				</p>
			  </div>
			<?php
			endforeach;
		  else : ?>
			<div class="loginpress-addons-loading-errors">
			  <img src="<?php echo plugins_url( '../img/clock.png', __FILE__ );?>" alt="clock">
			  <h3>
				  <?php esc_html_e( 'Trouble in loading Add-ons. Please reload the page.', 'loginpress' ) ?>
			  </h3>
			  <p><?php echo sprintf( __( 'Findout the LoginPress %1$s', 'loginpress' ), '<a href="https://wpbrigade.com/wordpress/plugins/loginpress/" target="_blank">Add-ons</a>') ?></p>
			</div>
		  <?php endif; ?>
		</div>

	</div>
