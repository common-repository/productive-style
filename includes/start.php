<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
	die(); 
}

if( !function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

require_once plugin_dir_path( $productive_style_plugin_main_file ) . 'global-settings.php';

$productive_style_plugin_version_obj        = get_plugin_data( $productive_style_plugin_main_file );
$productive_style_plugin_version            = $productive_style_plugin_version_obj['Version'];

$productiveminds_base_demo_url              = 'https://demo.productiveminds.com';
$productiveminds_base_support_url           = 'https://www.productiveminds.com/support';
$productiveminds_base_documentation_url     = 'https://www.productiveminds.com/support/docs';

$plugin_slug                    = $productive_style_plugin_version_obj[ 'TextDomain' ];
$plugin_name                    = $productive_style_plugin_version_obj[ 'Name' ];
$plugin_url                     = $productive_style_plugin_version_obj[ 'PluginURI' ];
$author_name                    = $productive_style_plugin_version_obj[ 'Author' ];
$author_url                     = $productive_style_plugin_version_obj[ 'AuthorURI' ];
$plugin_demo_url                = $productiveminds_base_demo_url . '/' . $plugin_slug;
$plugin_support_url             = $productiveminds_base_support_url;
$plugin_documentation_url       = $productiveminds_base_documentation_url . '/' . $plugin_slug;
$plugin_review_on_repo_url      = 'https://wordpress.org/support/plugin' . '/' . $plugin_slug . '/reviews/';
$plugin_review_pro_url          = $author_url . '/product-reviews/' . $plugin_slug;
$plugin_download_from_repo_url  = 'https://downloads.wordpress.org/plugin' . '/' . $plugin_slug . 
        '.' . $productive_style_plugin_version . '.zip';

define( 'PRODUCTIVE_STYLE_VERSION', $productive_style_plugin_version );
define( 'PRODUCTIVE_STYLE_PLUGIN_DEVELOPER_NAME', 'productiveminds.com' );
define( 'PRODUCTIVE_STYLE_PLUGIN_DEVELOPER_WEBSITE', $author_url );
define( 'PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME', $plugin_name );
define( 'PRODUCTIVE_STYLE_PLUGIN_DEMO_URL', $plugin_demo_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_SUPPORT_URL', $plugin_support_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_DOCUMENTATION_URL', $plugin_documentation_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_DOWNLOAD_FROM_REPO_URL', $plugin_download_from_repo_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_REVIEW_ON_REPO_URL', $plugin_review_on_repo_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_PRO_REVIEW_URL', $plugin_review_pro_url );
define( 'PRODUCTIVE_STYLE_PLUGIN_FEATURES_OR_BUY_URL', $plugin_url );
define( 'PRODUCTIVE_STYLE_HOMEPAGE_PLUGIN_ICON', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/plugin-icon.webp' );
define( 'PRODUCTIVE_STYLE_PLACEHOLDER_IMAGE_POSTS', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/posts-placeholder.webp' );

define( 'PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_TYPOGRAPHY', esc_html__( 'Typography (theme options)', 'productive-style' ) );
define( 'PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_HOMEPAGE', esc_html__( 'Homepage (theme options)', 'productive-style' ) );


if( is_dir( PRODUCTIVE_STYLE_PLUGIN_PATH . 'extra' ) ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'extra/includes/functions-extra.php';
} else {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/functions.php';
}


// Start main plugin activation
register_activation_hook( $productive_style_plugin_main_file, 'productive_style_activate');

// Start main plugin deactivation
register_deactivation_hook( $productive_style_plugin_main_file, 'productive_style_deactivate' );


/**
 * Method productive_style_is_active.
 */
function productive_style_is_active() {}

function productive_style_is_extra() {
    return function_exists( 'productive_style_extra_is_active' );
}


/**
 * Method enable featured image.
 */
function productive_style_setup_plugin() {
    // initiate text-domain.
    load_plugin_textdomain( 'productive-style', false, PRODUCTIVE_STYLE_PLUGIN_PATH . 'languages' );
}
add_action( 'init', 'productive_style_setup_plugin' );


/**
 * Load (wp_enqueue_script) admin css * JS files.
 */
function productive_style_admin_scripts() {
    
    global $productive_style_plugin_version;
    
    // Admin Common assets
    if ( !function_exists( 'productiveminds_common_asset_admin') ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'productive_style_admin_css', PRODUCTIVE_STYLE_PLUGIN_URI . 'admin/css/admin-style.css', array(), $productive_style_plugin_version );
    
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/common/productiveminds-common-asset-admin.php';
    }
    wp_enqueue_script( 'productive_style_admin_js_handle', PRODUCTIVE_STYLE_PLUGIN_URI . 'admin/js/admin-plugin.js', array(), $productive_style_plugin_version, true );
    
    $admin_ajax_php_class = array(
        'ajax_admin_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('productive_style_admin_scripts'),
    );
    wp_localize_script(
    'productive_style_admin_js_handle',
    'productive_style_admin_js_url_name',
    $admin_ajax_php_class
    );
}
if ( ( is_admin() && isset($_GET[ 'page' ]) ) && 
        ( $_GET[ 'page' ] === PRODUCTIVE_STYLE_ADMIN_OVERVIEW_REQUEST_URI || $_GET[ 'page' ] === PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI || $_GET[ 'page' ] === PRODUCTIVE_GLOBAL_ADMIN_PAGE_REQUEST_URI ) ) {
    add_action( 'admin_enqueue_scripts', 'productive_style_admin_scripts' );
}

function productive_style_is_importing_demo_data() {
    if( !isset($_SERVER['REQUEST_URI']) || empty($_SERVER['REQUEST_URI']) ) {
        return false;
    }
    
    $request_uri = $_SERVER['REQUEST_URI'];
    if( strpos($request_uri, 'import.php') !== false || strpos($request_uri, 'admin.php?import') !== false ) {
        return true;
    }
    return false;
}


function productive_style_add_action_links ( $actions ) {
   $settings_text = __( 'Settings', 'productive-style' );
   $setting_page_uri = 'admin.php?page=' . PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI . '&tab=section_integration_options_tab';
   $plugin_action_links = array();
   $plugin_action_links[] = '<a href="' . esc_url( admin_url( $setting_page_uri ) ) . '">' . $settings_text . '</a>';
   $action_links = array_merge( $actions, $plugin_action_links );
   return $action_links;
}
add_filter( 'plugin_action_links_' . plugin_basename($productive_style_plugin_main_file), 'productive_style_add_action_links' );


function productive_style_apply_custom_css($important = '') {
    $css_settings = productive_style_get_custom_css();
    $css =  '' .
        '.header-breadcrumb-content-box, .header-breadcrumb-content-box span {
            color: ' . $css_settings['productive_style_breadcrumb_text_color'] . ';
        }.header-breadcrumb-content-box a {
            color: ' . $css_settings['productive_style_breadcrumb_hyperlink_color'] . ';
        }.header-breadcrumb-content-box a:hover {
            color: ' . $css_settings['productive_style_breadcrumb_hyperlink_color_hover'] . ';
        }.site-body-container_box_full.header-breadcrumb-container {
            border-bottom: 1px solid ' . $css_settings['productive_style_breadcrumb_border_color'] . ';
        }.homepage-element .productiveminds_section-single-item .productiveminds_section-single-item-media i {
            color: ' . $css_settings['productive_style_homepage_element_section_icon_color'] . ';
        }';
    
    if ( !empty($css_settings['productive_style_breadcrumb_home_icon_color']) ) {
        $css .= '.header-breadcrumb-content-box svg.productive_breadcrumb_home_icon path {
            fill: ' . $css_settings['productive_style_breadcrumb_home_icon_color'] . ';
        }';
    }
    
    if ( ! productive_style_breadcrumb_bg_image() ) {
        $css .= '.site-body-container_box_full.header-breadcrumb-container {
            background: ' . $css_settings['productive_style_breadcrumb_bg_color'] . ';
        }';
    }
    
    if( productive_global_is_a_productive_theme() ) {
        $css .= productive_style_get_style_css_themed( $css_settings, $important );
    } else {
        
        $css .= productive_style_get_style_css_non_themed( $important );
        
        // Additionally, Add static sizes, if non-themed
        
        $productive_style_all_headings_adjust_the_font_size = intval( $css_settings['productive_style_all_headings_adjust_the_font_size'] );
        if ( $productive_style_all_headings_adjust_the_font_size ) {
            $css .= 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, .h5, .h6, .h6 {';
            $css  .= 'font-size: ' . $productive_style_all_headings_adjust_the_font_size . 'px;';
            $css .= '}';
        }
        
        // Header Menu Typography available only in our themes

        $productive_style_body_adjust_the_font_size = intval( $css_settings['productive_style_body_adjust_the_font_size'] );
        if ( $productive_style_body_adjust_the_font_size ) {
            $css .= 'body {';
            $css  .= 'font-size: ' . $productive_style_body_adjust_the_font_size . 'px;';
            $css .= '}';
        }
    }
    
    return trim($css);
}
function productive_style_get_custom_css() {
    $css_settings = array();
    
    $css_settings['productive_style_breadcrumb_bg_color']                   = productive_style_breadcrumb_bg_color();
    $css_settings['productive_style_breadcrumb_home_icon_color']            = productive_style_breadcrumb_home_icon_color();
    $css_settings['productive_style_breadcrumb_text_color']                 = productive_style_breadcrumb_text_color();
    $css_settings['productive_style_breadcrumb_hyperlink_color']            = productive_style_breadcrumb_hyperlink_color();
    $css_settings['productive_style_breadcrumb_hyperlink_color_hover']      = productive_style_breadcrumb_hyperlink_color_hover();
    $css_settings['productive_style_breadcrumb_border_color']               = productive_style_breadcrumb_border_color();
    $css_settings['productive_style_all_headings_adjust_the_font_size']     = productive_style_all_headings_adjust_the_font_size();
    $css_settings['productive_style_header_menu_adjust_the_font_size']      = productive_style_header_menu_adjust_the_font_size();
    $css_settings['productive_style_body_adjust_the_font_size']             = productive_style_body_adjust_the_font_size();
    $css_settings['productive_style_homepage_element_section_icon_color']   = productive_style_homepage_element_section_icon_color();
    
    
    return $css_settings;
}

function productive_style_get_style_css_themed($css_settings, $important = '') {
    $css  = ':root {';
    
    $font_headings = productive_style_get_style_css_all_headings_themed($important);
    if ( !empty( $font_headings ) ) {
        foreach ( $font_headings as $key => $value) {
           $css .= $value;
        }
    }
    
    $font_header_menu = productive_style_get_style_css_header_menu_themed($important);
    if ( !empty( $font_header_menu ) ) {
        foreach ( $font_header_menu as $key => $value) {
           $css .= $value;
        }
    }
    
    $font_body = productive_style_get_style_css_body_themed($important);
    if ( !empty( $font_body ) ) {
        foreach ( $font_body as $key => $value) {
           $css .= $value;
        }
    }
    
    $productive_style_all_headings_adjust_the_font_size = intval( $css_settings['productive_style_all_headings_adjust_the_font_size'] );
    if ( $productive_style_all_headings_adjust_the_font_size ) {
        $base_font_size_heading = 0.25;
        $new_font_size = $base_font_size_heading + ($productive_style_all_headings_adjust_the_font_size * 0.02);
        $css  .= '--base-font-heading: ' . $new_font_size . 'rem;';
    }
    
    $productive_style_header_menu_adjust_the_font_size = intval( $css_settings['productive_style_header_menu_adjust_the_font_size'] );
    if ( $productive_style_header_menu_adjust_the_font_size ) {
        $base_font_size_heading = 0.5;
        $new_font_size = $base_font_size_heading + ($productive_style_header_menu_adjust_the_font_size * 0.02);
        $css  .= '--base-font-header-menu: ' . $new_font_size . 'rem;';
    }

    $productive_style_body_adjust_the_font_size = intval( $css_settings['productive_style_body_adjust_the_font_size'] );
    if ( $productive_style_body_adjust_the_font_size ) {
        $base_font_size_body = 0.21;
        $new_font_size = $base_font_size_body + ($productive_style_body_adjust_the_font_size * 0.1);
        $css  .= '--base-font-body: ' . $new_font_size . 'rem;';
    }

    $css .= '}';
    
    return $css;
}
function productive_style_get_style_css_all_headings_themed($important = '') {
    $loc_global_style_setting = array();
    if ( !empty(productive_style_all_headings_font_family()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_family'] = '--ff-heading: var(' . productive_style_all_headings_font_family() . ') ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_font_weight()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_weight'] = '--fw-heading: ' . productive_style_all_headings_font_weight() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_font_style()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_style'] = '--f-style-heading: ' . productive_style_all_headings_font_style() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_line_height()) ) {
        $loc_global_style_setting['productive_style_all_headings_line_height'] = '--lh-heading: ' . productive_style_all_headings_line_height() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_text_transform()) ) {
        $loc_global_style_setting['productive_style_all_headings_text_transform'] = '--tt-heading: ' . productive_style_all_headings_text_transform() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_text_decoration()) ) {
        $loc_global_style_setting['productive_style_all_headings_text_decoration'] = '--td-heading: ' . productive_style_all_headings_text_decoration() . ' ' . $important . '; ';
    }
    return $loc_global_style_setting;
}

