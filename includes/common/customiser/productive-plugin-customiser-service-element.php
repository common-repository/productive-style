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

if ( ! class_exists( 'Productive_Style_Customiser_Service_Element' ) ) {
    
    /**
     * Productive_Style_Customiser_Service_Element
     * Theme Customiser Class
     */
    class Productive_Style_Customiser_Service_Element extends Productive_Style_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise param.
         */
        public static function register( $wp_customise ) {
            
            // See common for Panels
            // 
            
            if ( function_exists( 'productive_business_is_active' ) ) {
                
            // Section
            $wp_customise->add_section(
                'productive_style_homepage_service_element_section_options',
                array(
                    'title' => __( 'Business Services', 'productive-style' ),
                    'description' => __( 'Options for Homepage Business Services', 'productive-style' ),
                    'panel' => 'productive_style_theme_options_homepage',
                    'priority' => 90,
                    'capability' => 'edit_theme_options',
                )
                );
            
            // add a setting for productive_style_homepage_service_element_section_enable control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_enable',
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
                'productive_style_homepage_service_element_section_enable',
                array(
                    'type' => 'checkbox',
                    'priority' => 20,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Enable Business Services Section?', 'productive-style' ),
                    'description' => __( 'Display service_element_section products section in the Homepage', 'productive-style' ),
                    // 'active_callback' => 'is_front_page',
                )
                );
            
            // add a setting for productive_style_homepage_service_element_section_icon_color control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_icon_color',
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
                    'productive_style_homepage_service_element_section_icon_color',
                    array(
                        'priority' => 30,
                        'label' => __( 'Icons Colour', 'productive-style' ),
                        'section' => 'productive_style_homepage_service_element_section_options',
                    )
                )
            );
            
            // add a setting for productive_style_homepage_service_element_section_title control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_title',
                array(
                    'type' => 'theme_mod',
                    'default' => __( 'Our Services', 'productive-style' ),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_no_html'),
                )
            );
            $wp_customise->add_control(
                'productive_style_homepage_service_element_section_title',
                array(
                    'type' => 'text',
                    'priority' => 32,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Section Title', 'productive-style' ),
                    'description' => __( 'Section Title (e.g Why Shop With Us)', 'productive-style' ),
                )
            );
            
            // add a setting for productive_style_homepage_service_element_section_intro, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_intro',
                array(
                    'type' => 'theme_mod',
                    'default' => __( 'We are the No 1 site for our business. Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'productive-style' ),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_html'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_style_homepage_service_element_section_intro',
                array(
                    'type' => 'textarea',
                    'priority' => 40,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Intro copy', 'productive-style' ),
                    'description' => __( 'More information to introduce your business', 'productive-style' ),
                )
                );
            
            // add a setting for productive_style_homepage_service_element_section_num_cols control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_num_cols',
                array(
                    'type' => 'theme_mod',
                    'default' => 3,
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                )
            );
            $wp_customise->add_control(
                'productive_style_homepage_service_element_section_num_cols',
                array(
                    'type' => 'number',
                    'priority' => 50,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Number of columns', 'productive-style' ),
                    'description' => __( 'The number of business services to show in a row.', 'productive-style' ),
                    'input_attrs' => array(
                        'min' => 2,
                        'max' => 7,
                        'step' => 1,
                    ),
                )
            );
            
            // add a setting for productive_style_homepage_service_element_section_num_rows control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_num_rows',
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
                'productive_style_homepage_service_element_section_num_rows',
                array(
                    'type' => 'number',
                    'priority' => 60,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Number of rows', 'productive-style' ),
                    'description' => '',
                    'input_attrs' => array(
                        'min' => 1,
                        'max' => 2,
                        'step' => 1,
                    ),
                )
            );
            
            /*
            // add a setting for productive_style_homepage_service_element_section_order control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_order',
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
                'productive_style_homepage_service_element_section_order',
                array(
                    'type' => 'number',
                    'priority' => 70,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Section Position', 'productive-style' ),
                    'description' => __( 'Section with lowest position is placed at the top of the page.', 'productive-style' ),
                    'input_attrs' => array(
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ),
                )
            );
             */
            
            if (function_exists( 'productive_style_extra_is_active' ) ) {
                // add a setting for productive_style_homepage_service_element_section_enable_button control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_enable_button',
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
                    'productive_style_homepage_service_element_section_enable_button',
                    array(
                        'type' => 'checkbox',
                        'priority' => 80,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Show Buttons', 'productive-style' ),
                        'description' => __( 'Display buttons (CTAs linking services urls) in each box', 'productive-style' ),
                        // 'active_callback' => 'is_front_page',
                    )
                    );


                // add a setting for productive_style_homepage_service_element_section_button_shape control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_button_shape',
                    array(
                        'type' => 'theme_mod',
                        'default' => 'ellipse',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_button_shape',
                    array(
                        'type' => 'select',
                        'priority' => 82,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'CTA Buttons Shape', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_button_radius_shapes(),
                    )
                );

                            // add a setting for productive_style_homepage_service_element_section_button_font_color control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_button_font_color',
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
                        'productive_style_homepage_service_element_section_button_font_color',
                        array(
                            'priority' => 90,
                            'label' => __( 'Buttons Text Colour', 'productive-style' ),
                            'section' => 'productive_style_homepage_service_element_section_options',
                        )
                        )
                    );

                // add a setting for productive_style_homepage_service_element_section_button_bg_color control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_button_bg_color',
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
                        'productive_style_homepage_service_element_section_button_bg_color',
                        array(
                            'priority' => 100,
                            'label' => __( 'Buttons Background Color', 'productive-style' ),
                            'section' => 'productive_style_homepage_service_element_section_options',
                        )
                        )
                    );
            
                // add a setting for productive_style_homepage_service_element_section_font_family control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_font_family',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 110,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Font Family', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_font_families(),
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_font_style control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_font_style',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_font_style',
                    array(
                        'type' => 'select',
                        'priority' => 120,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Font Style', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_font_styles()
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_font_size control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_font_size',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_font_size', 
                    array(
                        'type' => 'number',
                        'priority' => 130,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Font Size (rem)', 'productive-style' ),
                        'description' => __( 'This size is scaled relatively across the various elements of the website.', 'productive-style' ),
                        'input_attrs' => array(
                            'min' => PRODUCTIVE_STYLE_FONT_SIZE_MIN,
                            'max' => PRODUCTIVE_STYLE_FONT_SIZE_MAX,
                            'step' => PRODUCTIVE_STYLE_FONT_SIZE_STEP,
                        ),
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_font_weight control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_font_weight',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_font_weight',
                    array(
                        'type' => 'select',
                        'priority' => 140,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Font Weight', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_font_weights(),
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_line_height control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_line_height',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_line_height',
                    array(
                        'type' => 'number',
                        'priority' => 150,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Line Height', 'productive-style' ),
                        'description' => '',
                        'input_attrs' => array(
                            'min' => PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_MIN,
                            'max' => PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_MAX,
                            'step' => PRODUCTIVE_STYLE_LINE_HEIGHT_SIZE_STEP,
                        ),
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_text_transform control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_text_transform',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_text_transform',
                    array(
                        'type' => 'select',
                        'priority' => 160,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Text Transformation', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_font_transforms()
                    )
                );

                // add a setting for productive_style_homepage_service_element_section_text_decoration control, below.
                $wp_customise->add_setting(
                    'productive_style_homepage_service_element_section_text_decoration',
                    array(
                        'type' => 'theme_mod',
                        'default' => '',
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                    )
                );
                // add control...
                $wp_customise->add_control(
                    'productive_style_homepage_service_element_section_text_decoration',
                    array(
                        'type' => 'select',
                        'priority' => 170,
                        'section' => 'productive_style_homepage_service_element_section_options',
                        'label' => __( 'Text Decoration', 'productive-style' ),
                        'description' => '',
                        'choices' => productive_style_customiser_get_font_decorations()
                    )
                );
            }
            /*
            // add a setting for productive_style_homepage_service_element_section_bg_color control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_bg_color',
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
                    'productive_style_homepage_service_element_section_bg_color',
                    array(
                        'priority' => 180,
                        'label' => __( 'Background Colour', 'productive-style' ),
                        'section' => 'productive_style_homepage_service_element_section_options',
                    )
                )
            );
            
            
            // add a setting for productive_style_homepage_service_element_section_style control, below.
            $wp_customise->add_setting(
                'productive_style_homepage_service_element_section_style',
                array(
                    'type' => 'theme_mod',
                    'default' => 'style_1',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_style_homepage_service_element_section_style',
                array(
                    'type' => 'select',
                    'priority' => 190,
                    'section' => 'productive_style_homepage_service_element_section_options',
                    'label' => __( 'Layout Style', 'productive-style' ),
                    'description' => '',
                    'choices' => array (
                        'style_1' => __( 'Style 1', 'productive-style' ),
                        'style_2' => __( 'Style 2', 'productive-style' ),
                    )
                )
            );
            */
            }
        }
        
        
    } // End of class.
    add_action( 'customize_register', array( 'Productive_Style_Customiser_Service_Element', 'register' ) );
    
    
    /**
     * Method productive_style_homepage_service_element_section_enable.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_enable( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_enable', true);
    }

    /**
     * Method productive_style_homepage_service_element_section_icon_color.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_icon_color( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_icon_color', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_title.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_title( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_title', esc_html__( 'Our Services', 'productive-style' ) );
    }

    /**
     * Method productive_style_homepage_service_element_section_intro.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_intro( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_intro', esc_html__( 'We are the No 1 site for our business. Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'productive-style' ) );
    }

    /**
     * Method productive_style_homepage_service_element_section_num_cols.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_num_cols( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_num_cols', 3 );
    }

    /**
     * Method productive_style_homepage_service_element_section_num_rows.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_num_rows( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_num_rows', 1 );
    }

    /**
     * Method productive_style_homepage_service_element_section_order.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_order( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_order', 1 );
    }

    /**
     * Method productive_style_homepage_service_element_section_enable_button.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_enable_button( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_enable_button', 1 );
    }


    /**
     * Method productive_style_homepage_service_element_section_button_shape.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_button_shape( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_button_shape', 'ellipse' );
    }
    /**
     * Method productive_style_homepage_service_element_section_button_font_color.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_button_font_color( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_button_font_color', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_button_bg_color.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_button_bg_color( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_button_bg_color', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_font_family.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_font_family( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_font_family', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_font_style.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_font_style( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_font_style', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_font_size.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_font_size( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_font_size', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_font_weight.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_font_weight( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_font_weight', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_line_height.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_line_height( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_line_height', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_text_transform.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_text_transform( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_text_transform', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_text_decoration.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_text_decoration( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_text_decoration', '' );
    }
    
    /**
     * Method productive_style_homepage_service_element_section_bg_color.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_bg_color( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_bg_color', '' );
    }

    /**
     * Method productive_style_homepage_service_element_section_style.
     *
     * @param string $class ''.
     */
    function productive_style_homepage_service_element_section_style( $class = '' ) {
        return get_theme_mod( 'productive_style_homepage_service_element_section_style', '' );
    }
    
} // End of if class exists
