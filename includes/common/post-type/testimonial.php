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
function productive_style_testimonial_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'productive-style' ),
        'all_items'             => __( 'All Testimonials', 'productive-style' ),
        'add_new_item'          => __( 'Add New Testimonial', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New Testimonial', 'productive-style' ),
        'edit_item'             => __( 'Edit Testimonial', 'productive-style' ),
        'update_item'           => __( 'Update Testimonial', 'productive-style' ),
        'view_item'             => __( 'View Testimonial', 'productive-style' ),
        'view_items'            => __( 'View Testimonials', 'productive-style' ),
        'search_items'          => __( 'Search Testimonial', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'Testimonial Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add Testimonial Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove Testimonial Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main Testimonial Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into Testimonial', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this Testimonial', 'productive-style' ),
        'items_list'            => __( 'Testimonials list', 'productive-style' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter Testimonials', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'Testimonial post type for adding client testimonials', 'productive-style' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => productive_style_manage_cpts_testimonial_menu_visibility(),
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true, // HD
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_testimonial_post_type', 0 );


function productive_style_testimonial_add_meta_box() {
    $args = array(
        '__back_compact_meta_box' => true,
        '__block_editor_compatible_meta_box' => true,
    );
    add_meta_box('productive_testimonial_id', __( 'Testimonial Fields', 'productive-style' ), 'productive_style_testimonial_add_meta_box_callback', PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_SLUG, 'productive_style_testimonial_add_meta_box' );


function productive_style_testimonial_add_meta_box_callback( $post ) {
    $testimonial_post_id = $post->ID;
    $testimonial_meta_object = get_post_meta( $testimonial_post_id, PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_META_KEY, true );
    $testimonial_name = '';
    if ( !empty( $testimonial_meta_object['testimonial_name'] ) ) {
        $testimonial_name = $testimonial_meta_object['testimonial_name'];
    }
    $testimonial_company = '';
    if ( !empty( $testimonial_meta_object['testimonial_company'] ) ) {
        $testimonial_company = $testimonial_meta_object['testimonial_company'];
    }
    $testimonial_position = '';
    if ( !empty( $testimonial_meta_object['testimonial_position'] ) ) {
        $testimonial_position = $testimonial_meta_object['testimonial_position'];
    }
    $testimonial_email = '';
    if ( !empty( $testimonial_meta_object['testimonial_email'] ) ) {
        $testimonial_email = $testimonial_meta_object['testimonial_email'];
    }
    $testimonial_url = '';
    if ( !empty( $testimonial_meta_object['testimonial_url'] ) ) {
        $testimonial_url = $testimonial_meta_object['testimonial_url'];
    }
    $testimonial_rating_stars = '';
    if ( !empty( $testimonial_meta_object['testimonial_rating_stars'] ) ) {
        $testimonial_rating_stars = $testimonial_meta_object['testimonial_rating_stars'];
    }
    wp_nonce_field( 'testimonialnonce', '_pro_testimonialnonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="testimonial-testimonial_name"><?php echo __( 'Name', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_name"><?php echo __( 'Testimonial Name', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_name" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_name ); ?>" name="testimonial[testimonial_name]" class="form-required form-input-tip" /></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="testimonial-testimonial_company"><?php echo __( 'Company', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_company"><?php echo __( 'Company', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_company" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_company ); ?>" name="testimonial[testimonial_company]" class="form-required form-input-tip" /></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="testimonial-testimonial_position"><?php echo __( 'Position', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_position"><?php echo __( 'Position', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_position" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_position ); ?>" name="testimonial[testimonial_position]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'E.g Director', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="testimonial-testimonial_email"><?php echo __( 'Email', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_email"><?php echo __( 'Email', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_email" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_email ); ?>" name="testimonial[testimonial_email]" class="form-required form-input-tip" /></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="testimonial-testimonial_url"><?php echo __( 'Website Url', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_url"><?php echo __( 'Website Url', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_url" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_url ); ?>" name="testimonial[testimonial_url]" class="form-required form-input-tip" /></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="testimonial-testimonial_rating_stars"><?php echo __( 'Ratings (out of 5)', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="testimonial-testimonial_rating_stars"><?php echo __( 'Ratings (out of 5)', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="testimonial-testimonial_rating_stars" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $testimonial_rating_stars ); ?>" name="testimonial[testimonial_rating_stars]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Ratings (out of 5)', 'productive-style' ); ?></div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_style_testimonial_save_meta_box( $post_id, $post ) {
    $testimonial_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_testimonialnonce'] ) || !wp_verify_nonce( $_POST['_pro_testimonialnonce'], 'testimonialnonce' ) ) {
        return $testimonial_post_id;
    }

    $testimonial_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $testimonial_post_type_object->cap->edit_post, $testimonial_post_id ) ) {
        return $testimonial_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $testimonial_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $testimonial_post_id;
    }
    
    if ( isset( $_POST['testimonial'] ) && ! empty( $_POST['testimonial'] ) ) {
        $testimonial_meta_object = array();
        if ( !empty( $_POST['testimonial']['testimonial_name'] ) ) {
            $testimonial_meta_object['testimonial_name'] = sanitize_text_field( $_POST['testimonial']['testimonial_name'] );
        }
        if ( !empty( $_POST['testimonial']['testimonial_company'] ) ) {
            $testimonial_meta_object['testimonial_company'] = sanitize_text_field( $_POST['testimonial']['testimonial_company'] );
        }
        if ( !empty( $_POST['testimonial']['testimonial_position'] ) ) {
            $testimonial_meta_object['testimonial_position'] = sanitize_text_field( $_POST['testimonial']['testimonial_position'] );
        }
        if ( !empty( $_POST['testimonial']['testimonial_email'] ) ) {
            $testimonial_meta_object['testimonial_email'] = sanitize_text_field( $_POST['testimonial']['testimonial_email'] );
        }
        if ( !empty( $_POST['testimonial']['testimonial_url'] ) ) {
            $testimonial_meta_object['testimonial_url'] = sanitize_url( $_POST['testimonial']['testimonial_url'] );
        }
        if ( !empty( $_POST['testimonial']['testimonial_rating_stars'] ) ) {
            $testimonial_meta_object['testimonial_rating_stars'] = sanitize_text_field( $_POST['testimonial']['testimonial_rating_stars'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_META_KEY, $testimonial_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_META_KEY);
    }
    
    return $testimonial_post_id;
}
add_action( 'save_post', 'productive_style_testimonial_save_meta_box', 10, 20 );


function productive_style_testimonial_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Title', 'productive-style' ),
        'testimonial-testimonial-name'    => __( 'Name', 'productive-style' ),
        'testimonial-testimonial-company'    => __( 'Company', 'productive-style' ),
        'testimonial-testimonial-position'    => __( 'Position', 'productive-style' ),
        'testimonial-rating-stars'    => __( 'Ratings (out of 5)', 'productive-style' ),
        'date'    => __( 'Date', 'productive-style' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pro_testimonial_columns', 'productive_style_testimonial_edit_columns' );


function productive_style_testimonial_editable_columns( $column_name, $post_id ) {
    $testimonial_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TESTIMONIAL_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'testimonial-testimonial-name':
            if ( !empty( $testimonial_meta_object['testimonial_name'] ) ) {
                echo esc_attr( $testimonial_meta_object['testimonial_name'] );
            }
            break;

        case 'testimonial-testimonial-company':
            if ( !empty( $testimonial_meta_object['testimonial_company'] ) ) {
                echo esc_attr( $testimonial_meta_object['testimonial_company'] );
            }
            break;

        case 'testimonial-testimonial-position':
            if ( !empty( $testimonial_meta_object['testimonial_position'] ) ) {
                echo esc_attr( $testimonial_meta_object['testimonial_position'] );
            }
            break;

        case 'testimonial-rating-stars':
            if ( !empty( $testimonial_meta_object['testimonial_rating_stars'] ) ) {
                echo esc_attr( $testimonial_meta_object['testimonial_rating_stars'] );
            }
            break;

        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_style_testimonial_editable_columns', 10, 2 );
