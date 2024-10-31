<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/


function productive_style_render_faq( $cpt_section_args ) {
    
    $productiveminds_section_widget_type    = PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_FAQ;
    $productiveminds_section_content_type   = PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_SLUG;
    $productiveminds_section_meta_key       = PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_META_KEY;
    $productiveminds_section_toggle_parent_css_class = 'productive_toggler_list_block productive_toggler_faq';
    
    $columns_per_row = 4;
    $section_total_items = 10;
    $query_order = productive_global_get_cpt_query_order_by();
    if ( isset( $cpt_section_args['columns_per_row'] ) ) {
        $columns_per_row = $cpt_section_args['columns_per_row'];
    }
    if ( isset( $cpt_section_args['section_total_items'] ) ) {
        $section_total_items = $cpt_section_args['section_total_items'];
    }
    if ( isset( $cpt_section_args['section_content_settings_query_order_by'] ) ) {
        $section_content_settings_query_order_by = $cpt_section_args['section_content_settings_query_order_by'];
        $query_order = productive_global_get_cpt_query_order_by( $section_content_settings_query_order_by );
    }
    $limit = $section_total_items;
    
    $section_content_settings_taxonomy = '';
    $section_content_settings_terms_field = 'term_id';
    if ( isset( $cpt_section_args['section_content_settings_taxonomy'] ) && '' != $cpt_section_args['section_content_settings_taxonomy'] ) {
        $section_content_settings_taxonomy = $cpt_section_args['section_content_settings_taxonomy'];
    }
    if ( function_exists( 'productive_minds_is_active' ) && ( isset( $cpt_section_args['section_content_settings_product_slug_is_in_use'] ) && '1' == $cpt_section_args['section_content_settings_product_slug_is_in_use'] ) ) {
        if ( isset( $cpt_section_args['section_content_settings_product_slug'] ) && '' != $cpt_section_args['section_content_settings_product_slug'] ) {
            $section_content_settings_taxonomy = $cpt_section_args['section_content_settings_product_slug'];
            $section_content_settings_terms_field = 'slug';
        }
    }
    
    $taxonomy_args = array();
    if ( '' != $section_content_settings_taxonomy ) {
        $taxonomy_args = array(
            array(
                'taxonomy' => PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG,
                'field' => $section_content_settings_terms_field,
                'terms' => $section_content_settings_taxonomy,
            )
        );
    }
    
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    if ( !empty($taxonomy_args) ) {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_SLUG,
            'posts_per_page' => $limit,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
            'tax_query' => $taxonomy_args,
            'paged' => $paged,
        );
    } else {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_SLUG,
            'posts_per_page' => $limit,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
            'paged' => $paged,
        );
    }
    
    $productive_cpt = new WP_Query( $args );
    
    $section_content_header_is_show_section_header = 1;
    $section_title = __('Frequently Asked Questions', 'productive-style');
    $section_title_html_tag = 'h2';
    $section_intro = __('Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-style');
    $section_header_alignment = '';
    $section_content_settings_unique_id = 'section_content_unique_id_'. rand();
    $section_initiator = 'std';
    $section_content_layout_format = 'list';
    
    if ( isset( $cpt_section_args['section_content_header_is_show_section_header'] ) ) {
        $section_content_header_is_show_section_header = $cpt_section_args['section_content_header_is_show_section_header'];
    }
    if ( isset( $cpt_section_args['section_title'] ) ) {
        $section_title = $cpt_section_args['section_title'];
    }
    if ( isset( $cpt_section_args['section_title_html_tag'] ) ) {
        $section_title_html_tag = $cpt_section_args['section_title_html_tag'];
    }
    if ( isset( $cpt_section_args['section_intro'] ) ) {
        $section_intro = $cpt_section_args['section_intro'];
    }
    if ( isset( $cpt_section_args['section_header_alignment'] ) ) {
        $section_header_alignment = $cpt_section_args['section_header_alignment'];
    }
    if ( isset( $cpt_section_args['section_content_settings_unique_id'] ) ) {
        $section_content_settings_unique_id = $cpt_section_args['section_content_settings_unique_id'];
    }
    if ( isset( $cpt_section_args['section_initiator'] ) ) {
        $section_initiator = $cpt_section_args['section_initiator'];
    }
    if ( isset( $cpt_section_args['section_content_layout_format'] ) ) {
        $section_content_layout_format = $cpt_section_args['section_content_layout_format'];
    }
    $productiveminds_section_display = 'grided';
    if ( 'slider' == $section_content_layout_format ) {
        $productiveminds_section_display = 'flexed';
    }
    ?>
    <div class="productiveminds_section faq <?php echo esc_attr( $section_content_layout_format ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
        <div class="productiveminds_section_uno">
    <?php 
    
    // Header
    if ( $section_content_header_is_show_section_header ) {
        productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
    }
        
    if ( $productive_cpt->have_posts() ) {
    
        $section_show_content_title = 1;
        $section_show_content_text = 0;
        $section_toggle_button_location = 'right_button';
        $section_content_show_url_button = 0; // Not used in this type
        // Styles
        $productive_cpt_is_show_image_or_icon = ''; // Not used in this type
        $slider_navigation_arrows_control_position = 'nav-arrows-sides-in';
        $slider_pagination_control_position = 'nav-pagination-out';
        $slider_navigation_arrows_control_shape = 'slider_nav_shape_circle';
        $slider_pagination_control_shape = 'slider_pagination_shape_hybrid';
        $section_style_content_button_hover_animation = '';
        $section_content_widget_specific_content = 0;
        $section_settings_show_post_pagination = 0;
        $slider_swiper_css_class_from_elementor = 'via_std';

        if ( isset( $cpt_section_args['section_show_content_title'] ) ) {
            $section_show_content_title = intval( $cpt_section_args['section_show_content_title'] );
        }
        if ( isset( $cpt_section_args['section_show_content_text'] ) ) {
            $section_show_content_text = intval( $cpt_section_args['section_show_content_text'] );
        }
        if ( isset( $cpt_section_args['section_toggle_button_location'] ) ) {
            $section_toggle_button_location = $cpt_section_args['section_toggle_button_location'];
        }
        if ( isset( $cpt_section_args['section_content_show_url_button'] ) ) {
            $section_content_show_url_button = intval( $cpt_section_args['section_content_show_url_button'] );
        }
        if ( isset( $cpt_section_args['productive_cpt_is_show_image_or_icon'] ) ) {
            $productive_cpt_is_show_image_or_icon = $cpt_section_args['productive_cpt_is_show_image_or_icon'];
        }
        if ( isset( $cpt_section_args['slider_navigation_arrows_control_position'] ) ) {
            $slider_navigation_arrows_control_position = $cpt_section_args['slider_navigation_arrows_control_position'];
        }
        if ( isset( $cpt_section_args['slider_navigation_arrows_control_shape'] ) ) {
            $slider_navigation_arrows_control_shape = $cpt_section_args['slider_navigation_arrows_control_shape'];
        }
        if ( isset( $cpt_section_args['slider_pagination_control_shape'] ) ) {
            $slider_pagination_control_shape = $cpt_section_args['slider_pagination_control_shape'];
        }
        if ( isset( $cpt_section_args['slider_pagination_control_position'] ) ) {
            $slider_pagination_control_position = $cpt_section_args['slider_pagination_control_position'];
        }
        if ( isset( $cpt_section_args['section_style_content_button_hover_animation'] ) ) {
            $section_style_content_button_hover_animation = $cpt_section_args['section_style_content_button_hover_animation'];
        }
        if ( isset( $cpt_section_args['section_content_widget_specific_content'] ) ) {
            $section_content_widget_specific_content = $cpt_section_args['section_content_widget_specific_content'];
        }
        if ( isset( $cpt_section_args['section_settings_show_post_pagination'] ) ) {
            $section_settings_show_post_pagination = $cpt_section_args['section_settings_show_post_pagination'];
        }
        if ( isset( $cpt_section_args['slider_swiper_css_class_from_elementor'] ) ) {
            $slider_swiper_css_class_from_elementor = $cpt_section_args['slider_swiper_css_class_from_elementor'];
        }
    
        $misc = array(
            'productive_cpt_is_show_image_or_icon'              => $productive_cpt_is_show_image_or_icon,
            'section_content_show_url_button'                   => $section_content_show_url_button,
            'section_style_content_button_hover_animation'      => $section_style_content_button_hover_animation,
            'productiveminds_section_widget_type'               => $productiveminds_section_widget_type,
            'productiveminds_section_content_type'              => $productiveminds_section_content_type,
            'productiveminds_section_meta_key'                  => $productiveminds_section_meta_key,
            'section_content_widget_specific_content'           => $section_content_widget_specific_content,
            'productiveminds_section_toggle_parent_css_class'   => $productiveminds_section_toggle_parent_css_class,
            'section_show_content_title'                        => $section_show_content_title,
            'section_show_content_text'                         => $section_show_content_text,
            'section_toggle_button_location'                    => $section_toggle_button_location,
            'slider_navigation_arrows_control_shape'            => $slider_navigation_arrows_control_shape,
            'slider_pagination_control_shape'                   => $slider_pagination_control_shape,
            'section_settings_show_post_pagination'             => $section_settings_show_post_pagination,
        );

        if ( 'list' == $section_content_layout_format ) {
            
            productive_style_render_toggleable_v_1( 
                $productive_cpt, 
                $misc
            );
            
        } else if ( ( productive_style_is_extra() || productive_global_is_a_productive_extra_theme() ) && 'slider' == $section_content_layout_format ) {
            $slider_swiper_main_css_class = 'productiveminds-faq-slider';
            productive_style_render_slider_cpt_v_1( 
                $productive_cpt,
                $slider_navigation_arrows_control_position, 
                $slider_pagination_control_position, 
                $slider_swiper_main_css_class,
                $slider_swiper_css_class_from_elementor, 
                $misc
            );
            
        } else if ( ( productive_style_is_extra() || productive_global_is_a_productive_extra_theme() ) && 'grid' == $section_content_layout_format ) {
            
            productive_style_render_grid_v_1( 
                $productive_cpt, 
                $columns_per_row, 
                $misc
            );
            
        }
    } else {
        productive_global_render_no_content_found( 'faq', __('No FAQ found matching the criteria.', 'productive-style'), '' );
    }
    ?>
        </div><!-- productiveminds_section_uno -->
    </div><!-- productiveminds_section -->
    <?php
}
