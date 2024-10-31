<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/


function productive_style_render_homepage_element_section_via_builder( $cpt_section_args ) {
    
    $homepage_element_section_gutenberg_options = array(
        'section_design_type'                   => $cpt_section_args['section_design_type'],
        'section_title'                         => $cpt_section_args['section_title'],
        'section_title_html_tag'                => $cpt_section_args['section_title_html_tag'],
        'section_intro'                         => $cpt_section_args['section_intro'],
        'section_header_alignment'              => $cpt_section_args['section_header_alignment'],
        'columns_per_row'                       => $cpt_section_args['columns_per_row'],
        'section_rows'                          => $cpt_section_args['section_rows'],
        'section_content_show_url_button'       => $cpt_section_args['section_content_show_url_button'],
        'section_content_settings_taxonomy'     => $cpt_section_args['section_content_settings_taxonomy'],
    );
    
    $terms_id = intval( $cpt_section_args['section_content_settings_taxonomy'] );
    $terms_obj = null;
    if( $terms_id ) {
        $terms_obj = get_term( $terms_id );
    } else {
        $productive_global_get_post_latest_post = productive_global_get_post_latest_post(PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG);
        $productive_global_get_post_query_first_object = productive_global_get_post_query_first_object( $productive_global_get_post_latest_post );
        $terms = wp_get_object_terms( $productive_global_get_post_query_first_object->ID, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_SLUG );
        if( null != $terms && !empty($terms) ) {
            $first_terms_id = $terms[0];
            $terms_obj = get_term( $first_terms_id );
        } else {
            productive_style_get_homepage_element_section_error( $homepage_element_section_gutenberg_options, __('No category found matching the selected criteria. Please select a category and try again.', 'productive-style') );
            return;
        }
    }
    
    if( null != $terms_obj ) {
        $terms = $terms_obj->slug;
        $homepage_element_options = array();
        $homepage_element_section_type = $cpt_section_args['section_design_type'];
        if ( 'type_1' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( $homepage_element_section_gutenberg_options, productive_style_get_params_for_homepage_element_type_1( $terms ) );
        } else if ( 'type_2' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( $homepage_element_section_gutenberg_options, productive_style_get_params_for_homepage_element_type_2( $terms ) );
        } else if ( 'type_3' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( $homepage_element_section_gutenberg_options, productive_style_get_params_for_homepage_element_type_3( $terms ) );
        }

        productive_style_get_homepage_element_section( $homepage_element_options );
    }
}

/**
* Method for productive_style_render_homepage_element_section_via_customizers
*/
function productive_style_render_homepage_element_section_via_customizers() {
    if ( productive_style_homepage_element_section_enable() ) {
        $homepage_element_options = array();
        $homepage_element_section_type = productive_style_homepage_element_section_type();
        if ( 'type_1' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( productive_style_homepage_element_customizer_options(), productive_style_get_params_for_homepage_element_type_1() );
        } else if ( 'type_2' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( productive_style_homepage_element_customizer_options(), productive_style_get_params_for_homepage_element_type_2() );
        } else if ( 'type_3' == $homepage_element_section_type ) {
            $homepage_element_options = array_merge( productive_style_homepage_element_customizer_options(), productive_style_get_params_for_homepage_element_type_3() );
        }
        
        productive_style_get_homepage_element_section( $homepage_element_options );
    }
}
add_action( 'display_homepage_element_section', 'productive_style_render_homepage_element_section_via_customizers');

function productive_style_homepage_element_customizer_options() {
    $section_content_show_url_button = 0;
    if( productive_style_homepage_element_section_enable_button() ) {
        $section_content_show_url_button = 1;
    }
    return array(
        'section_title'                     => productive_style_homepage_element_section_title(),
        'section_title_html_tag'            => 'h2',
        'section_intro'                     => productive_style_homepage_element_section_intro(),
        'section_header_alignment'          => '',
        'columns_per_row'                   => productive_style_homepage_element_section_num_cols(),
        'section_rows'                      => productive_style_homepage_element_section_num_rows(),
        'section_content_show_url_button'   => $section_content_show_url_button,
    );
}

function productive_style_get_params_for_homepage_element_type_1( $terms = PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TYPE_HOMEPAGE_ELEMENTS_WITH_ICON ) {
    return array(
        'terms' => $terms,
        'section_design_type' => 'type-1',
        'to_num_of_cols' => 'to_two',
        'productive_cpt_is_show_image_or_icon' => 'icon',
        'alignable_container_justify_items_header' => 'justify-items-start',
        'alignable_container_layout_box' => 'flexed-no-wrap column-gap-10px',
        'alignable_container_layout_text' => 'grided gap-zero',
    );
}

function productive_style_get_params_for_homepage_element_type_2( $terms = PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TYPE_HOMEPAGE_ELEMENTS_WITH_ICON ) {
    return array(
        'terms' => $terms,
        'section_design_type' => 'type-2',
        'to_num_of_cols' => 'to_two',
        'productive_cpt_is_show_image_or_icon' => 'icon',
        'alignable_container_justify_items_header' => 'justify-items-start',
        'alignable_container_layout_box' => 'row-gap-20px',
        'alignable_container_layout_text' => 'grided gap-zero row-gap-10px',
    );
}

