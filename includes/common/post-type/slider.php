<?php
/**
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( !defined('ABSPATH') ) {
	die();
}

// Registrar Custom Post Type
function productive_style_pro_slider_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent Slider:', 'productive-style' ),
        'all_items'             => __( 'All Sliders', 'productive-style' ),
        'add_new_item'          => __( 'Add New Slider', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New Slider', 'productive-style' ),
        'edit_item'             => __( 'Edit Slider', 'productive-style' ),
        'update_item'           => __( 'Update Slider', 'productive-style' ),
        'view_item'             => __( 'View Slider', 'productive-style' ),
        'view_items'            => __( 'View Sliders', 'productive-style' ),
        'search_items'          => __( 'Search Slider', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'Slider Background Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add Slider Background Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove Slider Background Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main Slider Background Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into Slider', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this Slider', 'productive-style' ),
        'items_list'            => __( 'Sliders list', 'productive-style' ),
        'items_list_navigation' => __( 'Sliders list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter Sliders', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'Slider post type', 'productive-style' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => productive_style_manage_cpts_slider_menu_visibility(),
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_pro_slider_post_type', 0 );


function productive_style_pro_slider_add_meta_box() {
    $args = array(
        '__back_compact_meta_box' => true,
        '__block_editor_compatible_meta_box' => true,
    );
    add_meta_box('productive_pro_slider_id', __( 'Slider Fields', 'productive-style' ), 'productive_style_pro_slider_add_meta_box_callback', PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG, 'productive_style_pro_slider_add_meta_box' );


function productive_style_pro_slider_add_meta_box_callback( $post ) {
    $slider_post_id = $post->ID;
    $slider_meta_object = get_post_meta( $slider_post_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY, true );
    $cpt_auxiliary_content = '';
    if ( !empty( $slider_meta_object['cpt_auxiliary_content'] ) ) {
        $cpt_auxiliary_content = $slider_meta_object['cpt_auxiliary_content'];
    }
    $cpt_url_1 = '';
    if ( !empty( $slider_meta_object['cpt_url_1'] ) ) {
        $cpt_url_1 = $slider_meta_object['cpt_url_1'];
    }
    $cpt_url_1_text = '';
    if ( !empty( $slider_meta_object['cpt_url_1_text'] ) ) {
        $cpt_url_1_text = $slider_meta_object['cpt_url_1_text'];
    }
    $cpt_url_2 = '';
    if ( !empty( $slider_meta_object['cpt_url_2'] ) ) {
        $cpt_url_2 = $slider_meta_object['cpt_url_2'];
    }
    $cpt_url_2_text = '';
    if ( !empty( $slider_meta_object['cpt_url_2_text'] ) ) {
        $cpt_url_2_text = $slider_meta_object['cpt_url_2_text'];
    }
    $cpt_content_alignment_v = '';
    if ( !empty( $slider_meta_object['cpt_content_alignment_v'] ) ) {
        $cpt_content_alignment_v = $slider_meta_object['cpt_content_alignment_v'];
    }
    $cpt_content_alignment_h = '';
    if ( !empty( $slider_meta_object['cpt_content_alignment_h'] ) ) {
        $cpt_content_alignment_h = $slider_meta_object['cpt_content_alignment_h'];
    }
    $cpt_content_color = '';
    if ( !empty( $slider_meta_object['cpt_content_color'] ) ) {
        $cpt_content_color = $slider_meta_object['cpt_content_color'];
    }
    wp_nonce_field( 'slidernonce', '_pro_slidernonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="pro_slider-cpt_auxiliary_content"><?php echo __( 'Auxiliary content', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_slider-cpt_auxiliary_content"><?php echo __( 'Auxiliary content', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="cpt_auxiliary_content" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_auxiliary_content ); ?>" name="pro_slider[cpt_auxiliary_content]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Extra content for the slide (optional).', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_url_1"><?php echo __( 'CTA 1 Url', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_slider-cpt_url_1"><?php echo __( 'CTA 1 Url', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="cpt_url_1" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_1 ); ?>" name="pro_slider[cpt_url_1]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Destination Url for CTA 1 click, starting with http.', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_url_1_text"><?php echo __( 'CTA 1 Text', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_slider-cpt_url_1_text"><?php echo __( 'CTA 1 Text', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_slider-cpt_url_1_text" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_1_text ); ?>" name="pro_slider[cpt_url_1_text]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Text for the CTA 1 button', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_url_2"><?php echo __( 'CTA 2 Url', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_slider-cpt_url_2"><?php echo __( 'CTA 1 Url', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="cpt_url_2" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_2 ); ?>" name="pro_slider[cpt_url_2]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Destination Url for CTA 2 click, starting with http.', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_url_2_text"><?php echo __( 'CTA 2 Text', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_slider-cpt_url_2_text"><?php echo __( 'CTA 1 Text', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_slider-cpt_url_2_text" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_2_text ); ?>" name="pro_slider[cpt_url_2_text]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Text for the CTA 2 button', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_content_alignment_v"><?php echo __( 'Content Vertical Alignment', 'productive-style' ); ?></label>
                <label for="pro_slider-cpt_content_alignment_v" class="screen-reader-text" ><?php echo __( 'Content Vertical Alignment', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="cpt_content_alignment_v" class="regular-select" name="pro_slider[cpt_content_alignment_v]">
                        <?php
                            $productive_style_get_content_alignment_vs = productive_global_get_vertical_align_content_options();
                            foreach ( $productive_style_get_content_alignment_vs as $key => $productive_style_get_content_alignment_v ) {
                        ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $cpt_content_alignment_v, esc_attr( $key ), false ); ?>>
                               <?php echo esc_html( $productive_style_get_content_alignment_v ); ?>
                            </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_content_alignment_h"><?php echo __( 'Content Horizontal Alignment', 'productive-style' ); ?></label>
                <label for="pro_slider-cpt_content_alignment_h" class="screen-reader-text" ><?php echo __( 'Content Horizontal Alignment', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="cpt_content_alignment_h" class="regular-select" name="pro_slider[cpt_content_alignment_h]">
                        <?php
                            $productive_style_get_content_alignment_hs = productive_global_get_horizontal_justify_items_options();
                            foreach ( $productive_style_get_content_alignment_hs as $key => $productive_style_get_content_alignment_h ) {
                        ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $cpt_content_alignment_h, esc_attr( $key ), false ); ?>>
                               <?php echo esc_html( $productive_style_get_content_alignment_h ); ?>
                            </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_slider-cpt_content_color"><?php echo __( 'Content Color Scheme', 'productive-style' ); ?></label>
                <label for="pro_slider-cpt_content_color" class="screen-reader-text" ><?php echo __( 'Content Horizontal Alignment', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="cpt_content_color" class="regular-select"
                                name="pro_slider[cpt_content_color]">
                        <?php
                            $productive_global_get_colour_schemes_for_contents = productive_global_get_colour_schemes_for_contents();
                            foreach ( $productive_global_get_colour_schemes_for_contents as $key => $productive_global_get_colour_schemes_for_content ) {
                                ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $cpt_content_color, esc_attr( $key ), false ); ?>>
                                   <?php echo esc_html( $productive_global_get_colour_schemes_for_content ); ?>
                                </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div><?php echo __( 'Applies to this slide only. Set to "None" to use customizers color.', 'productive-style' ); ?></div>
                </div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_style_pro_slider_save_meta_box( $post_id, $post ) {
    $slider_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_slidernonce'] ) || !wp_verify_nonce( $_POST['_pro_slidernonce'], 'slidernonce' ) ) {
        return $slider_post_id;
    }

    $slider_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $slider_post_type_object->cap->edit_post, $slider_post_id ) ) {
        return $slider_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $slider_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $slider_post_id;
    }
    
    if ( isset( $_POST['pro_slider'] ) && ! empty( $_POST['pro_slider'] ) ) {
        $slider_meta_object = array();
        if ( !empty( $_POST['pro_slider']['cpt_auxiliary_content'] ) ) {
            $slider_meta_object['cpt_auxiliary_content'] = sanitize_text_field( $_POST['pro_slider']['cpt_auxiliary_content'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_url_1'] ) ) {
            $slider_meta_object['cpt_url_1'] = sanitize_url( $_POST['pro_slider']['cpt_url_1'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_url_1_text'] ) ) {
            $slider_meta_object['cpt_url_1_text'] = sanitize_text_field( $_POST['pro_slider']['cpt_url_1_text'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_url_2'] ) ) {
            $slider_meta_object['cpt_url_2'] = sanitize_url( $_POST['pro_slider']['cpt_url_2'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_url_2_text'] ) ) {
            $slider_meta_object['cpt_url_2_text'] = sanitize_text_field( $_POST['pro_slider']['cpt_url_2_text'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_content_alignment_v'] ) ) {
            $slider_meta_object['cpt_content_alignment_v'] = sanitize_text_field( $_POST['pro_slider']['cpt_content_alignment_v'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_content_alignment_h'] ) ) {
            $slider_meta_object['cpt_content_alignment_h'] = sanitize_text_field( $_POST['pro_slider']['cpt_content_alignment_h'] );
        }
        if ( !empty( $_POST['pro_slider']['cpt_content_color'] ) ) {
            $slider_meta_object['cpt_content_color'] = sanitize_text_field( $_POST['pro_slider']['cpt_content_color'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY, $slider_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY);
    }
    
    return $slider_post_id;
}
add_action( 'save_post', 'productive_style_pro_slider_save_meta_box', 10, 20 );


function productive_style_pro_slider_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Slide Title', 'productive-style' ),
        'taxonomy-pro-slider-type'    => __( 'Type', 'productive-style' ),
        'pro_slider-slider-url_1'    => __( 'CTA 1', 'productive-style' ),
        'pro_slider-slider-url_2'    => __( 'CTA 2', 'productive-style' ),
        'date'    => __( 'Date', 'productive-style' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pro_slider_columns', 'productive_style_pro_slider_edit_columns' );


function productive_style_pro_slider_editable_columns( $column_name, $post_id ) {
    $slider_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'pro_slider-slider-url_1':
            if ( !empty( $slider_meta_object['cpt_url_1'] ) ) {
                echo '<a target="_blank" href="' . esc_url( $slider_meta_object['cpt_url_1'] ) . '">' . esc_html( $slider_meta_object['cpt_url_1_text'] ) . '</a>';
            }
            break;
            
        case 'pro_slider-slider-url_2':
            if ( !empty( $slider_meta_object['cpt_url_2'] ) ) {
                echo '<a target="_blank" href="' . esc_url( $slider_meta_object['cpt_url_2'] ) . '">' . esc_html( $slider_meta_object['cpt_url_2_text'] ) . '</a>';
            }
            break;
            
        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_style_pro_slider_editable_columns', 10, 2 );


function productive_style_pro_slider_register_taxonomy() {
    $labels = array(
            'name'              => _x( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL, 'Taxonomy General Name', 'productive-style' ),
            'singular_name'     => _x( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR, 'Taxonomy Singular Name', 'productive-style' ),
            'search_items'      => __( 'Search ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'all_items'         => __( 'All ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'view_item'         => __( 'View ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'parent_item'       => __( 'Parent', 'productive-style' ),
            'parent_item_colon' => __( 'Parent', 'productive-style' ),
            'edit_item'         => __( 'Edit ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'update_item'       => __( 'Update ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'add_new_item'      => __( 'Add New ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'new_item_name'     => __( 'New ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_SINGULAR . ' Name', 'productive-style' ),
            'not_found'         => __( 'No ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL . ' Found', 'productive-style' ),
            'back_to_items'     => __( 'Back to ' . PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'menu_name'         => __( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_NAME_PLURAL, 'productive-style' ),
    );
    $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_SLUG ),
            'show_in_rest'      => true,
    );
    
    register_taxonomy( PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_TAXONOMY_SLUG, PRODUCTIVE_STYLE_PLUGIN_BANNER_SLIDER_POST_TYPE_SLUG, $args );
    
}
add_action( 'init', 'productive_style_pro_slider_register_taxonomy', 0 );

