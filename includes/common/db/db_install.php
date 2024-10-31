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
 * Method productive_style_database_setup ''.
 */
function productive_style_database_install() {

    // Check Multisite
    if ( is_multisite() ) {
        // Main plugin version
        add_site_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY, PRODUCTIVE_STYLE_VERSION );
    } else {
        // Main plugin version
        add_option( PRODUCTIVE_STYLE_OPTION_VERSION_KEY, PRODUCTIVE_STYLE_VERSION );
    }
    
    // Trigger rewrite rule flushing
    add_option( PRODUCTIVE_STYLE_IS_REWRITE_RULE_FLUSHED_KEY, 'no' );
}
