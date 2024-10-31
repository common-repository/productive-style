<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_homepage_hero() {
    productive_style_register_block_init_homepage_hero();
}
add_action( 'init', 'productive_style_register_blocks_init_action_homepage_hero' );


function productive_style_register_block_init_homepage_hero() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-hero/build/index.asset.php');
    
    wp_register_script(
        'productive-style-homepage-hero-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/homepage-hero/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-homepage-hero-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/homepage-hero/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/homepage-hero/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_homepage_hero',
        'editor_script' => 'productive-style-homepage-hero-script',
        'style' => 'productive-style-homepage-hero-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_homepage_hero( $attributes, $content ) {
    
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
        'homepage_hero_type'                    => $attributes['homepage_hero_type'],
    );
        
    ob_start();
    
    productive_style_render_homepage_hero( $cpt_section_args );
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
