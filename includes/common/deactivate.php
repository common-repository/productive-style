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
 * Method productive_style_deactivate ''.
 */
function productive_style_deactivate() {
    productive_style_deactivate_actions();
    productive_style_flush_rewrite_rule();
}

/**
 * Method productive_style_deactivate_actions ''.
 */
function productive_style_deactivate_actions() {
    delete_option( PRODUCTIVE_STYLE_APL_NAME );
    delete_option( PRODUCTIVE_STYLE_OPTION_EXTRAS_KEY );
    delete_option( PRODUCTIVE_STYLE_OPTION_EXTRAS_LAST_UPDATE_TIME );
    delete_option('_transient_productive_style');
    delete_option('_transient_timeout_productive_style');
}

/**
 * Method productive_style_flush_rewrite_rule ''.
 */
function productive_style_flush_rewrite_rule() {
    flush_rewrite_rules();
    delete_option( PRODUCTIVE_STYLE_IS_REWRITE_RULE_FLUSHED_KEY );
}
