<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */



function productive_style_register_section_manage_cpts() {
    global $section_manage_cpts_heading;
    // Add Section
    add_settings_section(
        'productive_style_section_manage_cpts',    // Section id
        $section_manage_cpts_heading, // Section heading
        'productive_style_section_manage_cpts_description_callback', // A callback method that displays the section description
        'productive_style_section_manage_cpts_options'   // The menu slug of the page that will display this section
    );
    
    productive_style_add_section_manage_cpts_fields('productive_style_section_manage_cpts_options');
    
    register_setting( 
            'productive_style_section_manage_cpts_options', // Option group (section)
            'productive_style_section_manage_cpts_options',   // Option name (it holds a collection of values of associated field - e.g productive_style_section_manage_cpts_options[field_name])
            'productive_style_register_section_manage_cpts_validate'      // Validate user entry
        );
    
    
    if ( false == productive_style_get_section_manage_cpts_options_object() || empty( productive_style_get_section_manage_cpts_options_object()) ) {
        add_option( 'productive_style_section_manage_cpts_options', apply_filters( 'productive_style_section_manage_cpts_options_init_fields', productive_style_section_manage_cpts_options_init_fields() ) );
    }
    
}

function productive_style_section_manage_cpts_description_callback() {
    ?>
	<p>
            <h2><?php echo esc_html__( 'Manage Custom Post Types', 'productive-style' ) ?></h2>
            <?php echo esc_html__( 'Enable/Disable and customize the Custom Post Types utilized on this website.', 'productive-style' ); ?>
        </p>
    <?php
}

