<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/


/**
* Method for productive_style_render_homepage_hero
*/
function productive_style_render_homepage_hero( $cpt_section_args ) {
    $homepage_hero_type = $cpt_section_args['homepage_hero_type'];
    do_action( 'display_productive_homepage_main_hero', $homepage_hero_type );
}
