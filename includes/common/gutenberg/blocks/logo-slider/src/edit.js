import { __ } from '@wordpress/i18n';
import './editor.scss';
import metadata from './block.json';

import ServerSideRender from '@wordpress/server-side-render';
import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, RangeControl, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
    
    const { section_content_layout_format,
        slider_navigation_arrows_control_position,
        section_s_p_view,
        slider_pagination_control_position,
        section_content_box_design_style,
        section_content_settings_taxonomy,
        section_taxonomy_type,
        columns_per_row,
        section_total_items,
        section_content_settings_query_order_by,
        section_settings_show_post_pagination,
        section_title, 
        section_title_html_tag,
        section_intro,
        section_header_alignment,
        section_content_media_item_shape,
        productive_cpt_is_link_image,
        section_show_content_title,
        section_block_max_width,
        section_block_spacing,
        section_bg_color_scheme
    } = attributes;
    
    
    let post_categories = null;
    if ( section_taxonomy_type ) {
        post_categories = useSelect((select) => {
            return select('core').getEntityRecords('taxonomy', section_taxonomy_type, {
                per_page: -1,
            });
        }, []);
    }
    

    let taxonomy_options_using_map = [];
    if ( null !== post_categories ) {
        taxonomy_options_using_map = post_categories.map( ({ id, name }) => ({label:name, value: id }) );
        taxonomy_options_using_map.unshift( { label: __( 'Select an Option', 'productive-style' ), value: '0' } );
    } else {
        taxonomy_options_using_map.push( { label: 'No matching content found', value: '0' } );
    }
    
    return (
        <>
            <InspectorControls>
                
                <PanelBody title={ __( 'Format (Layout)', 'productive-style' ) }>
                    
                    <SelectControl
                        label={ __( 'Format', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_content_layout_format }
                        options={ [
                            { label: __( 'Slider', 'productive-style' ), value: 'slider' },
                            { label: __( 'Grid', 'productive-style' ), value: 'grid' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_content_layout_format: value } ) }
                        __nextHasNoMarginBottom
                    />
                    { section_content_layout_format == 'slider' && (
                        <SelectControl
                            label={ __( 'Max Visible Slides', 'productive-style' ) }
                            labelPosition="top"
                            value={ section_s_p_view }
                            options={ [
                                { label: __( '7 Slides', 'productive-style' ), value: 's_p_view_7' },
                                { label: __( '6 Slides', 'productive-style' ), value: 's_p_view_6' },
                                { label: __( '5 Slides', 'productive-style' ), value: 's_p_view_5' },
                            ] }
                            onChange={ ( value ) => setAttributes( { section_s_p_view: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                    { section_content_layout_format == 'slider' && (
                        <SelectControl
                            label={ __( 'Slider Nav Controls', 'productive-style' ) }
                            labelPosition="top"
                            value={ slider_navigation_arrows_control_position }
                            options={ [
                                { label: __( 'None', 'productive-style' ), value: 'none-arrow' },
                                { label: __( 'Inside Content (overlay)', 'productive-style' ), value: 'nav-arrows-sides-in' },
                                { label: __( 'Beside Content', 'productive-style' ), value: 'nav-arrows-sides-out' },
                                { label: __( 'Above Content', 'productive-style' ), value: 'nav-arrows-top-out' },
                                { label: __( 'Below Content', 'productive-style' ), value: 'nav-arrows-bottom-out' },
                            ] }
                            onChange={ ( value ) => setAttributes( { slider_navigation_arrows_control_position: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                    { section_content_layout_format == 'slider' && (
                        <SelectControl
                            label={ __( 'Slider Pagination Controls', 'productive-style' ) }
                            labelPosition="top"
                            value={ slider_pagination_control_position }
                            options={ [
                                { label: __( 'None', 'productive-style' ), value: 'none-pagination' },
                                { label: __( 'Inside Content (overlay)', 'productive-style' ), value: 'nav-pagination-in' },
                                { label: __( 'Below Content', 'productive-style' ), value: 'nav-pagination-out' },
                            ] }
                            onChange={ ( value ) => setAttributes( { slider_pagination_control_position: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                    <SelectControl
                        label={ __( 'Style', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_content_box_design_style }
                        options={ [
                            { label: __( 'Content Above Image', 'productive-style' ), value: 'content_above_media' },
                            { label: __( 'Content Below Image', 'productive-style' ), value: 'content_below_media' },
                            { label: __( 'Content On Top Image', 'productive-style' ), value: 'content_on_top_media_fit_content' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_content_box_design_style: value } ) }
                        __nextHasNoMarginBottom
                    />
                </PanelBody>  
                    
                <PanelBody title={ __( 'Data', 'productive-style' ) }>
                    { taxonomy_options_using_map && (
                        <SelectControl
                            label={ __( 'Category', 'productive-style' ) }
                            labelPosition="top"
                            value={ section_content_settings_taxonomy }
                            options={ taxonomy_options_using_map }
                            onChange={ ( value ) => setAttributes( { section_content_settings_taxonomy: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                    { section_content_layout_format == 'grid' && (
                        <RangeControl
                            label={ __( 'Columns per row', 'productive-style' ) }
                            min={ 1 }
                            max={ 7 }
                            value={ columns_per_row }
                            onChange={ ( value ) => setAttributes( { columns_per_row: value } ) }
                        />
                    ) }
                    
                    <RangeControl
                        label={ __( 'Total Items', 'productive-style' ) }
                        min={ 1 }
                        max={ 100 }
                        value={ section_total_items }
                        onChange={ ( value ) => setAttributes( { section_total_items: value } ) }
                    />
                    <SelectControl
                        label={ __( 'Order By', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_content_settings_query_order_by }
                        options={ [
                            { label: __( 'Newest First', 'productive-style' ), value: 'newest' },
                            { label: __( 'Oldest First', 'productive-style' ), value: 'oldest' },
                            { label: __( 'My Order', 'productive-style' ), value: 'menu_order' },
                            { label: __( 'Title (a-z)', 'productive-style' ), value: 'title_a_z' },
                            { label: __( 'Title (z-a)', 'productive-style' ), value: 'title_z_a' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_content_settings_query_order_by: value } ) }
                        __nextHasNoMarginBottom
                    />
                    { section_content_layout_format != 'slider' && (
                        <ToggleControl
                            checked={ !! section_settings_show_post_pagination }
                            label={ __( 'Enable Pagination', 'productive-style' ) }
                            onChange={ () => setAttributes( { section_settings_show_post_pagination: ! section_settings_show_post_pagination, } ) }
                        />
                    ) }
                </PanelBody>
                
                <PanelBody title={ __( 'Header', 'productive-style' ) }>
                    <TextControl
                        label={ __( 'Title', 'productive-style' ) }
                        value={ section_title || '' }
                        onChange={ ( value ) => setAttributes( { section_title: value } ) }
                    />
                    { section_title && (
                        <SelectControl
                            label={ __( 'Title html Tag', 'productive-style' ) }
                            labelPosition="top"
                            value={ section_title_html_tag }
                            options={ [
                                { label: __( 'h1 html tag', 'productive-style' ), value: 'h1' },
                                { label: __( 'h2 html tag', 'productive-style' ), value: 'h2' },
                                { label: __( 'h3 html tag', 'productive-style' ), value: 'h3' },
                                { label: __( 'h4 html tag', 'productive-style' ), value: 'h4' },
                                { label: __( 'h5 html tag', 'productive-style' ), value: 'h5' },
                                { label: __( 'h6 html tag', 'productive-style' ), value: 'h6' },
                                { label: __( 'div html tag', 'productive-style' ), value: 'div' },
                                { label: __( 'span html tag', 'productive-style' ), value: 'span' },
                            ] }
                            onChange={ ( value ) => setAttributes( { section_title_html_tag: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                    <TextControl
                        label={ __( 'Description', 'productive-style' ) }
                        value={ section_intro || '' }
                        onChange={ ( value ) => setAttributes( { section_intro: value } ) }
                    />
                    { (section_title || section_intro) && (
                        <SelectControl
                            label={ __( 'Header Alignment', 'productive-style' ) }
                            labelPosition="top"
                            value={ section_header_alignment }
                            options={ [
                                { label: __( 'None', 'productive-style' ), value: 'none' },
                                { label: __( 'Center', 'productive-style' ), value: 'centered' },
                                { label: __( 'Left', 'productive-style' ), value: 'lefted' },
                                { label: __( 'Right', 'productive-style' ), value: 'righted' },
                                { label: __( 'Justify', 'productive-style' ), value: 'justified' },
                            ] }
                            onChange={ ( value ) => setAttributes( { section_header_alignment: value } ) }
                            __nextHasNoMarginBottom
                        />
                    ) }
                </PanelBody>
                
                <PanelBody title={ __( 'Content', 'productive-style' ) }>
                
                    <SelectControl
                        label={ __( 'Image Shape', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_content_media_item_shape }
                        options={ [
                            { label: __( 'Default', 'productive-style' ), value: 'shapeable-image-default' },
                            { label: __( 'Sharp Corner', 'productive-style' ), value: 'shapeable-image-sharped-corner' },
                            { label: __( 'Rounded Corner', 'productive-style' ), value: 'shapeable-image-rounded-corner' },
                            { label: __( 'Ellipse', 'productive-style' ), value: 'shapeable-image-ellipsed' },
                            { label: __( 'Oval', 'productive-style' ), value: 'shapeable-image-ovalled' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_content_media_item_shape: value } ) }
                        __nextHasNoMarginBottom
                    />
                    <SelectControl
                        label={ __( 'Image Clickable?', 'productive-style' ) }
                        labelPosition="top"
                        value={ productive_cpt_is_link_image }
                        options={ [
                            { label: __( 'No', 'productive-style' ), value: '0' },
                            { label: __( 'Yes, Open In The Same Window', 'productive-style' ), value: '1' },
                            { label: __( 'Yes, Open In New Window', 'productive-style' ), value: '2' },
                        ] }
                        onChange={ ( value ) => setAttributes( { productive_cpt_is_link_image: value } ) }
                        __nextHasNoMarginBottom
                    />
                    <SelectControl
                        label={ __( 'Display Title?', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_show_content_title }
                        options={ [
                            { label: __( 'Hide', 'productive-style' ), value: '0' },
                            { label: __( 'Text', 'productive-style' ), value: '1' },
                            { label: __( 'Link, Open In The Same Window', 'productive-style' ), value: '2' },
                            { label: __( 'Link, Open In New Window', 'productive-style' ), value: '3' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_show_content_title: value } ) }
                        __nextHasNoMarginBottom
                    />
                    <SelectControl
                        label={ __( 'Block Size (Width)', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_block_max_width }
                        options={ [
                            { label: __( 'Default', 'productive-style' ), value: 'siteMaxWidth_Std' },
                            { label: __( 'Narrow', 'productive-style' ), value: 'siteMaxWidth_Narrow' },
                            { label: __( 'Narrow, Align Left', 'productive-style' ), value: 'siteMaxWidth_Narrow_Align_Left' },
                            { label: __( 'Narrow, Align Right', 'productive-style' ), value: 'siteMaxWidth_Narrow_Align_Right' },
                            { label: __( 'Thin', 'productive-style' ), value: 'siteMaxWidth_Thin' },
                            { label: __( 'Thin, Align Left', 'productive-style' ), value: 'siteMaxWidth_Thin_Align_Left' },
                            { label: __( 'Thin, Align Right', 'productive-style' ), value: 'siteMaxWidth_Thin_Align_Right' },
                            { label: __( 'Extra Thin', 'productive-style' ), value: 'siteMaxWidth_Mini' },
                            { label: __( 'Extra Thin, Align Left', 'productive-style' ), value: 'siteMaxWidth_Mini_Align_Left' },
                            { label: __( 'Extra Thin, Align Right', 'productive-style' ), value: 'siteMaxWidth_Mini_Align_Right' },
                            { label: __( 'Micro Thin', 'productive-style' ), value: 'siteMaxWidth_Micro' },
                            { label: __( 'Micro Thin, Align Left', 'productive-style' ), value: 'siteMaxWidth_Micro_Align_Left' },
                            { label: __( 'Micro Thin, Align Right', 'productive-style' ), value: 'siteMaxWidth_Micro_Align_Right' },
                            { label: __( 'Wide', 'productive-style' ), value: 'siteMaxWidth_Wide' },
                            { label: __( 'Full Width (with padding)', 'productive-style' ), value: 'siteMaxWidth_Extended' },
                            { label: __( 'Full Width (100%)', 'productive-style' ), value: 'siteMaxWidth_100pc' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_block_max_width: value } ) }
                        __nextHasNoMarginBottom
                    />
                    <SelectControl
                        label={ __( 'Block Spacing', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_block_spacing }
                        options={ [
                            { label: __( 'No Spacing', 'productive-style' ), value: 'section_spacing_none' },
                            { label: __( 'Default', 'productive-style' ), value: 'section_spacing_default' },
                            { label: __( 'Small', 'productive-style' ), value: 'section_spacing_small' },
                            { label: __( 'Large', 'productive-style' ), value: 'section_spacing_large' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_block_spacing: value } ) }
                        __nextHasNoMarginBottom
                    />
                    <SelectControl
                        label={ __( 'Component Background Color Scheme', 'productive-style' ) }
                        labelPosition="top"
                        value={ section_bg_color_scheme }
                        options={ [
                            { label: __( 'None', 'productive-style' ), value: 'section_with_no_bg' },
                            { label: __( 'Light Background', 'productive-style' ), value: 'section_with_light_bg' },
                            { label: __( 'Dark Background', 'productive-style' ), value: 'section_with_dark_bg' },
                            { label: __( 'Light Background, Dark Content', 'productive-style' ), value: 'section_with_light_bg_dark_content' },
                            { label: __( 'Dark Background, Light Content', 'productive-style' ), value: 'section_with_dark_bg_light_content' },
                            { label: __( 'Theme Color Scheme', 'productive-style' ), value: 'section_with_themed_bg' },
                        ] }
                        onChange={ ( value ) => setAttributes( { section_bg_color_scheme: value } ) }
                        __nextHasNoMarginBottom
                    />
                    
                </PanelBody>
                
            </InspectorControls>
            
            <div { ...useBlockProps() }>
                <ServerSideRender
                    block="productive-style/logo-slider"
                    attributes={ attributes }
                />
            </div>
        </>
    );
}

