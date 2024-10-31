<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_homepage_product_section() {
    productive_style_register_block_init_homepage_product_section();
}
add_action( 'init', 'productive_style_register_blocks_init_action_homepage_product_section' );


function productive_style_register_block_init_homepage_product_section() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-product-section/build/index.asset.php');
    
    wp_register_script(
        'productive-style-homepage-product-section-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/homepage-product-section/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-homepage-product-section-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/homepage-product-section/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-product-section/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_homepage_product_section',
        'editor_script' => 'productive-style-homepage-product-section-script',
        'style' => 'productive-style-homepage-product-section-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_homepage_product_section( $attributes, $content ) {
    
    foreach ($attributes as $key => $attribute) {
        if( 'true' == $attribute ) {
            $attributes[$key] = '1';
        } else if( 'false' == $attribute ) {
            $attributes[$key] = '0';
        } else if( 'align' == $key && 'full' == $attribute ) {
            $attributes[$key] = 'alignfull';
        } else if( 'align' == $key && 'wide' == $attribute ) {
            $attributes[$key] = 'alignwide';
        }
    }
    
    $section_gtbg_align = '';
    if( isset($attributes['align']) ) {
        $section_gtbg_align = $attributes['align'];
    }
    
    $cpt_section_args = array(
        'section_content_type'                  => $attributes['section_content_type'],
        'section_content_settings_taxonomy'     => $attributes['section_content_settings_taxonomy'],
        'limit'                                 => $attributes['limit'],
        'section_design'                        => $attributes['section_design'],
        'section_blocks_ratio'                  => $attributes['section_blocks_ratio'],
        'cta_style'                             => $attributes['cta_style'],
        'content_alignment_v'                   => $attributes['content_alignment_v'],
        'content_alignment_h'                   => $attributes['content_alignment_h'],
        'hero_color_scheme'                     => $attributes['hero_color_scheme'],
        'section_bg_color_scheme'               => $attributes['section_bg_color_scheme'],
    );
        
    ob_start();
    
    productive_style_render_homepage_product_section( $cpt_section_args );
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
