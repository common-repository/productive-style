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
function productive_style_pro_content_element_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent Content Element:', 'productive-style' ),
        'all_items'             => __( 'All Content Elements', 'productive-style' ),
        'add_new_item'          => __( 'Add New Content Element', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New Content Element', 'productive-style' ),
        'edit_item'             => __( 'Edit Content Element', 'productive-style' ),
        'update_item'           => __( 'Update Content Element', 'productive-style' ),
        'view_item'             => __( 'View Content Element', 'productive-style' ),
        'view_items'            => __( 'View Content Elements', 'productive-style' ),
        'search_items'          => __( 'Search Content Element', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'Content Element Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add Content Element Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove Content Element Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main Content Element Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into Content Element', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this Content Element', 'productive-style' ),
        'items_list'            => __( 'Content Elements list', 'productive-style' ),
        'items_list_navigation' => __( 'Content Elements list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter Content Elements', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'Content Element post type for adding product elements', 'productive-style' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => productive_style_manage_cpts_content_element_menu_visibility(),
        'menu_position'         => 9,
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
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_pro_content_element_post_type', 0 );


function productive_style_pro_content_element_add_meta_box() {
    $args = array(
        '__back_compact_meta_box' => true,
        '__block_editor_compatible_meta_box' => true,
    );
    add_meta_box('productive_pro_content_element_id', __( 'Content Element Fields', 'productive-style' ), 'productive_style_pro_content_element_add_meta_box_callback', PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG, 'productive_style_pro_content_element_add_meta_box' );


function productive_style_pro_content_element_add_meta_box_callback( $post ) {
    $element_post_id = $post->ID;
    $element_meta_object = get_post_meta( $element_post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY, true );
    $cpt_icon = '';
    if ( !empty( $element_meta_object['cpt_icon'] ) ) {
        $cpt_icon = $element_meta_object['cpt_icon'];
    }
    $cpt_video = '';
    if ( !empty( $element_meta_object['cpt_video'] ) ) {
        $cpt_video = $element_meta_object['cpt_video'];
    }
    $cpt_video_platform = '';
    if ( !empty( $element_meta_object['cpt_video_platform'] ) ) {
        $cpt_video_platform = $element_meta_object['cpt_video_platform'];
    }
    $cpt_url = '';
    if ( !empty( $element_meta_object['cpt_url'] ) ) {
        $cpt_url = $element_meta_object['cpt_url'];
    }
    $cpt_url_text = '';
    if ( !empty( $element_meta_object['cpt_url_text'] ) ) {
        $cpt_url_text = $element_meta_object['cpt_url_text'];
    }
    wp_nonce_field( 'elementnonce', '_pro_elementnonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="pro_content_element-cpt_icon"><?php echo __( 'Icon', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_content_element-cpt_icon"><?php echo __( 'Icon', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_content_element-cpt_icon" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_icon ); ?>" name="pro_content_element[cpt_icon]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Font awesome Icon Code (e.g fa-check)', 'productive-style' ); ?>
                    <a target="_blank" href="https://fontawesome.com/v4/icons">Icons list</a>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_content_element-cpt_video"><?php echo __( 'Video ID', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_content_element-cpt_video"><?php echo __( 'Content Element Video ID', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_content_element-cpt_video" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_video ); ?>" name="pro_content_element[cpt_video]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'The video id of the video (not the full url, just the video ID)', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_content_element-cpt_video_platform"><?php echo __( 'Video Platform', 'productive-style' ); ?></label>
                <label for="pro_content_element-cpt_video_platform" class="screen-reader-text" ><?php echo __( 'Video Platform', 'productive-style' ); ?></label>
            </th>
            <td>
                <div>
                    <select id="pro_content_element-cpt_video_platform" class="regular-select"
                                name="pro_content_element[cpt_video_platform]">
                        <?php
                            $productive_style_get_video_platforms = productive_style_get_video_platforms();
                            foreach ( $productive_style_get_video_platforms as $key => $productive_style_get_video_platform ) {
                                ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $cpt_video_platform, esc_attr( $key ), false ); ?>>
                                   <?php echo esc_html( $productive_style_get_video_platform ); ?>
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
                <label for="pro_content_element-cpt_url"><?php echo __( 'Url', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_content_element-cpt_url"><?php echo __( 'Content Element Url', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_content_element-cpt_url" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url ); ?>" name="pro_content_element[cpt_url]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Destination Url for CTA click, starting with http.', 'productive-style' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_content_element-cpt_url_text"><?php echo __( 'CTA Text', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="pro_content_element-cpt_url_text"><?php echo __( 'Content Element Text', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="pro_content_element-cpt_url_text" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_text ); ?>" name="pro_content_element[cpt_url_text]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Text for the CTA button.', 'productive-style' ); ?></div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_style_pro_content_element_save_meta_box( $post_id, $post ) {
    $element_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_elementnonce'] ) || !wp_verify_nonce( $_POST['_pro_elementnonce'], 'elementnonce' ) ) {
        return $element_post_id;
    }

    $element_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $element_post_type_object->cap->edit_post, $element_post_id ) ) {
        return $element_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $element_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $element_post_id;
    }
    
    if ( isset( $_POST['pro_content_element'] ) && ! empty( $_POST['pro_content_element'] ) ) {
        $element_meta_object = array();
        if ( !empty( $_POST['pro_content_element']['cpt_icon'] ) ) {
            $element_meta_object['cpt_icon'] = sanitize_text_field( $_POST['pro_content_element']['cpt_icon'] );
        }
        if ( !empty( $_POST['pro_content_element']['cpt_video'] ) ) {
            $element_meta_object['cpt_video'] = sanitize_text_field( $_POST['pro_content_element']['cpt_video'] );
        }
        if ( !empty( $_POST['pro_content_element']['cpt_video_platform'] ) ) {
            $element_meta_object['cpt_video_platform'] = sanitize_text_field( $_POST['pro_content_element']['cpt_video_platform'] );
        }
        if ( !empty( $_POST['pro_content_element']['cpt_url'] ) ) {
            $element_meta_object['cpt_url'] = sanitize_url( $_POST['pro_content_element']['cpt_url'] );
        }
        if ( !empty( $_POST['pro_content_element']['cpt_url_text'] ) ) {
            $element_meta_object['cpt_url_text'] = sanitize_text_field( $_POST['pro_content_element']['cpt_url_text'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY, $element_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY);
    }
    
    return $element_post_id;
}
add_action( 'save_post', 'productive_style_pro_content_element_save_meta_box', 10, 20 );


function productive_style_pro_content_element_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Title', 'productive-style' ),
        'pro_content_element-element-icon'    => __( 'Icon', 'productive-style' ),
        'pro_content_element-element-video'    => __( 'Video', 'productive-style' ),
        'taxonomy-content-element-type'    => __( 'Type', 'productive-style' ),
        'pro_content_element-element-url'    => __( 'URL', 'productive-style' ),
        'date'    => __( 'Date', 'productive-style' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pro_content_element_columns', 'productive_style_pro_content_element_edit_columns' );


function productive_style_pro_content_element_editable_columns( $column_name, $post_id ) {
    $element_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'pro_content_element-element-icon':
            if ( !empty( $element_meta_object['cpt_icon'] ) ) {
                echo esc_attr( $element_meta_object['cpt_icon'] );
            }
            break;
            
        case 'pro_content_element-element-video':
            if ( !empty( $element_meta_object['cpt_video'] ) ) {
                $cpt_platform_player_url = 'https://www.youtube.com/watch?v=';
                if ( !empty( $element_meta_object['cpt_video'] ) && 'vimeo' == $element_meta_object['cpt_video'] ) {
                    $cpt_platform_player_url = 'https://vimeo.com/';
                }
                $url = $cpt_platform_player_url . $element_meta_object['cpt_video'];
                echo '<a target="_blank" href="' . esc_attr( $url ) . '">' . esc_html( $element_meta_object['cpt_video'] ) . '</a>';
            }
            break;
            
        case 'pro_content_element-element-url':
            if ( !empty( $element_meta_object['cpt_url'] ) ) {
                echo '<a target="_blank" href="' . esc_url( $element_meta_object['cpt_url'] ) . '">' . esc_html( $element_meta_object['cpt_url_text'] ) . '</a>';
            }
            break;
            
        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_style_pro_content_element_editable_columns', 10, 2 );


function productive_style_pro_content_element_register_taxonomy() {
    $labels = array(
        'name'              => _x( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL, 'Taxonomy General Name', 'productive-style' ),
        'singular_name'     => _x( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'Taxonomy Singular Name', 'productive-style' ),
        'search_items'      => __( 'Search ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-style' ),
        'all_items'         => __( 'All ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-style' ),
        'view_item'         => __( 'View ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
        'parent_item'       => __( 'Parent', 'productive-style' ),
        'parent_item_colon' => __( 'Parent', 'productive-style' ),
        'edit_item'         => __( 'Edit ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
        'update_item'       => __( 'Update ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
        'add_new_item'      => __( 'Add New ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
        'new_item_name'     => __( 'New ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_SINGULAR . ' Name', 'productive-style' ),
        'not_found'         => __( 'No ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL . ' Found', 'productive-style' ),
        'back_to_items'     => __( 'Back to ' . PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-style' ),
        'menu_name'         => __( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-style' ),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_SLUG ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_TAXONOMY_SLUG, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG, $args );
    
}
add_action( 'init', 'productive_style_pro_content_element_register_taxonomy', 0 );

