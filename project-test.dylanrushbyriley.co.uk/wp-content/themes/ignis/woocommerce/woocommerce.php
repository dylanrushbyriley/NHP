<?php
/**
 * Woocommerce Compatibility 
 *
 * @package Ignis
 */


if ( !class_exists('WooCommerce') )
    return;

/**
 * Declare support
 */
function ignis_wc_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );    
}
add_action( 'after_setup_theme', 'ignis_wc_support' );

/**
 * Add and remove actions
 */
function ignis_woo_actions() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action('woocommerce_before_main_content', 'ignis_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'ignis_wrapper_end', 10);
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    add_filter( 'woocommerce_show_page_title', '__return_false' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
}
add_action('wp','ignis_woo_actions');

/**
 * Theme wrappers
 */
function ignis_wrapper_start() {

    echo '<div id="primary" class="content-area col-md-10 nosidebar">';
        echo '<main id="main" class="site-main" role="main">';
}

function ignis_wrapper_end() {
        echo '</main>';
    echo '</div>';
}

/**
 * Number of related products
 */
function ignis_related_products_args( $args ) {
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ignis_related_products_args' );


/**
 * Update cart
 */
function ignis_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class="icon-shopping-bag"></i><span class="cart-amount"><?php echo WC()->cart->cart_contents_count; ?></span></a>
    <?php
    
    $fragments['a.cart-contents'] = ob_get_clean();
    
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ignis_header_add_to_cart_fragment' );

/**
 * Add cart to menu
 */
function ignis_nav_cart ( $items, $args ) {
    $swc_show_cart_menu = get_theme_mod('swc_show_cart_menu', 1);
    if ( $swc_show_cart_menu ) {
        if ( $args -> theme_location == 'menu-1' ) {
            $items .= '<li class="nav-cart menu-icon"><a class="cart-contents" href="' . esc_url( WC()->cart->get_cart_url() ) . '"><i class="icon-shopping-bag"></i><span class="cart-amount">' . WC()->cart->cart_contents_count . '</span></a></li>';
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'ignis_nav_cart', 10, 2 );

/**
 * Woocommerce account link in header
 */
function ignis_woocommerce_account_link( $items, $args ) {
    $swc_show_cart_menu = get_theme_mod('swc_show_cart_menu', 1);
    if ( $swc_show_cart_menu && ( $args -> theme_location == 'menu-1' ) ) {
        if ( is_user_logged_in() ) {
            $account = __( 'My Account', 'ignis' );
        } else {
            $account = __( 'Login/Register', 'ignis' );
        }
        $items .= '<li class="header-account menu-icon"><a href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . $account . '"><i class="icon-user"></i></a></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'ignis_woocommerce_account_link', 10, 2 );


/**
 * Search icon
 */
function ignis_menu_search( $items, $args ) {
    if ( $args -> theme_location == 'menu-1' ) {
        $items .= '<li class="header-search menu-icon"><a href="#"><i class="icon-search"></i></a></li>';
        $items .= '<div class="header-search-form">' . get_search_form(false) . '</div>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'ignis_menu_search', 10, 2 );


/**
 * Returns true if current page is shop, product archive or product tag
 */
function ignis_wc_archive_check() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Number of columns
 */
function ignis_archive_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'ignis_archive_columns' );
