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


function productive_style_database_upgrade_init() {
    $current_version_in_db = get_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY );
    if ( is_multisite() ) {
        $current_version_in_db = get_site_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY );
    }
    if ( $current_version_in_db  < PRODUCTIVE_STYLE_VERSION ) {
        if( $current_version_in_db == '1.0.2' ) {
           productive_style_taxonomy_upgrade_element_1_0_2();
        }
        if( version_compare($current_version_in_db, '1.0.3', '>=') && version_compare($current_version_in_db, '1.0.8', '<=') ) {
           productive_style_upgrade_to_content_element_1_0_8();
        }
        if( version_compare($current_version_in_db, '1.0.8', '>=') && version_compare($current_version_in_db, '1.1.5', '<=') ) {
            productive_style_upgrade_to_content_element_1_1_6();
        }
        productive_style_database_upgrade();
    }
}
// Enable below when there is an upgrade
add_action( 'plugins_loaded', 'productive_style_database_upgrade_init');

/**
 * Method productive_style_database_upgrade ''.
 */
function productive_style_database_upgrade() {
    if ( is_multisite() ) {
        update_site_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY, PRODUCTIVE_STYLE_VERSION );
    } else {
        update_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY, PRODUCTIVE_STYLE_VERSION );
    }
    
    // Trigger rewrite rule flushing after an update
    update_option( PRODUCTIVE_STYLE_IS_REWRITE_RULE_FLUSHED_KEY, 'no' );
}


/**
 * Rename element name and slug to match new design.
 * Method productive_style_taxonomy_upgrade_element_1_0_2 ''.
 */
function productive_style_taxonomy_upgrade_element_1_0_2() {
    global $wpdb;
    $table = $wpdb->prefix . 'terms';

    $data = array(
        'name' => 'Service Element',
        'slug' => 'service-element',
    );
    $where = array( 'name' => 'Services', 'slug' => 'services' );
    $wpdb->update( $table, $data, $where );
    
    $data_f = array(
        'name' => 'Homepage Element',
        'slug' => 'homepage-element',
    );
    $where_f = array( 'name' => 'Features', 'slug' => 'features' );
    $wpdb->update( $table, $data_f, $where_f );
}


/**
 * upgrade DB accordingly
 */
function productive_style_upgrade_to_content_element_1_0_8() {
    global $wpdb;
    $table_posts = $wpdb->prefix . 'posts';
    $table_postmeta = $wpdb->prefix . 'postmeta';
    $table_term_taxonomy = $wpdb->prefix . 'term_taxonomy';
    
    // Element
    productive_style_upgrade_to_content_element_1_0_8_posts( $wpdb, $table_posts, $table_postmeta, $table_term_taxonomy, 'pro_element', '_pro_element' );
    productive_style_upgrade_to_content_element_1_0_8_meta( $wpdb, $table_posts, 'element_icon', 'url', 'cta_text' );
    
    // Service
    productive_style_upgrade_to_content_element_1_0_8_posts( $wpdb, $table_posts, $table_postmeta, '', 'pro_service', '_pro_service' );
    productive_style_upgrade_to_content_element_1_0_8_meta( $wpdb, $table_posts, 'service_icon', 'service_url', 'service_cta_text' );
}


function productive_style_upgrade_to_content_element_1_0_8_posts( $wpdb, $table_posts, $table_postmeta, $table_term_taxonomy, $post_type, $post_meta ) {
    $data = array(
        'post_type' => PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG,
    );
    $where = array( 'post_type' => $post_type );
    $wpdb->update( $table_posts, $data, $where );
    
    $data_meta = array(
        'meta_key' => PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY,
    );
    $where_meta = array( 'meta_key' => $post_meta );
    $wpdb->update( $table_postmeta, $data_meta, $where_meta ); 
    
    if( '' != $table_term_taxonomy ) {
        $data_term_taxonomy = array(
            'taxonomy' => 'content-element-type',
        );
        $where_term_taxonomy = array( 'taxonomy' => 'element-type' );
        $wpdb->update( $table_term_taxonomy, $data_term_taxonomy, $where_term_taxonomy );
    }
}

function productive_style_upgrade_to_content_element_1_0_8_meta( $wpdb, $table_posts, $element_icon, $url, $cta_text ) {
    $sql = 'SELECT * FROM ' . $table_posts;
    $sql .= ' WHERE post_type = %s' ;
    $posts = $wpdb->get_results( $wpdb->prepare($sql, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_SLUG), ARRAY_A ); 
    if ( 0 < count( $posts ) ) {
        $post_ids = array();
        foreach ( $posts as $post ) {
            $post_ids[] = $post['ID'];
        }
        if ( 0 < count($post_ids) ) {
            foreach ( $post_ids as $post_id ) {
                $element_meta_object = array();
                $productive_cpt_meta_object = get_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY, true );
                if( !empty( $productive_cpt_meta_object[ $element_icon ] ) || !empty( $productive_cpt_meta_object[ $url ] ) ) {
                    if ( !empty( $productive_cpt_meta_object[ $element_icon ] ) ) {
                        $element_meta_object['cpt_icon'] = sanitize_text_field( $productive_cpt_meta_object[ $element_icon ] );
                        unset( $productive_cpt_meta_object[ $element_icon ] );
                    }
                    if ( !empty( $productive_cpt_meta_object[ $url ] ) ) {
                        $element_meta_object['cpt_url'] = sanitize_text_field( $productive_cpt_meta_object[ $url ] );
                        unset( $productive_cpt_meta_object[ $url ] );
                    }
                    if ( !empty( $productive_cpt_meta_object[ $cta_text ] ) ) {
                        $element_meta_object['cpt_url_text'] = sanitize_text_field( $productive_cpt_meta_object[ $cta_text ] );
                        unset( $productive_cpt_meta_object[ $cta_text ] );
                    }
                    update_post_meta( $post_id, PRODUCTIVE_STYLE_PLUGIN_CONTENT_ELEMENT_POST_TYPE_META_KEY, $element_meta_object);
                }
            }
        }
    }
}


function productive_style_upgrade_to_content_element_1_1_6() {
    global $wpdb;
    $table_terms = $wpdb->prefix . 'terms';
    
    $data_terms = array(
        'name' => 'Homepage Elements With Icon',
        'slug' => 'homepage-elements-with-icon',
    );
    $where_terms = array( 'slug' => 'h-e-type1-productive-banner' );
    $wpdb->update( $table_terms, $data_terms, $where_terms );
}
