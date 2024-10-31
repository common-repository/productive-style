<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/


/**
* Method for productive_style_the_home_section_bestsellers
*/
function productive_style_render_homepage_product_section( $cpt_section_args ) {
    
    $terms = '';
    $terms_id = intval( $cpt_section_args['section_content_settings_taxonomy'] );
    if( $terms_id ) {
        $terms_obj = get_term( $terms_id );
        if( null != $terms_obj ) {
            $terms = $terms_obj->slug;
        }
    } else {
        $productive_global_get_post_latest_post = productive_global_get_post_latest_post(PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG);
        $productive_global_get_post_query_first_object = productive_global_get_post_query_first_object( $productive_global_get_post_latest_post );
        $terms = wp_get_object_terms( $productive_global_get_post_query_first_object->ID, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_SLUG );
        if( null != $terms && !empty($terms) ) {
            $first_terms_id = $terms[0];
            $terms_obj = get_term( $first_terms_id );
            if( null != $terms_obj ) {
                $terms = $terms_obj->slug;
            }
        }
    }
    
    $misc = array(
        'section_content_type'          => $cpt_section_args['section_content_type'],
        'terms'                         => $terms,
        'limit'                         => $cpt_section_args['limit'],
        'section_design'                => $cpt_section_args['section_design'],
        'section_blocks_ratio'          => $cpt_section_args['section_blocks_ratio'],
        'content_alignment_v'           => $cpt_section_args['content_alignment_v'],
        'content_alignment_h'           => $cpt_section_args['content_alignment_h'],
        'hero_color_scheme'             => $cpt_section_args['hero_color_scheme'],
        'cta_style'                     => $cpt_section_args['cta_style'],
        'section_bg_color_scheme'       => 'page_main_section_container home ' . $cpt_section_args['section_bg_color_scheme'],
    );

    do_action( 'display_productive_theme_homepage_woo_product_element', $misc );
}
