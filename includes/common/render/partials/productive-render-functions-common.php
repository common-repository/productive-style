<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/ 

/**
 * Display Block Header
 * 
 * @param type $section_title
 * @param type $section_intro
 */
function productive_style_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment = '' ) {
?>
    <?php if ( !empty( $section_title ) || !empty( $section_intro ) ) { ?>
    <div class="productiveminds_section-header-container productiveminds-alignable-container">
        <div class="productiveminds_section-header-container_uno productiveminds-alignable-container_uno <?php echo esc_attr( $section_header_alignment ); ?>">
            <?php if ( !empty( $section_title ) ) { ?>

                <?php 
                if ( productive_global_is_valid_html_tag_for_title( $section_title_html_tag ) ) {
                    echo '<' . esc_attr( $section_title_html_tag ) . ' class="section-title">' . wp_specialchars_decode( $section_title ) . '</' . esc_attr( $section_title_html_tag ) . '>';
                } else { 
                ?>
                    <h2 class="section-title">
                        <?php echo wp_specialchars_decode( $section_title ) ?>
                    </h2>
                <?php } ?>
            <?php } ?>
            <?php if ( !empty( $section_intro ) ) { ?>
                <div class="section-intro">
                    <?php echo wp_specialchars_decode( $section_intro ) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
<?php 
}

/**
 * Display Block Header (data)
 * 
 * @param type $section_title
 * @param type $section_title_html_tag
 * @param type $section_intro
 * @param type $section_header_alignment
 * @return string
 */
function productive_style_render_header_v_1_data( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment = '' ) {
    $section_data = '';
    if ( !empty( $section_title ) || !empty( $section_intro ) ) {
        $section_data = '<div class="productiveminds_section-header-container productiveminds-alignable-container">';
        $section_data .= '<div class="productiveminds_section-header-container_uno productiveminds-alignable-container_uno ' . $section_header_alignment . '">';
        if ( !empty( $section_title ) ) {
            if ( productive_global_is_valid_html_tag_for_title( $section_title_html_tag ) ) {
                $section_data .= '<' . esc_attr( $section_title_html_tag ) . ' class="section-title">' . wp_specialchars_decode( $section_title ) . '</' . esc_attr( $section_title_html_tag ) . '>';
            } else {
                $section_data .= '<h2 class="section-title">' . wp_specialchars_decode( $section_title ) . '</h2>';
            }
        }
        if ( !empty( $section_intro ) ) {
            $section_data .= '<div class="section-intro">' . wp_specialchars_decode( $section_intro ) . '</div>';
        }
        $section_data .= '</div>';
        $section_data .= '</div>';
    }
    return $section_data;
}


/**
 * Display Block Header
 * 
 * @param type $misc
 * @param type $productive_cpt_id
 */
function productive_style_render_content_media_v_1( $misc = array(), $productive_cpt_id = 0 ) {
    
    $productive_cpt_is_show_image_or_icon               = $misc['productive_cpt_is_show_image_or_icon'];
    
    $is_search_result_page = false;
    if( isset( $misc['is_search_result_page'] )) {
        $is_search_result_page                      = $misc['is_search_result_page'];
    }
    
    $section_show_search_result_post_type = false;
    if( isset( $misc['section_show_search_result_post_type'] )) {
        $section_show_search_result_post_type       = $misc['section_show_search_result_post_type'];
    }
    
    $section_content_media_item_shape = '';
    if( isset( $misc['section_content_media_item_shape'] )) {
        $section_content_media_item_shape               = $misc['section_content_media_item_shape'];
    }
    
    $productive_cpt_icon_code = '';
    if( isset( $misc['productive_cpt_icon_code'] ) ) {
        $productive_cpt_icon_code = $misc['productive_cpt_icon_code'];
    }
    
    $section_video_thumbnail_id = '';
    $productiveminds_section_video_item_thumbnail = '';
    $productiveminds_section_video_render_inline_container = 0;
    if( isset( $misc['productive_cpt_video'] ) ) {
        if( $misc['productive_cpt_video'] ) {
            $section_video_thumbnail_id = $misc['productive_cpt_video'];
            $productiveminds_section_video_item_thumbnail = 'productiveminds_section_video_item_thumbnail';
            $productiveminds_section_video_render_inline_container = 1;
        }
    }
?>
    <?php if ( ( !empty( $productive_cpt_icon_code ) && 'icon' == $productive_cpt_is_show_image_or_icon ) || strpos( $productive_cpt_is_show_image_or_icon, 'image' ) !== false ) { ?>
        <div class="productiveminds_section-single-item-media shapeable-image-box <?php echo esc_attr_e($section_content_media_item_shape); ?> productiveminds-alignable-container width-autoed <?php echo esc_attr( $productiveminds_section_video_item_thumbnail ); ?>" data-video-id="<?php echo esc_attr( $section_video_thumbnail_id ); ?>">
            <?php
            if ( strpos( $productive_cpt_is_show_image_or_icon, 'image' ) !== false ) {
                _productive_style_render_content_media( $misc, $productive_cpt_id );
            } else if ( !empty( $productive_cpt_icon_code ) ) { ?>
                <i class="single-item-icon fa <?php echo esc_attr($productive_cpt_icon_code); ?>"></i>
            <?php 
            } ?>

            <?php if ( $productiveminds_section_video_render_inline_container ) { ?>
                <div class="productiveminds_section-single-item-media-video"></div>
            <?php } ?>
            
            <?php if ( $is_search_result_page && $section_show_search_result_post_type ) { ?>
                <div class="search-result-page-post-type">
                    <?php echo _productive_style_get_search_result_page_post_type(); ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php 
}


function _productive_style_render_content_media( $misc, $productive_cpt_id = 0 ) {
    
    $productive_cpt_is_link_image = 0;
    if( isset( $misc['productive_cpt_is_link_image'] )) {
        $productive_cpt_is_link_image                           = $misc['productive_cpt_is_link_image'];
    }
    
    $productiveminds_section_widget_type = '';
    if( isset( $misc['productiveminds_section_widget_type'] )) {
        $productiveminds_section_widget_type                     = $misc['productiveminds_section_widget_type'];
    }
    
    $get_post_type = get_post_type();
    $product_title = get_the_title();
    if( $productive_cpt_is_link_image || 'post' == $get_post_type || $productiveminds_section_widget_type == PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_SEARCH_RESULT ) {
        
        $productive_cpt_url = '';
        if( isset( $misc['productive_cpt_url'] )) {
            $productive_cpt_url                     = $misc['productive_cpt_url'];
        }

        $url = '#';
        if( 'post' == $get_post_type || $productiveminds_section_widget_type == PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_SEARCH_RESULT ) {
            $url = get_permalink( $productive_cpt_id );
        } else if( !empty($productive_cpt_url) ) {
            $url = $productive_cpt_url;
        }

        $section_content_show_url_button_target = '_parent'; 
        if( 2 == $productive_cpt_is_link_image ) {
            $section_content_show_url_button_target = '_blank';
        }
        
        if ( has_post_thumbnail() ) {
            $attr = array (
                'alt' => $product_title,
            );
        ?>
            <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php the_post_thumbnail( 'full', $attr ); ?></a>
        <?php } else { ?>
            <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php do_action( 'display_productive_global_post_thumbnail', productive_style_get_image_placeholder_args($product_title) ); ?></a>
        <?php
        }
    } else {
        do_action( 'display_productive_global_post_thumbnail', productive_style_get_image_placeholder_args($product_title) );
    }
}
function productive_style_get_image_placeholder_args($product_title) {
    return array(
        'post_id'           => get_the_ID(),
        'default_image_url' => PRODUCTIVE_STYLE_PLACEHOLDER_IMAGE_POSTS,
        'alt'               => $product_title,
        'type'              => 'full',
    );
}

function _productive_style_get_search_result_page_post_type() {
    if( 'post' == get_post_type() ) {
        return __('blog', 'productive-style');
    }
    return get_post_type();
}


/**
 * 
 * @param type $misc
 * @param type $productive_cpt_id
 */
function productive_style_render_content_text_v_1( $misc, $productive_cpt_id = 0 ) {
    $section_content_show_url_button                    = intval($misc['section_content_show_url_button']);
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    $section_show_content_title                         = intval($misc['section_show_content_title']);
    $section_show_content_text                          = intval($misc['section_show_content_text']);
    
    $productive_cpt_url = '';
    if( isset( $misc['productive_cpt_url'] )) {
        $productive_cpt_url                         = $misc['productive_cpt_url'];
    }
    $productive_cpt_url_text = '';
    if( isset( $misc['productive_cpt_url_text'] )) {
        $productive_cpt_url_text                    = $misc['productive_cpt_url_text'];
    }
    $alignable_container_layout_text                = '';
    if( isset( $misc['alignable_container_layout_text'] )) {
        $alignable_container_layout_text            = $misc['alignable_container_layout_text'];
    }
    $content_type = 'content';
    if( isset( $misc['content_type'] )) {
        $content_type                               = $misc['content_type'];
    }
    $excerpt_word_count = 20;
    if( isset( $misc['excerpt_word_count'] )) {
        $excerpt_word_count                         = $misc['excerpt_word_count'];
    }
    
    $section_content_show_url_button_target = '_parent'; 
    if( 2 == $section_content_show_url_button ) {
        $section_content_show_url_button_target = '_blank';
    }
?>
    <?php if( $section_show_content_title || $section_show_content_text || $section_content_show_url_button ) { ?>
    <div class="productiveminds_section-single-item-text productiveminds-alignable-container align-items-flex-start align-content-flex-start <?php echo esc_attr( $alignable_container_layout_text ); ?> row-gap-5px">
        <?php if( $section_show_content_title ) { ?>
            <?php _productive_style_render_the_title( $section_show_content_title, $productive_cpt_id, $productive_cpt_url ); ?>
        <?php } ?>
        <?php
            if( 'excerpt' == $content_type ) {
                _productive_style_render_the_excerpt( get_the_excerpt(), $section_show_content_text, $excerpt_word_count );
            } else {
                _productive_style_render_the_content( get_the_content(), $section_show_content_text );
            }
        ?>
        <?php if ( !empty( $productive_cpt_url ) && $section_content_show_url_button ) { ?>
            <div class="single-item-button-container">
                <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" class="single-item-button <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                   aria-label="<?php echo __('Read more about ', 'productive-style') . the_title(); ?>" 
                   href="<?php echo esc_url($productive_cpt_url); ?>">
                        <?php echo esc_html($productive_cpt_url_text); ?>
                        <span class="screen-reader-text"><?php echo __('Read more about ', 'productive-style') . the_title(); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
<?php 
}

function _productive_style_render_the_title( $section_show_content_title, $productive_cpt_id, $productive_cpt_url = '' ) {
    ?>
    <div class="single-item-title">
        <?php
        $section_content_show_url_button_target = '_parent';
        if( 3 == $section_show_content_title ) {
            $section_content_show_url_button_target = '_blank';
        }
        $get_post_type = get_post_type();
        if( 1 < $section_show_content_title || 'post' == $get_post_type ) {
            $url = '#';
            if( 'post' == $get_post_type ) {
                $url = get_permalink( $productive_cpt_id );
            } else if( !empty($productive_cpt_url) ) {
                $url = $productive_cpt_url;
            }
        ?>
        <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php the_title(); ?></a>
        <?php } else { ?>
            <?php the_title(); ?>
        <?php } ?>
    </div>
    <?php
}

function _productive_style_render_the_excerpt( $the_excerpt, $section_show_content_text = 1, $excerpt_word_count = 20 ) {
    if( $section_show_content_text ) { 
    ?>
        <div class="single-item-desc">
            <?php echo wp_specialchars_decode( wp_trim_words( $the_excerpt, $excerpt_word_count ) ); ?>
        </div>
    <?php 
    }
}

function _productive_style_render_the_content( $the_content, $section_show_content_text = 1 ) {
    if( $section_show_content_text ) { 
    ?>
        <div class="single-item-desc">
            <?php echo wp_specialchars_decode($the_content); ?>
        </div>
    <?php 
    }
}




/**
 * Start:: Blog Element
 */

/**
 * Grid
 * 
 * THEMED
 * 
 * @param type $productive_cpt
 * @param type $columns_per_row
 * @param type $misc
 */
function productive_style_render_blog_element_grid_v_1( $productive_cpt, $columns_per_row, $misc ) {
    ?>
    <div class="productiveminds_section-container grid columns-<?php echo esc_attr( $columns_per_row ); ?> productiveminds-standard-content-container">
        <?php
        while( $productive_cpt->have_posts() ) {
            $productive_cpt->the_post();
        ?>
        <div class="productiveminds_section-container-column">
            <div class="productiveminds_section-container-column-content">
                <div class="productiveminds_section-container-column-content-body no-box">
                    <div class="productiveminds_section-single-item productiveminds-alignable-container row-gap-10px">
                        <?php
                            productive_style_render_content_media_v_1( $misc );
                            productive_style_render_content_text_blog_element_v_1( $productive_cpt, $misc );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php productive_style_render_post_pagination( $productive_cpt, $misc ); ?>
     <?php wp_reset_postdata(); ?>
    <?php 
}

/**
 * Display main content
 * 
 * @param type $productive_cpt
 * @param int $misc
 */
function productive_style_render_content_text_blog_element_v_1( $productive_cpt, $misc ) {
    
    $section_content_show_url_button                        = $misc['section_content_show_url_button'];
    $section_style_content_button_hover_animation           = $misc['section_style_content_button_hover_animation'];
    $section_show_content_text                              = $misc['section_show_content_text'];
    $productive_style_posts_excerpt_word_count              = $misc['productive_style_posts_excerpt_word_count'];
    $section_show_post_author                               = $misc['section_show_post_author'];
    $section_show_post_comments_count                       = $misc['section_show_post_comments_count'];
    $section_show_post_date                                 = $misc['section_show_post_date'];
    $section_show_post_date_copy                            = $misc['section_show_post_date_copy'];
    $section_show_post_date_original                        = $misc['section_show_post_date_original'];
    $section_show_post_date_original_copy                   = $misc['section_show_post_date_original_copy'];
    $section_show_reading_time                              = $misc['section_show_reading_time'];
    $section_show_post_category                             = $misc['section_show_post_category']; 
    $section_show_content_title                             = $misc['section_show_content_title']; 
    
    $section_content_show_url_button_target = '_parent'; 
    if( 2 == $section_content_show_url_button ) {
        $section_content_show_url_button_target = '_blank';
    }
    
    $post_id = get_the_ID();
?>
    <?php if( $section_show_post_category || $section_show_reading_time || $section_show_content_title || $section_show_content_text || 
            $section_show_post_comments_count || $section_show_post_date_original || $section_show_post_date || $section_content_show_url_button ) { ?>
    <div class="productiveminds_section-single-item-text productiveminds-alignable-container align-items-flex-start align-content-flex-start row-gap-10px productive-blog-element">
        
        <?php if( $section_show_post_category || $section_show_reading_time ) { ?>
            <div class="productive-blog-element-cat-and-read-time productiveminds-alignable-container flexed-no-wrap justify-content-space-between row-gap-5px column-gap-30px">
                <?php if( $section_show_post_category ) { ?>
                    <div class="section_show_post_category righted">
                        <?php the_category( ',  ' ); ?>
                    </div>
                <?php } ?>
                <?php if( $section_show_reading_time ) { ?>
                    <div class="section_show_reading_time">
                        <?php echo productive_style_get_blog_read_time( get_the_content() ); ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        
        <?php if( $section_show_content_title ) { ?>
            <div class="single-item-title">
                <a aria-label="<?php the_title(); ?>" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
            </div>
        <?php } ?>
        
        <?php 
        $post_format = get_post_format();
        if( $section_show_content_text && 'status' != $post_format && 'aside' != $post_format ) { ?>
            <div class="single-item-desc">
                <?php echo esc_html( wp_trim_words( get_the_excerpt(), $productive_style_posts_excerpt_word_count ) ); ?>
            </div>
        <?php } ?>
        
        <?php
            $current_location = $section_show_post_author;
            productive_style_render_post_author_via_avatar( $current_location, $misc );
        ?>
        
        <?php if( $section_show_post_date_original || $section_show_post_date || $section_show_post_comments_count ) { ?>
            <div class="productive-blog-element-date productiveminds-alignable-container flexed justify-content-space-between gap-10px">
                <?php if( $section_show_post_date && $section_show_post_date != 4 ) { ?>
                    <div class="section_show_post_date">
                        <?php if( !empty( $section_show_post_date_copy ) ) { ?>
                            <span class="section_show_post_date_copy"><?php echo esc_html( $section_show_post_date_copy ); ?></span>
                        <?php } ?>
                        <?php echo get_the_modified_date(); ?>
                    </div>
                <?php } else if( $section_show_post_date_original && $section_show_post_date_original != 4 ) { ?>
                    <div class="section_show_post_date_original">
                        <?php if( !empty( $section_show_post_date_original_copy ) ) { ?>
                            <span class="section_show_post_date_original_copy"><?php echo esc_html( $section_show_post_date_original_copy ); ?></span>
                        <?php } ?>
                        <?php echo get_the_date(); ?>
                    </div>
                <?php } ?>
                
                <?php if( $section_show_post_comments_count ) { ?>
                    <div class="section_show_post_comments_count righted">
                        <?php
                            $get_comment_count = get_comment_count( $post_id );
                            $approved_comments_count = $get_comment_count['approved'];
                            echo $approved_comments_count . ' comments';
                        ?>
                    </div>
                <?php } ?>

            </div>
        <?php } ?>
        
        <?php if( $section_content_show_url_button ) { ?>
            <div class="single-item-button-container productive-blog-element-read-more-btn">
                <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" class="single-item-button <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                    aria-label="<?php echo __( 'Read more', 'productive-style' ); ?>" 
                    href="<?php echo esc_url( get_permalink() ); ?>">
                         <?php echo __( 'Read more', 'productive-style' ); ?>
                 </a>
            </div>
        <?php } ?>
        
    </div>
    <?php } ?>
<?php 
}

/**
 * End:: Blog Element
 */





/**
 * Grid
 * 
 * @param type $productive_cpt
 * @param type $columns_per_row
 * @param type $misc
 */
function productive_style_render_grid_std( $productive_cpt, $columns_per_row, $misc ) {
    $productiveminds_section_meta_key               = $misc['productiveminds_section_meta_key'];
    $alignable_container_layout_box                 = '';
    if( isset( $misc['alignable_container_layout_box'] )) {
        $alignable_container_layout_box             = $misc['alignable_container_layout_box'];
    }
    $to_num_of_cols = 'to_two';
    if( isset( $misc['to_num_of_cols'] )) {
        $to_num_of_cols             = $misc['to_num_of_cols'];
    }
    ?>
    <div class="productiveminds_section-container <?php echo esc_attr( $to_num_of_cols ); ?> grid columns-<?php echo esc_attr( $columns_per_row ); ?> productiveminds-standard-content-container">
        <?php
        while( $productive_cpt->have_posts() ) {
            $productive_cpt->the_post();
            $productive_cpt_id = get_the_ID();
            $productive_style_render_content_get_loop_data_cpt_obj = productive_style_render_content_get_loop_data_cpt( $productive_cpt_id, $productiveminds_section_meta_key );
            $misc['productive_cpt_icon_code']       = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_icon_code'];
            $misc['productive_cpt_url']             = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url'];
            $misc['productive_cpt_url_text']        = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_text'];
            $misc['productive_cpt_video']           = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_video'];
            $misc['productive_cpt_video_platform']  = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_video_platform'];
        ?>
        <div class="productiveminds_section-container-column">
            <div class="productiveminds_section-container-column-content">
                <div class="productiveminds_section-container-column-content-body no-box">
                    <div class="productiveminds_section-single-item productiveminds-alignable-container <?php echo esc_attr( $alignable_container_layout_box ); ?>">
                        <?php
                            productive_style_render_content_media_v_1( $misc, $productive_cpt_id );
                            productive_style_render_content_text_v_1( $misc, $productive_cpt_id );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php productive_style_render_post_pagination( $productive_cpt, $misc ); ?>
    <?php wp_reset_postdata(); ?>
    <?php 
}


function productive_style_render_post_author_via_avatar( $current_location, $misc ) {
    
    $section_show_post_author                   = $misc['section_show_post_author'];
    $section_show_post_author_by_copy           = $misc['section_show_post_author_by_copy'];
    $section_show_post_author_avatar            = $misc['section_show_post_author_avatar'];
    $section_post_author_avatar_size            = $misc['section_post_author_avatar_size'];
    $section_show_post_author_bio               = $misc['section_show_post_author_bio'];
    $section_show_post_author_url               = $misc['section_show_post_author_url'];
    $section_author_horizontal_alignment       = $misc['section_author_horizontal_alignment'];
    
    $author_profile_type = '';
    if( isset($misc['author_profile_type']) ) {
        $author_profile_type = $misc['author_profile_type'];
    }
    
    /* Set width value to ensure horizontal alignment is effective */
    $width_autoed = '';
    if( 2 == $section_show_post_author_bio || 5 == $section_show_post_author_bio ) {
        $width_autoed = 'width-autoed';
    }
    
    /* Set value to disable horizontal alignment */
    if( 1 == $section_show_post_author_bio ) {
        $section_author_horizontal_alignment = 'justify-content-flex-start';
    }
    
    $author_id = get_the_author_meta( 'ID' );
    $author_url = get_the_author_meta( 'user_url' );
    
    if( $current_location && $current_location == $section_show_post_author ) {
?>
    <div class="productive-author-container productiveminds-alignable-container  <?php echo esc_attr($author_profile_type); ?>">
        <div class="productive-author-container-box productiveminds-alignable-container gap-10px">            
            <div class="productive-author-container-all productiveminds-alignable-container flexed-no-wrap <?php echo esc_attr($section_author_horizontal_alignment); ?> row-gap-5px column-gap-10px">
                <?php
                if( $section_show_post_author_avatar && get_option( 'show_avatars' ) ) {
                ?>
                    <div class="productive-author-container-media">
                        <?php echo get_avatar( $author_id, $section_post_author_avatar_size, null ); ?>
                    </div>
                <?php } ?>
                <div class="productive-author-container-details productiveminds-alignable-container <?php echo esc_attr($width_autoed); ?> gap-10px">
                    <div class="productiveminds-alignable-container gap-zero">
                        <div class="productive-author-container-name">
                            <?php if( !empty( $section_show_post_author_by_copy ) ) { ?>
                            <span class=""><?php echo esc_html( $section_show_post_author_by_copy ); ?></span>
                            <?php } ?>
                            <a aria-label="<?php echo get_the_author(); ?>" 
                                href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" >
                                 <span><?php echo get_the_author(); ?></span>
                             </a>
                        </div>
                        <?php
                        if( 1 == $section_show_post_author_url && !empty( $author_url ) ) { ?>
                            <div class="productive-author-container-url">
                                <a target="_blank" aria-label="<?php echo get_the_author(); ?>" href="<?php echo esc_url( $author_url ); ?>">
                                     <?php echo productive_style_get_website_domain_name_only( $author_url ); ?>
                                 </a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                        if ( 1 == $section_show_post_author_bio ) {
                            productive_style_render_post_author_bio( $section_show_post_author_url, $author_url, $section_author_horizontal_alignment );
                        } 
                    ?>
                </div>
            </div>
            <?php 
                if ( 2 == $section_show_post_author_bio ) {
                    productive_style_render_post_author_bio( $section_show_post_author_url, $author_url, $section_author_horizontal_alignment );
                } 
            ?>
        </div>
    </div>
<?php 
    }
}

function productive_style_render_post_author_bio( $section_show_post_author_url = '0', $author_url = '', $section_author_horizontal_alignment = '' ) {
    ?>
    <div class="productive-author-container-bio <?php echo esc_attr($section_author_horizontal_alignment); ?>">
        <?php the_author_meta( 'description' ); ?>
    </div>
    <?php 
    if( 2 == $section_show_post_author_url && !empty( $author_url ) ) { ?>
        <div class="productive-author-container-url <?php echo esc_attr($section_author_horizontal_alignment); ?>">
            <a aria-label="<?php echo get_the_author(); ?>" href="<?php echo esc_url( $author_url ); ?>">
                 <?php echo productive_style_get_website_domain_name_only( $author_url ); ?>
             </a>
        </div>
    <?php } ?>
    <?php
}


function productive_style_render_content_get_loop_data_cpt( $productive_cpt_id, $productiveminds_section_meta_key ) {
    $productive_cpt_data = array();
    $productive_cpt_data['productive_cpt_icon_code'] = '';
    $productive_cpt_data['productive_cpt_video'] = '';
    $productive_cpt_data['productive_cpt_video_platform'] = '';
    $productive_cpt_data['productive_cpt_url'] = '';
    $productive_cpt_data['productive_cpt_url_text'] = '';
    
    $productive_cpt_meta_object = get_post_meta( $productive_cpt_id, $productiveminds_section_meta_key, true );
    if ( !empty( $productive_cpt_meta_object['cpt_icon'] ) ) {
        $productive_cpt_data['productive_cpt_icon_code'] = sanitize_text_field( $productive_cpt_meta_object['cpt_icon'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_video'] ) ) {
        $productive_cpt_data['productive_cpt_video'] = sanitize_text_field( $productive_cpt_meta_object['cpt_video'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_video_platform'] ) ) {
        $productive_cpt_data['productive_cpt_video_platform'] = sanitize_text_field( $productive_cpt_meta_object['cpt_video_platform'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url'] ) ) {
        $productive_cpt_data['productive_cpt_url'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_text'] ) ) {
        $productive_cpt_data['productive_cpt_url_text'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_text'] );
    }
    
    return $productive_cpt_data;
}

function productive_style_render_slider_get_loop_data_cpt( $productive_cpt_id, $productiveminds_section_meta_key ) {
    $productive_cpt_data = array();
    $productive_cpt_data['productive_cpt_auxiliary_content'] = '';
    $productive_cpt_data['productive_cpt_url_1'] = '';
    $productive_cpt_data['productive_cpt_url_1_text'] = '';
    $productive_cpt_data['productive_cpt_url_2'] = '';
    $productive_cpt_data['productive_cpt_url_2_text'] = '';
    $productive_cpt_data['productive_cpt_content_alignment_v'] = '';
    $productive_cpt_data['productive_cpt_content_alignment_h'] = '';
    $productive_cpt_data['productive_cpt_content_color'] = '';
    
    $productive_cpt_meta_object = get_post_meta( $productive_cpt_id, $productiveminds_section_meta_key, true );
    if ( !empty( $productive_cpt_meta_object['cpt_auxiliary_content'] ) ) {
        $productive_cpt_data['productive_cpt_auxiliary_content'] = sanitize_text_field( $productive_cpt_meta_object['cpt_auxiliary_content'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_1'] ) ) {
        $productive_cpt_data['productive_cpt_url_1'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_1'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_1_text'] ) ) {
        $productive_cpt_data['productive_cpt_url_1_text'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_1_text'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_2'] ) ) {
        $productive_cpt_data['productive_cpt_url_2'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_2'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_2_text'] ) ) {
        $productive_cpt_data['productive_cpt_url_2_text'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_2_text'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_content_alignment_v'] ) ) {
        $productive_cpt_data['productive_cpt_content_alignment_v'] = sanitize_text_field( $productive_cpt_meta_object['cpt_content_alignment_v'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_content_alignment_h'] ) ) {
        $productive_cpt_data['productive_cpt_content_alignment_h'] = sanitize_text_field( $productive_cpt_meta_object['cpt_content_alignment_h'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_content_color'] ) ) {
        $productive_cpt_data['productive_cpt_content_color'] = sanitize_text_field( $productive_cpt_meta_object['cpt_content_color'] );
    }
    
    return $productive_cpt_data;
}

function productive_style_render_post_pagination( $productive_cpt, $misc ) {
    $section_settings_show_post_pagination = 0;
    if( isset( $misc['section_settings_show_post_pagination'] )) {
        $section_settings_show_post_pagination  = $misc['section_settings_show_post_pagination'];
    }
    if( $section_settings_show_post_pagination ) {
        productive_global_paginate_links( $productive_cpt ); 
    }
}



function productive_style_render_banner_slider_v_1( $productive_cpt, $slider_navigation_arrows_control_position, $slider_pagination_control_position, $slider_swiper_main_css_class, $slider_swiper_css_class_from_elementor, $misc = array() ) {
    
    $productive_global_slider_nav_control_shape         = productive_global_slider_nav_control_shape();
    if( isset( $misc['slider_navigation_arrows_control_shape'] )) {
        $productive_global_slider_nav_control_shape                 = $misc['slider_navigation_arrows_control_shape'];
    }
    
    $productive_global_slider_pagination_control_shape  = productive_global_slider_pagination_control_shape();
    if( isset( $misc['slider_pagination_control_shape'] )) {
        $productive_global_slider_pagination_control_shape          = $misc['slider_pagination_control_shape'];
    }
    
    $section_style_button_1_button_hover_animation  = '';
    if( isset( $misc['section_style_button_1_button_hover_animation'] )) {
        $section_style_button_1_button_hover_animation          = $misc['section_style_button_1_button_hover_animation'];
    }
    
    $section_style_button_2_button_hover_animation  = '';
    if( isset( $misc['section_style_button_2_button_hover_animation'] )) {
        $section_style_button_2_button_hover_animation          = $misc['section_style_button_2_button_hover_animation'];
    }
    
    $slider_content_entrance_easing         = $misc['slider_content_entrance_easing'];
    $slider_content_start                   = $misc['slider_content_start'];
    $slider_slide_content_width             = $misc['slider_slide_content_width'];
    $slider_banner_height                   = $misc['slider_banner_height'];
    $slider_slide_overlay_color             = $misc['slider_slide_overlay_color'];
    $slider_slide_overlay_opacity           = $misc['slider_slide_overlay_opacity'];
    
    $content_auxiliary_location         = $misc['content_auxiliary_location'];
    
    ?>
    <div class="productiveminds-slider-content-container">
        <div class="swiper_container <?php echo esc_attr( $slider_navigation_arrows_control_position ); ?> <?php echo esc_attr( $slider_pagination_control_position ); ?> <?php echo esc_attr( $productive_global_slider_pagination_control_shape ); ?> <?php echo esc_attr( $productive_global_slider_nav_control_shape ); ?>">
            <div class="swiper <?php echo esc_attr( $slider_swiper_main_css_class ); ?> <?php echo esc_attr( $slider_swiper_css_class_from_elementor ); ?>">
                <div class="swiper-wrapper">
                    <?php
                    while( $productive_cpt->have_posts() ) {
                        
                        $productive_cpt->the_post();
                        $productive_cpt_id = get_the_ID();
                        
                        $slider_content_thumbnail_url = get_the_post_thumbnail_url();
                        $productive_style_render_content_get_loop_data_cpt_obj = productive_style_render_slider_get_loop_data_cpt( $productive_cpt_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY );
                        $slider_content_alignment_v = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_alignment_v'];
                        $slider_content_alignment_h = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_alignment_h'];
                        $slider_content_color = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_color'];
                        
                        $copy_and_css = array(
                            'css_class' => $content_auxiliary_location,
                            'copy' => $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_auxiliary_content'],
                        );
                    ?>
                        <div class="swiper-slide">
                            <div class="productiveminds_section-single-item productiveminds-alignable-container">
                                <?php do_action( 'display_content_wrapper_full_full_top', '' ); ?>
                                <div class="productiveminds_banner_container main_banner container_with_bg_image banner-slider productiveminds-alignable-container justify-items-normal justify-content-space-evenly <?php echo esc_attr($slider_content_alignment_v); ?>" style="background-image: url(<?php echo esc_url( $slider_content_thumbnail_url ); ?>); height: <?php echo esc_attr($slider_banner_height); ?>px">
                                    <div style="background: <?php echo esc_attr($slider_slide_overlay_color); ?>; opacity: <?php echo esc_attr($slider_slide_overlay_opacity); ?>" class="productiveminds_banner_container_content_bg_overlay"></div>
                                    <div class="productiveminds_banner_container_content_bg_overlay_content productiveminds-alignable-container_uno-wrapper productiveminds-alignable-container <?php echo esc_attr($slider_content_alignment_v); ?> <?php echo esc_attr($slider_content_alignment_h); ?>">
                                        <div class="productiveminds-alignable-container_uno width-autoed" data-enter-exit-transition-home-slider="<?php echo esc_attr($slider_content_start); ?>">
                                            <div class="productiveminds_banner_container_content productiveminds-alignable-container row-gap-10px <?php echo esc_attr($slider_content_color); ?> home-slider-content" style="max-width: <?php echo esc_attr($slider_slide_content_width); ?>px; transition: all 0.4s var(<?php echo esc_attr($slider_content_entrance_easing); ?>)">
                                                
                                                <?php 
                                                    if( 'content_auxiliary_top' == $content_auxiliary_location ) {
                                                        do_action( 'display_productive_global_hero_content_auxiliary', $copy_and_css );
                                                    }
                                                ?>
                                                
                                                <?php do_action( 'display_productive_global_hero_content_title', get_the_title() ); ?>
                                                <?php do_action( 'display_productive_global_hero_content_main', get_the_content() ); ?>
                                                
                                                <?php 
                                                    if( 'content_auxiliary_bottom' == $content_auxiliary_location ) {
                                                        do_action( 'display_productive_global_hero_content_auxiliary', $copy_and_css );
                                                    }
                                                ?>
                                                
                                                <div class="cta spacious align-content-center">
                                                    <?php 
                                                        $cta_1_css_class = 'cta1 ' . $section_style_button_1_button_hover_animation;
                                                        productive_global_hero_content_cta( $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_1'], $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_1_text'], $cta_1_css_class ); 
                                                    ?>
                                                    <?php
                                                        $cta_2_css_class = 'cta2 ' . $section_style_button_2_button_hover_animation;
                                                        productive_global_hero_content_cta( $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_2'], $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_2_text'], $cta_2_css_class ); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>             
                                    </div>
                                </div>
                                <?php do_action('display_content_wrapper_full_full_bottom'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <?php
                    // Arrow nav controls
                    $productiveminds_slider_controls = 'all';
                    if ( 'all' == $productiveminds_slider_controls || 
                        'arrows' == $productiveminds_slider_controls || 
                        'dots_and_arrows' == $productiveminds_slider_controls || 
                        'touch_swipe_and_arrows' == $productiveminds_slider_controls ) {
               ?>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
               <?php } ?>
                <?php
                    // Pagination nav controls
                    if ( 'all' == $productiveminds_slider_controls || 
                        'dots' == $productiveminds_slider_controls || 
                        'dots_and_arrows' == $productiveminds_slider_controls || 
                        'touch_swipe_and_dots' == $productiveminds_slider_controls ) {
               ?>
                    <div class="swiper-pagination"></div>
               <?php } ?>
            </div>
        </div>
    </div>
    <?php 
}



function productive_style_render_banner_slider_v_2( $productive_cpt, $slider_navigation_arrows_control_position, $slider_pagination_control_position, $slider_swiper_main_css_class, $slider_swiper_css_class_from_elementor, $misc = array() ) {
    
    $productive_global_slider_nav_control_shape         = productive_global_slider_nav_control_shape();
    if( isset( $misc['slider_navigation_arrows_control_shape'] )) {
        $productive_global_slider_nav_control_shape                 = $misc['slider_navigation_arrows_control_shape'];
    }
    
    $productive_global_slider_pagination_control_shape  = productive_global_slider_pagination_control_shape();
    if( isset( $misc['slider_pagination_control_shape'] )) {
        $productive_global_slider_pagination_control_shape          = $misc['slider_pagination_control_shape'];
    }
    
    $section_style_button_1_button_hover_animation  = '';
    if( isset( $misc['section_style_button_1_button_hover_animation'] )) {
        $section_style_button_1_button_hover_animation          = $misc['section_style_button_1_button_hover_animation'];
    }
    
    $section_style_button_2_button_hover_animation  = '';
    if( isset( $misc['section_style_button_2_button_hover_animation'] )) {
        $section_style_button_2_button_hover_animation          = $misc['section_style_button_2_button_hover_animation'];
    }
    
    $slider_slide_image_width  = 1000;
    if( isset( $misc['slider_slide_image_width'] )) {
        $slider_slide_image_width          = $misc['slider_slide_image_width'];
    }
    
    $slider_slide_image_min_width  = 50;
    if( isset( $misc['slider_slide_image_min_width'] )) {
        $slider_slide_image_min_width          = $misc['slider_slide_image_min_width'];
    }
    
    $slider_slide_content_width_indentation  = 100;
    if( isset( $misc['slider_slide_content_width_indentation'] )) {
        $slider_slide_content_width_indentation          = $misc['slider_slide_content_width_indentation'];
    }
    
    $slider_content_entrance_easing         = $misc['slider_content_entrance_easing'];
    $slider_content_start                   = $misc['slider_content_start'];
    $slider_slide_content_width             = $misc['slider_slide_content_width'];
    $slider_banner_height                   = $misc['slider_banner_height'];
    $slider_slide_overlay_color             = $misc['slider_slide_overlay_color'];
    $slider_slide_overlay_opacity           = $misc['slider_slide_overlay_opacity'];
    
    $content_auxiliary_location         = $misc['content_auxiliary_location'];
    
    ?>
    <div class="productiveminds-slider-content-container">
        <div class="swiper_container <?php echo esc_attr( $slider_navigation_arrows_control_position ); ?> <?php echo esc_attr( $slider_pagination_control_position ); ?> <?php echo esc_attr( $productive_global_slider_pagination_control_shape ); ?> <?php echo esc_attr( $productive_global_slider_nav_control_shape ); ?>">
            <div class="swiper <?php echo esc_attr( $slider_swiper_main_css_class ); ?> <?php echo esc_attr( $slider_swiper_css_class_from_elementor ); ?>">
                <div class="swiper-wrapper">
                    <?php
                    while( $productive_cpt->have_posts() ) {
                        
                        $productive_cpt->the_post();
                        $productive_cpt_id = get_the_ID();
                        
                        $slider_content_thumbnail_url = get_the_post_thumbnail_url();
                        $productive_style_render_content_get_loop_data_cpt_obj = productive_style_render_slider_get_loop_data_cpt( $productive_cpt_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY );
                        $slider_content_alignment_v = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_alignment_v'];
                        $slider_content_alignment_h = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_alignment_h'];
                        $slider_content_color = $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_content_color'];
                        
                        $copy_and_css = array(
                            'css_class' => $content_auxiliary_location,
                            'copy' => $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_auxiliary_content'],
                        );
                    ?>
                        <div class="swiper-slide">
                            <div class="productiveminds_section-single-item productiveminds-alignable-container">
                                <?php do_action( 'display_content_wrapper_full_full_top', '' ); ?>
                                <div>
                                    
                                    
                                    
                                    <div class="productiveminds_banner_container slider-design-02 productiveminds-alignable-container flexed-no-wrap align-items-center align-content-center justify-items-flex-start justify-content-flex-start">
                                        
                                        <div style="min-width: <?php echo esc_attr($slider_slide_image_min_width); ?>%; max-width: <?php echo esc_attr($slider_slide_image_width); ?>px; background-image: url(<?php echo esc_url( $slider_content_thumbnail_url ); ?>); height: <?php echo esc_attr($slider_banner_height); ?>px" class="productiveminds_banner_container main_banner container_with_bg_image banner-slider productiveminds-alignable-container justify-items-normal justify-content-space-evenly">
                                            <div style="background: <?php echo esc_attr($slider_slide_overlay_color); ?>; opacity: <?php echo esc_attr($slider_slide_overlay_opacity); ?>" class="productiveminds_banner_container_content_bg_overlay"></div>
                                            <div class="productiveminds_banner_container_content_bg_overlay_content productiveminds-alignable-container_uno-wrapper productiveminds-alignable-container">
                                                  &nbsp;       
                                            </div>
                                        </div>
                                        
                                        <div class="productiveminds_banner_container_content_wrapper" style="margin-left: -<?php echo esc_attr($slider_slide_content_width_indentation); ?>px;">
                                            <div class="productiveminds-alignable-container_uno width-autoed" data-enter-exit-transition-home-slider="<?php echo esc_attr($slider_content_start); ?>">
                                                <div class="productiveminds_banner_container_content productiveminds-alignable-container row-gap-10px <?php echo esc_attr($slider_content_color); ?> home-slider-content" style="max-width: <?php echo esc_attr($slider_slide_content_width); ?>px; transition: all 0.4s var(<?php echo esc_attr($slider_content_entrance_easing); ?>)">

                                                    <?php 
                                                        if( 'content_auxiliary_top' == $content_auxiliary_location ) {
                                                            do_action( 'display_productive_global_hero_content_auxiliary', $copy_and_css );
                                                        }
                                                    ?>

                                                    <?php do_action( 'display_productive_global_hero_content_title', get_the_title() ); ?>
                                                    <?php do_action( 'display_productive_global_hero_content_main', get_the_content() ); ?>

                                                    <?php 
                                                        if( 'content_auxiliary_bottom' == $content_auxiliary_location ) {
                                                            do_action( 'display_productive_global_hero_content_auxiliary', $copy_and_css );
                                                        }
                                                    ?>

                                                    <div class="cta spacious align-content-center">
                                                        <?php 
                                                            $cta_1_css_class = 'cta1 ' . $section_style_button_1_button_hover_animation;
                                                            productive_global_hero_content_cta( $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_1'], $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_1_text'], $cta_1_css_class ); 
                                                        ?>
                                                        <?php
                                                            $cta_2_css_class = 'cta2 ' . $section_style_button_2_button_hover_animation;
                                                            productive_global_hero_content_cta( $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_2'], $productive_style_render_content_get_loop_data_cpt_obj['productive_cpt_url_2_text'], $cta_2_css_class ); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                                <?php do_action('display_content_wrapper_full_full_bottom'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <?php
                    // Arrow nav controls
                    $productiveminds_slider_controls = 'all';
                    if ( 'all' == $productiveminds_slider_controls || 
                        'arrows' == $productiveminds_slider_controls || 
                        'dots_and_arrows' == $productiveminds_slider_controls || 
                        'touch_swipe_and_arrows' == $productiveminds_slider_controls ) {
               ?>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
               <?php } ?>
                <?php
                    // Pagination nav controls
                    if ( 'all' == $productiveminds_slider_controls || 
                        'dots' == $productiveminds_slider_controls || 
                        'dots_and_arrows' == $productiveminds_slider_controls || 
                        'touch_swipe_and_dots' == $productiveminds_slider_controls ) {
               ?>
                    <div class="swiper-pagination"></div>
               <?php } ?>
            </div>
        </div>
    </div>
    <?php 
}




/**
 * Start:: Toggleable 
 */

/**
 * 
 * @param type $productive_cpt
 * @param type $misc
 */
function productive_style_render_toggleable_v_1( $productive_cpt, $misc ) {
    $productive_cpt_is_show_image_or_icon               = $misc['productive_cpt_is_show_image_or_icon'];
    $productiveminds_section_widget_type                = $misc['productiveminds_section_widget_type'];
    $productiveminds_section_meta_key                   = $misc['productiveminds_section_meta_key'];
    $productiveminds_section_toggle_parent_css_class    = $misc['productiveminds_section_toggle_parent_css_class'];

    $section_content_layout_is_grid_template_column = 'say-no-to-grid-template-columns';
    if ( 'image' == $productive_cpt_is_show_image_or_icon || 'icon' == $productive_cpt_is_show_image_or_icon ) {
        $section_content_layout_is_grid_template_column = '';
    }
    ?>
    <div class="productiveminds_section-container list productiveminds-standard-content-container <?php echo esc_attr( $productiveminds_section_toggle_parent_css_class ); ?>">
        <?php
        while( $productive_cpt->have_posts() ) {
            $productive_cpt->the_post();
            if( $productiveminds_section_widget_type != PRODUCTIVE_STYLE_PLUGIN_WIDGET_TYPE_BLOG_ELEMENT ) {
                $productive_cpt_id = get_the_ID();
                $productive_style_get_loop_data_cpt_obj = productive_style_render_content_get_loop_data_cpt( $productive_cpt_id, $productiveminds_section_meta_key );
                $misc['productive_cpt_icon_code']       = $productive_style_get_loop_data_cpt_obj['productive_cpt_icon_code'];
                $misc['productive_cpt_url']             = $productive_style_get_loop_data_cpt_obj['productive_cpt_url'];
                $misc['productive_cpt_url_text']        = $productive_style_get_loop_data_cpt_obj['productive_cpt_url_text'];
                $misc['productive_cpt_video']           = $productive_style_get_loop_data_cpt_obj['productive_cpt_video'];
                $misc['productive_cpt_video_platform']  = $productive_style_get_loop_data_cpt_obj['productive_cpt_video_platform'];
            }
        ?>
        <div class="productiveminds_section-container-column clickable_container_css_class">
            <div class="productiveminds_section-container-column-content">
                <div class="productiveminds_section-container-column-content-body no-box">
                    <div class="productiveminds_section-single-item <?php echo esc_attr( $section_content_layout_is_grid_template_column ); ?>">
                        <?php 
                            productive_style_render_content_media_v_1( $misc, $productive_cpt_id );
                            productive_style_render_content_toggleable_text_v_1( $misc ); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php productive_style_render_post_pagination( $productive_cpt, $misc ); ?>
        <?php wp_reset_postdata(); ?>
    </div>
    <?php 
}

/**
 * 
 * @param type $productive_style_get_loop_data_cpt_obj
 * @param type $productive_cpt_url
 * @param type $productive_cpt_url_text
 * @param type $misc
 */
function productive_style_render_content_toggleable_text_v_1( $misc ) {
    $section_content_show_url_button                    = $misc['section_content_show_url_button'];
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    $section_show_content_text                          = $misc['section_show_content_text'];
    $section_toggle_button_location                     = $misc['section_toggle_button_location'];
    
    $productive_cpt_url                    = '';
    if( isset( $misc['productive_cpt_url'] )) {
        $productive_cpt_url                     = $misc['productive_cpt_url'];
    }
    $productive_cpt_url_text                    = '';
    if( isset( $misc['productive_cpt_url_text'] )) {
        $productive_cpt_url_text                = $misc['productive_cpt_url_text'];
    }
    
    $section_content_show_url_button_target = '_parent'; 
    if( 2 == $section_content_show_url_button ) {
        $section_content_show_url_button_target = '_blank';
    }
?>
    <?php if( $section_show_content_text || $section_content_show_url_button ) { ?>
    <div class="productiveminds_section-single-item-text productiveminds-alignable-container align-items-flex-start align-content-flex-start row-gap-10px">
        <div class="single-item-title toggle_symbol_container_css_class">
            <div class="toggle_symbol_container_css_class_content <?php echo esc_attr( $section_toggle_button_location ); ?>">
                <?php if( 'left_button' == $section_toggle_button_location ) { ?>
                    <div class="toggle_symbol_container_css_class_content_button"></div>
                <?php } ?>
                <div class="toggle_symbol_container_css_class_content_text">
                    <?php the_title(); ?>
                </div>
                <?php if( 'right_button' == $section_toggle_button_location ) { ?>
                    <div class="toggle_symbol_container_css_class_content_button"></div>
                <?php } ?>
            </div>
        </div>
        <div class="single-item-desc toggleable_content_css_class">
            <?php if( $section_show_content_text ) {
                the_content();
            } ?>
        </div>
        
        <?php if ( !empty( $productive_cpt_url ) && $section_content_show_url_button ) { ?>
            <div class="single-item-button-container">
                <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" class="single-item-button <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                   aria-label="<?php echo esc_attr($productive_cpt_url_text); ?>" 
                   href="<?php echo esc_url($productive_cpt_url); ?>">
                        <?php echo esc_html($productive_cpt_url_text); ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
<?php 
}

/**
 * End:: Toggleable
 */

