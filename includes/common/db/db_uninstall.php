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


/** 
 * Method productive_style_uninstall_db ''.
 */
function productive_style_uninstall_db() {
    
    $options = get_option( 'productive_style_section_integration_options' );
    if ( isset( $options['productive_style_keep_plugin_data_during_uninstall'] )) {
        $productive_style_get_keep_plugin_data_during_uninstall = sanitize_text_field( $options['productive_style_keep_plugin_data_during_uninstall'] );
    } else {
        $productive_style_get_keep_plugin_data_during_uninstall = '';
    }
    if ( empty( $productive_style_get_keep_plugin_data_during_uninstall ) || 'checked' !== $productive_style_get_keep_plugin_data_during_uninstall ) {
        global $wpdb;
        $table_dropables = $wpdb->prefix . PRODUCTIVE_STYLE_DATABASE_NAME;

        $sql = "DROP TABLE IF EXISTS $table_dropables";
        $wpdb->query( $sql );
        
        $option_value_review = sanitize_text_field( $options['productive_style_review_woo_page_list_of_reviews_page'] );
        if( $option_value_review ) {
            wp_delete_post( $option_value_review );
        }
        
        delete_option( PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_DEFAULT_SLUG_VALUE );
        delete_option( 'productive_style_section_integration_options' );
        delete_option( PRODUCTIVE_STYLE_OPTION_EXTRAS_LAST_UPDATE_TIME );
        delete_option('_transient_productive_style');
        delete_option('_transient_timeout_productive_style');
    }
    
    // Check Multisite
    if ( is_multisite() ) {
        // Main plugin version
        delete_site_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY );
    } else {
        // Main plugin version
        delete_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY );
    }
}