<?php
/**
 * Plugin Customiser Common
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}


if ( ! class_exists( 'Productive_Style_Customiser_Common' ) ) {
    
    /**
     * Productive_Style_Customiser_Common
     * Theme Customiser Class
     */
    class Productive_Style_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise Param.
         */
        public static function register( $wp_customise ) {
            
            if( function_exists( 'productiveminds_theme_is_active' ) ) {
                // Theme General Options                                        10
                // Theme Homepage Options (either from style plugin or theme)   11
                // Theme Typography Options (from plugin)                       12
                // Theme WooCommerce Options                                    13
                // Panel for productive_style_options
                $panel_title = PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_HOMEPAGE; 
                $panel_desc = esc_html__( 'Customisable Options for', 'productive-style' ) . PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_HOMEPAGE; 
                $wp_customise->add_panel(
                    'productive_style_theme_options_homepage',
                    array(
                        'title' => $panel_title,
                        'description' => $panel_desc,
                        'priority' => 11,
                    )
                );
                
                $panel_title2 = PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_TYPOGRAPHY; 
                $panel_desc2 = esc_html__( 'Customisable Options for', 'productive-style' ) . PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME_CUSTOMIZER_TYPOGRAPHY; 
                $wp_customise->add_panel(
                    'productive_theme_style_options_typography',
                    array(
                        'title' => $panel_title2,
                        'description' => $panel_desc2,
                        'priority' => 12,
                    )
                );
            } else {
                $panel_title3 = 'Productive Style'; 
                $panel_desc3 = esc_html__( 'Customisable Options for Productive Style', 'productive-style' ); 
                $wp_customise->add_panel(
                    'productive_style_plugin_customizers',
                    array(
                        'title' => $panel_title3,
                        'description' => $panel_desc3,
                        'priority' => 15,
                    )
                );
            }
        }
        
        /**
         * Method productive_style_sanitize_checkbox ''.
         *
         * @param boolean $checked ''.
         *
         * @return boolean ''.
         */
        public static function productive_style_sanitize_checkbox( $checked ) {
            return ( ( isset( $checked ) && true == $checked ) ?  true : false );
        }
        
        /**
         * Method productive_style_sanitize_select ''.
         *
         * @param string $input ''.
         * @param object $setting ''.
         *
         * @return string Input or default.
         */
        public static function productive_style_sanitize_select( $input, $setting ) {
            $input = sanitize_key( $input );
            $choices = $setting->manager->get_control( $setting->id )->choices;
            return ( ( array_key_exists( $input, $choices ) ) ? $input : $setting->default );
        }
        
        /**
         * Method productive_style_sanitize_html ''.
         *
         * @param string $html ''.
         *
         * @return string Sanitized version of the $html param.
         */
        public static function productive_style_sanitize_html( $html ) {
            return wp_filter_post_kses( $html );
        }
        
        /**
         * Method productive_style_sanitize_no_html ''.
         *
         * @param string $text ''.
         *
         * @return string ''.
         */
        public static function productive_style_sanitize_no_html( $text ) {
            return wp_filter_nohtml_kses( $text );
        }
        
        /**
         * Method productive_style_sanitize_url ''.
         *
         * @param string $url ''.
         *
         * @return string Sanitized version of the $url param.
         */
        public static function productive_style_sanitize_url( $url ) {
            return esc_url_raw( $url );
        }
        
        /**
         * Method productive_style_sanitize_absint ''.
         *
         * @param int $number ''.
         * @param object $setting ''.
         *
         * @return string Sanitized version of the $number or setting default.
         */
        public static function productive_style_sanitize_absint( $number, $setting ) {
            $number = absint( $number );
            
            return ( $number ? $number : $setting->default );
        }
        
        /**
         * Method productive_style_sanitize_float ''.
         *
         * @param int $value ''.
         * @param object $setting ''.
         *
         * @return string Sanitized version of the $value or setting default.
         */
        public static function productive_style_sanitize_float( $float, $setting ) {
            $value = floatval( $float );
            return ( $value ? $value : $setting->default );
        }
        
        /**
         * Method productive_style_sanitize_image ''.
         *
         * @param string $image ''.
         * @param object $setting ''.
         *
         * @return string ''.
         */
        public static function productive_style_sanitize_image( $image, $setting ) {
            
            $mimes = array(
                'jpg|jpeg|jpe'    => 'image/jpeg',
                'png'             => 'image/png',
                'gif'             => 'image/gif',
                'bmp'             => 'image/bmp',
                'tif/tiff'        => 'image/tiff',
                'ico'             => 'image/x-icon'
            );
            
            $file = wp_check_filetype( $image, $mimes );
            
            if ( null != $file && array_key_exists('ext', $file) ) {
                return $image;
            } else {
                return $setting->default;
            }
            
        }
        
        
        /**
         * Method productive_style_sanitize_color ''.
         *
         * @param string $color ''.
         *
         * @return string ''.
         */
        public static function productive_style_sanitize_color( $color ) {
            if ( 'blank' === $color || empty( trim($color) ) ) {
                return '';
            }
            $color_sani = sanitize_hex_color( $color );
            if ( empty( $color_sani ) ) {
                $color_sani = '#000000';
            }
            return $color_sani;
        }
        
        
    } // end of class.
    
    // add hook for the class.
    add_action( 'customize_register', array( 'Productive_Style_Customiser_Common', 'register' ) );
    
}
