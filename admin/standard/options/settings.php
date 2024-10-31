<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( !defined('ABSPATH') ) {
	die();
}
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'includes/common/validate-verify-process.php';

require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/common/options/global/global-settings-admin.php';

require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/common/options/partials/section-about.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/common/options/partials/section-manage-cpts.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/standard/options/partials/section-integration.php';
require PRODUCTIVE_STYLE_PLUGIN_PATH . 'admin/standard/options/partials/section-go-pro.php'; 

$productive_style_admin_navbar_title    = PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME . esc_html__( ' Admin Settings and Options', 'productive-style' );
$productive_style_admin_topmenu_title   = esc_html('Productive...');

add_action('wp_loaded', 'productive_style_goto_plugin_options');
function productive_style_goto_plugin_options() {  
    if( isset( $_GET[ 'page' ] ) && ( $_GET[ 'page' ] == PRODUCTIVE_STYLE_ADMIN_OVERVIEW_REQUEST_URI && !isset( $_GET[ 'tab' ] ) ) ) {
        wp_safe_redirect( add_query_arg( array( 'page' => PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI .'&tab=section_about_options_tab' ), admin_url( 'admin.php' ) ) );
    }
}

/**
 * Render Pages and Menus
 * 
 * @global string $productive_style_admin_navbar_title
 * @global type $productive_style_admin_topmenu_title
 */
function productive_style_plugin_options_render_page_menu() {
    
    global $productive_style_admin_navbar_title;
    global $productive_style_admin_topmenu_title;
    
    $page_title         = PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME;
    $menu_title         = PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME;
    $capability         = 'administrator';          // allowed user role.
    $icon_url           = 'dashicons-carrot';
    $position           = 60; // Just after the Appearnce Page Menu
    
    // Plugin Custom Top-Level Menu & SubMenu
    // Register a new section in the "productive_style" page.
    add_menu_page(
        $productive_style_admin_navbar_title, // Browser navbar title
        $productive_style_admin_topmenu_title, // Sidebar menu text
        'administrator',
        PRODUCTIVE_STYLE_ADMIN_OVERVIEW_REQUEST_URI, // Unique id, which will be used to bind submenus to this top menu
        'productive_style_plugin_options_render_page_menu_html', // Callback function for the menu
        $icon_url, 
        $position,
    );
   
    // Add global content
    productive_global_plugin_options_render_page_menu_global();
    
    // Plugin Custom Top-Level Menu & SubMenu
    // Register a new section in the "productive_style" page.
    add_submenu_page(
        PRODUCTIVE_STYLE_ADMIN_OVERVIEW_REQUEST_URI,
        $productive_style_admin_navbar_title, // Browser navbar title
        $menu_title, // Sidebar menu text
        'administrator', 
        PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI, // Unique id
        'productive_style_plugin_options_render_page_menu_html' // Callback function for the menu
    );
   
}
add_action( 'admin_menu', 'productive_style_plugin_options_render_page_menu' );

function productive_style_options_main_init() {
    // Add global sections
    productive_global_register_sections();
    // Add manage cpts options
    productive_style_register_section_manage_cpts();
    // Add plugin-specific sections
    productive_style_register_section_integration();
}
add_action( 'admin_init', 'productive_style_options_main_init' );

