<?php
/**
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Method productive_style_activate ''.
 */
function productive_style_activate() {
    productive_style_database_install();
    if(function_exists( 'productive_style_extra_is_active' ) ) {
        productive_style_create_review_woo_page_landing_page();
    }
}

/**
 * Method productive_style_create_review_woo_page_landing_page ''.
 */
function productive_style_create_review_woo_page_landing_page() {
    $args = array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'name'           => PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_SLUG,
    );
    
    $page_exists = false;
    $productive_posts = new WP_Query( $args );
    if ( $productive_posts->have_posts() ) {
        $page_exists = true;
    }
    
    $admin_user_id = get_current_user_id();
    $page_content = '';
    
    if ( !$page_exists && user_can_access_admin_page() ) {
        $new_page_id = wp_insert_post(
            array(
                'comment_status'    =>	'closed',
                'ping_status'       =>	'closed',
                'post_author'       =>	$admin_user_id,
                'post_name'         =>	PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_SLUG,
                'post_title'        =>	PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_TITLE,
                'post_content'      =>  $page_content,
                'post_status'       =>	'publish',
                'post_type'         =>	'page'
            )
        );
        add_option( PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_DEFAULT_SLUG_VALUE, PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_SLUG );
    } else {
        $options = get_option( 'productive_style_section_integration_options' );
        $option_value = 0;
        if( isset( $options['productive_style_review_woo_page_list_of_reviews_page'] ) ) {
            $option_value = sanitize_text_field( $options['productive_style_review_woo_page_list_of_reviews_page'] );
        }
        if( $option_value ) {
            $page = get_post( $option_value );
            if( null != $page && is_object( $page ) ) {
                update_option( PRODUCTIVE_STYLE_PRODUCT_REVIEW_WOO_PAGE_LANDING_PAGE_DEFAULT_SLUG_VALUE, $page->post_name );
            }
        }
    }   
}

