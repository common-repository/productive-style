<?php
/**
 * Plugin Customiser Base
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

// Load first
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-common.php';

require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-font-headings.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-font-header-menu.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-font-body.php';

require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-breadcrumb.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/customiser/productive-plugin-customiser-homepage-element.php';
