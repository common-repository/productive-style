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
 * Method productive_style_render_breadcrumb
 */
function productive_style_render_breadcrumb() {
    $page_does_not_require_breadcrumb = is_front_page() || is_404() || is_home();
    if( productive_style_breadcrumb_switch_on() && !$page_does_not_require_breadcrumb ) {
        
        $productive_style_breadcrumb_home_icon = productive_style_breadcrumb_home_icon();
        $productive_style_breadcrumb_home_icon_size = productive_style_breadcrumb_home_icon_size();
        $productive_style_breadcrumb_separator = productive_style_get_breadcrumb_separator_value( productive_style_breadcrumb_separator() );
        $productive_style_breadcrumb_alignment = productive_style_breadcrumb_alignment();
        $productive_style_home_icon_args = array(
            'i'     => 'home', 
            'w'     => $productive_style_breadcrumb_home_icon_size,
            'h'     => $productive_style_breadcrumb_home_icon_size,
            'css'   => '',
            'svg_css'   => 'productive_breadcrumb_home_icon'
        );

        $attachment_id = productive_style_breadcrumb_bg_image();
        $productive_style_breadcrumb_bg_image = '';
        if( $attachment_id ) {
            $productive_style_breadcrumb_bg_image = productive_global_get_attachment_url_by_attachment_id( $attachment_id, PRODUCTIVE_STYLE_PLACEHOLDER_IMAGE_POSTS );
        }
    ?>
    <?php if( $attachment_id && !empty($productive_style_breadcrumb_bg_image) ) { ?>
        <div class="site-body-container_box_full header-breadcrumb-container container_with_bg_image" style="background-image: url(<?php echo esc_url( $productive_style_breadcrumb_bg_image ); ?>)">
        <?php } else { ?>
        <div class="site-body-container_box_full header-breadcrumb-container">
        <?php } ?>
        <div class="site-body-container_box">
            <div class="site-body-container_box_uno">
                <div class="header-breadcrumb-content-box productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-5px <?php echo esc_attr($productive_style_breadcrumb_alignment) ?>">
                    <a class="productiveminds-alignable-container flexed flexed-in-a-flexed align-items-center align-content-center column-gap-5px" href="<?php echo esc_url( home_url() ); ?>">
                        <?php 
                        if( 'left' == $productive_style_breadcrumb_home_icon ) {
                            do_action('display_productiveminds_display_font_icon', $productive_style_home_icon_args);
                        }
                        ?>
                        <?php echo __('Home', 'productive-style'); ?>
                        <?php 
                        if( 'right' == $productive_style_breadcrumb_home_icon ) {
                            do_action('display_productiveminds_display_font_icon', $productive_style_home_icon_args);
                        }
                        ?>
                    </a>
                    <?php if ( is_page() ) { ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php the_title(); ?>
                    <?php } else if ( is_author() || is_category() || ( productive_global_is_woocommerce_active() && is_product_category() ) ) { ?>
                        <?php add_filter("get_the_archive_title_prefix", "__return_empty_string"); ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php
                            $term_title = wp_kses_post( get_the_archive_title() );
                            productive_style_render_archived_breadcrumb_sections( $term_title, $productive_style_breadcrumb_separator ); 
                        ?>
                    <?php } else if ( is_single() && !( productive_global_is_woocommerce_active() && is_product() ) ) { ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php if ( 'post' == get_post_type() ) { ?>
                            <?php productive_style_render_breadcrumb_category_for_single_page( 'post', 1 ); ?>
                            <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php } ?>
                        <?php the_title(); ?>
                    <?php } else if ( ( productive_global_is_woocommerce_active() && is_shop() ) ) { ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php
                            $term_title = woocommerce_page_title( false );
                            productive_style_render_archived_breadcrumb_sections( $term_title, $productive_style_breadcrumb_separator ); 
                        ?>
                    <?php } else if ( ( productive_global_is_woocommerce_active() && is_product() ) ) { ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php productive_style_render_breadcrumb_category_for_single_page( 'product', 1 ); ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php the_title(); ?>
                    <?php } else if ( is_search() ) { ?>
                        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
                        <?php echo __('Search: ', 'productive-style'); ?>
                        "<?php the_search_query(); ?>"
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}
add_shortcode('display_productive_breadcrumb', 'productive_style_render_breadcrumb');
add_action('display_productive_breadcrumb', 'productive_style_render_breadcrumb');

function productive_style_get_breadcrumb_separator_value( $separator = 'slash' ) {
    $separator_html = '';
    switch ( $separator ) {
        case 'angled':
            $separator_html = '>';
            break;
        case 'pipe':
            $separator_html = '|';
            break;
        case 'hyphen':
            $separator_html = '-';
            break;
        case 'chevron':
            $separator_html = '>>';
            break;
        case 'bullet':
            $separator_html = '&bull;';
            break;
        default:
            $separator_html = '/';
            break;
    }
    return $separator_html;
}

function productive_style_render_breadcrumb_category_for_single_page( $category_type = 0, $linked = 1 ) {
    $cats = array();
    if( 'post' == $category_type ) {
        global $post;
        $cats = wp_get_post_categories( $post->ID );
    } else if( 'product' == $category_type ) {
        global $product;
        $product_object = productive_global_get_woo_product_return_wc_get_product_object( $product );
        if( null != $product_object && is_object($product_object) ) {
            $cats = $product_object->get_category_ids();
        }
    }
    if( null != $cats && !empty( $cats ) ) {
        $first_cat_id = $cats[0];  
        $first_cat = get_term( $first_cat_id );
        $url = get_term_link( $first_cat_id );
        $title = $first_cat->name;
        if( $linked ) {
        ?>
            <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a>
        <?php
        } else { ?>
            <?php echo esc_html( $title ); ?>
        <?php
        }
    }
}

function productive_style_render_archived_breadcrumb_sections($term_title, $productive_style_breadcrumb_separator) {
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    if( 1 < $paged ) {
        $term_id = get_queried_object_id();
        $category_url = get_category_link( $term_id );
?>
        <a class="productiveminds-alignable-container flexed flexed-in-a-flexed align-items-center align-content-center column-gap-5px" href="<?php echo esc_url( $category_url ); ?>">
           <?php echo esc_html($term_title); ?>
        </a>
        <span class="productive_breadcrumb_separotor"><?php echo esc_html( $productive_style_breadcrumb_separator ); ?></span>
        <?php echo __('Page ', 'productive-style') . $paged; ?>
<?php
    } else {
        echo esc_html($term_title);
    }
}
