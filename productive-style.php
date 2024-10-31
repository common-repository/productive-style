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
 * Plugin Name:       Productive Style
 * Plugin URI:        https://www.productiveminds.com/product/productive-style
 * Description:       Utilize Gutenberg blocks and patterns, Elementor widgets and templates, breadcrumbs, sliders, and various page content such as blog elements, content and video elements, product categories, team members, testimonials, and FAQs.
 * Version:           1.1.18
 * Requires at least: 5.4
 * Requires PHP:      7.0
 * Author:            productiveminds.com
 * Author URI:        https://www.productiveminds.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       productive-style
 * Domain Path:       /languages
 */

if ( !defined('ABSPATH') ) {
    exit;
}
$productive_style_plugin_main_file = __FILE__;
require_once plugin_dir_path( $productive_style_plugin_main_file ) . 'includes/start.php';
