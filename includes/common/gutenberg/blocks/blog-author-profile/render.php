<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_blog_author_profile() {
    productive_style_register_block_init_blog_author_profile();
}
add_action( 'init', 'productive_style_register_blocks_init_action_blog_author_profile' );


function productive_style_register_block_init_blog_author_profile() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/blog-author-profile/build/index.asset.php');
    
    wp_register_script(
        'productive-style-blog-author-profile-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/blog-author-profile/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-blog-author-profile-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/common/gutenberg/blocks/blog-author-profile/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/gutenberg/blocks/blog-author-profile/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_blog_author_profile',
        'editor_script' => 'productive-style-blog-author-profile-script',
        'style' => 'productive-style-blog-author-profile-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_blog_author_profile( $attributes, $content ) {
    
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
    
    if( isset($attributes['section_content_layout_format']) &&
        ( 'list_lefted_grided' == $attributes['section_content_layout_format'] || 'list_righted_grided' == $attributes['section_content_layout_format']) ) {
            $attributes['section_content_box_design_style'] = 'content_below_media';
    }
    
    $cpt_section_args = array(
        'section_initiator'                                     => 'std gtbg',
        'section_gtbg_align'                                    => '',
        'section_title'                                         => $attributes['section_title'],
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
        'section_read_more_url'                                 => $attributes['section_read_more_url'],
        'section_read_more_url_text'                            => $attributes['section_read_more_url_text'],
        'section_show_content_name_and_position'                => $attributes['section_show_content_name_and_position'],
        'section_content_media_item_shape'                      => $attributes['section_content_media_item_shape'],
        'section_show_content_text'                             => $attributes['section_show_content_text'],
        'productive_style_posts_excerpt_word_count'             => $attributes['productive_style_posts_excerpt_word_count'],
        'section_content_show_contact_icons'                    => $attributes['section_content_show_contact_icons'],
        'section_content_social_media_icon_shape'               => $attributes['section_content_social_media_icon_shape'],
        'section_content_layout_format'                         => $attributes['section_content_layout_format'],
        'section_content_wrap_in_small_screen'                  => $attributes['section_content_wrap_in_small_screen'],
        'section_content_box_design_style'                      => $attributes['section_content_box_design_style'],
        'section_content_settings_taxonomy'                     => $attributes['section_content_settings_taxonomy'],
        'columns_per_row'                                       => $attributes['columns_per_row'],
        'section_total_items'                                   => $attributes['section_total_items'],
        'slider_navigation_arrows_control_position'             => $attributes['slider_navigation_arrows_control_position'],
        'slider_pagination_control_position'                    => $attributes['slider_pagination_control_position'],
        'section_settings_show_post_pagination'                 => $attributes['section_settings_show_post_pagination'],
        'section_content_settings_query_order_by'               => $attributes['section_content_settings_query_order_by'],
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg ' . $attributes['section_s_p_view'],
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
        . ' ' . $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'] . ' ' . $attributes['section_content_media_item_shape'];
    
    $section_content_content_box_shape = '';
    if( isset($attributes['section_content_content_box_shape']) ) {
        $section_content_content_box_shape = $attributes['section_content_content_box_shape'];
    }
    $section_content_content_box_alignment_h = '';
    if( isset($attributes['section_content_content_box_alignment_h']) ) {
        $section_content_content_box_alignment_h = $attributes['section_content_content_box_alignment_h'];
    }
    $section_content_show_url_button_shape = '';
    if( isset($attributes['section_content_show_url_button_shape']) ) {
        $section_content_show_url_button_shape = $attributes['section_content_show_url_button_shape'];
    }
    $section_content_show_url_button_width = '';
    if( isset($attributes['section_content_show_url_button_width']) ) {
        $section_content_show_url_button_width = $attributes['section_content_show_url_button_width'];
    }
    $section_content_items_css_classes = ' ' . $section_content_content_box_shape . ' ' . $section_content_content_box_alignment_h 
            . ' ' . $section_content_show_url_button_shape . ' ' . $section_content_show_url_button_width;
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action( 'display_content_wrapper_full_top', $section_content_items_css_classes );
        productive_style_render_blog_author_profile( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
