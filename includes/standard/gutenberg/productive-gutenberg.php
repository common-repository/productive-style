<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


if ( !function_exists( 'productive_gutenberg_add_block_category' ) ) {
    /**
     * Register a new Gutenberg Category for listing ProductiveMinds' Gutenberg Blocks
     * @param array $categories
     * @param WP_Block_Editor_Context $block_editor_context
     */
    function productive_gutenberg_add_block_category( $categories, $block_editor_context ) {
        return array_merge(
            array(
                array(
                    'slug'  => 'productiveminds',
                    'title' => __( 'ProductiveMinds', 'productive-style' ),
                    //'icon'  => ''
                ),
            ),
            $categories,
        );
    }
    
    if ( version_compare( get_bloginfo('version'), '5.8.0', '>=' ) ) {
        add_filter( 'block_categories_all', 'productive_gutenberg_add_block_category', 10, 2 );
    } else {
        add_filter( 'block_categories', 'productive_gutenberg_add_block_category', 10, 2 );
    }
}



require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-hero/render.php';
require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-element/render.php';

if( productive_style_manage_cpts_slider_enable() ) {
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/banner-slider/render.php';
}

if( productive_global_is_a_productive_extra_theme() ) {
    
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/blog-element/render.php';
    
    if( productive_style_manage_cpts_content_element_enable() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/content-element/render.php';
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/logo-slider/render.php';
        if( productive_global_is_woocommerce_active() && productive_global_is_a_productive_theme() ) {
            require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-product-section/render.php';
        }
    }
    if( productive_style_manage_cpts_faq_enable() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/faq/render.php';
    }
    if( productive_style_manage_cpts_team_enable() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/team-member/render.php';
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/blog-author-profile/render.php';
    }
    if( productive_style_manage_cpts_testimonial_enable() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/testimonial/render.php';
    }
    
    if( productive_global_is_woocommerce_active() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/product-category/render.php';
    }
    
} else {
    
    require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/blog-element/render.php';
    
    if( productive_style_manage_cpts_faq_enable() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/faq/render.php';
    }
    
    if( productive_global_is_woocommerce_active() && productive_style_manage_cpts_content_element_enable() && productive_global_is_a_productive_theme() ) {
        require_once PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-product-section/render.php';
    }
}

