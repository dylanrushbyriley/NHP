<?php

class LoginPress_Entities {

  /**
  * Variable that Check for LoginPress Key.
  *
  * @var string
  * @since 1.0.0
  */
  public $loginpress_key;

  /**
  * Class constructor
  */
  public function __construct() {

    $this->loginpress_key = get_option( 'loginpress_customization' );
    $this->_hooks();
  }


  /**
  * Hook into actions and filters
  *
  * @since 1.0.0
  */
  private function _hooks() {

    add_filter( 'login_headerurl',		array( $this, 'login_page_logo_url' ) );
    add_filter( 'login_headertitle',	array( $this, 'login_page_logo_title' ) );
    add_filter( 'login_errors',			 	array( $this, 'login_error_messages' ) );

    add_filter( 'login_message',			array( $this, 'change_welcome_message' ) );
    add_action( 'customize_register', array( $this, 'customize_login_panel' ) );
    add_action( 'login_footer',			 	array( $this, 'login_page_custom_footer' ) );
    add_action( 'login_head',				 	array( $this, 'login_page_custom_head' ) );
    add_action( 'init',							 	array( $this, 'redirect_to_custom_page' ) );
    add_action( 'admin_menu',				 	array( $this, 'menu_url' ), 10 );

    add_action( 'customize_controls_enqueue_scripts', 	array( $this,  'loginpress_customizer_js' ) );
    // add_action( 'customize_preview_init', 	array( $this, 'loginpress_customizer_js' ) );
    add_filter( 'woocommerce_process_login_errors',     array( $this, 'loginpress_woo_login_errors' ), 10, 3 );

  }


  /**
  * Enqueue jQuery and use wp_localize_script.
  *
  * @since 1.0.9
  */
  function loginpress_customizer_js() {
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'loginpress-customize-control',   plugins_url(  'js/customize-controls.js' , LOGINPRESS_ROOT_FILE  ), array( 'jquery', 'customize-preview' ), LOGINPRESS_VERSION, true );


    // Get Background URL for use in Customizer JS.
    $loginpress_bg = get_option( 'loginpress_customization');
    $loginpress_bg_url = $loginpress_bg['setting_background'] ? $loginpress_bg['setting_background'] : false;

    // Array for localize.
    $loginpress_localize = array(
      'admin_url'         => admin_url(),
      'plugin_url'        => plugins_url(),
      'login_theme'       => get_option( 'customize_presets_settings', true ),
      'loginpress_bg_url' => $loginpress_bg_url
    );

