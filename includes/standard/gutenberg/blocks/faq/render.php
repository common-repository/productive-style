<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_faq() {
    productive_style_register_block_init_faq();
}
add_action( 'init', 'productive_style_register_blocks_init_action_faq' );


function productive_style_register_block_init_faq() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/faq/build/index.asset.php');
    
    wp_register_script(
        'productive-style-faq-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/standard/gutenberg/blocks/faq/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-faq-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/standard/gutenberg/blocks/faq/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/faq/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_faq',
        'editor_script' => 'productive-style-faq-script',
        'style' => 'productive-style-faq-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_faq( $attributes, $content ) {
    
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
        'section_gtbg_align'                                    => '',
        'section_title'                                         => '',
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
        'section_show_content_title'                            => '1',
        'section_show_content_text'                             => '1',
        'section_content_layout_format'                         => $attributes['section_content_layout_format'],
        'section_content_box_design_style'                      => $attributes['section_content_box_design_style'],
        'columns_per_row'                                       => $attributes['columns_per_row'],
        'section_total_items'                                   => $attributes['section_total_items'],
        'slider_navigation_arrows_control_position'             => $attributes['slider_navigation_arrows_control_position'],
        'slider_pagination_control_position'                    => $attributes['slider_pagination_control_position'],
        'section_settings_show_post_pagination'                 => $attributes['section_settings_show_post_pagination'],
        'section_content_settings_query_order_by'               => $attributes['section_content_settings_query_order_by'],
    );
    
    $faq_css_selectors = $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_content_box_design_style'];
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
            . ' ' . $faq_css_selectors . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'];
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action('display_content_wrapper_full_top');
        
            $counter = 0;
            $faq_cpt_terms_in_use = array();
            $taxonomy = $attributes['section_content_settings_taxonomy'];
            $faq_cpt_terms = productive_global_get_cpt_terms( PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG, false );
            if( empty( $taxonomy ) ) {
                $faq_cpt_terms_in_use = $faq_cpt_terms;
            } else {
                foreach ( $faq_cpt_terms as $key => $faq_cpt_term ) {
                    if( $taxonomy == $key ) {
                        $faq_cpt_terms_in_use[$key] = $faq_cpt_term;
                    }
                }
            }
            foreach ( $faq_cpt_terms_in_use as $key => $faq_cpt_term ) {
                $cpt_section_args['section_title'] = $faq_cpt_term;
                $cpt_section_args['section_content_settings_taxonomy'] = $key;
                if( $counter ) {
                    $cpt_section_args['section_initiator'] = 'std faq-page';
                }
                productive_style_render_faq( $cpt_section_args );
                $counter++;
            }
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
