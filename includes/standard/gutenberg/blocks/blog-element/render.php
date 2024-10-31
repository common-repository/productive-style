<?php
/**
 *
 * @package productive-style
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_style_register_blocks_init_action_blog_element() {
    productive_style_register_block_init_blog_element();
}
add_action( 'init', 'productive_style_register_blocks_init_action_blog_element' );


function productive_style_register_block_init_blog_element() {
    
    global $productive_style_plugin_version;
    
    $asset_file = include( PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/blog-element/build/index.asset.php');
    
    wp_register_script(
        'productive-style-blog-element-script',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/standard/gutenberg/blocks/blog-element/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-style-blog-element-style',
        PRODUCTIVE_STYLE_PLUGIN_URI . 'includes/standard/gutenberg/blocks/blog-element/build/style-index.css',
        array(),
        $productive_style_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/blog-element/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_style_plugin_version,
        'render_callback' => 'productive_style_register_block_render_callback_blog_element',
        'editor_script' => 'productive-style-blog-element-script',
        'style' => 'productive-style-blog-element-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_style_register_block_render_callback_blog_element( $attributes, $content ) {
    
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
        'productive_cpt_is_show_image_or_icon'                  => $attributes['productive_cpt_is_show_image_or_icon'],
        'section_show_content_title'                            => $attributes['section_show_content_title'],
        'section_show_content_text'                             => $attributes['section_show_content_text'],
        'section_content_show_url_button'                       => $attributes['section_content_show_url_button'],
        'columns_per_row'                                       => $attributes['columns_per_row'],
        'section_total_items'                                   => $attributes['section_total_items'],
        'section_settings_show_post_pagination'                 => $attributes['section_settings_show_post_pagination'],
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg',
        'productive_style_posts_excerpt_word_count'             => $attributes['productive_style_posts_excerpt_word_count'],
        'section_content_settings_filter_by'                    => $attributes['section_content_settings_filter_by'],
        'section_show_post_author'                              => $attributes['section_show_post_author'],
        'section_show_post_author_url'                          => $attributes['section_show_post_author_url'],
        'section_author_horizontal_alignment'                   => $attributes['section_author_horizontal_alignment'],
        'section_show_post_category'                            => $attributes['section_show_post_category'],
        'section_show_reading_time'                             => $attributes['section_show_reading_time'],
        'section_show_post_comments_count'                      => $attributes['section_show_post_comments_count'],
        'section_show_post_date'                                => $attributes['section_show_post_date'],
        'section_show_post_date_copy'                           => $attributes['section_show_post_date_copy'],
        'section_show_post_date_original'                       => $attributes['section_show_post_date_original'],
        'section_show_post_date_original_copy'                  => $attributes['section_show_post_date_original_copy'],
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
        . ' ' . $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'];
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action('display_content_wrapper_full_top');
            productive_style_render_blog_element( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
