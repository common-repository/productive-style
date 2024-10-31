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
function productive_style_team_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent Team:', 'productive-style' ),
        'all_items'             => __( 'All Teams', 'productive-style' ),
        'add_new_item'          => __( 'Add New Team', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New Team', 'productive-style' ),
        'edit_item'             => __( 'Edit Team', 'productive-style' ),
        'update_item'           => __( 'Update Team', 'productive-style' ),
        'view_item'             => __( 'View Team', 'productive-style' ),
        'view_items'            => __( 'View Teams', 'productive-style' ),
        'search_items'          => __( 'Search Team', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'Team Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add Team Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove Team Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main Team Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into Team', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this Team', 'productive-style' ),
        'items_list'            => __( 'Teams list', 'productive-style' ),
        'items_list_navigation' => __( 'Teams list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter Teams', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'Team post type for adding client teams', 'productive-style' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => productive_style_manage_cpts_team_menu_visibility(),
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
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_team_post_type', 0 );


function productive_style_team_add_meta_box() {
    $args = array(
        '__back_compact_meta_box' => true,
        '__block_editor_compatible_meta_box' => true,
    );
    add_meta_box('productive_team_id', __( 'Team Member Fields', 'productive-style' ), 'productive_style_team_add_meta_box_callback', PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_SLUG, 'productive_style_team_add_meta_box' );


function productive_style_team_add_meta_box_callback( $post ) {
    $team_post_id = $post->ID;
    $team_meta_object = get_post_meta( $team_post_id, PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_META_KEY, true );
    $team_position = '';
    if ( !empty( $team_meta_object['team_position'] ) ) {
        $team_position = $team_meta_object['team_position'];
    }
    $team_social_site_1 = '';
    if ( !empty( $team_meta_object['team_social_site_1'] ) ) {
        $team_social_site_1 = $team_meta_object['team_social_site_1'];
    }
    $team_social_site_2 = '';
    if ( !empty( $team_meta_object['team_social_site_2'] ) ) {
        $team_social_site_2 = $team_meta_object['team_social_site_2'];
    }
    $team_social_site_3 = '';
    if ( !empty( $team_meta_object['team_social_site_3'] ) ) {
        $team_social_site_3 = $team_meta_object['team_social_site_3'];
    }
    $team_social_site_4 = '';
    if ( !empty( $team_meta_object['team_social_site_4'] ) ) {
        $team_social_site_4 = $team_meta_object['team_social_site_4'];
    }
    wp_nonce_field( 'teamnonce', '_pro_teamnonce' );
    ?>
    
    <div class="bolded">
        <?php echo __( 'You may add up to four social media profile URLs. Please note that only the following social media sites are supported: Facebook, LinkedIn, Twitter, Instagram, YouTube', 'productive-style' ); ?>
    </div>
    <table class="form-table">
        <tr>
            <th>
                <label for="team-team_position"><?php echo __( 'Position', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="team-team_position"><?php echo __( 'Position', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="team-team_position" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $team_position ); ?>" name="team[team_position]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'E.g Director', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="team-team_social_site_1"><?php echo __( 'Social Media Profile Url 1', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="team-team_social_site_1"><?php echo __( 'Social Media Profile Url 1', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="team-team_social_site_1" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $team_social_site_1 ); ?>" name="team[team_social_site_1]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Enter full url, starting with "http"', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="team-team_social_site_2"><?php echo __( 'Social Media Profile Url 2', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="team-team_social_site_2"><?php echo __( 'Social Media Profile Url 2', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="team-team_social_site_2" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $team_social_site_2 ); ?>" name="team[team_social_site_2]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Enter full url, starting with "http"', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="team-team_social_site_3"><?php echo __( 'Social Media Profile Url 3', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="team-team_social_site_3"><?php echo __( 'Social Media Profile Url 3', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="team-team_social_site_3" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $team_social_site_3 ); ?>" name="team[team_social_site_3]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Enter full url, starting with "http"', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="team-team_social_site_4"><?php echo __( 'Social Media Profile Url 4', 'productive-style' ); ?></label>
                <label class="screen-reader-text" for="team-team_social_site_4"><?php echo __( 'Social Media Profile Url 4', 'productive-style' ); ?></label>
            </th>
            <td>
                <div><input id="team-team_social_site_4" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $team_social_site_4 ); ?>" name="team[team_social_site_4]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Enter full url, starting with "http"', 'productive-style' ); ?>
                </div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_style_team_save_meta_box( $post_id, $post ) {
    $team_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_teamnonce'] ) || !wp_verify_nonce( $_POST['_pro_teamnonce'], 'teamnonce' ) ) {
        return $team_post_id;
    }

    $team_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $team_post_type_object->cap->edit_post, $team_post_id ) ) {
        return $team_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $team_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $team_post_id;
    }
    
    if ( isset( $_POST['team'] ) && ! empty( $_POST['team'] ) ) {
        $team_meta_object = array();
        if ( !empty( $_POST['team']['team_position'] ) ) {
            $team_meta_object['team_position'] = sanitize_text_field( $_POST['team']['team_position'] );
        }
        if ( !empty( $_POST['team']['team_social_site_1'] ) ) {
            $team_meta_object['team_social_site_1'] = sanitize_text_field( $_POST['team']['team_social_site_1'] );
        }
        if ( !empty( $_POST['team']['team_social_site_4'] ) ) {
            $team_meta_object['team_social_site_4'] = sanitize_url( $_POST['team']['team_social_site_4'] );
        }
        if ( !empty( $_POST['team']['team_social_site_2'] ) ) {
            $team_meta_object['team_social_site_2'] = sanitize_text_field( $_POST['team']['team_social_site_2'] );
        }
        if ( !empty( $_POST['team']['team_social_site_3'] ) ) {
            $team_meta_object['team_social_site_3'] = sanitize_text_field( $_POST['team']['team_social_site_3'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_META_KEY, $team_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_META_KEY);
    }
    
    return $team_post_id;
}
add_action( 'save_post', 'productive_style_team_save_meta_box', 10, 20 );


function productive_style_team_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Team Member Name', 'productive-style' ),
        'team-team-position'    => __( 'Position', 'productive-style' ),
        'date'    => __( 'Date', 'productive-style' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pro_team_columns', 'productive_style_team_edit_columns' );


function productive_style_team_editable_columns( $column_name, $post_id ) {
    $team_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'team-team-position':
            if ( !empty( $team_meta_object['team_position'] ) ) {
                echo esc_attr( $team_meta_object['team_position'] );
            }
            break;

        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_style_team_editable_columns', 10, 2 );


function productive_style_pro_team_register_taxonomy() {
    $labels = array(
            'name'              => _x( PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL, 'Taxonomy General Name', 'productive-style' ),
            'singular_name'     => _x( PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR, 'Taxonomy Singular Name', 'productive-style' ),
            'search_items'      => __( 'Search ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'all_items'         => __( 'All ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'view_item'         => __( 'View ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'parent_item'       => __( 'Parent', 'productive-style' ),
            'parent_item_colon' => __( 'Parent', 'productive-style' ),
            'edit_item'         => __( 'Edit ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'update_item'       => __( 'Update ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'add_new_item'      => __( 'Add New ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'new_item_name'     => __( 'New ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_SINGULAR . ' Name', 'productive-style' ),
            'not_found'         => __( 'No ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL . ' Found', 'productive-style' ),
            'back_to_items'     => __( 'Back to ' . PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'menu_name'         => __( PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_NAME_PLURAL, 'productive-style' ),
    );
    $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_SLUG ),
            'show_in_rest'      => true,
    );
    
    register_taxonomy( PRODUCTIVE_STYLE_PLUGIN_TEAM_TAXONOMY_SLUG, PRODUCTIVE_STYLE_PLUGIN_TEAM_POST_TYPE_SLUG, $args );
    
}
add_action( 'init', 'productive_style_pro_team_register_taxonomy', 0 );
