<?php
/**
 * Ignis Theme Customizer
 *
 * @package Ignis
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ignis_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'header_image' )->panel = 'ignis_panel_header';
    $wp_customize->get_section( 'colors' )->panel = 'ignis_panel_colors';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'colors' )->title = __('General', 'ignis');



    // Panel: Header.
    $wp_customize->add_panel( 'ignis_panel_header', array(
        'priority'       => 10,
        'title'          => __( 'Header', 'ignis' ),
    ) );
    // Section: Header text.
    $wp_customize->add_section( 'ignis_section_header', array(
        'priority'       => 10,
        'panel'          => 'ignis_panel_header',
        'title'          => __( 'Header text', 'ignis' ),
    ) );
    // Setting: Hero title.
    $wp_customize->add_setting( 'header_title', array(
        'sanitize_callback'    => 'wp_kses_post',
        'default'              => __( 'My name is Joe<span class="color-primary">.</span><br> I\'m a ', 'ignis'),
    ) );
    // Control: Hero title
    $wp_customize->add_control( 'header_title', array(
        'label'       => __( 'Hero title', 'ignis' ),
        'section'     => 'ignis_section_header',
        'type'        => 'text',
        'settings'    => 'header_title',
    ) );
    // Setting: Hero subtitle.
    $wp_customize->add_setting( 'header_subtitle', array(
        'sanitize_callback'    => 'wp_kses_post',
        'default'              => __( 'Scroll down to begin your adventure', 'ignis')
    ) );
    // Control: Hero subtitle
    $wp_customize->add_control( 'header_subtitle', array(
        'label'       => __( 'Hero subtitle', 'ignis' ),
        'section'     => 'ignis_section_header',
        'type'        => 'text',
        'settings'    => 'header_subtitle',
    ) );    
	// Setting: Typed strings.
	$wp_customize->add_setting( 'typed_strings', array(
		'sanitize_callback'    => 'wp_kses_post',
        'default'              => '^developer' . "\n" . '^entrepreneur',
	) );
	
	// Control: Typed strings.
	$wp_customize->add_control( 'typed_strings', array(
		'label'       => __( 'Animated typing', 'ignis' ),
        'description' => __( 'Start each new line with <strong>^</strong>, as shown below for the default values', 'ignis' ),        
		'section'     => 'ignis_section_header',
		'type'        => 'textarea',
		'settings'    => 'typed_strings',
	) );
    // Section: Menu.
    $wp_customize->add_section( 'ignis_section_menu', array(
        'priority'       => 13,
        'panel'          => 'ignis_panel_header',
        'title'          => __( 'Menu options', 'ignis' ),
    ) );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           =>  'sticky-header',
            'sanitize_callback' => 'ignis_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'ignis'),
            'section' => 'ignis_section_menu',
            'choices' => array(
                'sticky-header'   => __('Sticky', 'ignis'),
                'static-header'   => __('Static', 'ignis'),
            ),
        )
    );


	// Panel: Typography.
	$wp_customize->add_panel( 'ignis_typography', array(
		'priority'       => 21,
		'title'          => __( 'Typography', 'ignis' ),
		'description'    => __( 'Panle Description.', 'ignis' ),
	) );
	// Section: Fonts.
	$wp_customize->add_section( 'ignis_fonts', array(
		'priority'       => 10,
		'panel'          => 'ignis_typography',
		'title'          => __( 'Fonts', 'ignis' ),
	) );
	
    //Headings
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default'           => 'Poppins',
            'sanitize_callback' => 'ignis_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'type'        => 'text',
            'label'       => __('Headings font', 'ignis'),
            'section'     => 'ignis_fonts',
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default'           => 'Nunito',
            'sanitize_callback'	=> 'ignis_sanitize_text'
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'type'        => 'text',
            'label'       => __('Body font', 'ignis'),
            'section'     => 'ignis_fonts',
        )
    );
    // Section: Font sizes.
    $wp_customize->add_section( 'ignis_font_sizes', array(
        'priority'       => 11,
        'panel'          => 'ignis_typography',
        'title'          => __( 'Font sizes', 'ignis' ),
    ) );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'            
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 10,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Site title', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Site desc
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'            
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Site description', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Home hero
    $wp_customize->add_setting(
        'hero_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '94',
            'transport'         => 'postMessage'            
        )       
    );
    $wp_customize->add_control( 'hero_text_size', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Home hero text', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 120,
            'step'  => 1,
        ),
    ) );    
    // Menu items
    $wp_customize->add_setting(
        'menu_items',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '13',
            'transport'         => 'postMessage'            
        )       
    );
    $wp_customize->add_control( 'menu_items', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Menu items', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 40,
            'step'  => 1,
        ),
    ) );
    // Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 14,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Body', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Index post titles
    $wp_customize->add_setting(
        'index_post_title',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '22',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'index_post_title', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Index post titles', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Single post titles
    $wp_customize->add_setting(
        'single_post_title',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '56',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'single_post_title', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Banner titles (singles, archives etc.)', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Sidebar widget titles
    $wp_customize->add_setting(
        'sidebar_widgets_title',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'sidebar_widgets_title', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'ignis_font_sizes',
        'label'       => __('Sidebar widget titles', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );

    // Panel: Colors.
     $wp_customize->add_panel( 'ignis_panel_colors', array(
         'priority'       => 21,
         'title'          => __( 'Colors', 'ignis' ),
     ) );
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#ff6b7e',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'ignis'),
                'section'       => 'colors',
                'priority'      => 10
            )
        )
    );    
    //Secondary color
    $wp_customize->add_setting(
        'secondary_color',
        array(
            'default'           => '#37c9df',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'secondary_color',
            array(
                'label'         => __('Secondary color', 'ignis'),
                'section'       => 'colors',
                'priority'      => 11
            )
        )
    );                       
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#4a4a4a',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'ignis'),
                'section' => 'colors',
                'settings' => 'body_text_color',
                'priority' => 12
            )
        )
    );    
    // Section: Header colors.
    $wp_customize->add_section( 'ignis_section_header_colors', array(
        'priority'       => 11,
        'panel'          => 'ignis_panel_colors',
        'title'          => __( 'Header', 'ignis' ),
    ) );
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'ignis'),
                'section' => 'ignis_section_header_colors',
                'settings' => 'site_title_color',
                'priority' => 10
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#b2b5bb',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'ignis'),
                'section' => 'ignis_section_header_colors',
                'priority' => 11
            )
        )
    );
    //Home hero text
    $wp_customize->add_setting(
        'home_hero_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'home_hero_color',
            array(
                'label' => __('Home hero text', 'ignis'),
                'section' => 'ignis_section_header_colors',
                'priority' => 11
            )
        )
    );
    //Home hero subtext
    $wp_customize->add_setting(
        'home_hero_subtext_color',
        array(
            'default'           => '#686d73',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'home_hero_subtext_color',
            array(
                'label' => __('Home hero subtext', 'ignis'),
                'section' => 'ignis_section_header_colors',
                'priority' => 11
            )
        )
    );
    //Banner titles
    $wp_customize->add_setting(
        'banner_titles_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'banner_titles_color',
            array(
                'label' => __('Banner titles', 'ignis'),
                'section' => 'ignis_section_header_colors',
                'priority' => 11
            )
        )
    );

    // Section: Menu colors.
    $wp_customize->add_section( 'ignis_section_menu_colors', array(
        'priority'       => 12,
        'panel'          => 'ignis_panel_colors',
        'title'          => __( 'Menu', 'ignis' ),
    ) );    
    //Menu items
    $wp_customize->add_setting(
        'menu_items_color',
        array(
            'default'           => '#4a4a4a',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_items_color',
            array(
                'label' => __('Menu items', 'ignis'),
                'section' => 'ignis_section_menu_colors',
                'priority' => 12
            )
        )
    );
    //Mobile button
    $wp_customize->add_setting(
        'mobile_btn_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mobile_btn_color',
            array(
                'label' => __('Mobile button color', 'ignis'),
                'section' => 'ignis_section_menu_colors',
                'priority' => 13
            )
        )
    );
    //Mobile bg
    $wp_customize->add_setting(
        'mobile_menu_bg',
        array(
            'default'           => '#202529',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mobile_menu_bg',
            array(
                'label' => __('Mobile menu background', 'ignis'),
                'section' => 'ignis_section_menu_colors',
                'priority' => 14
            )
        )
    );
    //Mobile items
    $wp_customize->add_setting(
        'mobile_menu_items',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mobile_menu_items',
            array(
                'label' => __('Mobile menu items', 'ignis'),
                'section' => 'ignis_section_menu_colors',
                'priority' => 15
            )
        )
    );

    // Section: Blog options.
    $wp_customize->add_section( 'ignis_section_blog', array(
        'priority'       => 21,
        'title'          => __( 'Blog options', 'ignis' ),
    ) );
    // Blog layout  
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'masonry-fullwidth',
            'sanitize_callback' => 'ignis_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'ignis'),
            'section'   => 'ignis_section_blog',
            'priority'  => 10,
            'choices'   => array(
                'classic'           => __( 'Classic', 'ignis' ),
                'masonry'           => __( 'Masonry', 'ignis' ),
                'masonry-fullwidth' => __( 'Masonry fullwidth', 'ignis' )
            ),
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )       
    );
    $wp_customize->add_control( 'exc_length', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'   => 'ignis_section_blog',
        'label'       => __('Excerpt length', 'ignis'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );

    //Continue reading
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'sanitize_callback' => 'ignis_sanitize_text',
            'default'           => __( 'Continue reading', 'ignis' ),
        )       
    );
    $wp_customize->add_control( 'read_more_text', array(
        'type'        => 'text',
        'priority'    => 14,
        'section'   => 'ignis_section_blog',
        'label'       => __('Read more text', 'ignis'),
    ) );


    //Meta
    $wp_customize->add_setting(
      'hide_meta_singles',
      array(
        'sanitize_callback' => 'ignis_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_singles',
      array(
        'type' => 'checkbox',
        'label' => __('Hide meta on single posts?', 'ignis'),
        'section' => 'ignis_section_blog',
        'priority' => 15,
      )
    );
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'ignis_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide meta on blog index?', 'ignis'),
        'section' => 'ignis_section_blog',
        'priority' => 16,
      )
    );    
    //Featured images
    $wp_customize->add_setting(
        'hide_featured_singles',
        array(
            'sanitize_callback' => 'ignis_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_featured_singles',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images on single posts?', 'ignis'),
            'section' => 'ignis_section_blog',
            'priority' => 17,
        )
    );    

}
add_action( 'customize_register', 'ignis_customize_register' );

/**
 * Sanitize
 */

//Text
function ignis_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Blog layout
function ignis_sanitize_blog( $input ) {
    if ( in_array( $input, array( 'classic', 'masonry', 'masonry-fullwidth' ), true ) ) {
        return $input;
    }
}
//Checkboxes
function ignis_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Menu style
function ignis_sanitize_sticky( $input ) {
    if ( in_array( $input, array( 'sticky-header', 'static-header' ), true ) ) {
        return $input;
    }
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ignis_customize_preview_js() {
	wp_enqueue_script( 'ignis_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20170605', true );
}
add_action( 'customize_preview_init', 'ignis_customize_preview_js' );
