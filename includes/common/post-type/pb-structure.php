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
function productive_style_pb_structure_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent Page Structure:', 'productive-style' ),
        'all_items'             => __( 'All Page Structures', 'productive-style' ),
        'add_new_item'          => __( 'Add New Page Structure', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New Page Structure', 'productive-style' ),
        'edit_item'             => __( 'Edit Page Structure', 'productive-style' ),
        'update_item'           => __( 'Update Page Structure', 'productive-style' ),
        'view_item'             => __( 'View Page Structure', 'productive-style' ),
        'view_items'            => __( 'View Page Structures', 'productive-style' ),
        'search_items'          => __( 'Search Page Structure', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'Page Structure Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add Page Structure Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove Page Structure Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main Page Structure Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into Page Structure', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this Page Structure', 'productive-style' ),
        'items_list'            => __( 'Page Structures list', 'productive-style' ),
        'items_list_navigation' => __( 'Page Structures list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter Page Structures', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'Page Structure post type for adding site structures such as header, footer, and pages', 'productive-style' ),
        'labels'                => $labels,
        //'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true, // HD
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => false, // HD
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_pb_structure_post_type', 0 );


function productive_style_pb_structure_add_meta_box() {
    $args = array(
        //'__back_compact_meta_box' => true,
        //'__block_editor_compatible_meta_box' => false,
    );
    add_meta_box('productive_pb_structure_id', __( 'Page Structure Fields', 'productive-style' ), 'productive_style_pb_structure_add_meta_box_callback', PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_SLUG, 'productive_style_pb_structure_add_meta_box' );


function productive_style_pb_structure_add_meta_box_callback( $post ) {
    $pb_structure_post_id = $post->ID;
    $pb_structure_meta_object = get_post_meta( $pb_structure_post_id, PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_META_KEY, true );
    $structure_type = '';
    if ( !empty( $pb_structure_meta_object['structure_type'] ) ) {
        $structure_type = $pb_structure_meta_object['structure_type'];
    }
    $structure_page_location = '';
    if ( !empty( $pb_structure_meta_object['structure_page_location'] ) ) {
        $structure_page_location = $pb_structure_meta_object['structure_page_location'];
    }
    $structure_template = '';
    if ( !empty( $pb_structure_meta_object['structure_template'] ) ) {
        $structure_template = $pb_structure_meta_object['structure_template'];
    }
    wp_nonce_field( 'elementnonce', '_pro_elementnonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="pb_structure-structure_type"><?php echo __( 'Structure Type', 'productive-style' ); ?></label>
                <label for="pb_structure-structure_type" class="screen-reader-text" ><?php echo __( 'Structure Type', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="structure_type" class="regular-select"
                                name="pb_structure[structure_type]">
                        <?php
                            $productive_style_get_list_of_structure_types = productive_style_get_list_of_structure_types();
                            foreach ( $productive_style_get_list_of_structure_types as $key => $productive_style_get_list_of_structure_type ) {
                                ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $structure_type, esc_attr( $key ), false ); ?>>
                                   <?php echo esc_html( $productive_style_get_list_of_structure_type ); ?>
                                </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div>
                        <?php echo __( 'Select a structure type', 'productive-style' ); ?>
                    </div>
                    
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pb_structure-structure_page_location"><?php echo __( 'Location', 'productive-style' ); ?></label>
                <label for="pb_structure-structure_page_location" class="screen-reader-text" ><?php echo __( 'Location', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="structure_page_location" class="regular-select"
                                name="pb_structure[structure_page_location]">
                        <?php
                            $productive_style_get_list_of_structure_locations = productive_style_get_list_of_structure_locations();
                            foreach ( $productive_style_get_list_of_structure_locations as $key => $productive_style_get_list_of_structure_location ) {
                                ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $structure_page_location, esc_attr( $key ), false ); ?>>
                                   <?php echo esc_html( $productive_style_get_list_of_structure_location ); ?>
                                </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div>
                        <?php echo __( 'Select the site pages that use this structure', 'productive-style' ); ?>
                    </div>
                    
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pb_structure-structure_template"><?php echo __( 'Elementor Template', 'productive-style' ); ?></label>
                <label for="pb_structure-structure_template" class="screen-reader-text" ><?php echo __( 'Elementor Template', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="structure_template" class="regular-select"
                                name="pb_structure[structure_template]">
                        <?php
                            $productive_style_get_list_of_pb_structure_starter_templates = productive_style_get_list_of_pb_structure_starter_templates();
                            foreach ( $productive_style_get_list_of_pb_structure_starter_templates as $key => $productive_style_get_list_of_pb_structure_template ) {
                                ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $structure_template, esc_attr( $key ), false ); ?>>
                                   <?php echo esc_html( $productive_style_get_list_of_pb_structure_template ); ?>
                                </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div>
                        <?php echo __( 'Select Elementor Template to which this structure belongs', 'productive-style' ); ?>
                    </div>
                    
                </div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_style_pb_structure_save_meta_box( $post_id, $post ) {
    $pb_structure_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_elementnonce'] ) || !wp_verify_nonce( $_POST['_pro_elementnonce'], 'elementnonce' ) ) {
        return $pb_structure_post_id;
    }

    $pb_structure_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $pb_structure_post_type_object->cap->edit_post, $pb_structure_post_id ) ) {
        return $pb_structure_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $pb_structure_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $pb_structure_post_id;
    }
    
    if ( isset( $_POST['pb_structure'] ) && ! empty( $_POST['pb_structure'] ) ) {
        $pb_structure_meta_object = array();
        if ( !empty( $_POST['pb_structure']['structure_type'] ) ) {
            $pb_structure_meta_object['structure_type'] = sanitize_text_field( $_POST['pb_structure']['structure_type'] );
        }
        if ( !empty( $_POST['pb_structure']['structure_page_location'] ) ) {
            $pb_structure_meta_object['structure_page_location'] = sanitize_text_field( $_POST['pb_structure']['structure_page_location'] );
        }
        if ( !empty( $_POST['pb_structure']['structure_template'] ) ) {
            $pb_structure_meta_object['structure_template'] = sanitize_text_field( $_POST['pb_structure']['structure_template'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_META_KEY, $pb_structure_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_META_KEY);
    }
    
    return $pb_structure_post_id;
}
add_action( 'save_post', 'productive_style_pb_structure_save_meta_box', 10, 20 );


function productive_style_pb_structure_edit_columns( $columns ) {
    $columns = array(
        'cb'                                            => '<input type="checkbox" />',
        'title'                                         => __( 'Title', 'productive-style' ),
        'pb_structure-structure-template'        => __( 'Template', 'productive-style' ),
        'pb_structure-structure-type'            => __( 'Type', 'productive-style' ),
        //'pb_structure-structure-page-location'   => __( 'Location', 'productive-style' ),
        'date'    => __( 'Date', 'productive-style' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pb_structure_columns', 'productive_style_pb_structure_edit_columns' );


function productive_style_pb_structure_editable_columns( $column_name, $post_id ) {
    $pb_structure_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_PB_STRUCTURE_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'pb_structure-structure-type':
            if ( !empty( $pb_structure_meta_object['structure_type'] ) ) {
                echo esc_attr( $pb_structure_meta_object['structure_type'] );
            }
            break;

//        case 'pb_structure-structure-page-location':
//            if ( !empty( $pb_structure_meta_object['structure_page_location'] ) ) {
//                echo esc_attr( $pb_structure_meta_object['structure_page_location'] );
//            }
//            break;

        case 'pb_structure-structure-template':
            if ( !empty( $pb_structure_meta_object['structure_template'] ) ) {
                echo esc_attr( $pb_structure_meta_object['structure_template'] );
            }
            break;

        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_style_pb_structure_editable_columns', 10, 2 );


