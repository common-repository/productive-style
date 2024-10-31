<?php
/**
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}


if ( ! class_exists( 'Productive_Style_Customiser_Breadcrumb' ) ) { 
    
    /**
     * Productive_Style_Customiser_Breadcrumb
     * Theme Customiser Class
     */
    class Productive_Style_Customiser_Breadcrumb extends Productive_Style_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise param.
         */
        public static function register( $wp_customise ) {
            
            $panel = 'productive_style_plugin_customizers';
            $get_template = get_template();
            if ( strpos( $get_template, 'productive-business') !== false ) {
                $panel = 'productive_business_theme_options';
            } else if ( strpos( $get_template, 'productive-ecommerce') !== false ) {
                $panel = 'productive_ecommerce_theme_options';
            } else if ( strpos( $get_template, 'stockist') !== false ) {
                $panel = 'productive_stockist_theme_options';
            }
            
            if( !empty( $panel ) ) {
                
                $wp_customise->add_section(
                    'productive_style_breadcrumb_options',
                    array(
                        'title' => __( 'Breadcrumb Options', 'productive-style' ),
                        'description' => '',
                        'panel' => $panel,
                        'priority' => 70,
                        'capability' => 'edit_theme_options',
                    )
                    );

                // add a setting for productive_style_breadcrumb_switch_on control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_switch_on',
                    array(
                        'type' => 'theme_mod',
                        'default' => true,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_checkbox'),
                    )
                    );
                // add control..
                $wp_customise->add_control(
                    'productive_style_breadcrumb_switch_on',
                    array(
                        'type' => 'checkbox',
                        'priority' => 10,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Enable Breadcrumb', 'productive-style' ),
                        'description' => '',
                        // 'active_callback' => 'is_front_page',
                    )
                    );

                // add a setting for productive_style_breadcrumb_disable_on_pages control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_disable_on_pages',
                    array(
                        'type' => 'theme_mod',
                        'default' => false,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_checkbox'),
                    )
                    );
                // add control..
                $wp_customise->add_control(
                    'productive_style_breadcrumb_disable_on_pages',
                    array(
                        'type' => 'checkbox',
                        'priority' => 20,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Disable Breadcrumb on Pages', 'productive-style' ),
                        'description' => '',
                        // 'active_callback' => 'is_front_page',
                    )
                    );

                // add a setting for productive_style_breadcrumb_home_icon control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_home_icon',
                    array(
                        'type' => 'theme_mod',
                        'default' => 'left',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_breadcrumb_home_icon',
                    array(
                        'type' => 'select',
                        'priority' => 30,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Display Home icon', 'productive-style' ),
                        'description' => '',
                        'choices' => array(
                            'left' => __( 'Icon on the left', 'productive-style' ),
                            'right' => __( 'Icon on the right', 'productive-style' ),
                            'hide_breadcrumb_icon' => __( 'Hide Home icon', 'productive-style' ),
                        ),
                    )
                );

                // add a setting for productive_style_breadcrumb_home_icon_size control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_home_icon_size',
                    array(
                        'type' => 'theme_mod',
                        'default' => 21,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_absint'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_breadcrumb_home_icon_size',
                    array(
                        'type' => 'number',
                        'priority' => 40,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Breadcrumb Home icon width (px)', 'productive-style' ),
                        'description' => '',
                        'input_attrs' => array(
                            'min' => 5,
                            'max' => 100,
                            'step' => 1,
                        ),
                    )
                );

                // add a setting for productive_style_breadcrumb_home_icon_color control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_home_icon_color',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                    );

                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_home_icon_color',
                        array(
                            'priority' => 50,
                            'label' => __( 'Breadcrumb Home icon color', 'productive-style' ),
                            'section' => 'productive_style_breadcrumb_options',
                        )
                        )
                    );

                // add a setting for productive_style_breadcrumb_separator control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_separator',
                    array(
                        'type' => 'theme_mod',
                        'default' => 'slash',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_breadcrumb_separator',
                    array(
                        'type' => 'select',
                        'priority' => 60,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Item separator', 'productive-style' ),
                        'description' => '',
                        'choices' => array(
                            'slash' => __( 'Slash (/)', 'productive-style' ),
                            'angled' => __( 'Angled bracket (>)', 'productive-style' ),
                            'pipe' => __( 'Pipe (|)', 'productive-style' ),
                            'hyphen' => __( 'Hyplen (-)', 'productive-style' ),
                            'chevron' => __( 'Chevron (>>)', 'productive-style' ),
                            'bullet' => __( 'Bullet (&bull;)', 'productive-style' ),
                        ),
                    )
                );

                // add a setting for productive_style_breadcrumb_text_color control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_text_color',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '#000000',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                    );

                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_text_color',
                        array(
                            'priority' => 70,
                            'label' => __( 'Current page and separator color', 'productive-style' ),
                            'section' => 'productive_style_breadcrumb_options',
                        )
                        )
                    );

                // add a setting for productive_style_breadcrumb_hyperlink_color control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_hyperlink_color',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '#0a47bb',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                    );

                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_hyperlink_color',
                        array(
                            'priority' => 80,
                            'label' => __( 'Breadcrumb hyperlink color', 'productive-style' ),
                            'section' => 'productive_style_breadcrumb_options',
                        )
                        )
                    );

                // add a setting for productive_style_breadcrumb_hyperlink_color_hover control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_hyperlink_color_hover',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '#0761c1',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                    );

                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_hyperlink_color_hover',
                        array(
                            'priority' => 90,
                            'label' => __( 'Breadcrumb hyperlink color (on Hover)', 'productive-style' ),
                            'section' => 'productive_style_breadcrumb_options',
                        )
                        )
                    );

                // add a setting for productive_style_breadcrumb_alignment control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_alignment',
                    array(
                        'type' => 'theme_mod',
                        'default' => 'justify-content-flex-start',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_breadcrumb_alignment',
                    array(
                        'type' => 'select',
                        'priority' => 100,
                        'section' => 'productive_style_breadcrumb_options',
                        'label' => __( 'Breadcrumb Alignment', 'productive-style' ),
                        'description' => '',
                        'choices' => array(
                            'justify-content-flex-start' => __( 'Left', 'productive-style' ),
                            'justify-content-flex-end' => __( 'Right', 'productive-style' ),
                            'justify-content-center' => __( 'Center', 'productive-style' ),
                        ),
                    )
                );

            // add a setting for productive_style_breadcrumb_border_color control, below.
            $wp_customise->add_setting(
                'productive_style_breadcrumb_border_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'   => '#bfdaef',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_style_breadcrumb_border_color',
                    array(
                        'priority' => 110,
                        'label' => __( 'Bottom Border color', 'productive-style' ),
                        'section' => 'productive_style_breadcrumb_options',
                    )
                    )
                );

                // add a setting for productive_style_breadcrumb_bg_color control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_bg_color',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '#f4f8f9',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                    );

                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_bg_color',
                        array(
                            'priority' => 120,
                            'label' => __( 'Breadcrumb background color', 'productive-style' ),
                            'section' => 'productive_style_breadcrumb_options',
                        )
                        )
                    );

                // add a setting for productive_style_breadcrumb_bg_image control, below.
                $wp_customise->add_setting(
                    'productive_style_breadcrumb_bg_image',
                    array(
                        'type' => 'theme_mod',
                        'default' => false,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_image'),
                    )
                    );
                // add control..
                $wp_customise->add_control(
                    new WP_Customize_Media_Control(
                        $wp_customise,
                        'productive_style_breadcrumb_bg_image',
                            array(
                                'priority' => 130,
                                'section' => 'productive_style_breadcrumb_options',
                                'label' => __( 'Breadcrumb background Image', 'productive-style' ),
                                'description' => __( 'If set, the image overrides the background color.', 'productive-style' ),
                            )
                        )
                    );
            }
            // END: MYACCOUNT
            
        }
        
    } // End of class.
    
    // add hook for the class.
    add_action( 'customize_register', array( 'Productive_Style_Customiser_Breadcrumb', 'register' ) );
    
} // End of if class exists