function productive_style_plugin_options_render_page_menu_html() {
    // check user capabilities
    if ( !current_user_can( 'manage_options' ) ) {
        add_settings_error( 'productive_style_admin_messages', 'productive_style_admin_message', esc_html__( 'You do not have permission to access this resource.', 'productive-style' ), 'error' );
        settings_errors( 'productive_style_admin_messages' );
    } else {
    
    // check if the user have submitted the settings
    $is_error_count_section_manage_cpts = count( get_settings_errors('productive_style_section_manage_cpts_options') );
    $is_error_count_section_integration = count( get_settings_errors('productive_style_section_integration_options') );
    if ( isset( $_GET['settings-updated'] ) && $is_error_count_section_manage_cpts < 1 && $is_error_count_section_integration < 1 ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'productive_style_admin_messages', 'productive_style_admin_message', __( 'Settings Saved', 'productive-style' ), 'updated' );
    }
    settings_errors( 'productive_style_admin_messages' );
    
    $active_tab = 'section_about_options_tab';
    if( isset( $_GET[ 'tab' ] ) ) {
        $active_tab = sanitize_text_field( $_GET[ 'tab' ] );
    }
    ?>

    <div class="wrap productive-global-options-page-wrapper">
        <div class="page-wrapper-heading-container">
            <div class="page-wrapper-heading">
                <h1>
                    <img class="admin-page-heading-icon" src="<?php echo PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/productivemedia/' . PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_TEXT_DOMAIN . '.webp' ?>" alt="" />
                    <?php echo PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME; ?>
                    <a target="_blank" class="page-wrapper-heading-get-pro" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_DOCUMENTATION_URL; ?>"><?php echo esc_html__( 'Documentation', 'productive-style' ); ?></a>
                    <a target="_blank" class="page-wrapper-heading-get-pro" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_SUPPORT_URL; ?>"><?php echo esc_html__( 'Get Support', 'productive-style' ); ?></a>
                </h1>
            </div>
            <div class="page-wrapper-heading-version">
                <div><?php echo 'v' . PRODUCTIVE_STYLE_VERSION; ?></div>
            </div>
        </div>
        <div class="page-wrapper-body">
                
            <div class="page-wrapper-options-error">
                <?php settings_errors('productive_style_section_manage_cpts_options'); ?>
                <?php settings_errors('productive_style_section_integration_options'); ?>
                <?php settings_errors('productive_style_section_pro_options'); ?>
            </div>
            
            <?php
                $section_about_options_tab_active = '';
                if ( $active_tab === 'section_about_options_tab' ) {
                    $section_about_options_tab_active = 'nav-tab-active';
                }
                $section_manage_cpts_options_tab = '';
                if ( $active_tab === 'section_manage_cpts_options_tab' ) {
                    $section_manage_cpts_options_tab = 'nav-tab-active';
                }
                $section_integration_options_tab = '';
                if ( $active_tab === 'section_integration_options_tab' ) {
                    $section_integration_options_tab = 'nav-tab-active';
                }
                $section_pro_options_tab = '';
                if ( $active_tab === 'section_pro_options_tab' ) {
                    $section_pro_options_tab = 'nav-tab-active';
                }
            ?>
            
            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_about_options_tab" class="nav-tab <?php echo esc_attr($section_about_options_tab_active); ?>"><?php echo PRODUCTIVE_STYLE_OPTION_TAB_ABOUT_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_manage_cpts_options_tab" class="nav-tab <?php echo esc_attr($section_manage_cpts_options_tab); ?>"><?php echo PRODUCTIVE_STYLE_OPTION_TAB_MANAGE_CPTS_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_integration_options_tab" class="nav-tab <?php echo esc_attr($section_integration_options_tab); ?>"><?php echo PRODUCTIVE_STYLE_OPTION_TAB_INTEGRATION_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_pro_options_tab" class="nav-tab <?php echo esc_attr( $section_pro_options_tab ); ?>"><?php echo PRODUCTIVE_STYLE_OPTION_TAB_PRO_TITLE; ?></a>
            </h2>
            
            <div class="page-wrapper-body-form">
                
                <?php if ( $active_tab === 'section_manage_cpts_options_tab' || $active_tab === 'section_integration_options_tab' ) { ?>
                       <form name="productive_style_options_form" method="post" action="options.php">                        
                <?php } ?>
                           
                <?php if ( $active_tab == 'section_about_options_tab' ) { ?>
                    <?php
                        productive_style_about_section();
                    ?>
                <?php } else { ?>
                
                    <div class="productive-global-item-container">
                        <?php if ( $active_tab == 'section_manage_cpts_options_tab' ) { ?>
                            <?php
                                settings_fields( 'productive_style_section_manage_cpts_options' );
                                do_settings_sections( 'productive_style_section_manage_cpts_options' );
                            ?>
                            <?php submit_button();?>
                        <?php } else if ( $active_tab == 'section_integration_options_tab' ) { ?>
                            <?php
                                settings_fields( 'productive_style_section_integration_options' );
                                do_settings_sections( 'productive_style_section_integration_options' );
                            ?>
                            <?php submit_button();?>
                        <?php } else if ( $active_tab == 'section_pro_options_tab' ) { ?>
                            <?php
                                productive_style_section_get_pro();
                           ?>
                        <?php } ?>
                    </div> 
                           
                <?php } ?>
                           
                <?php if ( $active_tab === 'section_manage_cpts_options_tab' || $active_tab === 'section_integration_options_tab' ) { ?>
                    </form>                       
                <?php } ?>
            </div>
            
            <div class="leave-a-review-box">
                <?php _e( 'Support our efforts, interact with fellow users, and contribute to enhancing ', 'productive-style' ); ?>
                <?php echo PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME; ?>.
                <a target="_blank" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_REVIEW_ON_REPO_URL; ?>">
                    <?php _e( 'Kindly submit a review', 'productive-style' ); ?>
               </a>
            </div>
            
        </div>
    </div>
    <?php
    }
}
