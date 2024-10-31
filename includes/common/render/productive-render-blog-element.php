<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/

function productive_style_render_blog_element( $cpt_section_args ) {
    global $wp_query;
    $section_content_page_number = '';
    if( isset($wp_query->query_vars['paged']) ) {
        $section_content_page_number = $wp_query->query_vars['paged'];
    }
    $category_name_in_query = '';
    if( isset($wp_query->query_vars['category_name']) ) {
        $category_name_in_query = $wp_query->query_vars['category_name'];
    }
    
    $productiveminds_section_widget_type    = PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_BLOG_ELEMENT;
    $productiveminds_section_content_type   = PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_POST_TYPE_SLUG;
    $productiveminds_section_meta_key       = PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_POST_TYPE_META_KEY;
    
    $columns_per_row    = 4;
    $section_total_items       = 10;
    $query_order = productive_global_get_cpt_query_order_by( 'newest' );
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
    
    $taxonomy_args = array();
    $section_content_settings_taxonomy = '';
    $is_related_posts = false;
    $current_post_id = 0;
    if ( isset( $cpt_section_args['section_content_settings_filter_by'] ) && '' != $cpt_section_args['section_content_settings_filter_by'] ) {
        global $post;
        $current_post_type = 0;
        if( null != $post && !empty($post) ) {
            $current_post_id = $post->ID;
            $current_post_type = $post->post_type;
        }
        
        $section_content_settings_filter_by = $cpt_section_args['section_content_settings_filter_by'];
        if ( 'related' == $section_content_settings_filter_by && ( $current_post_id && is_single() && PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_POST_TYPE_SLUG == $current_post_type ) ) {
            $is_related_posts = true;
            $post_categories = get_the_category( $current_post_id );
            $section_content_settings_taxonomy = $post_categories[0]->term_id;
        } else if ( 'latest' == $section_content_settings_filter_by ) {
            $query_order = productive_global_get_cpt_query_order_by( 'newest' );
        }
        
    } else if ( !empty($category_name_in_query) && ( !isset( $cpt_section_args['section_content_settings_taxonomy'] ) || '' == $cpt_section_args['section_content_settings_taxonomy'] ) ) {
        $section_content_settings_taxonomy = $category_name_in_query;
    } else if ( isset( $cpt_section_args['section_content_settings_taxonomy'] ) && '' != $cpt_section_args['section_content_settings_taxonomy'] ) {
        $section_content_settings_taxonomy = $cpt_section_args['section_content_settings_taxonomy'];
    }
    
    if ( '' != $section_content_settings_taxonomy ) {
        
        $taxonomy_args = array(
            array(
                'taxonomy' => PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_TAXONOMY_SLUG,
                'field' => 'term_id',
                'terms' => $section_content_settings_taxonomy,
            )
        );
    }
    
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    if ( !empty($taxonomy_args) ) {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_POST_TYPE_SLUG,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
            'tax_query' => $taxonomy_args,
            // 'paged' => $paged,
        );
    } else {
        $args = array(
            'post_type' => PRODUCTIVE_STYLE_PLUGIN_BLOG_ELEMENT_POST_TYPE_SLUG,
            'orderby' => $query_order['orderby'],
            'order' => $query_order['order'],
            'suppress_filters' => 0,
            // 'paged' => $paged,
        );
    }
    
    if( '-1' != $limit ) {
        $args['posts_per_page'] = $limit;
    } else {
        $args['posts_per_page'] = 100;
        // TODO: Consider usecases for posts_per_page option
        //$args['posts_per_page'] = get_option( 'posts_per_page' );
    }
    
    if( $is_related_posts && $current_post_id ) {
        $args['post__not_in'] = array( $current_post_id );
    }
    
    if( $section_content_page_number ) {
        $args['paged'] = $section_content_page_number;
    }
    
    $productive_cpt = new WP_Query( $args );
    
    $section_content_header_is_show_section_header = 1;
    $section_title = __('Blog Elements', 'productive-style');
    $section_title_html_tag = 'h2';
    $section_intro = __('Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-style');
    $section_header_alignment = '';
    $section_content_settings_unique_id = 'section_content_unique_id_'. rand();
    $section_initiator = 'std';
    $section_content_layout_format = 'grid';
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
    if ( isset( $cpt_section_args['section_content_layout_format'] ) ) {
        $section_content_layout_format = $cpt_section_args['section_content_layout_format'];
    }
    if ( isset( $cpt_section_args['section_content_wrap_in_small_screen'] ) ) {
        $section_content_wrap_in_small_screen = $cpt_section_args['section_content_wrap_in_small_screen'];
    }
    $productiveminds_section_display = 'grided';
    if ( 'slider' == $section_content_layout_format ) {
        $productiveminds_section_display = 'flexed';
    }
    ?>
    <div class="productiveminds_section blog-element <?php echo esc_attr( $section_content_wrap_in_small_screen ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
        <div class="productiveminds_section_uno">
    <?php
    
    // Header
    if ( $section_content_header_is_show_section_header ) {
        productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
    }

    if ( $productive_cpt->have_posts() ) {
    
        $section_show_content_title = 1;
        $section_show_content_text = 0;
        $section_content_show_url_button = 1;
        // Styles
        $productive_cpt_is_show_image_or_icon = 'image'; 
        $slider_navigation_arrows_control_position = 'nav-arrows-sides-in';
        $slider_pagination_control_position = 'nav-pagination-out';
        $slider_navigation_arrows_control_shape = 'slider_nav_shape_circle';
        $slider_pagination_control_shape = 'slider_pagination_shape_hybrid';
        $section_style_content_button_hover_animation = '';
        $section_content_widget_specific_content = 0;
        $section_settings_show_post_pagination = 0;
        $slider_swiper_css_class_from_elementor = 'via_std';

        $productive_style_posts_excerpt_word_count = 20;
        $section_show_post_author = 1;
        $section_show_post_author_by_copy = '';
        $section_post_author_position = 'bottom';
        $section_show_post_author_avatar = 1;
        $section_post_author_avatar_size = 40;
        $section_show_post_author_bio = 5;
        $section_show_post_author_url = 1;
        $section_author_horizontal_alignment = 'justify-content-flex-start';
        $section_show_post_comments_count = 1;
        $section_show_post_date = 1;
        $section_show_post_date_copy = '';
        $section_show_post_date_original = 1;
        $section_show_post_date_original_copy = '';
        $section_show_reading_time = 1;
        $section_show_post_category = 1;

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
        if ( isset( $cpt_section_args['productive_style_posts_excerpt_word_count'] ) ) {
            $productive_style_posts_excerpt_word_count = intval( $cpt_section_args['productive_style_posts_excerpt_word_count'] );
        }
        if ( isset( $cpt_section_args['section_show_post_author'] ) ) {
            $section_show_post_author = intval( $cpt_section_args['section_show_post_author'] );
        }
        if ( isset( $cpt_section_args['section_show_post_author_by_copy'] ) ) {
            $section_show_post_author_by_copy = $cpt_section_args['section_show_post_author_by_copy'];
        }
        if ( isset( $cpt_section_args['section_post_author_position'] ) ) {
            $section_post_author_position = $cpt_section_args['section_post_author_position'];
        }
        if ( isset( $cpt_section_args['section_show_post_author_avatar'] ) ) {
            $section_show_post_author_avatar = intval( $cpt_section_args['section_show_post_author_avatar'] );
        }
        if ( isset( $cpt_section_args['section_post_author_avatar_size'] ) ) {
            $section_post_author_avatar_size = $cpt_section_args['section_post_author_avatar_size'];
        }
        if ( isset( $cpt_section_args['section_show_post_author_bio'] ) ) {
            $section_show_post_author_bio = intval( $cpt_section_args['section_show_post_author_bio'] );
        }
        if ( isset( $cpt_section_args['section_show_post_author_url'] ) ) {
            $section_show_post_author_url = intval( $cpt_section_args['section_show_post_author_url'] );
        }
        if ( isset( $cpt_section_args['section_author_horizontal_alignment'] ) ) {
            $section_author_horizontal_alignment = $cpt_section_args['section_author_horizontal_alignment'];
        }
        if ( isset( $cpt_section_args['section_show_post_comments_count'] ) ) {
            $section_show_post_comments_count = intval( $cpt_section_args['section_show_post_comments_count'] );
        }
        if ( isset( $cpt_section_args['section_show_post_date'] ) ) {
            $section_show_post_date = $cpt_section_args['section_show_post_date'];
        }
        if ( isset( $cpt_section_args['section_show_post_date_copy'] ) ) {
            $section_show_post_date_copy = $cpt_section_args['section_show_post_date_copy'];
        }
        if ( isset( $cpt_section_args['section_show_post_date_original'] ) ) {
            $section_show_post_date_original = $cpt_section_args['section_show_post_date_original'];
        }
        if ( isset( $cpt_section_args['section_show_post_date_original_copy'] ) ) {
            $section_show_post_date_original_copy = $cpt_section_args['section_show_post_date_original_copy'];
        }
        if ( isset( $cpt_section_args['section_show_reading_time'] ) ) {
            $section_show_reading_time = $cpt_section_args['section_show_reading_time'];
        }
        if ( isset( $cpt_section_args['section_show_post_category'] ) ) {
            $section_show_post_category = $cpt_section_args['section_show_post_category'];
        }
    
        $misc = array(
            'productive_cpt_is_show_image_or_icon'              => $productive_cpt_is_show_image_or_icon,
            'section_content_show_url_button'                   => $section_content_show_url_button,
            'section_style_content_button_hover_animation'      => $section_style_content_button_hover_animation,
            'productiveminds_section_widget_type'               => $productiveminds_section_widget_type,
            'productiveminds_section_content_type'              => $productiveminds_section_content_type,
            'productiveminds_section_meta_key'                  => $productiveminds_section_meta_key,
            'section_content_widget_specific_content'           => $section_content_widget_specific_content,
            
            'section_show_content_title'                        => $section_show_content_title,
            'section_show_content_text'                         => $section_show_content_text,
            'productive_style_posts_excerpt_word_count'         => $productive_style_posts_excerpt_word_count,
            'section_show_post_author'                          => $section_show_post_author,
            'section_show_post_author_by_copy'                  => $section_show_post_author_by_copy,
            'section_post_author_position'                      => $section_post_author_position,
            'section_show_post_author_avatar'                   => $section_show_post_author_avatar,
            'section_post_author_avatar_size'                   => $section_post_author_avatar_size,
            'section_show_post_author_bio'                      => $section_show_post_author_bio,
            'section_show_post_author_url'                      => $section_show_post_author_url,
            'section_author_horizontal_alignment'               => $section_author_horizontal_alignment,
            'section_show_post_comments_count'                  => $section_show_post_comments_count,
            'section_show_post_date'                            => $section_show_post_date,
            'section_show_post_date_copy'                       => $section_show_post_date_copy,
            'section_show_post_date_original'                   => $section_show_post_date_original,
            'section_show_post_date_original_copy'              => $section_show_post_date_original_copy,
            'section_show_reading_time'                         => $section_show_reading_time,
            'section_show_post_category'                        => $section_show_post_category,
            'slider_navigation_arrows_control_shape'            => $slider_navigation_arrows_control_shape,
            'slider_pagination_control_shape'                   => $slider_pagination_control_shape,
            'section_settings_show_post_pagination'             => $section_settings_show_post_pagination,
        );
        
        productive_style_render_blog_element_grid_v_1( 
            $productive_cpt, 
            $columns_per_row, 
            $misc
        );
        
        productive_global_the_posts_navigation();
        
    } else {
        productive_global_render_no_content_found( 'blog-element', __('No Post found matching the criteria.', 'productive-style'), '' );
    }
    ?>
        </div><!-- productiveminds_section_uno -->
    </div><!-- productiveminds_section -->
    <?php
}