function productive_style_get_params_for_homepage_element_type_3( $terms = PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TYPE_HOMEPAGE_ELEMENTS_WITH_IMAGE ) {
    return array(
        'terms' => $terms,
        'section_design_type' => 'type-3',
        'to_num_of_cols' => 'to_one',
        'productive_cpt_is_show_image_or_icon' => 'image',
        'alignable_container_justify_items_header' => 'justify-items-start',
        'alignable_container_layout_box' => 'row-gap-zero',
        'alignable_container_layout_text' => 'grided gap-zero row-gap-10px',
    );
}


/**
* Method for productive_style_get_homepage_element_section
*/
function productive_style_get_homepage_element_section( $homepage_element_options = array() ) {
    
    $section_title              = $homepage_element_options['section_title'];
    $section_title_html_tag     = $homepage_element_options['section_title_html_tag'];
    $section_intro              = $homepage_element_options['section_intro'];
    $section_header_alignment   = $homepage_element_options['section_header_alignment'];
    $columns_per_row            = $homepage_element_options['columns_per_row'];
    $section_rows               = $homepage_element_options['section_rows'];
    
    $alignable_container_justify_items_header = $homepage_element_options['alignable_container_justify_items_header'];    
    $alignable_container_layout_box = $homepage_element_options['alignable_container_layout_box'];    
    $alignable_container_layout_text = $homepage_element_options['alignable_container_layout_text'];
    
    $limit = $columns_per_row * $section_rows; 
    
    $taxonomy_args = array(
        array(
            'taxonomy' => PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_SLUG,
            'field' => 'slug',
            'terms' => $homepage_element_options['terms'],
        )
    );
    $args = array(
        'post_type' => PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG,
        'posts_per_page' => $limit,
        'orderby' => 'menu_order ASC',
        'order' => 'ASC',
        'suppress_filters' => 0,
        'tax_query' => $taxonomy_args,
    );
    $productive_cpt = new WP_Query( $args );
    if ( $productive_cpt->have_posts() ) {
    
    $section_content_settings_unique_id = 'section_content_unique_id_'. rand();
    $section_initiator = 'std';
    $productiveminds_section_display = 'grided';
    ?>
        <?php do_action( 'display_content_wrapper_full_top', 'page_main_section_container home' ); ?>
            <div class="productiveminds_widget_container_home">

                <div class="productiveminds_section homepage-element <?php echo esc_attr( $homepage_element_options['section_design_type'] ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
                    <div class="productiveminds_section_uno">
                        <?php
                            $productiveminds_section_content_type = PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG;
                            $productiveminds_section_meta_key = PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY;
                            $section_show_content_title = 1;
                            $section_show_content_text = 1;
                            // Styles
                            $productive_cpt_is_show_image_or_icon = $homepage_element_options['productive_cpt_is_show_image_or_icon'];
                            $section_style_content_button_hover_animation = '';
                            $section_content_widget_specific_content = 0;

                            $section_content_show_url_button = 0;
                            if( $homepage_element_options['section_content_show_url_button'] ) {
                                $section_content_show_url_button = 1;
                            }

                            $misc = array(
                                'productive_cpt_is_show_image_or_icon'              => $productive_cpt_is_show_image_or_icon,
                                'section_content_show_url_button'                   => $section_content_show_url_button,
                                'section_style_content_button_hover_animation'      => $section_style_content_button_hover_animation,
                                'productiveminds_section_content_type'              => $productiveminds_section_content_type,
                                'productiveminds_section_meta_key'                  => $productiveminds_section_meta_key,
                                'section_content_widget_specific_content'           => $section_content_widget_specific_content,
                                'section_show_content_title'                        => $section_show_content_title,
                                'section_show_content_text'                         => $section_show_content_text,
                                'alignable_container_justify_items_header'          => $alignable_container_justify_items_header,
                                'alignable_container_layout_box'                    => $alignable_container_layout_box,
                                'alignable_container_layout_text'                   => $alignable_container_layout_text,
                                'to_num_of_cols'                                    => $homepage_element_options['to_num_of_cols'],
                                'content_type'                                      => 'content',
                            );

                            productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );

                            productive_style_render_grid_std( $productive_cpt, $columns_per_row, $misc );
                        ?>
                    </div>
                </div>
            </div>
        <?php do_action('display_content_wrapper_full_bottom'); ?>
    <?php
    } else {
        productive_style_get_homepage_element_section_error( $homepage_element_options, __('No Homepage Element found matching the selected criteria.', 'productive-style') );
    }
}

function productive_style_get_homepage_element_section_error( $homepage_element_options, $error_message = '' ) {
    ?>
    <?php do_action( 'display_content_wrapper_full_top', 'page_main_section_container home' ); ?>
        <div class="productiveminds_widget_container_home">
            <div class="productiveminds_section homepage-element">
                <div class="productiveminds_section_uno">
                    <?php
                        $section_title              = $homepage_element_options['section_title'];
                        $section_title_html_tag     = $homepage_element_options['section_title_html_tag'];
                        $section_intro              = $homepage_element_options['section_intro'];
                        $section_header_alignment   = $homepage_element_options['section_header_alignment'];
                        productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
                        productive_global_render_no_content_found( 'homepage-element', $error_message, '' );
                    ?>
                </div>
            </div>
        </div>
    <?php do_action('display_content_wrapper_full_bottom'); ?>
    <?php
}
