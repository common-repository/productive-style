<?php
/**
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/db/db_install.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/db/db_upgrade.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/activate.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/deactivate.php';

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/standard/options/settings.php'; 

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/module/breadcrumb.php';

$productive_style_is_importing_demo_data = productive_style_is_importing_demo_data();
if( productive_style_manage_cpts_content_element_enable() || $productive_style_is_importing_demo_data ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/post-type/content-element.php';
}
if( productive_style_manage_cpts_faq_enable() || $productive_style_is_importing_demo_data ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/post-type/faq.php';
}
if( productive_style_manage_cpts_slider_enable() || $productive_style_is_importing_demo_data ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/post-type/slider.php';
}
if( productive_style_manage_cpts_team_enable() || $productive_style_is_importing_demo_data ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/post-type/team.php';
}
if( productive_style_manage_cpts_testimonial_enable() || $productive_style_is_importing_demo_data ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/post-type/testimonial.php';
}

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/productiveminds-style-options.php';

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/productive-plugin-customiser.php';

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/partials/productive-render-functions-common.php';

require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-banner-slider.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-homepage-hero.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-homepage-element.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-homepage-product-section.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-faq.php';

if( !productive_global_is_a_productive_extra_theme() ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/render/productive-render-blog-element.php';
}


require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/productive-gutenberg.php';

productive_global_flush_rewrite_rule( PRODUCTIVE_STYLE_IS_REWRITE_RULE_FLUSHED_KEY );


/**
 * Method productive_style_scripts.
 */
function productive_style_scripts() {
    global $productive_style_plugin_version;
    $productiveminds_global_localize_script_vars = array();
    
    // Swiper
    if ( !function_exists( 'productiveminds_library_swiper') ) {
        wp_enqueue_style( 'productiveminds_library_swiper_css', PRODUCTIVE_STYLE_PLUGIN_URI . 'libraries/swiper/11-0-7/swiper-bundle.min.css', array(), $productive_style_plugin_version );
        wp_enqueue_script( 'productiveminds_library_swiper_js', PRODUCTIVE_STYLE_PLUGIN_URI . 'libraries/swiper/11-0-7/swiper-bundle.min.js', array(), $productive_style_plugin_version, true );

        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'libraries/swiper/productiveminds-library-swiper.php';
    }
     
    wp_enqueue_style( 'productive_style_font_awesome', PRODUCTIVE_STYLE_PLUGIN_URI . 'libraries/fonts/font-awesome-4.7.0/css/font-awesome.min.css', array(), $productive_style_plugin_version );
       
    // Common assets
    if ( !function_exists( 'productiveminds_common_asset') ) {
        
        wp_enqueue_style( 'productiveminds_common_css', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/css/productiveminds-common-css.min.css', array(), $productive_style_plugin_version );
        wp_style_add_data( 'productiveminds_common_css', 'rtl', 'replace' );
        
        wp_enqueue_script( 'productiveminds_common_js_handle', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/js/productiveminds-common-js.min.js', array( 'productiveminds_library_swiper_js' ), $productive_style_plugin_version, true );
        
        productive_global_get_common_swiper_localize_script( $productiveminds_global_localize_script_vars );
        // Assign others
        productive_global_get_common_std_localize_script( $productiveminds_global_localize_script_vars );
        wp_localize_script(
            'productiveminds_common_js_handle',
            'productiveminds_common_js_name',
            $productiveminds_global_localize_script_vars
            );
        
        $custom_css_global = productive_global_apply_custom_css();
        wp_add_inline_style('productiveminds_common_css', $custom_css_global);
        
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/productiveminds-common-asset.php';
    }
    
    wp_enqueue_style( 'productive_style_style', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/css/style.bundle.min.css', array(), $productive_style_plugin_version );
    wp_style_add_data( 'productive_style_style', 'rtl', 'replace' );
    
    wp_enqueue_script( 'productive_style_std_plugin_js_handle', PRODUCTIVE_STYLE_PLUGIN_URI . 'public/js/plugin.min.js', array(), $productive_style_plugin_version, true );
    $wp_localize_script_values_std_plugin_js_handle = array(
        'ajax_admin_url'                                        => admin_url( 'admin-ajax.php' ),
        'nonce'                                                 => wp_create_nonce('productive_style_main_plugin_scripts'),
    );
    wp_localize_script(
        'productive_style_std_plugin_js_handle',
        'productive_style_std_plugin_js_handle_name',
        $wp_localize_script_values_std_plugin_js_handle
    );
    
}
if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'productive_style_scripts', 76 );
} else if ( is_admin() ) {
    global $pagenow;
    if( productive_global_is_block_editor_active() && 
            ( 'post.php' == $pagenow || 'post-new.php' == $pagenow || 'comment.php' == $pagenow ) ) {
        add_action( 'admin_enqueue_scripts', 'productive_style_scripts', 76 );
    }
}

/**
 * Method productive_style_scripts_styles.
 */
function productive_style_scripts_styles() {
    $custom_css = productive_style_apply_custom_css();
    if( function_exists( 'productiveminds_theme_is_active' ) ) {
        wp_add_inline_style('productive_parent_theme_main_css_style', $custom_css);
    } else {
        wp_add_inline_style('productive_style_styles_fonts', $custom_css);
    }
}
if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'productive_style_scripts_styles', 84 );
} else if ( is_admin() ) {
    global $pagenow;
    if( productive_global_is_block_editor_active() && 
            ( 'post.php' == $pagenow || 'post-new.php' == $pagenow || 'comment.php' == $pagenow ) ) {
        add_action( 'admin_enqueue_scripts', 'productive_style_scripts_styles', 84 );
    }
}
