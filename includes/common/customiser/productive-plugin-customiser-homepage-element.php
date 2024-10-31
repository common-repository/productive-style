<?php
/**
 * Theme Customiser
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

if ( ! class_exists( 'Productive_Style_Customiser_Homepage_Element' ) ) {
    
    /**
     * Productive_Style_Customiser_Homepage_Element
     * Theme Customiser Class
     */
    class Productive_Style_Customiser_Homepage_Element extends Productive_Style_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise param.
         */
        public static function register( $wp_customise ) {
            
            // See common for Panels
            // 
            
            if ( productive_global_is_a_productive_theme() ) {
            // Section
                $wp_customise->add_section(
                    'productive_style_homepage_element_section_options',
                    array(
                        'title' => __( 'Homepage Element', 'productive-style' ),
                        'description' => __( 'Options for Homepage Element', 'productive-style' ),
                        'panel' => 'productive_style_theme_options_homepage',
                        'priority' => 80,
                        'capability' => 'edit_theme_options',
                    )
                    );

                // add a setting for productive_style_homepage_element_section_enable control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_enable',
                    array(
                        'type' => 'theme_mod',
                        'default' => true,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_checkbox'),
                    )
                    );
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_enable',
                    array(
                        'type' => 'checkbox',
                        'priority' => 20,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Enable Homepage Element Section?', 'productive-style' ),
                        'description' => __( 'Display homepage element section in the Homepage', 'productive-style' ),
                        // 'active_callback' => 'is_front_page',
                    )
                    );
            
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_type',
                    array(
                        'type' => 'theme_mod',
                        'default' => productive_style_get_default_homepage_element_style(),
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_type',
                    array(
                        'type' => 'select',
                        'priority' => 30,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Select Element type', 'productive-style' ),
                        'description' => '',
                        'choices' => array(
                            'type_1' => __( 'Icons beside content', 'productive-style' ),
                            'type_2' => __( 'Icons above content', 'productive-style' ),
                            'type_3' => __( 'Images above content', 'productive-style' ),
                        ),
                    )
                );

                // add a setting for productive_style_homepage_element_section_icon_color control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_icon_color',
                    array(
                        'type' => 'theme_mod',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'default'              => '#ea3b06',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_color'),
                    )
                );
                $wp_customise->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customise,
                        'productive_style_homepage_element_section_icon_color',
                        array(
                            'priority' => 40,
                            'label' => __( 'Icons Colour', 'productive-style' ),
                            'section' => 'productive_style_homepage_element_section_options',
                        )
                    )
                );

                // add a setting for productive_style_homepage_element_section_title control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_title',
                    array(
                        'type' => 'theme_mod',
                        'default' => productive_style_get_default_homepage_element_title(),
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_no_html'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_title',
                    array(
                        'type' => 'text',
                        'priority' => 50,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Section Title', 'productive-style' ),
                        'description' => __( 'Section Title (e.g Why Shop With Us)', 'productive-style' ),
                    )
                );

                // add a setting for productive_style_homepage_element_section_intro, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_intro',
                    array(
                        'type' => 'theme_mod',
                        'default' => __( 'Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-style' ),
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_html'),
                    )
                    );
                // add control..
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_intro',
                    array(
                        'type' => 'textarea',
                        'priority' => 60,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Intro copy', 'productive-style' ),
                        'description' => __( 'More information to introduce your business', 'productive-style' ),
                    )
                    );

                // add a setting for productive_style_homepage_element_section_num_cols control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_num_cols',
                    array(
                        'type' => 'theme_mod',
                        'default' => 4,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_num_cols',
                    array(
                        'type' => 'number',
                        'priority' => 70,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Number of columns', 'productive-style' ),
                        'description' => __( 'The number of business services to show in a row.', 'productive-style' ),
                        'input_attrs' => array(
                            'min' => 2,
                            'max' => 7,
                            'step' => 1,
                        ),
                    )
                );

                // add a setting for productive_style_homepage_element_section_num_rows control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_element_section_num_rows',
                    array(
                        'type' => 'theme_mod',
                        'default' => '1',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_element_section_num_rows',
                    array(
                        'type' => 'number',
                        'priority' => 80,
                        'section' => 'productive_style_homepage_element_section_options',
                        'label' => __( 'Number of rows', 'productive-style' ),
                        'description' => '',
                        'input_attrs' => array(
                            'min' => 1,
                            'max' => 2,
                            'step' => 1,
                        ),
                    )
                );

            // add a setting for productive_style_homepage_element_section_enable_button control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_element_section_enable_button',
                array(
                    'type' => 'theme_mod',
                    'default' => productive_style_get_default_homepage_element_section_enable_button(),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_checkbox'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_style_homepage_element_section_enable_button',
                array(
                    'type' => 'checkbox',
                    'priority' => 90,
                    'section' => 'productive_style_homepage_element_section_options',
                    'label' => __( 'Display Link Button', 'productive-style' ),
                    'description' => __( 'Display buttons in Homepage Elements', 'productive-style' ),
                    // 'active_callback' => 'is_front_page',
                )
                );
                
            }
        }
        
    } // End of class.
    add_action( 'customize_register', array( 'Productive_Style_Customiser_Homepage_Element', 'register' ) );
    
    
    /**
     * Method productive_style_homepage_element_section_enable.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_enable( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_enable', true);
    }

    /**
     * Method productive_style_homepage_element_section_type.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_type( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_type', productive_style_get_default_homepage_element_style() );
    }

    /**
     * Method productive_style_homepage_element_section_icon_color.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_icon_color( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_icon_color', '#ea3b06' );
    }

    /**
     * Method productive_style_homepage_element_section_title.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_title( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_title', productive_style_get_default_homepage_element_title() );
    }

    /**
     * Method productive_style_homepage_element_section_intro.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_intro( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_intro', esc_html__( 'Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-style' ) );
    }

    /**
     * Method productive_style_homepage_element_section_num_cols.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_num_cols( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_num_cols', 4 );
    }

    /**
     * Method productive_style_homepage_element_section_num_rows.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_num_rows( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_num_rows', 1 );
    }
    /**
     * Method productive_style_homepage_element_section_enable_button.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_element_section_enable_button( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_element_section_enable_button', productive_style_get_default_homepage_element_section_enable_button() );
    }
    
} // End of if class exists
