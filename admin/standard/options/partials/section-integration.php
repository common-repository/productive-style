<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */



function productive_style_register_section_integration() {
    global $section_integration_heading;
    // Add Section
    add_settings_section(
        'productive_style_section_integration',    // Section id
        $section_integration_heading, // Section heading
        'productive_style_section_integration_description_callback', // A callback method that displays the section description
        'productive_style_section_integration_options'   // The menu slug of the page that will display this section
    );
    
    productive_style_add_section_integration_fields('productive_style_section_integration_options');
    
    register_setting( 
            'productive_style_section_integration_options', // Option group (section)
            'productive_style_section_integration_options',   // Option name (it holds a collection of values of associated field - e.g productive_style_section_integration_options[field_name])
            'productive_style_register_section_integration_validate'      // Validate user entry
        );
    
    
    if ( false == productive_style_get_section_integration_options_object() || empty( productive_style_get_section_integration_options_object()) ) {
        add_option( 'productive_style_section_integration_options', apply_filters( 'productive_style_section_integration_options_init_fields', productive_style_section_integration_options_init_fields() ) );
    }
    
}

// part template include
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/common/options/partials/part-section-integration.php'; 

function productive_style_get_section_integration_options_object() {
    $options = get_option( 'productive_style_section_integration_options' );
    return $options;
}


function productive_style_register_section_integration_validate( $section_inputs ) {
    
    $validated_values = array();
    
    foreach ( $section_inputs as $key => $input ) {
        if ( isset($section_inputs[$key]) ) {
            $validated_values[$key] = productive_style_get_validate_input_default($input);
        }
    }
    
    return apply_filters('productive_style_register_section_integration_validate', $validated_values, $section_inputs);
}


function productive_style_section_integration_options_init_fields() {
    $default_fields_values = array(
        'productive_style_keep_plugin_data_during_uninstall'                    => 'checked',
        'productive_style_words_per_minutes_to_read'                            => 200,
    );
    return apply_filters( 'productive_style_section_integration_options_init_fields', $default_fields_values );
}


// Gets

/**
 * Method productive_style_keep_plugin_data_during_uninstall.
 */
function productive_style_keep_plugin_data_during_uninstall() {
    $options = productive_style_get_section_integration_options_object();
    if ( isset( $options['productive_style_keep_plugin_data_during_uninstall'] )) {
        $option_value = sanitize_text_field( $options['productive_style_keep_plugin_data_during_uninstall'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_style_words_per_minutes_to_read.
 */
function productive_style_words_per_minutes_to_read() {
    $options = productive_style_get_section_integration_options_object();
    if ( isset( $options['productive_style_words_per_minutes_to_read'] )) {
        $option_value = sanitize_text_field( $options['productive_style_words_per_minutes_to_read'] );
    } else {
        $option_value = 200;
    }
    return $option_value;
}
