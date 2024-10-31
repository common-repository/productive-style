<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */


function productive_style_section_integration_description_callback() {
    ?>
	<p>
            <h2><?php echo esc_html__( 'General Settings', 'productive-style' ) ?></h2>
            <?php echo esc_html__( 'Settings that affect more than one section of the plugin.', 'productive-style' ); ?>
        </p>
    <?php
}

/* ============ START Section fields ================= */
function productive_style_add_section_integration_fields($productive_style_section_integration_options) {
    
    $args_field_1 = array( 
        'label_for' => 'productive_style_keep_plugin_data_during_uninstall', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_keep_plugin_data_during_uninstall', // field id
        __( 'Preserve data, if plugin is uninstalled?', 'productive-style' ), // Field label
        'productive_style_callback_keep_plugin_data_during_uninstall',
        $productive_style_section_integration_options, 
        'productive_style_section_integration', 
        $args_field_1
    );
    
    if( productive_style_is_extra() ) {
        $args_field_2 = array(
            'label_for' => 'productive_style_review_woo_page_list_of_reviews_page', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_style_review_woo_page_list_of_reviews_page', // field id
            __( 'Product Reviews Page', 'productive-style' ), // Field label
            'productive_style_callback_integration_review_woo_page_list_of_reviews_page',
            $productive_style_section_integration_options, 
            'productive_style_section_integration', 
            $args_field_2
        );
    }
    
    $args_field_3 = array( 
        'label_for' => 'productive_style_words_per_minutes_to_read', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_words_per_minutes_to_read', // field id
        __( 'Blog Reading Speed', 'productive-style' ), // Field label
        'productive_style_callback_words_per_minutes_to_read',
        $productive_style_section_integration_options, 
        'productive_style_section_integration', 
        $args_field_3
    );
    
}

function productive_style_callback_keep_plugin_data_during_uninstall() {
        $options = productive_style_get_section_integration_options_object();
        $productive_style_keep_plugin_data_during_uninstall = '';
        if (isset( $options['productive_style_keep_plugin_data_during_uninstall']) ) {
            $productive_style_keep_plugin_data_during_uninstall = $options['productive_style_keep_plugin_data_during_uninstall'];
        }
    ?>
    <p>
        <input id="productive_style_section_integration_options[productive_style_keep_plugin_data_during_uninstall]" type="checkbox" name="productive_style_section_integration_options[productive_style_keep_plugin_data_during_uninstall]" value="checked" <?php echo checked('checked', $productive_style_keep_plugin_data_during_uninstall, false ); ?> />
        <label for="productive_style_section_integration_options[productive_style_keep_plugin_data_during_uninstall]"><?php echo esc_html__( 'Keep settings and data (do not delete), if this plugin is uninstalled.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_integration_review_woo_page_list_of_reviews_page( $args ) {        
        $options = productive_style_get_section_integration_options_object();
        $productive_style_options_item_value = 'select_an_option';
        if (isset( $options['productive_style_review_woo_page_list_of_reviews_page']) ) {
            $productive_style_options_item_value = $options['productive_style_review_woo_page_list_of_reviews_page'];
        }
        wp_dropdown_pages(
            array(
                'name'              => 'productive_style_section_integration_options[productive_style_review_woo_page_list_of_reviews_page]',
                'echo'              => 1,
                'show_option_none'  => __( 'Select an Option', 'productive-style' ),
                'option_none_value' => 'select_an_option',
                'selected'          => $productive_style_options_item_value,
            )
        );
        ?>
        <p id="settings_section_review_page">
            <?php echo esc_html__( 'Select a page for Reviews. If page does not exist, create a page, then add the "Woo Reviews (Page)" Elementor widget to the page.', 'productive-style' ); ?>
            <br>
            <?php echo esc_html__( 'After changing this option, please go to Settings => Permlinks. Then click "Save Changes".', 'productive-style' ); ?>
        </p>
    <?php
}

function productive_style_callback_words_per_minutes_to_read( $args ) {
        $options = productive_style_get_section_integration_options_object();
        $productive_style_words_per_minutes_to_read = '';
        if (isset( $options['productive_style_words_per_minutes_to_read']) ) {
            $productive_style_words_per_minutes_to_read = $options['productive_style_words_per_minutes_to_read'];
        }
    ?>
    <input type="number" name="productive_style_section_integration_options[productive_style_words_per_minutes_to_read]" value="<?php echo esc_attr( $productive_style_words_per_minutes_to_read ); ?>" size="20" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'Estimated reading speed for Blog visitors (in words per minute)', 'productive-style' ); ?>
    </p>
   <?php
}
// End of option functions

/* ============ END Section fields ================= */
