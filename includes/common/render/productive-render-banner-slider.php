<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/ 


function productive_style_render_banner_slider( $cpt_section_args ) {
    
    $productiveminds_section_widget_type    = PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_BANNER_SLIDER;
    $productiveminds_section_content_type   = PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG;
    $productiveminds_section_meta_key       = PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY;
    
    $section_total_items       = 10;
    $query_order = productive_global_get_cpt_query_order_by();
    if ( isset( $cpt_section_args['section_total_items'] ) ) {
        $section_total_items = $cpt_section_args['section_total_items'];
    }
    if ( isset( $cpt_section_args['section_content_settings_query_order_by'] ) ) {
        $section_content_settings_query_order_by = $cpt_section_args['section_content_settings_query_order_by'];
        $query_order = productive_global_get_cpt_query_order_by( $section_content_settings_query_order_by );
    }
    $limit = $section_total_items;
    
    $taxonomy_args = array();
    $section_content_settings_taxonomy = 0;
    if ( isset( $cpt_section_args['section_content_settings_taxonomy'] ) && '' != $cpt_section_args['section_content_settings_taxonomy'] ) {
        $section_content_settings_taxonomy = intval( $cpt_section_args['section_content_settings_taxonomy'] );
        if( $section_content_settings_taxonomy ) {
            $taxonomy_args = array(
                array(
                    'taxonomy' => PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_SLUG,
                    'field' => 'term_id',
                    'terms' => $section_content_settings_taxonomy,
                )
            );
        }
    }
        
    if ( !empty($taxonomy_args) ) {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG,
            'posts_per_page' => $limit,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
            'tax_query' => $taxonomy_args,
        );
    } else {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG,
            'posts_per_page' => $limit,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
        );
    }
    
    $productive_cpt = new WP_Query( $args );
    
    $section_content_header_is_show_section_header = 1;
    $section_title = __('Banner Slider', 'productive-style');
    $section_title_html_tag = 'h2';
    $section_intro = __('Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-style');
    $section_header_alignment = '';
    $section_content_settings_unique_id = 'section_content_unique_id_'. rand();
    $section_initiator = 'std';
    $section_gtbg_align = '';
    $section_content_layout_format = 'slider';
    $section_content_wrap_in_small_screen = 'wrap_to_one_column_in_small_screen';
    
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
    if ( isset( $cpt_section_args['section_gtbg_align'] ) ) {
        $section_gtbg_align = $cpt_section_args['section_gtbg_align'];
    }
    if ( isset( $cpt_section_args['section_content_layout_format'] ) ) {
        $section_content_layout_format = $cpt_section_args['section_content_layout_format'];
    }
    if ( isset( $cpt_section_args['section_content_wrap_in_small_screen'] ) ) {
        $section_content_wrap_in_small_screen = $cpt_section_args['section_content_wrap_in_small_screen'];
    }
    $productiveminds_section_display = 'flexed';
    ?>
    <div class="productiveminds_section banner-slider productiveminds-home-hero-slider <?php echo esc_attr( $section_content_wrap_in_small_screen ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?> <?php echo esc_attr( $section_gtbg_align ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
        <div class="productiveminds_section_uno">
    <?php 
    
    if ( $section_content_header_is_show_section_header ) {
        productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
    }
        
    if ( $productive_cpt->have_posts() ) {
        $section_show_content_title = 1;
        $section_show_content_text = 1;
        $section_content_show_url_button = 1;
        // Styles
        $productive_cpt_is_show_image_or_icon = 'image';
        $productive_cpt_is_link_image = 0;
        $slider_navigation_arrows_control_position = 'nav-arrows-sides-in';
        $slider_pagination_control_position = 'nav-pagination-out';
        $slider_navigation_arrows_control_shape = 'slider_nav_shape_circle';
        $slider_pagination_control_shape = 'slider_pagination_shape_hybrid';
        $content_auxiliary_location = 'content_auxiliary_bottom';
        $section_style_content_button_hover_animation = '';
        $section_style_button_1_button_hover_animation = '';
        $section_style_button_2_button_hover_animation = '';
        $section_content_widget_specific_content = 0;
        $slider_swiper_css_class_from_elementor = 'via_std';
        
        $slider_content_start = '--ease-in-out';
        $slider_content_entrance_easing = 'top';
        $slider_slide_image_width       = 1000;
        $slider_slide_image_min_width       = 50;
        $slider_slide_content_width     = 700;
        $slider_slide_content_width_indentation = 100;
        $slider_banner_height = 700;
        $slider_slide_overlay_color = '#000000';
        $slider_slide_overlay_opacity = 0.05;
        
        $slider_design_type = 'hero_slider_design_1';
        
        if ( isset( $cpt_section_args['section_show_content_title'] ) ) {
            $section_show_content_title = intval( $cpt_section_args['section_show_content_title'] );
        }
        if ( isset( $cpt_section_args['section_show_content_text'] ) ) {
            $section_show_content_text = intval( $cpt_section_args['section_show_content_text'] );
        }
        if ( isset( $cpt_section_args['section_content_show_url_button'] ) ) {
            $section_content_show_url_button = intval( $cpt_section_args['section_content_show_url_button'] );
        }
        if ( isset( $cpt_section_args['productive_cpt_is_show_image_or_icon'] ) ) {
            $productive_cpt_is_show_image_or_icon = $cpt_section_args['productive_cpt_is_show_image_or_icon'];
        }
        if ( isset( $cpt_section_args['productive_cpt_is_link_image'] ) ) {
            $productive_cpt_is_link_image = intval( $cpt_section_args['productive_cpt_is_link_image'] );
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
        if ( isset( $cpt_section_args['content_auxiliary_location'] ) ) {
            $content_auxiliary_location = $cpt_section_args['content_auxiliary_location'];
        }
        if ( isset( $cpt_section_args['slider_pagination_control_position'] ) ) {
            $slider_pagination_control_position = $cpt_section_args['slider_pagination_control_position'];
        }
        if ( isset( $cpt_section_args['section_style_content_button_hover_animation'] ) ) {
            $section_style_content_button_hover_animation = $cpt_section_args['section_style_content_button_hover_animation'];
        }
        if ( isset( $cpt_section_args['section_style_button_1_button_hover_animation'] ) ) {
            $section_style_button_1_button_hover_animation = $cpt_section_args['section_style_button_1_button_hover_animation'];
        }
        if ( isset( $cpt_section_args['section_style_button_2_button_hover_animation'] ) ) {
            $section_style_button_2_button_hover_animation = $cpt_section_args['section_style_button_2_button_hover_animation'];
        }
        if ( isset( $cpt_section_args['section_content_widget_specific_content'] ) ) {
            $section_content_widget_specific_content = $cpt_section_args['section_content_widget_specific_content'];
        }
        if ( isset( $cpt_section_args['slider_swiper_css_class_from_elementor'] ) ) {
            $slider_swiper_css_class_from_elementor = $cpt_section_args['slider_swiper_css_class_from_elementor'];
        }
        
        if ( isset( $cpt_section_args['slider_content_entrance_easing'] ) ) {
            $slider_content_entrance_easing = $cpt_section_args['slider_content_entrance_easing'];
        }
        if ( isset( $cpt_section_args['slider_content_start'] ) ) {
            $slider_content_start = $cpt_section_args['slider_content_start'];
        }
        if ( isset( $cpt_section_args['slider_slide_image_width'] ) ) {
            $slider_slide_image_width = intval( $cpt_section_args['slider_slide_image_width'] );
        }
        if ( isset( $cpt_section_args['slider_slide_image_min_width'] ) ) {
            $slider_slide_image_min_width = intval( $cpt_section_args['slider_slide_image_min_width'] );
        }
        if ( isset( $cpt_section_args['slider_slide_content_width'] ) ) {
            $slider_slide_content_width = intval( $cpt_section_args['slider_slide_content_width'] );
        }
        if ( isset( $cpt_section_args['slider_slide_content_width_indentation'] ) ) {
            $slider_slide_content_width_indentation = intval( $cpt_section_args['slider_slide_content_width_indentation'] );
        }
        if ( isset( $cpt_section_args['slider_banner_height'] ) ) {
            $slider_banner_height = $cpt_section_args['slider_banner_height'];
        }
        if ( isset( $cpt_section_args['slider_slide_overlay_color'] ) ) {
            $slider_slide_overlay_color = $cpt_section_args['slider_slide_overlay_color'];
        }
        if ( isset( $cpt_section_args['slider_slide_overlay_opacity'] ) ) {
            $slider_slide_overlay_opacity = floatval( $cpt_section_args['slider_slide_overlay_opacity'] );
        }
        if ( isset( $cpt_section_args['slider_design_type'] ) ) {
            $slider_design_type = $cpt_section_args['slider_design_type'];
        }
        
        $misc = array(
            'productive_cpt_is_show_image_or_icon'              => $productive_cpt_is_show_image_or_icon,
            'productive_cpt_is_link_image'                      => $productive_cpt_is_link_image,
            'section_content_show_url_button'                   => $section_content_show_url_button,
            'section_style_content_button_hover_animation'      => $section_style_content_button_hover_animation,
            'section_style_button_1_button_hover_animation'     => $section_style_button_1_button_hover_animation,
            'section_style_button_2_button_hover_animation'     => $section_style_button_2_button_hover_animation,
            'productiveminds_section_widget_type'               => $productiveminds_section_widget_type,
            'productiveminds_section_content_type'              => $productiveminds_section_content_type,
            'productiveminds_section_meta_key'                  => $productiveminds_section_meta_key,
            'section_content_widget_specific_content'           => $section_content_widget_specific_content,
            'section_show_content_title'                        => $section_show_content_title,
            'section_show_content_text'                         => $section_show_content_text,
            'slider_navigation_arrows_control_shape'            => $slider_navigation_arrows_control_shape,
            'slider_pagination_control_shape'                   => $slider_pagination_control_shape,
            'content_auxiliary_location'                        => $content_auxiliary_location,
            'slider_content_entrance_easing'                    => $slider_content_entrance_easing,
            'slider_content_start'                              => $slider_content_start,
            'slider_slide_image_width'                          => $slider_slide_image_width,
            'slider_slide_image_min_width'                      => $slider_slide_image_min_width,
            'slider_slide_content_width'                        => $slider_slide_content_width,
            'slider_slide_content_width_indentation'            => $slider_slide_content_width_indentation,
            'slider_banner_height'                              => $slider_banner_height,
            'slider_slide_overlay_color'                        => $slider_slide_overlay_color,
            'slider_slide_overlay_opacity'                      => $slider_slide_overlay_opacity,
        );
        
        $slider_swiper_main_css_class = 'productiveminds-banner-slider-slider';
        
        if( 'hero_slider_design_1' == $slider_design_type ) {
            productive_style_render_banner_slider_v_1( 
                $productive_cpt,
                $slider_navigation_arrows_control_position, 
                $slider_pagination_control_position, 
                $slider_swiper_main_css_class,
                $slider_swiper_css_class_from_elementor, 
                $misc
            );
        } else if( 'hero_slider_design_2' == $slider_design_type ) {
            productive_style_render_banner_slider_v_2( 
                $productive_cpt,
                $slider_navigation_arrows_control_position, 
                $slider_pagination_control_position, 
                $slider_swiper_main_css_class,
                $slider_swiper_css_class_from_elementor, 
                $misc
            );
        }
        
    } else {
        productive_global_render_no_content_found( 'banner-slider', __('No Banner Slider found matching the criteria.', 'productive-style'), '' );
    }
    ?>
        </div><!-- productiveminds_section_uno -->
    </div><!-- productiveminds_section -->
    <?php 
}
