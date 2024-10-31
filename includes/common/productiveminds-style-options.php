<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

define( 'PRODUCTIVE_STYLE_FONT_SIZE_STEP', 0.1 );
define( 'PRODUCTIVE_STYLE_FONT_SIZE_MIN', 0.7 );
define( 'PRODUCTIVE_STYLE_FONT_SIZE_MAX', 12 );

define( 'PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_STEP', 0.1 );
define( 'PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_MIN', 1.0 );
define( 'PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_MAX', 5.0 );

function productive_style_customiser_get_font_families() {
    return array(
        '' => __( 'Use Default', 'productive-style' ),
        '--arizonia'            => __( 'Arizonia', 'productive-style' ),
        '--inconsolata'         => __( 'Inconsolata', 'productive-style' ),
        '--indie_flower'        => __( 'Indie Flower', 'productive-style' ),
        '--lato'                => __( 'Lato', 'productive-style' ),
        '--lobster'             => __( 'Lobster', 'productive-style' ),
        '--lobster_two'         => __( 'Lobster Two', 'productive-style' ),
        '--merriweather'        => __( 'Merriweather', 'productive-style' ),
        '--merriweather_sans'   => __( 'Merriweather Sans', 'productive-style' ),
        '--montserrat'          => __( 'Montserrat', 'productive-style' ),
        '--oleo_script'         => __( 'Oleo Script', 'productive-style' ),
        '--opensans'            => __( 'Open Sans', 'productive-style' ),
        '--oswald'              => __( 'Oswald', 'productive-style' ),
        '--poppins'             => __( 'Poppins', 'productive-style' ),
        '--raleway'             => __( 'Raleway', 'productive-style' ),
        '--roboto'              => __( 'Roboto', 'productive-style' ),
        '--roboto_condensed'    => __( 'Roboto Condensed', 'productive-style' ),
        '--tangerine'           => __( 'Tangerine', 'productive-style' ),
    );
}

function productive_style_customiser_get_font_styles() {
    return array(
            '' => __( 'Use Default', 'productive-style' ),
            'normal' => __( 'Normal', 'productive-style' ),
            'italic' => __( 'Italic', 'productive-style' ),
            'oblique' => __( 'Oblique', 'productive-style' ),
        );
}

function productive_style_customiser_get_font_weights() {
    return array(
        '' => __( 'Use Default', 'productive-style' ),
        'normal' => __( 'Normal', 'productive-style' ),
        'bold' => __( 'Bold', 'productive-style' ),
        '100' => __( '100 ', 'productive-style' ),
        '200' => __( '200 ', 'productive-style' ),
        '300' => __( '300 ', 'productive-style' ),
        '400' => __( '400 ', 'productive-style' ),
        '500' => __( '500 ', 'productive-style' ),
        '600' => __( '600 ', 'productive-style' ),
        '700' => __( '700 ', 'productive-style' ),
        '800' => __( '800 ', 'productive-style' ),
        '900' => __( '900 ', 'productive-style' ),
    );
}

function productive_style_customiser_get_font_transforms() {
    return array(
        '' => __( 'Default', 'productive-style' ),
        'lowercase' => __( 'lower case', 'productive-style' ),
        'capitalize' => __( 'Title Case', 'productive-style' ),
        'uppercase' => __( 'UPPER CASE', 'productive-style' ),
    );
}

function productive_style_customiser_get_font_decorations() {
    return array(
        '' => __( 'Default', 'productive-style' ),
        'overline' => __( 'Overline', 'productive-style' ),
        'underline' => __( 'Underline', 'productive-style' ),
        'line-through' => __( 'Line Through', 'productive-style' ),
        'underline_overline' => __( 'Underline and Overline', 'productive-style' ),
    );
}

function productive_style_get_slide_radius_css( $shape = 'sharp_corners' ) {
    $css_radius = '';
    switch ($shape) {
        case 'round_corners':
            $css_radius = '10px';
            break;
        case 'large_round_corners':
            $css_radius = '20px';
            break;
        case 'oval':
            $css_radius = '50%';
            break;
        default:
            $css_radius = '0';
            break;
    }
    return $css_radius;
}