function productive_style_get_style_css_header_menu_themed($important = '') {
    $loc_global_style_setting = array();
    if ( !empty(productive_style_header_menu_font_family()) ) {
        $loc_global_style_setting['productive_style_header_menu_font_family'] = '--ff-header-menu: var(' . productive_style_header_menu_font_family() . ') ' . $important . '; ';
    }
    if ( !empty(productive_style_header_menu_font_weight()) ) {
        $loc_global_style_setting['productive_style_header_menu_font_weight'] = '--fw-header-menu: ' . productive_style_header_menu_font_weight() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_header_menu_font_style()) ) {
        $loc_global_style_setting['productive_style_header_menu_font_style'] = '--f-style-header-menu: ' . productive_style_header_menu_font_style() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_header_menu_line_height()) ) {
        $loc_global_style_setting['productive_style_header_menu_line_height'] = '--lh-header-menu: ' . productive_style_header_menu_line_height() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_header_menu_text_transform()) ) {
        $loc_global_style_setting['productive_style_header_menu_text_transform'] = '--tt-header-menu: ' . productive_style_header_menu_text_transform() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_header_menu_text_decoration()) ) {
        $loc_global_style_setting['productive_style_header_menu_text_decoration'] = '--td-header-menu: ' . productive_style_header_menu_text_decoration() . ' ' . $important . '; ';
    }
    return $loc_global_style_setting;
}