    wp_localize_script( 'loginpress-customize-control', 'loginpress_script', $loginpress_localize );

  }



  /**
  * Register plugin settings Panel in WP Customizer
  *
  * @param	$wp_customize
  * @since	1.0.0
  */
  public function customize_login_panel( $wp_customize ) {

    include LOGINPRESS_ROOT_PATH .'classes/control-presets.php';

    if ( ! has_action( 'loginpress_pro_add_template' ) ) :
      include LOGINPRESS_ROOT_PATH .'classes/class-loginpress-promo.php';
    endif;

    //	=============================
    //	= Panel for the LoginPress	=
    //	=============================
    $wp_customize->add_panel( 'loginpress_panel', array(
      'title'						=> __( 'LoginPress', 'loginpress' ),
      'description'			=> __( 'Customize Your WordPress Login Page with LoginPress :)', 'loginpress' ),
      'priority'				=> 30,
    ) );

    /**
    * =============================
    *	= Section for Presets		=
    * =============================
    *
    * @since	1.0.9
    */
    $wp_customize->add_section( 'customize_presets', array(
      'title'				   => __( 'Themes', 'loginpress' ),
      'description'	   => __( 'Choose Theme', 'loginpress' ),
      'priority'			 => 1,
      'panel'				   => 'loginpress_panel',
      ) );

      $wp_customize->add_setting( 'customize_presets_settings', array(
        'default'				=> 'default1',
        'type'					=> 'option',
        'capability'		=> 'manage_options',
      ) );

      $loginpress_free_templates = array(
        'default1' => array(
          'img'       => plugins_url( 'img/bg.jpg', LOGINPRESS_ROOT_FILE ),
          'thumbnail' => plugins_url( 'img/thumbnail/default-1.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default1',
          'name'      => 'Default'
        ),
        'default2' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-2.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default2',
          'name'      => __( 'Company', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default3' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-3.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default3',
          'name'      => __( 'Persona', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default4' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-4.jpg', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default4',
          'name'      => __( 'Corporate', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default5' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-5.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default5',
          'name'      => __( 'Corporate', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default6' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-6.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default6',
          'name'      => __( 'Startup', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default7' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-7.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default7',
          'name'      => __( 'Wedding', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default8' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-8.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default8',
          'name'      => __( 'Wedding #2', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default9' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-9.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default9',
          'name'      => __( 'Company', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default10' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-10.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default10',
          'name'      => __( 'Bikers', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default11' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-11.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default11',
          'name'      => __( 'Fitness', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default12' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-12.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default12',
          'name'      => __( 'Shopping', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default13' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-13.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default13',
          'name'      => __( 'Writers', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default14' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-14.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default14',
          'name'      => __( 'Persona', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default15' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-15.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default15',
          'name'      => __( 'Geek', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default16' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-16.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default16',
          'name'      => __( 'Innovation', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default17' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/default-17.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default17',
          'name'      => __( 'Photographers', 'loginpress' ),
          'pro'       => 'yes'
        ),
        'default18' => array(
          'thumbnail' => plugins_url( 'img/thumbnail/custom-design.png', LOGINPRESS_ROOT_FILE ),
          'id'        => 'default18',
          'name'      => 'Custom Design',
          'pro'       => 'yes'
        )

        );
        $loginpress_templates = apply_filters( 'loginpress_pro_add_template', $loginpress_free_templates );

        $wp_customize->add_control( new LoginPress_Presets( $wp_customize, 'customize_presets_settings',
        array(
          'section' => 'customize_presets',
          // 'label'   => __( 'Themes', 'loginpress' ),
          'choices' => $loginpress_templates
        ) ) );
    //End of Presets.


    //	=============================
    //	= Section for Login Logo		=
    //	=============================
    $wp_customize->add_section( 'customize_logo_section', array(
      'title'				 => __( 'Logo', 'loginpress' ),
      'description'	 => __( 'Customize Your Logo Section', 'loginpress' ),
      'priority'			=> 5,
      'panel'				 => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[setting_logo]', array(
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'      => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'loginpress_customization[setting_logo]', array(
      'label'		 => __( 'Logo Image:', 'loginpress' ),
      'section'	 => 'customize_logo_section',
      'priority'	=> 5,
      'settings'	=> 'loginpress_customization[setting_logo]'
    ) ) );

    $logo_control = array( 'customize_logo_width', 'customize_logo_height', 'customize_logo_padding', 'customize_logo_hover', 'customize_logo_hover_title' );
    $logo_default = array( '84px', '84px', '5px', '', '' );
    $logo_label = array(
      __( 'Logo Width:', 'loginpress' ),
      __( 'Logo Height:', 'loginpress' ),
      __( 'Padding Bottom:', 'loginpress' ),
      __( 'Logo URL:', 'loginpress' ),
      __( 'Logo Hover Title:', 'loginpress' )
    );

    $logo = 0;
    while ( $logo < 5 ) :

      $wp_customize->add_setting( "loginpress_customization[{$logo_control[$logo]}]", array(
        'default'					=> $logo_default[$logo],
        'type'						=> 'option',
        'capability'			=> 'manage_options',
        'transport'       => 'postMessage'
      ) );

      $wp_customize->add_control( "loginpress_customization[{$logo_control[$logo]}]", array(
        'label'						 => $logo_label[$logo],
        'section'					 => 'customize_logo_section',
        'priority'					=> 10,
        'settings'					=> "loginpress_customization[{$logo_control[$logo]}]"
      ) );

      $logo++;
    endwhile;

    //	=============================
    //	= Section for Background		=
    //	=============================
    $wp_customize->add_section( 'section_background', array(
      'title'				 => __( 'Background', 'loginpress' ),
      'description'	 => '',
      'priority'		 => 10,
      'panel'				 => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[loginpress_display_bg]', array(
      'default'        => true,
      'type'           => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[loginpress_display_bg]', array(
      'settings' => 'loginpress_customization[loginpress_display_bg]',
      'label'		=> __( 'Display Background Image?', 'loginpress'),
      'section'	=> 'section_background',
      'priority' => 5,
      'type'		 => 'checkbox',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[setting_background_color]', array(
      // 'default'				=> '#ddd5c3',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[setting_background_color]', array(
      'label'		 => __( 'Background Color:', 'loginpress' ),
      'section'	 => 'section_background',
      'priority'	=> 10,
      'settings'	=> 'loginpress_customization[setting_background_color]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[setting_background]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', LOGINPRESS_ROOT_FILE ) ,
      'type'					 => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'loginpress_customization[setting_background]', array(
      'label'		   => __( 'Background Image:', 'loginpress' ),
      'section'	   => 'section_background',
      'priority'	 => 15,
      'settings'	 => 'loginpress_customization[setting_background]',
    ) ) );


    $wp_customize->add_setting( 'loginpress_customization[background_repeat_radio]', array(
      'default'				=> 'no-repeat',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[background_repeat_radio]', array(
      'label'					=> __( 'Background Repeat:', 'loginpress' ),
      'section'				=> 'section_background',
      'priority'			=> 20,
      'settings'			=> 'loginpress_customization[background_repeat_radio]',
      'type'					=> 'radio',
      'choices'				=> array(
        'repeat'				=> 'repeat',
        'repeat-x'			=> 'repeat-x',
        'repeat-y'			=> 'repeat-y',
        'no-repeat'		  => 'no-repeat',
        'initial'			  => 'initial',
        'inherit'			  => 'inherit',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[background_position]', array(
      'default'				=> 'center',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );
    $wp_customize->add_control( 'loginpress_customization[background_position]', array(
      'settings'			=> 'loginpress_customization[background_position]',
      'label'					=> __( 'Select Position:', 'loginpress' ),
      'section'				=> 'section_background',
      'priority'			=> 25,
      'type'					=> 'select',
      'choices'				=> array(
        'left top'			=> 'left top',
        'left center'	  => 'left center',
        'left bottom'	  => 'left bottom',
        'right top'		  => 'right top',
        'right center'	=> 'right center',
        'right bottom'	=> 'right bottom',
        'center top'		=> 'center top',
        'center'				=> 'center',
        'center bottom' => 'center bottom',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[background_image_size]', array(
      'default'				=> 'cover',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ));

    $wp_customize->add_control( 'loginpress_customization[background_image_size]', array(
      'label'					=> __( 'Background Image Size: ', 'loginpress' ),
      'section'				=> 'section_background',
      'priority'			=> 30,
      'settings'			=> 'loginpress_customization[background_image_size]',
      'type'					=> 'select',
      'choices'					=> array(
        'auto'					=> 'auto',
        'cover'				  => 'cover',
        'contain'			  => 'contain',
        'initial'			  => 'initial',
        'inherit'			  => 'inherit',
      ),
    ) );

    //	=============================
    //	= Section for Form Beauty	 =
    //	=============================
    $wp_customize->add_section( 'section_form', array(
      'title'				 => __( 'Customize Login Form', 'loginpress' ),
      'description'	 => '',
      'priority'			=> 15,
      'panel'				 => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[setting_form_background]', array(
      'type'          => 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'loginpress_customization[setting_form_background]', array(
      'label'		 => __( 'Form Background Image', 'loginpress' ),
      'section'	 => 'section_form',
      'priority'	=> 5,
      'settings'	=> 'loginpress_customization[setting_form_background]'
    ) ) );

    $form_control = array( 'customize_form_width', 'customize_form_height', 'customize_form_padding', 'customize_form_border', 'textfield_width', 'textfield_margin' );
    $form_default = array( '', '200px', '26px 24px 46px', '', '100%', '2px 6px 16px 0px' );
    $form_label = array(
      __( 'Form Width:', 'loginpress' ),
      __( 'Form Minimum Height:', 'loginpress' ),
      __( 'Form Padding:', 'loginpress' ),
      __( 'Border (Example: 2px dotted black):', 'loginpress' ),
      __( 'Input Text Field Width:', 'loginpress' ),
      __( 'Input Text Field Margin:', 'loginpress' )
    );

    $form = 0;
    while ( $form < 6 ) :

      $wp_customize->add_setting( "loginpress_customization[{$form_control[$form]}]", array(
        'default'				=> $form_default[$form],
        'type'					=> 'option',
        'capability'		=> 'manage_options',
        'transport'     => 'postMessage'
      ) );

      $wp_customize->add_control( "loginpress_customization[{$form_control[$form]}]", array(
        'label'						 => $form_label[$form],
        'section'					 => 'section_form',
        // 'priority'					=> 15,
        'settings'				 => "loginpress_customization[{$form_control[$form]}]"
      ) );

      $form++;
    endwhile;

    $form_color_control = array( 'form_background_color', 'textfield_background_color', 'textfield_color', 'textfield_label_color' );
    $form_color_default = array( '#FFF', '#FFF', '#333', '#777' );
    $form_color_label = array(
      __( 'Form Background Color:', 'loginpress' ),
      __( 'Input Field Background Color:', 'loginpress' ),
      __( 'Input Field Text Color:', 'loginpress' ),
      __( 'Label Color:', 'loginpress' ),
    );

    $form_color = 0;
    while ( $form_color < 4 ) :

      $wp_customize->add_setting( "loginpress_customization[{$form_color_control[$form_color]}]", array(
        // 'default'				=> $form_color_default[$form_color],
        'type'					=> 'option',
        'capability'		=> 'manage_options',
        'transport'     => 'postMessage'
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "loginpress_customization[{$form_color_control[$form_color]}]", array(
        'label'		 => $form_color_label[$form_color],
        'section'	 => 'section_form',
        // 'priority'	=> 50,
        'settings'	=> "loginpress_customization[{$form_color_control[$form_color]}]"
      ) ) );

      $form_color++;
    endwhile;

    //	=============================
    //	= Section for Forget Form	 =
    //	=============================
    $wp_customize->add_section(
    'section_forget_form',
    array(
      'title'				 => __( 'Customize Forget Form', 'loginpress' ),
      'description'	 => '',
      'priority'		 => 20,
      'panel'				 => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[forget_form_background]', array(
      'type'          => 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'loginpress_customization[forget_form_background]', array(
      'label'		    => __( 'Forget Form Background Image', 'loginpress' ),
      'section'	    => 'section_forget_form',
      'priority'	  => 5,
      'settings'	  => 'loginpress_customization[forget_form_background]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[forget_form_background_color]', array(
      // 'default'				=> '#FFF',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[forget_form_background_color]', array(
      'label'		 => __( 'Forget Form Background Color', 'loginpress' ),
      'section'	 => 'section_forget_form',
      'priority'	=> 10,
      'settings'	=> 'loginpress_customization[forget_form_background_color]'
    ) ) );

    //	=============================
    //	= Section for Button Style	=
    //	=============================
    $wp_customize->add_section( 'section_button', array(
      'title'				 => __( 'Button Beauty', 'loginpress' ),
      'description'	 => '',
      'priority'		 => 25,
      'panel'				 => 'loginpress_panel',
    ) );

    $button_control = array( 'custom_button_color', 'button_border_color', 'button_hover_color', 'button_hover_border', 'custom_button_shadow', 'button_text_color' );
    $button_default = array( '#2EA2CC', '#0074A2', '#1E8CBE', '#0074A2', '#78C8E6', '#FFF' );
    $button_label = array(
      __( 'Button Color:', 'loginpress' ),
      __( 'Button Border Color:', 'loginpress' ),
      __( 'Button Color (Hover):', 'loginpress' ),
      __( 'Button Border (Hover):', 'loginpress' ),
      __( 'Button Box Shadow:', 'loginpress' ),
      __( 'Button Text Color:', 'loginpress' )
    );

    $button = 0;
    while ( $button < 6 ) :

      $wp_customize->add_setting( "loginpress_customization[{$button_control[$button]}]", array(
        // 'default'				=> $button_default[$button],
        'type'					=> 'option',
        'capability'		=> 'manage_options',
        'transport'     => 'postMessage'
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "loginpress_customization[{$button_control[$button]}]", array(
        'label'		 => $button_label[$button],
        'section'	 => 'section_button',
        'priority'	=> 5,
        'settings'	=> "loginpress_customization[{$button_control[$button]}]"
      ) ) );

      $button++;
    endwhile;

    //	=============================
    //	= Section for Error message =
    //	=============================
    $wp_customize->add_section( 'section_error', array(
      'title'				 => __( 'Error Messages', 'loginpress' ),
      'description'	 => '',
      'priority'		 => 30,
      'panel'				 => 'loginpress_panel',
    ) );

    $error_control = array( 'incorrect_username', 'incorrect_password', 'empty_username', 'empty_password', 'invalid_email', 'empty_email', 'username_exists', 'email_exists', 'invalidcombo_message', 'force_email_login' );
    $error_default = array(
      sprintf( __( '%1$sError:%2$s Invalid Username.', 'loginpress' ), '<strong>', '</strong>' ), sprintf( __( '%1$sError:%2$s Invalid Password.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s The username field is empty.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s The password field is empty.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s The email address isn\'t correct..', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s Please type your email address.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s This username is already registered. Please choose another one.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s This email is already registered, please choose another one.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s Invalid username or email.', 'loginpress' ), '<strong>', '</strong>' ),
      sprintf( __( '%1$sError:%2$s Invalid Email Address', 'loginpress' ), '<strong>', '</strong>' ) );
    $error_label = array(
      __( 'Incorrect Username Message:',  'loginpress' ),
      __( 'Incorrect Password Message:',  'loginpress' ),
      __( 'Empty Username Message:',      'loginpress' ),
      __( 'Empty Password Message:',      'loginpress' ),
      __( 'Invalid Email Message:',       'loginpress' ),
      __( 'Empty Email Message:',         'loginpress' ),
      __( 'Username Already Exist Message:','loginpress' ),
      __( 'Email Already Exist Message:', 'loginpress' ),
      __( 'Forget Password Message:',     'loginpress' ),
      __( 'Login with Email Message:',    'loginpress' ),
    );

    $error = 0;
    while ( $error < 10 ) :

      $wp_customize->add_setting( "loginpress_customization[{$error_control[$error]}]", array(
        'default'				=> $error_default[$error],
        'type'					=> 'option',
        'capability'		=> 'manage_options',
        'transport'     => 'postMessage'
      ) );

      $wp_customize->add_control( "loginpress_customization[{$error_control[$error]}]", array(
        'label'						 => $error_label[$error],
        'section'					 => 'section_error',
        'priority'				 => 5,
        'settings'				 => "loginpress_customization[{$error_control[$error]}]",
      ) );

      $error++;
    endwhile;

    //	=============================
    //	= Section for Welcome message
    //	=============================
    $wp_customize->add_section( 'section_welcome', array(
      'title'				 => __( 'Welcome Messages', 'loginpress' ),
      'description'	 => '',
      'priority'		 => 35,
      'panel'				 => 'loginpress_panel',
    ) );

    $welcome_control = array( 'lostpwd_welcome_message', 'welcome_message', 'register_welcome_message', 'logout_message', 'message_background_border' );
    $welcome_default = array( 'Forgot password?', 'Welcome', 'Register For This Site', 'Logout', '' );
    $welcome_label	 = array(
      __( 'Welcome Message on Lost Password:', 'loginpress' ),
      __( 'Welcome Message on Login Page:', 'loginpress' ),
      __( 'Welcome Message on Registration:', 'loginpress' ),
      __( 'Logout Message:', 'loginpress' ),
      __( 'Message Field Border: ( Example: 1px solid #00a0d2; )', 'loginpress' ),
    );

    $welcome = 0;
    while ( $welcome < 5 ) :

      $wp_customize->add_setting( "loginpress_customization[{$welcome_control[$welcome]}]", array(
        'type'					=> 'option',
        'capability'		=> 'manage_options',
        'transport'     => 'postMessage'
      ));

      $wp_customize->add_control( "loginpress_customization[{$welcome_control[$welcome]}]", array(
        'label'						 => $welcome_label[ $welcome ],
        'section'					 => 'section_welcome',
        'priority'					=> 5,
        'settings'					=> "loginpress_customization[{$welcome_control[$welcome]}]",
        'input_attrs' => array(
            'placeholder' => $welcome_default[ $welcome ],
        )
      ) );

      $welcome++;
    endwhile;

    $wp_customize->add_setting( 'loginpress_customization[message_background_color]', array(
      // 'default'				=> '#fff',
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[message_background_color]', array(
      'label'		 => __( 'Message Field Background Color:', 'loginpress' ),
      'section'	 => 'section_welcome',
      'priority'	=> 30,
      'settings'	=> 'loginpress_customization[message_background_color]'
    ) ) );

    //	=============================
    //	= Section for Header message
    //	=============================
    // $wp_customize->add_section(
    //		 'section_head',
    //		 array(
    //				 'title'				 => __( 'Header Message', 'loginpress' ),
    //				 'description'	 => '',
    //				 'priority'			=> 35,
    //				 'panel'				 => 'loginpress_panel',
    // ));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_hearder_message]', array(
    //		 'default'					 => 'Latest NEWS',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control( 'login_hearder_message', array(
    //		 'label'						 => __( 'Header Message:', 'loginpress' ),
    //		 'section'					 => 'section_head',
    //		 'priority'					=> 5,
    //		 'settings'					=> 'loginpress_customization[login_hearder_message]',
    // ));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_hearder_message_link]', array(
    //		 'default'					 => '#',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control( 'login_hearder_message_link', array(
    //		 'label'						 => __( 'Header Message Link:', 'loginpress' ),
    //		 'section'					 => 'section_head',
    //		 'priority'					=> 5,
    //		 'settings'					=> 'loginpress_customization[login_hearder_message_link]',
    // ));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_head_color]', array(
    //		 'default'					 => '#17a8e3',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control(
    //		 new WP_Customize_Color_Control(
    //				 $wp_customize,
    //				 'login_head_color',
    //				 array(
    //						 'label'		 => __( 'Header Text Color:', 'loginpress' ),
    //						 'section'	 => 'section_head',
    //						 'priority'	=> 10,
    //						 'settings'	=> 'loginpress_customization[login_head_color]'
    //		 )));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_head_color_hover]', array(
    //		 // 'default'					 => '#17a8e3',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control(
    //		 new WP_Customize_Color_Control(
    //				 $wp_customize,
    //				 'login_head_color_hover',
    //				 array(
    //						 'label'		 => __( 'Header Text Hover Color:', 'loginpress' ),
    //						 'section'	 => 'section_head',
    //						 'priority'	=> 15,
    //						 'settings'	=> 'loginpress_customization[login_head_color_hover]'
    //		 )));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_head_font_size]', array(
    //		 'default'					 => '13px;',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control( 'login_head_font_size', array(
    //		 'label'						 => __( 'Text Font Size:', 'loginpress' ),
    //		 'section'					 => 'section_head',
    //		 'priority'					=> 20,
    //		 'settings'					=> 'loginpress_customization[login_head_font_size]',
    // ));
    //
    // $wp_customize->add_setting( 'loginpress_customization[login_head_bg_color]', array(
    //		 // 'default'					 => '#17a8e3',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));
    //
    // $wp_customize->add_control(
    //		 new WP_Customize_Color_Control(
    //				 $wp_customize,
    //				 'login_head_bg_color',
    //				 array(
    //						 'label'		 => __( 'Header Background Color:', 'loginpress' ),
    //						 'section'	 => 'section_head',
    //						 'priority'	=> 25,
    //						 'settings'	=> 'loginpress_customization[login_head_bg_color]'
    //		 )));

    //	=============================
    //	= Custom Header Login menu	=
    //	=============================
    // $menuVals	 = array();
    // $menus			= get_registered_nav_menus();
    //
    // foreach ( $menus as $location => $name ) {
    //   $menuVals[$location] =	 $name ;
    // }
    // $wp_customize->add_section(
    // 'customize_menu_section',
    // array(
    //   'title'				 => __( 'Login Page Menus', 'loginpress' ),
    //   'description'	 => '',
    //   'priority'			=> 32,
    //   'panel'				 => 'loginpress_panel',
    // ));
    //
    // $wp_customize->add_setting('loginpress_customization[header_login_menu]', array(
    //   'capability' => 'edit_theme_options',
    //   'type'			 => 'option',
    // ));
    //
    // $wp_customize->add_control('header_login_menu', array(
    //   'settings' => 'loginpress_customization[header_login_menu]',
    //   'label'		=> __( 'Display Header Menu?', 'loginpress'),
    //   'section'	=> 'customize_menu_section',
    //   'priority' => 5,
    //   'type'		 => 'checkbox',
    // ));
    //
    // $wp_customize->add_setting('loginpress_customization[customize_login_menu]', array(
    //   'capability'		 => 'edit_theme_options',
    //   'type'					 => 'option',
    //
    // ));
    // $wp_customize->add_control( 'customize_login_menu', array(
    //   'settings' => 'loginpress_customization[customize_login_menu]',
    //   'label'	 => __( 'Select Menu for Header:', 'loginpress' ),
    //   'section' => 'customize_menu_section',
    //   'type'		=> 'select',
    //   'priority' => 10,
    //   'choices'		=> $menuVals,
    // ));
    //
    // $wp_customize->add_setting('loginpress_customization[footer_login_menu]', array(
    //   'capability' => 'edit_theme_options',
    //   'type'			 => 'option',
    // ));
    //
    // $wp_customize->add_control('footer_login_menu', array(
    //   'settings' => 'loginpress_customization[footer_login_menu]',
    //   'label'		=> __( 'Display Footer Menu?', 'loginpress' ),
    //   'section'	=> 'customize_menu_section',
    //   'priority' => 15,
    //   'type'		 => 'checkbox',
    // ));
    //
    // $wp_customize->add_setting('loginpress_customization[customize_login_footer_menu]', array(
    //   'capability'		 => 'edit_theme_options',
    //   'type'					 => 'option',
    //
    // ));
    // $wp_customize->add_control( 'customize_login_footer_menu', array(
    //   'settings' => 'loginpress_customization[customize_login_footer_menu]',
    //   'label'	 => __( 'Select Menu:', 'loginpress' ),
    //   'section' => 'customize_menu_section',
    //   'priority' => 20,
    //   'type'		=> 'select',
    //   'choices'		=> $menuVals,
    // ));

    //	=============================
    //	= Section for Form Footer	 =
    //	=============================
    $wp_customize->add_section( 'section_fotter', array(
      'title'				 => __( 'Form Footer', 'loginpress' ),
      'description'	 => '',
      'priority'			=> 40,
      'panel'				 => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_text]', array(
      'default'					=> 'Lost your password?',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[login_footer_text]', array(
      'label'						 => __( 'Lost Password Text', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'				 => 5,
      'settings'				 => 'loginpress_customization[login_footer_text]',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[footer_display_text]', array(
      'default'					=> 'block',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ));

    $wp_customize->add_control( 'loginpress_customization[footer_display_text]', array(
      'label'						 => __( 'Footer Text Display:', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'				 => 10,
      'settings'				 => 'loginpress_customization[footer_display_text]',
      'type'						 => 'radio',
      'choices'					 => array(
        'block'				 => 'show',
        'none'				 => 'hide',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_text_decoration]', array(
      'default'					=> 'none',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'

    ) );
    $wp_customize->add_control( 'loginpress_customization[login_footer_text_decoration]', array(
      'settings'				=> 'loginpress_customization[login_footer_text_decoration]',
      'label'						=> 'Select Text Decoration:',
      'section'					=> 'section_fotter',
      'priority'				=> 15,
      'type'						=> 'select',
      'choices'					=> array(
        'none'					=> 'none',
        'overline'			=> 'overline',
        'line-through'	=> 'line-through',
        'underline'		  => 'underline',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_color]', array(
      // 'default'					=> '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_footer_color]', array(
      'label'		    => __( 'Footer Text Color:', 'loginpress' ),
      'section'	    => 'section_fotter',
      'priority'	  => 20,
      'settings'	  => 'loginpress_customization[login_footer_color]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_color_hover]', array(
      // 'default'				  => '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_footer_color_hover]', array(
      'label'		 => __( 'Footer Text Hover Color:', 'loginpress' ),
      'section'	 => 'section_fotter',
      'priority'	=> 25,
      'settings'	=> 'loginpress_customization[login_footer_color_hover]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_font_size]', array(
      'default'					=> '13px',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[login_footer_font_size]', array(
      'label'						 => __( 'Text Font Size:', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'					=> 30,
      'settings'					=> 'loginpress_customization[login_footer_font_size]',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_bg_color]', array(
      // 'default'					 => '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_footer_bg_color]', array(
      'label'		 => __( 'Footer Background Color:', 'loginpress' ),
      'section'	 => 'section_fotter',
      'priority'	=> 35,
      'settings'	=> 'loginpress_customization[login_footer_bg_color]'
    ) ) );
    // Fields for Back Link
    // $wp_customize->add_setting( 'login_back_text', array(
    //		 'default'					 => 'Lost your password?',
    //		 'type'							=> 'option',
    //		 'capability'				=> 'edit_theme_options',
    // ));

    // $wp_customize->add_control( 'login_back_text', array(
    //		 'label'						 => __( 'Lost Password Text', 'loginpress' ),
    //		 'section'					 => 'section_fotter',
    //		 'priority'					=> 40,
    //		 'settings'					=> 'login_back_text',
    // ));

    $wp_customize->add_setting( 'loginpress_customization[back_display_text]', array(
      'default'					=> 'block',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[back_display_text]', array(
      'label'						 => __( '"Back to" Text Display:', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'				 => 45,
      'settings'				 => 'loginpress_customization[back_display_text]',
      'type'						 => 'radio',
      'choices'					 => array(
        'block'				 => 'show',
        'none'				 => 'hide',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_back_text_decoration]', array(
      'default'					=> 'none',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'

    ) );
    $wp_customize->add_control( 'loginpress_customization[login_back_text_decoration]', array(
      'settings'				 => 'loginpress_customization[login_back_text_decoration]',
      'label'						 => __( '"Back to" Text Decoration:', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'				 => 50,
      'type'						 => 'select',
      'choices'					 => array(
        'none'					=> 'none',
        'overline'			=> 'overline',
        'line-through'	=> 'line-through',
        'underline'		  => 'underline',
      ),
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_back_color]', array(
      // 'default'					=> '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_back_color]', array(
      'label'		 => __( '"Back to" Text Color:', 'loginpress' ),
      'section'	 => 'section_fotter',
      'priority'	=> 55,
      'settings'	=> 'loginpress_customization[login_back_color]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[login_back_color_hover]', array(
      // 'default'					 => '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_back_color_hover]', array(
      'label'		  => __( '"Back to" Text Hover Color:', 'loginpress' ),
      'section'	  => 'section_fotter',
      'priority'	=> 60,
      'settings'	=> 'loginpress_customization[login_back_color_hover]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[login_back_font_size]', array(
      'default'					=> '13px;',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[login_back_font_size]', array(
      'label'						 => __( '"Back to" Text Font Size:', 'loginpress' ),
      'section'					 => 'section_fotter',
      'priority'				 => 65,
      'settings'				 => 'loginpress_customization[login_back_font_size]',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[login_back_bg_color]', array(
      // 'default'					 => '#17a8e3',
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'loginpress_customization[login_back_bg_color]', array(
      'label'		        => __( 'Footer Background Color:', 'loginpress' ),
      'section'	        => 'section_fotter',
      'priority'	      => 70,
      'settings'	      => 'loginpress_customization[login_back_bg_color]'
    ) ) );

    $wp_customize->add_setting( 'loginpress_customization[login_footer_copy_right]', array(
      'default'					=> sprintf( __('© %1$s %2$s, All Rights Reserved.', 'loginpress'), date("Y"), get_bloginfo('name') ),
      'type'						=> 'option',
      'capability'			=> 'manage_options',
      'transport'       => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[login_footer_copy_right]', array(
      'label'						 => __( 'Copyright Note:', 'loginpress' ),
      'type'						 => 'textarea',
      'section'					 => 'section_fotter',
      'priority'				 => 75,
      'settings'				 => 'loginpress_customization[login_footer_copy_right]'
    ) );

    $wp_customize->add_setting( 'loginpress_customization[loginpress_show_love]', array(
      'default'          => true,
      'type'             => 'option',
      'capability'		   => 'manage_options',
      'transport'        => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[loginpress_show_love]', array(
      'settings'         => 'loginpress_customization[loginpress_show_love]',
      'section'	         => 'section_fotter',
      'priority'         => 80,
      'type'		         => 'checkbox',
      'label'		         => __( 'Show some Love. Please help other learn about this free plugin by placing small link in footer. Thank you very much!', 'loginpress' ),
    ) );

    //	=============================
    //	= Section for Custom CSS/JS	=
    //	=============================
    $wp_customize->add_section(
    'loginpress_custom_css_js',
    array(
      'title'				      => __( 'Custom CSS/JS', 'loginpress' ),
      'description'	      => '',
      'priority'		      => 50,
      'panel'				      => 'loginpress_panel',
    ) );

    $wp_customize->add_setting( 'loginpress_customization[loginpress_custom_css]', array(
      'type'						  => 'option',
      'capability'			  => 'manage_options',
      'transport'         => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[loginpress_custom_css]', array(
      'label'						  => __( 'Customize CSS', 'loginpress' ),
      'type'						  => 'textarea',
      'section'					  => 'loginpress_custom_css_js',
      'priority'				  => 5,
      'settings'				  => 'loginpress_customization[loginpress_custom_css]',
      'description'       => sprintf( __( 'Custom CSS doen\'t make effect live. For preview please save the setting and visit %1$s login%2$s page or after save refresh the customizer.', "loginpress" ), '<a href="' . wp_login_url() .'"title="Login" target="_blank">', '</a>')
    ) );

    $wp_customize->add_setting( 'loginpress_customization[loginpress_custom_js]', array(
      'type'						   => 'option',
      'capability'			   => 'manage_options',
      'transport'          => 'postMessage'
    ) );

    $wp_customize->add_control( 'loginpress_customization[loginpress_custom_js]', array(
      'label'						   => __( 'Customize JS', 'loginpress' ),
      'type'						   => 'textarea',
      'section'					   => 'loginpress_custom_css_js',
      'priority'				   => 10,
      'settings'				   => 'loginpress_customization[loginpress_custom_js]',
      'description'        => sprintf( __( 'Custom JS doen\'t make effect live. For preview please save the setting and visit %1$s login%2$s page or after save refresh the customizer.', "loginpress" ), '<a href="' . wp_login_url() .'"title="Login" target="_blank">', '</a>')
    ) );
    //	=============================
    //	= Section for Custom JS		 =
    //	=============================
    // $wp_customize->add_section(
    // 'section_js',
    // array(
    //   'title'				       => __( 'Custom JS', 'loginpress' ),
    //   'description'	       => '',
    //   'priority'		       => 55,
    //   'panel'				       => 'loginpress_panel',
    // ) );
    //
    // $wp_customize->add_setting( 'loginpress_customization[loginpress_custom_js]', array(
    //   'type'						   => 'option',
    //   'capability'			   => 'manage_options',
    //   'transport'          => 'postMessage'
    // ) );
    //
    // $wp_customize->add_control( 'loginpress_customization[loginpress_custom_js]', array(
    //   'label'						   => __( 'Customize JS', 'loginpress' ),
    //   'type'						   => 'textarea',
    //   'section'					   => 'section_js',
    //   'priority'				   => 5,
    //   'settings'				   => 'loginpress_customization[loginpress_custom_js]',
    //   'description'        => sprintf( __( 'Custom JS doen\'t make effect live. For preview please save the setting and visit %1$s login%2$s page or after save refresh the customizer.', "loginpress" ), '<a href="' . wp_login_url() .'"title="Login" target="_blank">', '</a>')
    // ) );
  }

  /**
  * Manage the Login Footer Links
  *
  * @since	1.0.0
  * * * * * * * * * * * * * * * */
  public function login_page_custom_footer() {

    if ( empty( $this->loginpress_key ) || ( isset($this->loginpress_key['loginpress_show_love']) &&  $this->loginpress_key['loginpress_show_love'] != ''  ) ) {
      echo '<div class="loginpress-show-love">' . __( 'Powered by:', 'loginpress' ) . ' <a href="https://wpbrigade.com" target="_blank">LoginPress</a></div>';
    }

    if ( $this->loginpress_key ) {

      // echo '</div></div>';
      echo '<div class="footer-wrapper">';
      echo '<div class="footer-cont">';

      //   if ( array_key_exists( 'footer_login_menu', $this->loginpress_key ) && checked( $this->loginpress_key['footer_login_menu'], true, false ) ) {
      //
      //     wp_nav_menu( array(
      //       'theme_location' => $this->loginpress_key['customize_login_footer_menu'],
      //       'container' => false,
      //       'menu_class' => 'loginFooterMenu',
      //       'echo' => true,
      //     )
      //   );
      //
      // }

      if ( array_key_exists( 'login_footer_copy_right', $this->loginpress_key ) && ! empty( $this->loginpress_key['login_footer_copy_right'] ) ) {

        echo '<div class="copyRight">'.$this->loginpress_key['login_footer_copy_right'].'</div>';
      }

      echo '</div></div>';
    }
  }

  /**
  * Manage the Login Head
  *
  * @since	1.0.0
  * * * * * * * * * * * */
  public function login_page_custom_head() {

		add_filter( 'gettext', array( $this, 'change_lostpassword_message' ), 20, 3 );
    // Include CSS File in heared.

    include( LOGINPRESS_DIR_PATH . 'css/style-presets.php' );
    include( LOGINPRESS_DIR_PATH . 'css/style-login.php' );

    if ( $this->loginpress_key && array_key_exists( 'header_login_menu', $this->loginpress_key ) ) {

      // echo '<div class="header-wrapper">';
      // echo '<div class="header-cell">';
      //   if ( array_key_exists( 'header_login_menu', $this->loginpress_key ) && checked( $this->loginpress_key['header_login_menu'], true, false ) ) {
      //
      //     wp_nav_menu( array(
      //       'theme_location' => $this->loginpress_key['customize_login_menu'],
      //       'container' => false,
      //       'menu_class' => 'loginHeaderMenu',
      //       'echo' => true,
      //     )
      //   );
      // }
      // echo '</div></div><div class="login-wrapper"><div class="login-cell">';
    }
  }
  /**
  * Set Redirect Path of Logo
  *
  * @since	1.0.0
  * @return mixed
  * * * * * * * * * * * * * */
  public function login_page_logo_url() {

    if ( $this->loginpress_key && array_key_exists( 'customize_logo_hover', $this->loginpress_key ) && ! empty( $this->loginpress_key['customize_logo_hover'] ) ) {
      return $this->loginpress_key["customize_logo_hover"];
    } else {
      return	home_url();
    }
  }

  /**
  * Remove the filter login_errors from woocommerce login form.
  *
  * @since	1.0.16
  * @return errors
  * * * * * * * * * * * * */
  function loginpress_woo_login_errors( $validation_error, $arg1, $arg2 ) {

      remove_filter( 'login_errors', array( $this, 'login_error_messages' ) );
      return $validation_error;
  }


  /**
  * Set hover Title of Logo
  *
  * @since	1.0.0
  * @return mixed
  * * * * * * * * * * * * */
  public function login_page_logo_title() {

    if ( $this->loginpress_key && array_key_exists( 'customize_logo_hover_title', $this->loginpress_key ) && ! empty( $this->loginpress_key['customize_logo_hover_title'] ) ) {
      return $this->loginpress_key["customize_logo_hover_title"];
    } else {
      return	home_url();
    }
  }

  /**
  * Set Errors Messages to Show off
  *
  * @param	$error
  * @since	1.0.0
  * @return string
  * * * * * * * * * * * * * * * * */
  public function login_error_messages($error) {

    global $errors;

    if ( isset( $errors ) ){

        $error_codes = $errors->get_error_codes();

        if ( $this->loginpress_key ) {

            $invalid_usrname = array_key_exists( 'incorrect_username', $this->loginpress_key ) && ! empty( $this->loginpress_key['incorrect_username'] ) ? $this->loginpress_key['incorrect_username'] : sprintf( __( '%1$sError:%2$s Invalid Username.', 'loginpress' ), '<strong>', '</strong>' );

            $invalid_pasword = array_key_exists( 'incorrect_password', $this->loginpress_key ) && ! empty( $this->loginpress_key['incorrect_password'] ) ? $this->loginpress_key['incorrect_password'] : sprintf( __( '%1$sError:%2$s Invalid Password.', 'loginpress' ), '<strong>', '</strong>' );

            $empty_username = array_key_exists( 'empty_username', $this->loginpress_key ) && ! empty( $this->loginpress_key['empty_username'] ) ? $this->loginpress_key['empty_username'] : sprintf( __( '%1$sError:%2$s The username field is empty.', 'loginpress' ), '<strong>', '</strong>' );

            $empty_password = array_key_exists( 'empty_password', $this->loginpress_key ) && ! empty( $this->loginpress_key['empty_password'] ) ? $this->loginpress_key['empty_password'] : sprintf( __( '%1$sError:%2$s The password field is empty.', 'loginpress' ), '<strong>', '</strong>' );

            $invalid_email   = array_key_exists( 'invalid_email', $this->loginpress_key ) && ! empty( $this->loginpress_key['invalid_email'] ) ? $this->loginpress_key['invalid_email'] : sprintf( __( '%1$sError:%2$s The email address isn\'t correct..', 'loginpress' ), '<strong>', '</strong>' );

            $empty_email     = array_key_exists( 'empty_email', $this->loginpress_key ) && ! empty( $this->loginpress_key['empty_email'] ) ? $this->loginpress_key['empty_email'] : sprintf( __( '%1$sError:%2$s Please type your email address.', 'loginpress' ), '<strong>', '</strong>' );

            $username_exists  = array_key_exists( 'username_exists', $this->loginpress_key ) && ! empty( $this->loginpress_key['username_exists'] ) ? $this->loginpress_key['username_exists'] : sprintf( __( '%1$sError:%2$s This username is already registered. Please choose another one.', 'loginpress' ), '<strong>', '</strong>' );

            $email_exists  = array_key_exists( 'email_exists', $this->loginpress_key ) && ! empty( $this->loginpress_key['email_exists'] ) ? $this->loginpress_key['email_exists'] : sprintf( __( '%1$sError:%2$s This email is already registered, please choose another one.', 'loginpress' ), '<strong>', '</strong>' );

            $invalidcombo   = array_key_exists( 'invalidcombo_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['invalidcombo_message'] ) ? $this->loginpress_key['invalidcombo_message'] : sprintf( __( '%1$sError:%2$s Invalid username or email.', 'loginpress' ), '<strong>', '</strong>' );

            if ( in_array( 'invalid_username',    $error_codes ) ) return $invalid_usrname;

            if ( in_array( 'incorrect_password',  $error_codes ) ) return $invalid_pasword;

            if ( in_array( 'empty_username',      $error_codes ) ) return $empty_username;

            if ( in_array( 'empty_password',      $error_codes ) ) return $empty_password;

            // registeration Form enteries.
            if ( in_array( 'invalid_email',       $error_codes ) ) return $invalid_email;

            if ( in_array( 'empty_email',         $error_codes ) ) return "</br>" . $empty_email;

            if ( in_array( 'username_exists',     $error_codes ) ) return $username_exists;

            if ( in_array( 'email_exists',        $error_codes ) ) return $email_exists;

            // forget password entery.
            if ( in_array( 'invalidcombo',        $error_codes ) ) return $invalidcombo;
        }
    }

    return $error;
  }

  /**
  * Change Lost Password Text from Form
  *
  * @param	$text
  * @since	1.0.0
  * @version 1.0.21
  * @return mixed
  * * * * * * * * * * * * * * * * * * */
  public function change_lostpassword_message ( $translated_text, $text, $domain ) {

		if ( is_array( $this->loginpress_key ) && array_key_exists( 'login_footer_text', $this->loginpress_key ) && $text == 'Lost your password?'  && 'default' == $domain && trim( $this->loginpress_key['login_footer_text'] ) ) {

			return trim( $this->loginpress_key['login_footer_text'] );
		}

    return $translated_text;
  }

  /**
  * Manage Welcome Messages
  *
  * @param	$message
  * @since	1.0.0
  * @return string
  * * * * * * * * * * * * */
  public function change_welcome_message ($message) {

    if ( $this->loginpress_key ) {

      //Check, User Logedout.
      if ( isset( $_GET['loggedout'] ) && TRUE == $_GET['loggedout'] ) {

        if ( array_key_exists( 'logout_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['logout_message'] ) ) {

          $loginpress_message = $this->loginpress_key['logout_message'];
        }
      }

      //Logged In messages.
      else if ( strpos( $message, __( "Please enter your username or email address. You will receive a link to create a new password via email." ) ) == true ) {

        if ( array_key_exists( 'lostpwd_welcome_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['lostpwd_welcome_message'] ) ) {

          $loginpress_message = $this->loginpress_key['lostpwd_welcome_message'];
        }
      }

      else if( strpos( $message, __( "Register For This Site" ) ) == true ) {

        if ( array_key_exists( 'register_welcome_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['register_welcome_message'] ) ) {

          $loginpress_message = $this->loginpress_key['register_welcome_message'];
        }
      }

      // @since 1.0.18
      // else if ( strpos( $message, __( "Enter your new password below." ) ) == true ) {
      //
      //   if ( array_key_exists( 'reset_hint_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['reset_hint_message'] ) ) {
      //
      //     $loginpress_message = $this->loginpress_key['reset_hint_message'];
      //   }
      // }

      // @since 1.0.18
      else if ( strpos( $message, __( "Your password has been reset." ) ) == true ) {

        // if ( array_key_exists( 'after_reset_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['after_reset_message'] ) ) {

          $loginpress_message = __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>';
        // }
      }

      else {
        if ( array_key_exists( 'welcome_message', $this->loginpress_key ) && ! empty( $this->loginpress_key['welcome_message'] ) ) {

          $loginpress_message = $this->loginpress_key['welcome_message'];
        }
      }


      return ! empty( $loginpress_message ) ? "<p class='custom-message'>" . $loginpress_message. "</p>" : $message;
    }
  }

  /**
  * Hook to Redirect Page for Customize
  *
  * @since	1.0.0
  * * * * * * * * * * * * * * * * * * */
  public function redirect_to_custom_page() {
    if ( ! empty($_GET['page'] ) ) {

      if( ( $_GET['page'] == "abw" ) || ( $_GET['page'] == "loginpress" ) ) {

        wp_redirect(get_admin_url()."customize.php?url=".wp_login_url());
      }
    }
  }

  /**
  * Redirect to the Admin Panel After Closing LoginPress Customizer
  *
  * @since	1.0.0
  * @return null
  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  public function menu_url() {

    global $submenu;

    $parent = 'index.php';
    $page	 = 'abw';

    // Create specific url for login view
    $login_url = wp_login_url();
    $url			 = add_query_arg(
    array(
      'url'		=> urlencode( $login_url ),
      'return' => admin_url( 'themes.php' ),
    ),
    admin_url( 'customize.php' )
    );

    // If is Not Design Menu, return
    if ( ! isset( $submenu[ $parent ] ) ) {
      return NULL;
    }

    foreach ( $submenu[ $parent ] as $key => $value ) {
      // Set new URL for menu item
      if ( $page === $value[ 2 ] ) {
        $submenu[ $parent ][ $key ][ 2 ] = $url;
        break;
      }
    }
  }
}

?>
