<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_banner_slider() {
    productive_style_register_block_init_banner_slider();
}
add_action( 'init', 'productive_style_register_blocks_init_action_banner_slider' );


function productive_style_register_block_init_banner_slider() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/banner-slider/build/index.asset.php');
    
    wp_register_script(
        'productive-style-banner-slider-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/banner-slider/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-banner-slider-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/banner-slider/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/banner-slider/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_banner_slider',
        'editor_script' => 'productive-style-banner-slider-script',
        'style' => 'productive-style-banner-slider-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_banner_slider( $attributes, $content ) {
    
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
        'section_initiator'                                     => 'std gtbg',
        'section_gtbg_align'                                    => '',
        'section_title'                                         => $attributes['section_title'],
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
        'section_content_layout_format'                         => 'slider',
        'section_content_settings_taxonomy'                     => $attributes['section_content_settings_taxonomy'],
        'section_total_items'                                   => $attributes['section_total_items'],  // No of slides to display
        'slider_content_entrance_easing'                        => $attributes['slider_content_entrance_easing'],
        'slider_content_start'                                  => $attributes['slider_content_start'],
        'slider_navigation_arrows_control_position'             => $attributes['slider_navigation_arrows_control_position'],
        'slider_pagination_control_position'                    => $attributes['slider_pagination_control_position'],
        'slider_navigation_arrows_control_shape'                => $attributes['slider_navigation_arrows_control_shape'],
        'slider_pagination_control_shape'                       => $attributes['slider_pagination_control_shape'],
        'content_auxiliary_location'                            => $attributes['content_auxiliary_location'],
        'section_content_settings_query_order_by'               => $attributes['section_content_settings_query_order_by'],
        'slider_design_type'                                    => $attributes['slider_design_type'],
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg',
        
        'slider_slide_image_width'                              => $attributes['slider_slide_image_width'],
        'slider_slide_image_min_width'                          => $attributes['slider_slide_image_min_width'],
        'slider_slide_content_width'                            => $attributes['slider_slide_content_width'],
        'slider_slide_content_width_indentation'                => $attributes['slider_slide_content_width_indentation'],
        'slider_banner_height'                                  => $attributes['slider_banner_height'],
        'slider_slide_overlay_color'                            => $attributes['slider_slide_overlay_color'],
        'slider_slide_overlay_opacity'                          => $attributes['slider_slide_overlay_opacity'],
    );
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_gtbg_align );
        productive_style_render_banner_slider( $cpt_section_args );
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
