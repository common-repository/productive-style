<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_product_category() {
    productive_style_register_block_init_product_category();
}
add_action( 'init', 'productive_style_register_blocks_init_action_product_category' );


function productive_style_register_block_init_product_category() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/product-category/build/index.asset.php');
    
    wp_register_script(
        'productive-style-product-category-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/product-category/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-product-category-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/product-category/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/product-category/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_product_category',
        'editor_script' => 'productive-style-product-category-script',
        'style' => 'productive-style-product-category-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_product_category( $attributes, $content ) {
    
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
        'section_show_content_title'                            => $attributes['section_show_content_title'],
        'productive_cpt_is_link_image'                          => $attributes['productive_cpt_is_link_image'],
        'section_content_media_item_shape'                      => $attributes['section_content_media_item_shape'],
        'section_content_layout_format'                         => $attributes['section_content_layout_format'],
        'section_content_box_design_style'                      => $attributes['section_content_box_design_style'],
        'section_content_settings_taxonomy'                     => $attributes['section_content_settings_taxonomy'],
        'columns_per_row'                                       => $attributes['columns_per_row'],
        'section_total_items'                                   => $attributes['section_total_items'],
        'slider_navigation_arrows_control_position'             => $attributes['slider_navigation_arrows_control_position'],
        'slider_pagination_control_position'                    => $attributes['slider_pagination_control_position'],
        'section_content_settings_query_order_by'               => $attributes['section_content_settings_query_order_by'],
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg ' . $attributes['section_s_p_view'],
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
        . ' ' . $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'];
    
    $block_data = productive_global_get_content_wrapper_full_full_top_data( $section_bg_color_scheme );
    $block_data .= productive_global_get_content_wrapper_full_top_data();
        $block_data .= productive_style_render_product_category( $cpt_section_args );
    $block_data .= productive_global_get_content_wrapper_full_full_bottom_data();
    $block_data .= productive_global_get_content_wrapper_full_bottom_data();

    return $block_data;
    
}