function productive_style_get_style_css_body_themed($important = '') {
    $loc_global_style_setting = array();
    if ( !empty(productive_style_body_font_family()) ) {
        $loc_global_style_setting['productive_style_body_font_family'] = '--ff-body: var(' . productive_style_body_font_family() . ') ' . $important . '; ';
    }
    if ( !empty(productive_style_body_font_weight()) ) {
        $loc_global_style_setting['productive_style_body_font_weight'] = '--fw-body: ' . productive_style_body_font_weight() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_font_style()) ) {
        $loc_global_style_setting['productive_style_body_font_style'] = '--f-style-body: ' . productive_style_body_font_style() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_line_height()) ) {
        $loc_global_style_setting['productive_style_body_line_height'] = '--lh-body: ' . productive_style_body_line_height() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_text_transform()) ) {
        $loc_global_style_setting['productive_style_body_text_transform'] = '--tt-body: ' . productive_style_body_text_transform() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_text_decoration()) ) {
        $loc_global_style_setting['productive_style_body_text_decoration'] = '--td-body: ' . productive_style_body_text_decoration() . ' ' . $important . '; ';
    }
    return $loc_global_style_setting;
}


function productive_style_get_style_css_non_themed($important = '') {
    $css = '';
    
    $font_headings = productive_style_get_style_css_all_headings_non_themed( $important );
    if ( !empty( $font_headings ) ) {
        $css .= 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, .h5, .h6, .h6 {';
        foreach ( $font_headings as $key => $value) {
           $css .= $value;
        }
        $css .= '}';
    }
    
    // Header Menu Typography available only in our themes
    
    $font_body = productive_style_get_style_css_body_non_themed( $important );
    $css .= '';
    if ( !empty( $font_body ) ) {
        $css .= 'body {';
        foreach ( $font_body as $key => $value) {
           $css .= $value;
        }
        $css .= '}';
    }
    
    return trim($css);
}
function productive_style_get_style_css_all_headings_non_themed($important = '') {
    $loc_global_style_setting = array();
    if ( !empty(productive_style_all_headings_font_family()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_family'] = 'font-family: var(' . productive_style_all_headings_font_family() . ') ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_font_weight()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_weight'] = 'font-weight: ' . productive_style_all_headings_font_weight() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_font_style()) ) {
        $loc_global_style_setting['productive_style_all_headings_font_style'] = 'font-style: ' . productive_style_all_headings_font_style() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_line_height()) ) {
        $loc_global_style_setting['productive_style_all_headings_line_height'] = 'line-height: ' . productive_style_all_headings_line_height() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_text_transform()) ) {
        $loc_global_style_setting['productive_style_all_headings_text_transform'] = 'text-transform: ' . productive_style_all_headings_text_transform() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_all_headings_text_decoration()) ) {
        $loc_global_style_setting['productive_style_all_headings_text_decoration'] = 'text-decoration: ' . str_replace('_', ' ', productive_style_all_headings_text_decoration()) . ' ' . $important . '; ';
    }
    return $loc_global_style_setting;
}

function productive_style_get_style_css_body_non_themed($important = '') {
    $loc_global_style_setting = array();
    if ( !empty(productive_style_body_font_family()) ) {
        $loc_global_style_setting['productive_style_body_font_family'] = 'font-family: var(' . productive_style_body_font_family() . ') ' . $important . '; ';
    }
    if ( !empty(productive_style_body_font_weight()) ) {
        $loc_global_style_setting['productive_style_body_font_weight'] = 'font-weight: ' . productive_style_body_font_weight() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_font_style()) ) {
        $loc_global_style_setting['productive_style_body_font_style'] = 'font-style: ' . productive_style_body_font_style() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_line_height()) ) {
        $loc_global_style_setting['productive_style_body_line_height'] = 'line-height: ' . productive_style_body_line_height() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_text_transform()) ) {
        $loc_global_style_setting['productive_style_body_text_transform'] = 'text-transform: ' . productive_style_body_text_transform() . ' ' . $important . '; ';
    }
    if ( !empty(productive_style_body_text_decoration()) ) {
        $loc_global_style_setting['productive_style_body_text_decoration'] = 'text-decoration: ' . str_replace('_', ' ', productive_style_body_text_decoration()) . ' ' . $important . '; ';
    }
    return $loc_global_style_setting;
}