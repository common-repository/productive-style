<?php
/**
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

function productive_style_about_section() {
    ?>
    <div class="productiveminds_double_grid column_70_30">
        <div class="productiveminds_double_grid_content">
            <?php
                productive_style_about_section_intro();
                productive_style_about_section_features();
            ?>
        </div>
        <div class="productiveminds_double_grid_content">
            <?php
                productive_style_about_section_about();
            ?>
        </div>
    </div>
<?php
}

function productive_style_about_section_intro() {
    ?>
    <h2 class="">
        <?php echo __( 'Discover ', 'productive-style' ) . PRODUCTIVE_STYLE_CURRENT_PLUGIN_NAME; ?>
    </h2>
<?php
}

function productive_style_about_section_features() {
    ?>
    <div class="productive-global-admin-content-container">
        <h3 class=""><?php echo __( 'Key Functionalities', 'productive-style' ); ?></h3>
        <div class="productiveminds_double_grid column_70_30">
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-list">
                    <ul class="get-pro-features-box-list">
                        <li><?php _e( 'Compatible with our themes, allowing website owners to refine and customize site details in line with their branding requirements. Adjust site content, colors, fonts, and backgrounds with ease.', 'productive-style' ); ?></li>
                        <li><?php _e( 'Provides essential post types for seamless content creation during website development.', 'productive-style' ); ?></li>
                        <li><?php _e( 'Offers tools to integrate features throughout your site, including locally hosted Google fonts.', 'productive-style' ); ?></li>
                        <li><?php _e( 'Utilize the Content Element custom post types to craft content in the admin panel and showcase it anywhere on your site using Elementor widgets.', 'productive-style' ); ?></li>
                    </ul>
                </div>
            </div>
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-screenshots">
                    <div class="productive_video_player_admin_yt_container">
                        <a target="_blank" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_FEATURES_OR_BUY_URL; ?>">
                            <img src="<?php echo PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/productivemedia/' . PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_TEXT_DOMAIN . '.webp' ?>" alt="" width="100%" height="auto" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
        <div class="productive-global-get-pro-media-container">
            <?php if( !function_exists( 'productive_style_extra_is_active' ) ) { ?>
                <a class="page-wrapper-body-get-pro" href="?page=<?php echo PRODUCTIVE_STYLE_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_pro_options_tab">
                    <?php echo esc_html__( 'See Free vs Pro', 'productive-style' ); ?>
                </a>
            <?php } ?>
        </div>
    </div>
<?php
}

function productive_style_about_section_about() {
    ?>
    
    <div class="productive-global-admin-content-container">
        <div class="productiveminds_double_grid column_100">
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-list">
                    <h3 class=""><?php echo __( 'Leave a Review', 'productive-style' ); ?></h3>
                    <div>
                        <?php echo __( 'Share Your Insights! Get featured on our website and help enhance our effort.', 'productive-style' ); ?>
                    </div>
                    <div class="productive-global-block-link-container">
                        <?php
                            if( function_exists( 'productive_style_extra_is_active' ) ) { 
                                $plugin_review_url = PRODUCTIVE_STYLE_PLUGIN_PRO_REVIEW_URL;
                            } else {
                                $plugin_review_url = PRODUCTIVE_STYLE_PLUGIN_REVIEW_ON_REPO_URL;
                            }
                        ?>
                        <a target="_blank" class="standard-link" href="<?php echo esc_url( $plugin_review_url ); ?>">
                            <?php echo esc_html__( 'Kindly submit a review', 'productive-style' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
    </div>
    <div class="productive-global-admin-content-container">
        <div class="productiveminds_double_grid column_100">
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-list">
                    <h3 class=""><?php echo __( 'Premium Support', 'productive-style' ); ?></h3>
                    <div>
                        <?php echo __( 'Submit a support ticket with ease to receive prompt premium assistance with Pro', 'productive-style' ); ?>
                    </div>
                    <div class="productive-global-block-link-container">
                        <a target="_blank" class="standard-link" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_SUPPORT_URL; ?>">
                            <?php echo esc_html__( 'Access Support', 'productive-style' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
    </div>
    <div class="productive-global-admin-content-container">
        <div class="productiveminds_double_grid column_100">
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-list">
                    <h3 class=""><?php echo __( 'Documentation', 'productive-style' ); ?></h3>
                    <div>
                        <?php echo __( 'Seeking user guides for configuring this plugin on your website?', 'productive-style' ); ?>
                    </div>
                    <div class="productive-global-block-link-container">
                        <a target="_blank" class="standard-link" href="<?php echo PRODUCTIVE_STYLE_PLUGIN_DOCUMENTATION_URL; ?>">
                            <?php echo esc_html__( 'Access documentation', 'productive-style' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
    </div>
    <div class="productive-global-admin-content-container">
        <div class="productiveminds_double_grid column_100">
            <div class="productiveminds_double_grid_content">
                <div class="get-pro-features-box-list dense">
                    
                    <h3 class=""><?php echo __( 'Our Plugins', 'productive-style' ); ?></h3>
                    
                    <div class="items-in-rows">
                        <div class="productiveminds_section-container columns_left_icon-50px closeup">
                            <div>
                                <a target="_blank" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_OUR_URL; ?>">
                                    <img src="<?php echo PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/productivemedia/productive-style.webp' ?>" alt="" width="100%" height="auto" />
                                </a>
                            </div>
                            <div>
                                <div class="small-heading">
                                    <?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_TITLE; ?>
                                </div>
                                <div class="small-text">
                                    <?php echo __( 'Web pages and content building tools...', 'productive-style' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="productive-global-block-link-container">
                            <?php if( !function_exists( 'productive_style_is_active' ) ) { ?>
                                <a target="_blank" class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_REPO_URL; ?>">
                                    <?php echo esc_html__( 'Install plugin', 'productive-style' ); ?>
                                </a>
                            <?php } else { ?>
                                <a class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_STYLE_ADMIN_OPTIONS_LINK; ?>">
                                    <?php echo esc_html__( 'Customize plugin', 'productive-style' ); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <?php if( class_exists( 'woocommerce' ) ) { ?>
                        <div class="items-in-rows">
                            <div class="productiveminds_section-container columns_left_icon-50px closeup">
                                <div>
                                    <a target="_blank" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_COMMERCE_OUR_URL; ?>">
                                        <img src="<?php echo PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/productivemedia/productive-commerce.webp' ?>" alt="" width="100%" height="auto" />
                                    </a>
                                </div>
                                <div>
                                    <div class="small-heading">
                                        <?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_COMMERCE_TITLE; ?>
                                    </div>
                                    <div class="small-text">
                                        <?php echo __( 'Wishlist, Compare, Quick View, MiniCart...', 'productive-style' ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="productive-global-block-link-container">
                                <?php if( !function_exists( 'productive_commerce_is_active' ) ) { ?>
                                    <a target="_blank" class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_COMMERCE_REPO_URL; ?>">
                                        <?php echo esc_html__( 'Install plugin', 'productive-style' ); ?>
                                    </a>
                                <?php } else { ?>
                                    <a class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_COMMERCE_ADMIN_OPTIONS_LINK; ?>">
                                        <?php echo esc_html__( 'Customize plugin', 'productive-style' ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="items-in-rows">
                        <div class="productiveminds_section-container columns_left_icon-50px closeup">
                            <div>
                                <a target="_blank" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_FORMS_OUR_URL; ?>">
                                    <img src="<?php echo PRODUCTIVE_STYLE_PLUGIN_URI . 'public/images/productivemedia/productive-forms.webp' ?>" alt="" width="100%" height="auto" />
                                </a>
                            </div>
                            <div>
                                <div class="small-heading">
                                    <?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_FORMS_TITLE; ?>
                                </div>
                                <div class="small-text">
                                    <?php echo __( 'Contact forms, Newsletter opt-ins...', 'productive-style' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="productive-global-block-link-container">
                            <?php if( !function_exists( 'productive_forms_is_active' ) ) { ?>
                                <a target="_blank" class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_FORMS_REPO_URL; ?>">
                                    <?php echo esc_html__( 'Install plugin', 'productive-style' ); ?>
                                </a>
                            <?php } else { ?>
                                <a class="standard-link" href="<?php echo PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_FORMS_ADMIN_OPTIONS_LINK; ?>">
                                    <?php echo esc_html__( 'Customize plugin', 'productive-style' ); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
    </div>
<?php
}
