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

if ( ! class_exists( 'Productive_Style_Customiser_Header_Menu' ) ) {
    
    /**
     * Productive_Style_Customiser_Header_Menu
     * Theme Customiser Class
     */
    class Productive_Style_Customiser_Header_Menu extends Productive_Style_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise param.
         */
        public static function register( $wp_customise ) {
            $panel = '';
            if ( productive_global_is_a_productive_theme() ) {
                $panel = 'productive_theme_style_options_typography';
            } else {
                $panel = 'productive_style_plugin_customizers';
            }
            
            $wp_customise->add_section(
                'productive_style_header_menu_font_typography_options',
                array(
                    'title' => __( 'Top Menu Font', 'productive-style' ),
                    'description' => __( 'Control typography for the top level header menu items.', 'productive-style' ),
                    'panel' => $panel,
                    'priority' => 20,
                    'capability' => 'edit_theme_options',
                )
                );
            
            // add a setting for productive_style_header_menu_font_family control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_font_family',
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
                'productive_style_header_menu_font_family',
                array(
                    'type' => 'select',
                    'priority' => 10,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Font Family', 'productive-style' ),
                    'description' => '',
                    'choices' => productive_style_customiser_get_font_families(),
                )
            );
            
            if ( productive_global_is_a_productive_theme() ) {
                // add a setting for productive_style_header_menu_adjust_the_font_size control, below.
                $wp_customise->add_setting(
                    'productive_style_header_menu_adjust_the_font_size',
                    array(
                        'type' => 'theme_mod',
                        'default' => 0,
                        'theme_supports' => '',
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_absint'),
                    )
                );
                $wp_customise->add_control(
                    'productive_style_header_menu_adjust_the_font_size',
                    array(
                        'type' => 'number',
                        'priority' => 20,
                        'section' => 'productive_style_header_menu_font_typography_options',
                        'label' => __( 'Adjust Font Size (Header Menu)', 'productive-style' ),
                        'description' => __( 'Increases or decreases font size. Default = 0.', 'productive-style' ),
                        'input_attrs' => array(
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ),
                    )
                );
            }
            
            // add a setting for productive_style_header_menu_font_weight control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_font_weight',
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
                'productive_style_header_menu_font_weight',
                array(
                    'type' => 'select',
                    'priority' => 30,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Font Weight', 'productive-style' ),
                    'description' => '',
                    'choices' => productive_style_customiser_get_font_weights(),
                )
            );
            
            // add a setting for productive_style_header_menu_font_style control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_font_style',
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
                'productive_style_header_menu_font_style',
                array(
                    'type' => 'select',
                    'priority' => 40,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Font Style', 'productive-style' ),
                    'description' => '',
                    'choices' => productive_style_customiser_get_font_styles()
                )
            );
            
            // add a setting for productive_style_header_menu_line_height control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_line_height',
                array(
                    'type' => 'theme_mod',
                    'default' => '1.2',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_style_sanitize_float'),
                )
            );
            
            // add control...
            $wp_customise->add_control(
                'productive_style_header_menu_line_height',
                array(
                    'type' => 'number',
                    'priority' => 50,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Line Height', 'productive-style' ),
                    'description' => '',
                    'input_attrs' => array(
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                )
            );
            
            // add a setting for productive_style_header_menu_text_transform control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_text_transform',
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
                'productive_style_header_menu_text_transform',
                array(
                    'type' => 'select',
                    'priority' => 60,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Text Transformation', 'productive-style' ),
                    'description' => '',
                    'choices' => productive_style_customiser_get_font_transforms()
                )
            );
            
            // add a setting for productive_style_header_menu_text_decoration control, below.
            $wp_customise->add_setting(
                'productive_style_header_menu_text_decoration',
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
                'productive_style_header_menu_text_decoration',
                array(
                    'type' => 'select',
                    'priority' => 70,
                    'section' => 'productive_style_header_menu_font_typography_options',
                    'label' => __( 'Text Decoration', 'productive-style' ),
                    'description' => '',
                    'choices' => productive_style_customiser_get_font_decorations()
                )
            );
            
        }
        
        
    } // End of class.
    add_action( 'customize_register', array( 'Productive_Style_Customiser_Header_Menu', 'register' ) );
    
    

    /**
     * Method productive_style_header_menu_font_family.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_font_family( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_font_family', '' );
    }

    /**
     * 
     * Method productive_style_header_menu_adjust_the_font_size.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_adjust_the_font_size() {
        return get_theme_mod( 'productive_style_header_menu_adjust_the_font_size', 0 );
    }

    /**
     * Method productive_style_header_menu_font_weight.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_font_weight( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_font_weight', '' );
    }

    /**
     * Method productive_style_header_menu_font_style.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_font_style( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_font_style', '' );
    }

    /**
     * Method productive_style_header_menu_line_height.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_line_height( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_line_height', '1.2' );
    }

    /**
     * Method productive_style_header_menu_text_transform.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_text_transform( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_text_transform', '' );
    }

    /**
     * Method productive_style_header_menu_text_decoration.
     *
     * @param string $class ''.
     */
    function productive_style_header_menu_text_decoration( $class = '' ) {
        return get_theme_mod( 'productive_style_header_menu_text_decoration', '' );
    }

    
} // End of if class exists