/* ============ START Section fields ================= */
function productive_style_add_section_manage_cpts_fields($productive_style_section_manage_cpts_options) {
    
    $args_field_1a = array(
        'label_for' => 'productive_style_manage_cpts_content_element_heading',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_content_element_heading', // field id
        __( '', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_content_element_menu_visibility_heading',
        $productive_style_section_manage_cpts_options,
        'productive_style_section_manage_cpts',
        $args_field_1a
        );
    
    $args_field_1b = array( 
        'label_for' => 'productive_style_manage_cpts_content_element_enable', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_content_element_enable', // field id
        __( 'Enable Content Elements', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_content_element_menu_visibility_enable',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_1b
    );
    
    $args_field_1c = array( 
        'label_for' => 'productive_style_manage_cpts_content_element_menu_visibility', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_content_element_menu_visibility', // field id
        __( 'Show in Admin Menu?', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_content_element_menu_visibility',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_1c
    );

    
    $args_field_2a = array(
        'label_for' => 'productive_style_manage_cpts_faq_heading',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_faq_heading', // field id
        __( '', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_faq_menu_visibility_heading',
        $productive_style_section_manage_cpts_options,
        'productive_style_section_manage_cpts',
        $args_field_2a
        );
    
    $args_field_2b = array( 
        'label_for' => 'productive_style_manage_cpts_faq_enable', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_faq_enable', // field id
        __( 'Enable FAQs', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_faq_menu_visibility_enable',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_2b
    );
    
    $args_field_2c = array( 
        'label_for' => 'productive_style_manage_cpts_faq_menu_visibility', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_faq_menu_visibility', // field id
        __( 'Show in Admin Menu?', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_faq_menu_visibility',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_2c
    );

    
    $args_field_3a = array(
        'label_for' => 'productive_style_manage_cpts_slider_heading',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_slider_heading', // field id
        __( '', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_slider_menu_visibility_heading',
        $productive_style_section_manage_cpts_options,
        'productive_style_section_manage_cpts',
        $args_field_3a
        );
    
    $args_field_3b = array( 
        'label_for' => 'productive_style_manage_cpts_slider_enable', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_slider_enable', // field id
        __( 'Enable Sliders', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_slider_menu_visibility_enable',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_3b
    );
    
    $args_field_3c = array( 
        'label_for' => 'productive_style_manage_cpts_slider_menu_visibility', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_slider_menu_visibility', // field id
        __( 'Show in Admin Menu?', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_slider_menu_visibility',
        $productive_style_section_manage_cpts_options, 
        'productive_style_section_manage_cpts', 
        $args_field_3c
    );
    
    
    $args_field_4a = array(
        'label_for' => 'productive_style_manage_cpts_team_heading',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_team_heading', // field id
        __( '', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_team_menu_visibility_heading',
        $productive_style_section_manage_cpts_options,
        'productive_style_section_manage_cpts',
        $args_field_4a
        );

    if( productive_global_is_a_productive_extra_theme() || productive_style_is_extra() ) {
        
        $args_field_4b = array( 
            'label_for' => 'productive_style_manage_cpts_team_enable', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_style_manage_cpts_team_enable', // field id
            __( 'Enable Team Members', 'productive-style' ), // Field label
            'productive_style_callback_manage_cpts_team_menu_visibility_enable',
            $productive_style_section_manage_cpts_options, 
            'productive_style_section_manage_cpts', 
            $args_field_4b
        );

        $args_field_4c = array( 
            'label_for' => 'productive_style_manage_cpts_team_menu_visibility', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_style_manage_cpts_team_menu_visibility', // field id
            __( 'Show in Admin Menu?', 'productive-style' ), // Field label
            'productive_style_callback_manage_cpts_team_menu_visibility',
            $productive_style_section_manage_cpts_options, 
            'productive_style_section_manage_cpts', 
            $args_field_4c
        );

    }

    
    $args_field_5a = array(
        'label_for' => 'productive_style_manage_cpts_testimonial_heading',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_style_manage_cpts_testimonial_heading', // field id
        __( '', 'productive-style' ), // Field label
        'productive_style_callback_manage_cpts_testimonial_menu_visibility_heading',
        $productive_style_section_manage_cpts_options,
        'productive_style_section_manage_cpts',
        $args_field_5a
        );
    
    if( productive_global_is_a_productive_extra_theme() || productive_style_is_extra() ) {
        
        $args_field_5b = array( 
            'label_for' => 'productive_style_manage_cpts_testimonial_enable', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_style_manage_cpts_testimonial_enable', // field id
            __( 'Enable Testimonials', 'productive-style' ), // Field label
            'productive_style_callback_manage_cpts_testimonial_menu_visibility_enable',
            $productive_style_section_manage_cpts_options, 
            'productive_style_section_manage_cpts', 
            $args_field_5b
        );

        $args_field_5c = array( 
            'label_for' => 'productive_style_manage_cpts_testimonial_menu_visibility', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_style_manage_cpts_testimonial_menu_visibility', // field id
            __( 'Show in Admin Menu?', 'productive-style' ), // Field label
            'productive_style_callback_manage_cpts_testimonial_menu_visibility',
            $productive_style_section_manage_cpts_options, 
            'productive_style_section_manage_cpts', 
            $args_field_5c
        );
        
    }
    
}



/**
 * 
 * @param type $args
 */
function productive_style_callback_manage_cpts_content_element_menu_visibility_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Content Elements Options', 'productive-style' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Examples of website content by this Post Type include home slider, breadcrumbs, homepage elements, videos elements, banners, clients slides, sponsors slides, grid content, brands slides, awards slides, certificates slides, and product reviews, among others.', 'productive-style' ); ?>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_content_element_menu_visibility_enable() {
        $options = productive_style_get_section_manage_cpts_options_object();
        $productive_style_manage_cpts_content_element_enable = '';
        if (isset( $options['productive_style_manage_cpts_content_element_enable']) ) {
            $productive_style_manage_cpts_content_element_enable = $options['productive_style_manage_cpts_content_element_enable'];
        }
    ?>
    <p>
        <input id="productive_style_section_manage_cpts_options[productive_style_manage_cpts_content_element_enable]" type="checkbox" name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_content_element_enable]" value="checked" <?php echo checked('checked', $productive_style_manage_cpts_content_element_enable, false ); ?> />
        <label for="productive_style_section_manage_cpts_options[productive_style_manage_cpts_content_element_enable]"><?php echo esc_html__( 'Check this box to enable.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_content_element_menu_visibility( $args ) {
    $options = productive_style_get_section_manage_cpts_options_object();
    $productive_style_manage_cpts_content_element_menu_visibility = '';
    if( isset( $options['productive_style_manage_cpts_content_element_menu_visibility'] ) ) {
        $productive_style_manage_cpts_content_element_menu_visibility = $options['productive_style_manage_cpts_content_element_menu_visibility'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_content_element_menu_visibility]">
            <?php
                $productive_style_manage_cpts_content_element_menu_visibility_options = productive_global_get_show_or_hide_options();
                foreach ( $productive_style_manage_cpts_content_element_menu_visibility_options as $key => $productive_style_manage_cpts_content_element_menu_visibility_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_style_manage_cpts_content_element_menu_visibility, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_style_manage_cpts_content_element_menu_visibility_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Show or hide Content Elements as a menu item in WordPress Admin navigation menu.', 'productive-style' ); ?>
        </p>
    <?php
}
    


/**
 * 
 * @param type $args
 */
function productive_style_callback_manage_cpts_faq_menu_visibility_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'FAQs Options', 'productive-style' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Utilize this Custom Post Type to publish Frequently asked Questions (FAQs) on this website.', 'productive-style' ); ?>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_faq_menu_visibility_enable() {
        $options = productive_style_get_section_manage_cpts_options_object();
        $productive_style_manage_cpts_faq_enable = '';
        if (isset( $options['productive_style_manage_cpts_faq_enable']) ) {
            $productive_style_manage_cpts_faq_enable = $options['productive_style_manage_cpts_faq_enable'];
        }
    ?>
    <p>
        <input id="productive_style_section_manage_cpts_options[productive_style_manage_cpts_faq_enable]" type="checkbox" name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_faq_enable]" value="checked" <?php echo checked('checked', $productive_style_manage_cpts_faq_enable, false ); ?> />
        <label for="productive_style_section_manage_cpts_options[productive_style_manage_cpts_faq_enable]"><?php echo esc_html__( 'Check this box to enable.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_faq_menu_visibility( $args ) {
    $options = productive_style_get_section_manage_cpts_options_object();
    $productive_style_manage_cpts_faq_menu_visibility = '';
    if( isset( $options['productive_style_manage_cpts_faq_menu_visibility'] ) ) {
        $productive_style_manage_cpts_faq_menu_visibility = $options['productive_style_manage_cpts_faq_menu_visibility'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_faq_menu_visibility]">
            <?php
                $productive_style_manage_cpts_faq_menu_visibility_options = productive_global_get_show_or_hide_options();
                foreach ( $productive_style_manage_cpts_faq_menu_visibility_options as $key => $productive_style_manage_cpts_faq_menu_visibility_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_style_manage_cpts_faq_menu_visibility, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_style_manage_cpts_faq_menu_visibility_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Show or hide FAQs as a menu item in WordPress Admin navigation menu.', 'productive-style' ); ?>
        </p>
    <?php
}
    


/**
 * 
 * @param type $args
 */
function productive_style_callback_manage_cpts_slider_menu_visibility_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Sliders Options', 'productive-style' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Add and manage homepage slides with the Slider Custom Post Type.', 'productive-style' ); ?>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_slider_menu_visibility_enable() {
        $options = productive_style_get_section_manage_cpts_options_object();
        $productive_style_manage_cpts_slider_enable = '';
        if (isset( $options['productive_style_manage_cpts_slider_enable']) ) {
            $productive_style_manage_cpts_slider_enable = $options['productive_style_manage_cpts_slider_enable'];
        }
    ?>
    <p>
        <input id="productive_style_section_manage_cpts_options[productive_style_manage_cpts_slider_enable]" type="checkbox" name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_slider_enable]" value="checked" <?php echo checked('checked', $productive_style_manage_cpts_slider_enable, false ); ?> />
        <label for="productive_style_section_manage_cpts_options[productive_style_manage_cpts_slider_enable]"><?php echo esc_html__( 'Check this box to enable.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_slider_menu_visibility( $args ) {
    $options = productive_style_get_section_manage_cpts_options_object();
    $productive_style_manage_cpts_slider_menu_visibility = '';
    if( isset( $options['productive_style_manage_cpts_slider_menu_visibility'] ) ) {
        $productive_style_manage_cpts_slider_menu_visibility = $options['productive_style_manage_cpts_slider_menu_visibility'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_slider_menu_visibility]">
            <?php
                $productive_style_manage_cpts_slider_menu_visibility_options = productive_global_get_show_or_hide_options();
                foreach ( $productive_style_manage_cpts_slider_menu_visibility_options as $key => $productive_style_manage_cpts_slider_menu_visibility_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_style_manage_cpts_slider_menu_visibility, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_style_manage_cpts_slider_menu_visibility_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Show or hide Sliders as a menu item in WordPress Admin navigation menu.', 'productive-style' ); ?>
        </p>
    <?php
}
    


/**
 * 
 * @param type $args
 */
function productive_style_callback_manage_cpts_team_menu_visibility_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Team Members Options', 'productive-style' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Generate and publish Team member profiles with this Custom Post Type.', 'productive-style' ); ?>
    </p>
    <?php if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) { ?>
        <?php _e('Team Members is a Pro feature. Either upgrade your theme or ', 'productive-style'); ?>
        <a style="text-decoration: none !important" target="_blank" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_FEATURES_OR_BUY_URL; ?>">
            <?php echo __('upgrade to ', 'productive-style') . PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME; ?> <?php _e(' Pro', 'productive-style'); ?>
        </a>
    <?php } ?>
   <?php
}

function productive_style_callback_manage_cpts_team_menu_visibility_enable() {
        $options = productive_style_get_section_manage_cpts_options_object();
        $productive_style_manage_cpts_team_enable = '';
        if (isset( $options['productive_style_manage_cpts_team_enable']) ) {
            $productive_style_manage_cpts_team_enable = $options['productive_style_manage_cpts_team_enable'];
        }
    ?>
    <p>
        <input id="productive_style_section_manage_cpts_options[productive_style_manage_cpts_team_enable]" type="checkbox" name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_team_enable]" value="checked" <?php echo checked('checked', $productive_style_manage_cpts_team_enable, false ); ?> />
        <label for="productive_style_section_manage_cpts_options[productive_style_manage_cpts_team_enable]"><?php echo esc_html__( 'Check this box to enable.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_team_menu_visibility( $args ) {
    $options = productive_style_get_section_manage_cpts_options_object();
    $productive_style_manage_cpts_team_menu_visibility = '';
    if( isset( $options['productive_style_manage_cpts_team_menu_visibility'] ) ) {
        $productive_style_manage_cpts_team_menu_visibility = $options['productive_style_manage_cpts_team_menu_visibility'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_team_menu_visibility]">
            <?php
                $productive_style_manage_cpts_team_menu_visibility_options = productive_global_get_show_or_hide_options();
                foreach ( $productive_style_manage_cpts_team_menu_visibility_options as $key => $productive_style_manage_cpts_team_menu_visibility_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_style_manage_cpts_team_menu_visibility, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_style_manage_cpts_team_menu_visibility_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Show or hide Team Members as a menu item in WordPress Admin navigation menu.', 'productive-style' ); ?>
        </p>
    <?php
}
    


/**
 * 
 * @param type $args
 */
function productive_style_callback_manage_cpts_testimonial_menu_visibility_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Testimonials Options', 'productive-style' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Use this Custom Post Type to publish Testimonials.', 'productive-style' ); ?>
    </p>
    <?php if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) { ?>
        <?php _e('Testimonials is a Pro feature. Either upgrade your theme or ', 'productive-style'); ?>
        <a style="text-decoration: none !important" target="_blank" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_FEATURES_OR_BUY_URL; ?>">
            <?php echo __('upgrade to ', 'productive-style') . PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME; ?> <?php _e(' Pro', 'productive-style'); ?>
        </a>
    <?php } ?>
   <?php
}

function productive_style_callback_manage_cpts_testimonial_menu_visibility_enable() {
        $options = productive_style_get_section_manage_cpts_options_object();
        $productive_style_manage_cpts_testimonial_enable = '';
        if (isset( $options['productive_style_manage_cpts_testimonial_enable']) ) {
            $productive_style_manage_cpts_testimonial_enable = $options['productive_style_manage_cpts_testimonial_enable'];
        }
    ?>
    <p>
        <input id="productive_style_section_manage_cpts_options[productive_style_manage_cpts_testimonial_enable]" type="checkbox" name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_testimonial_enable]" value="checked" <?php echo checked('checked', $productive_style_manage_cpts_testimonial_enable, false ); ?> />
        <label for="productive_style_section_manage_cpts_options[productive_style_manage_cpts_testimonial_enable]"><?php echo esc_html__( 'Check this box to enable.', 'productive-style' ); ?></label>
    </p>
   <?php
}

function productive_style_callback_manage_cpts_testimonial_menu_visibility( $args ) {
    $options = productive_style_get_section_manage_cpts_options_object();
    $productive_style_manage_cpts_testimonial_menu_visibility = '';
    if( isset( $options['productive_style_manage_cpts_testimonial_menu_visibility'] ) ) {
        $productive_style_manage_cpts_testimonial_menu_visibility = $options['productive_style_manage_cpts_testimonial_menu_visibility'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_style_section_manage_cpts_options[productive_style_manage_cpts_testimonial_menu_visibility]">
            <?php
                $productive_style_manage_cpts_testimonial_menu_visibility_options = productive_global_get_show_or_hide_options();
                foreach ( $productive_style_manage_cpts_testimonial_menu_visibility_options as $key => $productive_style_manage_cpts_testimonial_menu_visibility_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_style_manage_cpts_testimonial_menu_visibility, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_style_manage_cpts_testimonial_menu_visibility_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Show or hide Testimonials as a menu item in WordPress Admin navigation menu.', 'productive-style' ); ?>
        </p>
    <?php
}

// End of option functions

/* ============ END Section fields ================= */



function productive_style_get_section_manage_cpts_options_object() {
    $options = get_option( 'productive_style_section_manage_cpts_options' );
    return $options;
}


function productive_style_register_section_manage_cpts_validate( $section_inputs ) {
    
    $validated_values = array();
    
    foreach ( $section_inputs as $key => $input ) {
        if ( isset($section_inputs[$key]) ) {
            $validated_values[$key] = productive_style_get_validate_input_default($input);
        }
    }
    
    return apply_filters('productive_style_register_section_manage_cpts_validate', $validated_values, $section_inputs);
}


function productive_style_section_manage_cpts_options_init_fields() {
    $default_review_woo_page_landing_page = get_option(PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_DEFAULT_SLUG_VALUE);
    $review_woo_page_page_id = 0;
    if( !empty($default_review_woo_page_landing_page) ) {
        $review_woo_page_page = get_page_by_path($default_review_woo_page_landing_page);
        if( null != $review_woo_page_page ) {
            $review_woo_page_page_id = $review_woo_page_page->ID;
        }
    }
    
    $checked_team = '';
    $checked_testimonial = '';
    if( productive_style_is_extra() ) {
        $checked_team = 'checked';
        $checked_testimonial = 'checked';
    }
    $default_fields_values = array(
        'productive_style_manage_cpts_content_element_enable'                       => 'checked',
        'productive_style_manage_cpts_content_element_menu_visibility'              => 1,
        'productive_style_manage_cpts_faq_enable'                                   => 'checked',
        'productive_style_manage_cpts_faq_menu_visibility'                          => 0,
        'productive_style_manage_cpts_slider_enable'                                => 'checked',
        'productive_style_manage_cpts_slider_menu_visibility'                       => 1,
        'productive_style_manage_cpts_team_enable'                                  => $checked_team,
        'productive_style_manage_cpts_team_menu_visibility'                         => 0,
        'productive_style_manage_cpts_testimonial_enable'                           => $checked_testimonial,
        'productive_style_manage_cpts_testimonial_menu_visibility'                  => 0,
    );
    return apply_filters( 'productive_style_section_manage_cpts_options_init_fields', $default_fields_values );
}


// Gets



/**
 * Method productive_style_manage_cpts_content_element_enable.
 */
function productive_style_manage_cpts_content_element_enable() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = 1;
    if ( isset( $options['productive_style_manage_cpts_content_element_enable'] ) && 'checked' == $options['productive_style_manage_cpts_content_element_enable'] ) {
        $option_value = 1;
    } else {
        $option_value = 0;
    }
    return $option_value;
}

/**
 * Method productive_style_manage_cpts_content_element_menu_visibility.
 */
function productive_style_manage_cpts_content_element_menu_visibility() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = true;
    if ( isset( $options['productive_style_manage_cpts_content_element_menu_visibility'] )) {
        $option_value_raw = sanitize_text_field( $options['productive_style_manage_cpts_content_element_menu_visibility'] );
        if( '1' == $option_value_raw ) {
            $option_value = true;
        } else {
            $option_value = false;
        }
    }
    return $option_value;
}


/**
 * Method productive_style_manage_cpts_faq_enable.
 */
function productive_style_manage_cpts_faq_enable() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = 1;
    if ( isset( $options['productive_style_manage_cpts_faq_enable'] ) && 'checked' == $options['productive_style_manage_cpts_faq_enable'] ) {
        $option_value = 1;
    } else {
        $option_value = 0;
    }
    return $option_value;
}

/**
 * Method productive_style_manage_cpts_faq_menu_visibility.
 */
function productive_style_manage_cpts_faq_menu_visibility() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = false;
    if ( isset( $options['productive_style_manage_cpts_faq_menu_visibility'] )) {
        $option_value_raw = sanitize_text_field( $options['productive_style_manage_cpts_faq_menu_visibility'] );
        if( '1' == $option_value_raw ) {
            $option_value = true;
        } else {
            $option_value = false;
        }
    }
    return $option_value;
}


/**
 * Method productive_style_manage_cpts_slider_enable.
 */
function productive_style_manage_cpts_slider_enable() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = 1;
    if ( isset( $options['productive_style_manage_cpts_slider_enable'] ) && 'checked' == $options['productive_style_manage_cpts_slider_enable'] ) {
        $option_value = 1;
    } else {
        $option_value = 0;
    }
    return $option_value;
}

/**
 * Method productive_style_manage_cpts_slider_menu_visibility.
 */
function productive_style_manage_cpts_slider_menu_visibility() {
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = true;
    if ( isset( $options['productive_style_manage_cpts_slider_menu_visibility'] )) {
        $option_value_raw = sanitize_text_field( $options['productive_style_manage_cpts_slider_menu_visibility'] );
        if( '1' == $option_value_raw ) {
            $option_value = true;
        } else {
            $option_value = false;
        }
    }
    return $option_value;
}


/**
 * Method productive_style_manage_cpts_team_enable.
 */
function productive_style_manage_cpts_team_enable() {
    
    if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) {
        return 0;
    }
    
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = 1;
    if ( isset( $options['productive_style_manage_cpts_team_enable'] ) && 'checked' == $options['productive_style_manage_cpts_team_enable'] ) {
        $option_value = 1;
    } else {
        $option_value = 0;
    }
    return $option_value;
}

/**
 * Method productive_style_manage_cpts_team_menu_visibility.
 */
function productive_style_manage_cpts_team_menu_visibility() {
    
    if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) {
        return false;
    }
    
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = false;
    if ( isset( $options['productive_style_manage_cpts_team_menu_visibility'] )) {
        $option_value_raw = sanitize_text_field( $options['productive_style_manage_cpts_team_menu_visibility'] );
        if( '1' == $option_value_raw ) {
            $option_value = true;
        } else {
            $option_value = false;
        }
    }
    return $option_value;
}


/**
 * Method productive_style_manage_cpts_testimonial_enable.
 */
function productive_style_manage_cpts_testimonial_enable() {
    
    if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) {
        return 0;
    }
    
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = 1;
    if ( isset( $options['productive_style_manage_cpts_testimonial_enable'] ) && 'checked' == $options['productive_style_manage_cpts_testimonial_enable'] ) {
        $option_value = 1;
    } else {
        $option_value = 0;
    }
    return $option_value;
}

/**
 * Method productive_style_manage_cpts_testimonial_menu_visibility.
 */
function productive_style_manage_cpts_testimonial_menu_visibility() {
    
    if( !productive_global_is_a_productive_extra_theme() && !productive_style_is_extra() ) {
        return false;
    }
    
    $options = productive_style_get_section_manage_cpts_options_object();
    $option_value = false;
    if ( isset( $options['productive_style_manage_cpts_testimonial_menu_visibility'] )) {
        $option_value_raw = sanitize_text_field( $options['productive_style_manage_cpts_testimonial_menu_visibility'] );
        if( '1' == $option_value_raw ) {
            $option_value = true;
        } else {
            $option_value = false;
        }
    }
    return $option_value;
}