function productive_style_customer_enables() {
    return productive_style_integration_enable_or_disable();
}

function productive_style_integration_enable_or_disable() {
    return array (
        'enabled' => __( 'Enable', 'productive-style' ),
        'disabled' => __( 'Disable', 'productive-style' ),
    );
}

function productive_style_get_button_radius_css( $shape = 'sharp_corners' ) {
    $css_radius = '';
    switch ($shape) {
        case 'round_corners':
            $css_radius = '5px';
            break;
        case 'ellipse':
            $css_radius = '25px';
            break;
        default:
            $css_radius = '0';
            break;
    }
    return $css_radius;
}

function productive_style_get_blog_read_time( $post_content ) {
    $words_read_per_minute = productive_style_words_per_minutes_to_read();
    if( !$words_read_per_minute ) {
        $words_read_per_minute = 200;
    }
    $word_count = str_word_count( $post_content );
    
    $reading_time = $word_count / $words_read_per_minute;
    if( $reading_time < 1 ) {
        $reading_time = 1;
    }
    return intval( $reading_time ) . __(' min read', 'productive-style');
}

function productive_style_customiser_get_button_radius_shapes() {
    return array (
        'sharp_corners' => __( 'Sharp Corners', 'productive-style' ),
        'round_corners' => __( 'Round Corners', 'productive-style' ),
        'ellipse' => __( 'Ellipse', 'productive-style' ),
    );
}

function productive_style_get_post_filter_by_types() {
   return array (
        '' => __( 'Select an Option', 'productive-style' ),
        'latest' => __( 'Latest Posts', 'productive-style' ),
        'related' => __( 'Related Posts', 'productive-style' ),
        'select_a_category' => __( 'Specific Category', 'productive-style' ),
    ); 
}

function productive_style_get_popup_transition_easings() {
    return array (
        '--ease' => __( 'Ease', 'productive-style' ),
        '--ease-in' => __( 'Ease In', 'productive-style' ),
        '--ease-out' => __( 'Ease Out', 'productive-style' ),
        '--ease-in-out' => __( 'Ease In/Out', 'productive-style' ),
        '--linear' => __( 'Linear', 'productive-style' ),
        '--cubic-bezier-1' => __( 'Cubic Bezier Style 1', 'productive-style' ),
        '--cubic-bezier-2' => __( 'Cubic Bezier Style 2', 'productive-style' ),
    );
}

function productive_style_get_popup_transition_directions() {
    return array (
        'slideFromTop' => __( 'Top', 'productive-style' ),
        'slideFromBottom' => __( 'Bottom', 'productive-style' ),
        'slideFromLeft' => __( 'Left', 'productive-style' ),
        'slideFromRight' => __( 'Right', 'productive-style' ),
    );
}

function productive_style_get_list_of_structure_types() {
    return array (
        ''                          => __( 'Select an Option', 'productive-style' ),
        'header'                    => __( 'Header', 'productive-style' ),
        'footer'                    => __( 'Footer', 'productive-style' ),
        'site_home'                 => __( 'Site Homepage', 'productive-style' ),
        'blog_home'                 => __( 'Blog Homepage', 'productive-style' ),
        'blog_single'               => __( 'Blog Single', 'productive-style' ),
        'blog_archive'              => __( 'Blog Archive', 'productive-style' ),
        'search_result_archive'       => __( 'Search Result', 'productive-style' ),
        'product_single_woo'        => __( 'Product Single (WooCommerce)', 'productive-style' ),
        'product_archive_woo'       => __( 'Product Archive (WooCommerce)', 'productive-style' ),
        'search_result'             => __( 'Search Result', 'productive-style' ),
        'product_review_woo_for_page'           => __( 'All Product Reviews', 'productive-style' ),
    );
}

function productive_style_get_list_of_structure_locations() {
    return array (
        ''                          => __( 'Select an Option', 'productive-style' ),
        'blog_single'               => __( 'Blog Single', 'productive-style' ),
        'blog_archive'              => __( 'Blog Archive', 'productive-style' ),
        'product_single_woo'        => __( 'Product Single (WooCommerce)', 'productive-style' ),
        'product_archive_woo'       => __( 'Product Archive (WooCommerce)', 'productive-style' ),
        'search_result'             => __( 'Search Result', 'productive-style' ),
    );
}

