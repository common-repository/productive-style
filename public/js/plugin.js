/**
 *
 * @package     productive-style
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

function init_Slider_Productive_Homepage_Banner() {
    let swiper_var_slidesPerView = "1, 1, 1, 1, 1, 1";
    let swiper_var_simulateTouch = false;
    let swiper_var_grabCursor = false;
    let container_css_class_objects = document.querySelectorAll( '.swiper_container .productiveminds-homepage-slider.via_std' );
    for( i = 0; i < container_css_class_objects.length; i++ ) {
        let container_css_class_object = container_css_class_objects[i];
        document.addEventListener('DOMContentLoaded', 
            productive_Common_Js_Slider(container_css_class_object, swiper_var_enabled, swiper_var_slidesPerView, swiper_var_slidesBreakPoints, swiper_var_effect, swiper_var_loop, swiper_var_direction, swiper_var_lazyLoading, swiper_var_autoplay, swiper_var_delay, swiper_var_pauseOnMouseEnter, swiper_var_scrollbar, swiper_var_simulateTouch, swiper_var_grabCursor, swiper_var_slides_margin )
        );
    }
}
init_Slider_Productive_Homepage_Banner();

function init_Slider_Productive_Block_Banner_Slider() {
    let swiper_var_slidesPerView = "1, 1, 1, 1, 1, 1";
    let swiper_var_simulateTouch = false;
    let swiper_var_grabCursor = false;
    let container_css_class_objects = document.querySelectorAll( '.swiper_container .productiveminds-banner-slider-slider.via_std' );
    for( i = 0; i < container_css_class_objects.length; i++ ) {
        let container_css_class_object = container_css_class_objects[i];
        document.addEventListener('DOMContentLoaded', 
            productive_Common_Js_Slider(container_css_class_object, swiper_var_enabled, swiper_var_slidesPerView, swiper_var_slidesBreakPoints, swiper_var_effect, swiper_var_loop, swiper_var_direction, swiper_var_lazyLoading, swiper_var_autoplay, swiper_var_delay, swiper_var_pauseOnMouseEnter, swiper_var_scrollbar, swiper_var_simulateTouch, swiper_var_grabCursor, swiper_var_slides_margin )
        );
    }
}
init_Slider_Productive_Block_Banner_Slider();

function init_Std_Productive_toggleable_Faq_Page_toggle_only_selected() {
    let productiveminds_section_css_class = document.querySelector( ".productive-paddable-section.toggle_only_selected" );
    if( undefined !== productiveminds_section_css_class && null !== productiveminds_section_css_class ) {        
        let section_content_layout_enable_accordion_toggle = 'toggle_only_selected';
        productive_Toggle_Accodion_Content_Toggle( productiveminds_section_css_class, "productive_toggler_faq", ".clickable_container_css_class", ".toggle_symbol_container_css_class", ".toggleable_content_css_class", section_content_layout_enable_accordion_toggle);
    }
}
document.addEventListener( 'DOMContentLoaded', init_Std_Productive_toggleable_Faq_Page_toggle_only_selected() );

function init_Std_Productive_toggleable_Faq_Page_toggle_reset_before_toggle() {
    let productiveminds_section_css_class = document.querySelector( ".productive-paddable-section.toggle_reset_before_toggle" );
    if( undefined !== productiveminds_section_css_class && null !== productiveminds_section_css_class ) {        
        let section_content_layout_enable_accordion_toggle = 'toggle_reset_before_toggle';
        productive_Toggle_Accodion_Content_Toggle( productiveminds_section_css_class, "productive_toggler_faq", ".clickable_container_css_class", ".toggle_symbol_container_css_class", ".toggleable_content_css_class", section_content_layout_enable_accordion_toggle);
    }
}
document.addEventListener( 'DOMContentLoaded', init_Std_Productive_toggleable_Faq_Page_toggle_reset_before_toggle() );

function init_Std_Productive_toggleable_Faq_Block() {
    let section_content_layout_enable_accordion_toggle = 'toggle_only_selected';
    let container_css_class_objects = document.getElementsByClassName("productiveminds_section faq std std_faq_block");
    for( i = 0; i < container_css_class_objects.length; i++ ) {
        let container_css_class_object = container_css_class_objects[i];
        if( undefined !== container_css_class_object && null !== container_css_class_object ) {
            productive_Toggle_Accodion_Content_Toggle( container_css_class_object, "productive_toggler_faq", ".clickable_container_css_class", ".toggle_symbol_container_css_class", ".toggleable_content_css_class", section_content_layout_enable_accordion_toggle);
        }
    }
}
document.addEventListener( 'DOMContentLoaded', init_Std_Productive_toggleable_Faq_Block() );