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

// Registrar Custom Post Type
function productive_style_faq_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-style' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-style' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_NAME_PLURAL, 'productive-style' ),
        'name_admin_bar'        => __( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'archives'              => __( 'Archives', 'productive-style' ),
        'attributes'            => __( 'Attributes', 'productive-style' ),
        'parent_item_colon'     => __( 'Parent FAQ:', 'productive-style' ),
        'all_items'             => __( 'All FAQs', 'productive-style' ),
        'add_new_item'          => __( 'Add New FAQ', 'productive-style' ),
        'add_new'               => __( 'Add New', 'productive-style' ),
        'new_item'              => __( 'New FAQ', 'productive-style' ),
        'edit_item'             => __( 'Edit FAQ', 'productive-style' ),
        'update_item'           => __( 'Update FAQ', 'productive-style' ),
        'view_item'             => __( 'View FAQ', 'productive-style' ),
        'view_items'            => __( 'View FAQs', 'productive-style' ),
        'search_items'          => __( 'Search FAQ', 'productive-style' ),
        'not_found'             => __( 'Not found', 'productive-style' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-style' ),
        'featured_image'        => __( 'FAQ Picture', 'productive-style' ),
        'set_featured_image'    => __( 'Add FAQ Picture', 'productive-style' ),
        'remove_featured_image' => __( 'Remove FAQ Picture', 'productive-style' ),
        'use_featured_image'    => __( 'Use as Main FAQ Picture', 'productive-style' ),
        'insert_into_item'      => __( 'Insert into FAQ', 'productive-style' ),
        'uploaded_to_this_item' => __( 'Upload to this FAQ', 'productive-style' ),
        'items_list'            => __( 'FAQs list', 'productive-style' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'productive-style' ),
        'filter_items_list'     => __( 'Filter FAQs', 'productive-style' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_NAME_SINGULAR, 'productive-style' ),
        'description'           => __( 'FAQ post type for adding client faqs', 'productive-style' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'page-attributes' ),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => productive_style_manage_cpts_faq_menu_visibility(),
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_style_faq_post_type', 0 );


function productive_style_faq_register_taxonomy() {
    $labels = array(
            'name'              => _x( PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL, 'Taxonomy General Name', 'productive-style' ),
            'singular_name'     => _x( PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR, 'Taxonomy Singular Name', 'productive-style' ),
            'search_items'      => __( 'Search ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'all_items'         => __( 'All ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'view_item'         => __( 'View ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'parent_item'       => __( 'Parent', 'productive-style' ),
            'parent_item_colon' => __( 'Parent', 'productive-style' ),
            'edit_item'         => __( 'Edit ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'update_item'       => __( 'Update ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'add_new_item'      => __( 'Add New ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR, 'productive-style' ),
            'new_item_name'     => __( 'New ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_SINGULAR . ' Name', 'productive-style' ),
            'not_found'         => __( 'No ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL . ' Found', 'productive-style' ),
            'back_to_items'     => __( 'Back to ' . PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL, 'productive-style' ),
            'menu_name'         => __( PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_NAME_PLURAL, 'productive-style' ),
    );
    $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG ),
            'show_in_rest'      => true,
    );
    register_taxonomy( PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG, PRODUCTIVE_STYLE_PLUGIN_FAQ_POST_TYPE_SLUG, $args );
    
    productive_style_faq_add_taxonomy_items();
    
}
add_action( 'init', 'productive_style_faq_register_taxonomy', 0 );


function productive_style_faq_add_taxonomy_items() {
    
    $taxonomy_exists = term_exists( 'general-faq', PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG );
    if ( null == $taxonomy_exists || !$taxonomy_exists || empty( $taxonomy_exists) ) {
        $args = array(
            'description'   => __( 'General FAQs are displayed on the main FAQs page', 'productive-style' ),
            'slug'          => 'general-faq',
        );
        wp_insert_term(
            __( 'General FAQs', 'productive-style' ), 
            PRODUCTIVE_STYLE_PLUGIN_FAQ_TAXONOMY_SLUG, 
            $args
        );
        
    }
}