function productive_style_get_list_of_pb_structure_starter_templates() {
    return array (
        ''                      => __( 'Select an Option', 'productive-style' ),
        'default'               => __( 'Default', 'productive-style' ),
        'sussex'                => __( 'Sussex', 'productive-style' ),
        'essex'                 => __( 'Essex', 'productive-style' ),
        'london'                => __( 'London', 'productive-style' ),
        'hampshire'             => __( 'Hampshire', 'productive-style' ),
        'mersey'                => __( 'Mersey', 'productive-style' ),
        'midlands'              => __( 'Midlands', 'productive-style' ),
        'kent'                  => __( 'Kent', 'productive-style' ),
        'yorkshire'             => __( 'Kent', 'productive-style' ),
        'buckinghamshire'       => __( 'Kent', 'productive-style' ),
    );
}

function productive_style_get_video_platforms() {
    return array (
        '' => __( 'Select an Option', 'productive-style' ),
        'yt' => __( 'YouTube', 'productive-style' ),
        'vimeo' => __( 'Vimeo (not supported yet - coming soon)', 'productive-style' ),
    );
}


function productive_style_get_video_play_rate_values() {
    return array (
        '0.25' => __( '0.25', 'productive-style' ),
        '0.5' => __( '0.5', 'productive-style' ),
        '0.75' => __( '0.75', 'productive-style' ),
        '1' => __( '1 - Default', 'productive-style' ),
        '1.25' => __( '1.25', 'productive-style' ),
        '1.5' => __( '1.5', 'productive-style' ),
        '1.75' => __( '1.75', 'productive-style' ),
        '2' => __( '2', 'productive-style' ),
    );
}

function productive_style_get_a_product_category_that_have_children() {
    global $wpdb;
    $table = $wpdb->prefix . 'term_taxonomy ';
    $sql = "SELECT * FROM " . $table . " WHERE taxonomy = 'product_cat' AND parent > %1d LIMIT 1";
    $parent_id = 0;
    $items = $wpdb->get_results( $wpdb->prepare($sql, $parent_id), ARRAY_A );
    
    $category_id = 0;
    if( null != $items && !empty($items) ) {
        $category_id = $items[0]['parent'];
    }
    return $category_id;
}

function productive_style_get_default_homepage_element_style() {
    $get_stylesheet = get_stylesheet();
    $homepage_element_style = 'type_1';
    if ( strpos( $get_stylesheet, 'productive-business') !== false ) {
        $homepage_element_style = 'type_3';
    } else if ( strpos( $get_stylesheet, 'productive-ecommerce') !== false ) {
        $homepage_element_style = 'type_1';
    } else if ( strpos( $get_stylesheet, 'stockist') !== false ) {
        $homepage_element_style = 'type_2';
    }
    return $homepage_element_style;
}

function productive_style_get_default_homepage_element_title() {
    $get_stylesheet = get_stylesheet();
    $title = __( 'Welcome To Our Site', 'productive-style' );
    if ( strpos( $get_stylesheet, 'productive-business') !== false ) {
        $title = __( 'Our Services', 'productive-style' );
    } else if ( strpos( $get_stylesheet, 'productive-ecommerce') !== false ) {
        $title = __( 'Welcome To Our Site', 'productive-style' );
    } else if ( strpos( $get_stylesheet, 'stockist') !== false ) {
        $title = __( 'About Us', 'productive-style' );
    }
    return $title;
}

function productive_style_get_default_homepage_element_section_enable_button() {
    $get_stylesheet = get_stylesheet();
    $enable_button = false;
    if ( strpos( $get_stylesheet, 'productive-business') !== false ) {
        $enable_button = true;
    } else if ( strpos( $get_stylesheet, 'productive-ecommerce') !== false ) {
        $enable_button = false;
    } else if ( strpos( $get_stylesheet, 'stockist') !== false ) {
        $enable_button = false;
    }
    return $enable_button;
}