/**
 * Method productive_style_breadcrumb_switch_on.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_switch_on( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_switch_on', true );
}

/**
 * Method productive_style_breadcrumb_disable_on_pages.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_disable_on_pages( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_disable_on_pages', false );
}

/**
 * Method productive_style_breadcrumb_home_icon.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_home_icon( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_home_icon', 'left' );
}

/**
 * 
 * Method productive_style_breadcrumb_home_icon_size.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_home_icon_size( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_home_icon_size', 21 );
}

/**
 * Method productive_style_breadcrumb_home_icon_color.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_home_icon_color( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_home_icon_color', '' );
}

/**
 * Method productive_style_breadcrumb_separator.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_separator( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_separator', 'slash' );
}

/**
 * Method productive_style_breadcrumb_text_color.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_text_color( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_text_color', '#000000' );
}

/**
 * Method productive_style_breadcrumb_hyperlink_color.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_hyperlink_color( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_hyperlink_color', '#0a47bb' );
}

/**
 * Method productive_style_breadcrumb_hyperlink_color_hover.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_hyperlink_color_hover( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_hyperlink_color_hover', '#0761c1' );
}

/**
 * Method productive_style_breadcrumb_alignment.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_alignment( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_alignment', 'justify-content-flex-start' );
}

/**
 * Method productive_style_breadcrumb_border_color.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_border_color( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_border_color', '#bfdaef' );
}

/**
 * Method productive_style_breadcrumb_bg_color.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_bg_color( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_bg_color', '#f4f8f9' );
}

/**
 * Method productive_style_breadcrumb_bg_image.
 *
 * @param string $class ''.
 */
function productive_style_breadcrumb_bg_image( $class = '' ) {
    return get_theme_mod( 'productive_style_breadcrumb_bg_image', false );
}
