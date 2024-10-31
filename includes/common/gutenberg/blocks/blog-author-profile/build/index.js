(()=>{"use strict";var e,t={882:(e,t,l)=>{const o=window.React,n=window.wp.blocks,a=window.wp.serverSideRender;var i=l.n(a);const _=window.wp.blockEditor,r=window.wp.i18n,s=JSON.parse('{"UU":"productive-style/blog-author-profile"}'),c=window.wp.data,u=window.wp.components,d=(0,o.createElement)("svg",{width:"24",height:"24",viewBox:"0 0 1792 1792",xmlns:"http://www.w3.org/2000/svg"},(0,o.createElement)("path",{d:"M896 352q-148 0-273 73t-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273-73-273-198-198-273-73zm768 544q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"}));(0,n.registerBlockType)(s.UU,{icon:d,edit:function({attributes:e,setAttributes:t}){const{section_content_layout_format:l,slider_navigation_arrows_control_position:n,section_s_p_view:a,slider_pagination_control_position:s,section_content_wrap_in_small_screen:d,section_content_box_design_style:p,columns_per_row:v,section_total_items:b,section_content_settings_query_order_by:h,section_content_settings_taxonomy:g,section_taxonomy_type:y,section_settings_show_post_pagination:m,section_title:w,section_title_html_tag:x,section_intro:C,section_header_alignment:B,section_read_more_url:f,section_read_more_url_text:E,section_show_content_name_and_position:M,section_content_media_item_shape:S,section_show_content_text:k,productive_style_posts_excerpt_word_count:N,section_content_show_contact_icons:P,section_content_social_media_icon_shape:T,section_block_max_width:R,section_block_spacing:W,section_content_show_url_button_shape:D,section_content_show_url_button_width:H,section_content_content_box_shape:A,section_content_content_box_alignment_h:O,section_bg_color_scheme:L}=e;let j=null;y&&(j=(0,c.useSelect)((e=>e("core").getEntityRecords("taxonomy",y,{per_page:-1})),[]));let z=[];return null!==j?(z=j.map((({id:e,name:t})=>({label:t,value:e}))),z.unshift({label:(0,r.__)("Select an Option","productive-style"),value:"0"})):z.push({label:"No matching content found",value:"0"}),(0,o.createElement)(o.Fragment,null,(0,o.createElement)(_.InspectorControls,null,(0,o.createElement)(u.PanelBody,{title:(0,r.__)("Format (Layout)","productive-style")},(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Format","productive-style"),labelPosition:"top",value:l,options:[{label:(0,r.__)("Slider","productive-style"),value:"slider"},{label:(0,r.__)("Grid","productive-style"),value:"grid"},{label:(0,r.__)("List (in grid, left media)","productive-style"),value:"list_lefted_grided"},{label:(0,r.__)("List (in grid, right media)","productive-style"),value:"list_righted_grided"}],onChange:e=>t({section_content_layout_format:e}),__nextHasNoMarginBottom:!0}),"slider"==l&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Max Visible Slides","productive-style"),labelPosition:"top",value:a,options:[{label:(0,r.__)("4.5 Slides","productive-style"),value:"s_p_view_4_5"},{label:(0,r.__)("4 Slides","productive-style"),value:"s_p_view_4"},{label:(0,r.__)("3.5 Slides","productive-style"),value:"s_p_view_3_5"},{label:(0,r.__)("3 Slides","productive-style"),value:"s_p_view_3"},{label:(0,r.__)("2.5 Slides","productive-style"),value:"s_p_view_2_5"}],onChange:e=>t({section_s_p_view:e}),__nextHasNoMarginBottom:!0}),"slider"==l&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Slider Nav Controls","productive-style"),labelPosition:"top",value:n,options:[{label:(0,r.__)("None","productive-style"),value:"none-arrow"},{label:(0,r.__)("Inside Content (overlay)","productive-style"),value:"nav-arrows-sides-in"},{label:(0,r.__)("Beside Content","productive-style"),value:"nav-arrows-sides-out"},{label:(0,r.__)("Above Content","productive-style"),value:"nav-arrows-top-out"},{label:(0,r.__)("Below Content","productive-style"),value:"nav-arrows-bottom-out"}],onChange:e=>t({slider_navigation_arrows_control_position:e}),__nextHasNoMarginBottom:!0}),"slider"==l&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Slider Pagination Controls","productive-style"),labelPosition:"top",value:s,options:[{label:(0,r.__)("None","productive-style"),value:"none-pagination"},{label:(0,r.__)("Inside Content (overlay)","productive-style"),value:"nav-pagination-in"},{label:(0,r.__)("Below Content","productive-style"),value:"nav-pagination-out"}],onChange:e=>t({slider_pagination_control_position:e}),__nextHasNoMarginBottom:!0}),"slider"!=l&&"grid"!=l&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Wrap Content in Small Screens","productive-style"),labelPosition:"top",value:d,options:[{label:(0,r.__)("Yes","productive-style"),value:"wrap_to_one_column_in_small_screen"},{label:(0,r.__)("No","productive-style"),value:"none"}],onChange:e=>t({section_content_wrap_in_small_screen:e}),__nextHasNoMarginBottom:!0}),("slider"==l||"grid"==l)&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Style","productive-style"),labelPosition:"top",value:p,options:[{label:(0,r.__)("Content Below Photo","productive-style"),value:"content_below_media"},{label:(0,r.__)("Content Over Photo (fits content)","productive-style"),value:"content_on_top_media_fit_content"},{label:(0,r.__)("Content Over Photo (full coverage on hover)","productive-style"),value:"content_on_top_media_full_cover"}],onChange:e=>t({section_content_box_design_style:e}),__nextHasNoMarginBottom:!0})),(0,o.createElement)(u.PanelBody,{title:(0,r.__)("Data","productive-style")},z&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Category","productive-style"),labelPosition:"top",value:g,options:z,onChange:e=>t({section_content_settings_taxonomy:e}),__nextHasNoMarginBottom:!0}),"slider"!=l&&(0,o.createElement)(u.RangeControl,{label:(0,r.__)("Columns per row","productive-style"),min:1,max:7,value:v,onChange:e=>t({columns_per_row:e})}),(0,o.createElement)(u.RangeControl,{label:(0,r.__)("Total Profiles","productive-style"),min:1,max:100,value:b,onChange:e=>t({section_total_items:e})}),(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Order By","productive-style"),labelPosition:"top",value:h,options:[{label:(0,r.__)("Newest First","productive-style"),value:"newest"},{label:(0,r.__)("Oldest First","productive-style"),value:"oldest"},{label:(0,r.__)("My Order","productive-style"),value:"menu_order"},{label:(0,r.__)("Title (a-z)","productive-style"),value:"title_a_z"},{label:(0,r.__)("Title (z-a)","productive-style"),value:"title_z_a"}],onChange:e=>t({section_content_settings_query_order_by:e}),__nextHasNoMarginBottom:!0}),"slider"!=l&&(0,o.createElement)(u.ToggleControl,{checked:!!m,label:(0,r.__)("Enable Pagination","productive-style"),onChange:()=>t({section_settings_show_post_pagination:!m})})),(0,o.createElement)(u.PanelBody,{title:(0,r.__)("Header","productive-style")},(0,o.createElement)(u.TextControl,{label:(0,r.__)("Title","productive-style"),value:w||"",onChange:e=>t({section_title:e})}),w&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Title html Tag","productive-style"),labelPosition:"top",value:x,options:[{label:(0,r.__)("h1 html tag","productive-style"),value:"h1"},{label:(0,r.__)("h2 html tag","productive-style"),value:"h2"},{label:(0,r.__)("h3 html tag","productive-style"),value:"h3"},{label:(0,r.__)("h4 html tag","productive-style"),value:"h4"},{label:(0,r.__)("h5 html tag","productive-style"),value:"h5"},{label:(0,r.__)("h6 html tag","productive-style"),value:"h6"},{label:(0,r.__)("div html tag","productive-style"),value:"div"},{label:(0,r.__)("span html tag","productive-style"),value:"span"}],onChange:e=>t({section_title_html_tag:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.TextControl,{label:(0,r.__)("Description","productive-style"),value:C||"",onChange:e=>t({section_intro:e})}),(w||C)&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Header Alignment","productive-style"),labelPosition:"top",value:B,options:[{label:(0,r.__)("None","productive-style"),value:"none"},{label:(0,r.__)("Center","productive-style"),value:"centered"},{label:(0,r.__)("Left","productive-style"),value:"lefted"},{label:(0,r.__)("Right","productive-style"),value:"righted"},{label:(0,r.__)("Justify","productive-style"),value:"justified"}],onChange:e=>t({section_header_alignment:e}),__nextHasNoMarginBottom:!0})),(0,o.createElement)(u.PanelBody,{title:(0,r.__)("Read More Options","productive-style")},(0,o.createElement)(u.TextControl,{label:(0,r.__)("Read More Url","productive-style"),value:f||"",onChange:e=>t({section_read_more_url:e})}),(0,o.createElement)(u.TextControl,{label:(0,r.__)("Read More Button Copy","productive-style"),value:E||"",onChange:e=>t({section_read_more_url_text:e})}),""!==f&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Read More Button Shape","productive-style"),labelPosition:"top",value:D,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-content-button-default"},{label:(0,r.__)("Sharp Corner","productive-style"),value:"shapeable-content-button-sharp-corner"},{label:(0,r.__)("Rounded Corner","productive-style"),value:"shapeable-content-button-rounded-corner"},{label:(0,r.__)("Ellipse","productive-style"),value:"shapeable-content-button-ellipsed"}],onChange:e=>t({section_content_show_url_button_shape:e}),__nextHasNoMarginBottom:!0}),""!==f&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Button Width","productive-style"),labelPosition:"top",value:H,options:[{label:(0,r.__)("Wrap Around Text","productive-style"),value:"button-width-auto"},{label:(0,r.__)("Full Width","productive-style"),value:"button-width-100pc"}],onChange:e=>t({section_content_show_url_button_width:e}),__nextHasNoMarginBottom:!0})),(0,o.createElement)(u.PanelBody,{title:(0,r.__)("Content","productive-style")},(0,o.createElement)(u.SelectControl,{label:(0,r.__)("photo Shape","productive-style"),labelPosition:"top",value:S,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-image-default"},{label:(0,r.__)("Sharp Corner","productive-style"),value:"shapeable-image-sharped-corner"},{label:(0,r.__)("Rounded Corner","productive-style"),value:"shapeable-image-rounded-corner"},{label:(0,r.__)("Ellipse","productive-style"),value:"shapeable-image-ellipsed"},{label:(0,r.__)("Oval","productive-style"),value:"shapeable-image-ovalled"}],onChange:e=>t({section_content_media_item_shape:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.ToggleControl,{checked:!!M,label:(0,r.__)("Display Name and Position","productive-style"),onChange:()=>t({section_show_content_name_and_position:!M})}),(0,o.createElement)(u.ToggleControl,{checked:!!k,label:(0,r.__)("Display Bio","productive-style"),onChange:()=>t({section_show_content_text:!k})}),(0,o.createElement)(u.RangeControl,{label:(0,r.__)("Bio Word Count","productive-style"),min:1,max:500,value:N,onChange:e=>t({productive_style_posts_excerpt_word_count:e})}),(0,o.createElement)(u.ToggleControl,{checked:!!P,label:(0,r.__)("Display Social Media Icons","productive-style"),onChange:()=>t({section_content_show_contact_icons:!P})}),P&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Social Media Icons Shape","productive-style"),labelPosition:"top",value:T,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-icon-default"},{label:(0,r.__)("Sharp Corner","productive-style"),value:"shapeable-icon-sharped-corner"},{label:(0,r.__)("Rounded Corner","productive-style"),value:"shapeable-icon-rounded-corner"},{label:(0,r.__)("Ellipse","productive-style"),value:"shapeable-icon-ellipsed"},{label:(0,r.__)("Oval","productive-style"),value:"shapeable-icon-ovalled"}],onChange:e=>t({section_content_social_media_icon_shape:e}),__nextHasNoMarginBottom:!0}),"content_below_media"===p&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Content Box Type","productive-style"),labelPosition:"top",value:A,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-content-box-default"},{label:(0,r.__)("Default, with Background","productive-style"),value:"shapeable-content-box-default-with-bg"},{label:(0,r.__)("Default, with Border","productive-style"),value:"shapeable-content-box-default-with-border"},{label:(0,r.__)("Rounded Corner, with Background","productive-style"),value:"shapeable-content-box-rounded-corner-with-bg"},{label:(0,r.__)("Rounded Corner, with Border","productive-style"),value:"shapeable-content-box-rounded-corner-with-border"},{label:(0,r.__)("Ellipse, with Background","productive-style"),value:"shapeable-content-box-ellipsed-with-bg"},{label:(0,r.__)("Ellipse, with Border","productive-style"),value:"shapeable-content-box-ellipsed-with-border"},{label:(0,r.__)("Default, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-default-with-bg"},{label:(0,r.__)("Default, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-default-with-border"},{label:(0,r.__)("Rounded Corner, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-rounded-corner-with-bg"},{label:(0,r.__)("Rounded Corner, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-rounded-corner-with-border"},{label:(0,r.__)("Ellipse, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-ellipsed-with-bg"},{label:(0,r.__)("Ellipse, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-ellipsed-with-border"}],onChange:e=>t({section_content_content_box_shape:e}),__nextHasNoMarginBottom:!0}),"content_below_media"!==p&&("slider"===l||"grid"===l)&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Content Box Type","productive-style"),labelPosition:"top",value:A,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-content-box-default"},{label:(0,r.__)("Rounded Corner, with Background","productive-style"),value:"shapeable-content-box-rounded-corner-with-bg"},{label:(0,r.__)("Ellipse, with Background","productive-style"),value:"shapeable-content-box-ellipsed-with-bg"}],onChange:e=>t({section_content_content_box_shape:e}),__nextHasNoMarginBottom:!0}),"content_below_media"!==p&&("list_lefted_grided"===l||"list_righted_grided"===l)&&(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Content Box Type","productive-style"),labelPosition:"top",value:A,options:[{label:(0,r.__)("Default","productive-style"),value:"shapeable-content-box-default"},{label:(0,r.__)("Default, with Background","productive-style"),value:"shapeable-content-box-default-with-bg"},{label:(0,r.__)("Default, with Border","productive-style"),value:"shapeable-content-box-default-with-border"},{label:(0,r.__)("Rounded Corner, with Background","productive-style"),value:"shapeable-content-box-rounded-corner-with-bg"},{label:(0,r.__)("Rounded Corner, with Border","productive-style"),value:"shapeable-content-box-rounded-corner-with-border"},{label:(0,r.__)("Ellipse, with Background","productive-style"),value:"shapeable-content-box-ellipsed-with-bg"},{label:(0,r.__)("Ellipse, with Border","productive-style"),value:"shapeable-content-box-ellipsed-with-border"},{label:(0,r.__)("Default, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-default-with-bg"},{label:(0,r.__)("Default, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-default-with-border"},{label:(0,r.__)("Rounded Corner, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-rounded-corner-with-bg"},{label:(0,r.__)("Rounded Corner, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-rounded-corner-with-border"},{label:(0,r.__)("Ellipse, with Background (Box)","productive-style"),value:"shapeable-content-whole-box-ellipsed-with-bg"},{label:(0,r.__)("Ellipse, with Border (Box)","productive-style"),value:"shapeable-content-whole-box-ellipsed-with-border"}],onChange:e=>t({section_content_content_box_shape:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Content Alignment (Horizontal)","productive-style"),labelPosition:"top",value:O,options:[{label:(0,r.__)("Center","productive-style"),value:"justify-block-content-center"},{label:(0,r.__)("Left","productive-style"),value:"justify-block-content-left"},{label:(0,r.__)("Right","productive-style"),value:"justify-block-content-right"}],onChange:e=>t({section_content_content_box_alignment_h:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Block Size (Width)","productive-style"),labelPosition:"top",value:R,options:[{label:(0,r.__)("Default","productive-style"),value:"siteMaxWidth_Std"},{label:(0,r.__)("Narrow","productive-style"),value:"siteMaxWidth_Narrow"},{label:(0,r.__)("Narrow, Align Left","productive-style"),value:"siteMaxWidth_Narrow_Align_Left"},{label:(0,r.__)("Narrow, Align Right","productive-style"),value:"siteMaxWidth_Narrow_Align_Right"},{label:(0,r.__)("Thin","productive-style"),value:"siteMaxWidth_Thin"},{label:(0,r.__)("Thin, Align Left","productive-style"),value:"siteMaxWidth_Thin_Align_Left"},{label:(0,r.__)("Thin, Align Right","productive-style"),value:"siteMaxWidth_Thin_Align_Right"},{label:(0,r.__)("Extra Thin","productive-style"),value:"siteMaxWidth_Mini"},{label:(0,r.__)("Extra Thin, Align Left","productive-style"),value:"siteMaxWidth_Mini_Align_Left"},{label:(0,r.__)("Extra Thin, Align Right","productive-style"),value:"siteMaxWidth_Mini_Align_Right"},{label:(0,r.__)("Micro Thin","productive-style"),value:"siteMaxWidth_Micro"},{label:(0,r.__)("Micro Thin, Align Left","productive-style"),value:"siteMaxWidth_Micro_Align_Left"},{label:(0,r.__)("Micro Thin, Align Right","productive-style"),value:"siteMaxWidth_Micro_Align_Right"},{label:(0,r.__)("Wide","productive-style"),value:"siteMaxWidth_Wide"},{label:(0,r.__)("Full Width (with padding)","productive-style"),value:"siteMaxWidth_Extended"},{label:(0,r.__)("Full Width (100%)","productive-style"),value:"siteMaxWidth_100pc"}],onChange:e=>t({section_block_max_width:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Block Spacing","productive-style"),labelPosition:"top",value:W,options:[{label:(0,r.__)("No Spacing","productive-style"),value:"section_spacing_none"},{label:(0,r.__)("Default","productive-style"),value:"section_spacing_default"},{label:(0,r.__)("Small","productive-style"),value:"section_spacing_small"},{label:(0,r.__)("Large","productive-style"),value:"section_spacing_large"}],onChange:e=>t({section_block_spacing:e}),__nextHasNoMarginBottom:!0}),(0,o.createElement)(u.SelectControl,{label:(0,r.__)("Component Background Color Scheme","productive-style"),labelPosition:"top",value:L,options:[{label:(0,r.__)("None","productive-style"),value:"section_with_no_bg"},{label:(0,r.__)("Light Background","productive-style"),value:"section_with_light_bg"},{label:(0,r.__)("Dark Background","productive-style"),value:"section_with_dark_bg"},{label:(0,r.__)("Light Background, Dark Content","productive-style"),value:"section_with_light_bg_dark_content"},{label:(0,r.__)("Dark Background, Light Content","productive-style"),value:"section_with_dark_bg_light_content"},{label:(0,r.__)("Theme Color Scheme","productive-style"),value:"section_with_themed_bg"}],onChange:e=>t({section_bg_color_scheme:e}),__nextHasNoMarginBottom:!0}))),(0,o.createElement)("div",{...(0,_.useBlockProps)()},(0,o.createElement)(i(),{block:"productive-style/blog-author-profile",attributes:e})))},save:function(){return null}})}},l={};function o(e){var n=l[e];if(void 0!==n)return n.exports;var a=l[e]={exports:{}};return t[e](a,a.exports,o),a.exports}o.m=t,e=[],o.O=(t,l,n,a)=>{if(!l){var i=1/0;for(c=0;c<e.length;c++){for(var[l,n,a]=e[c],_=!0,r=0;r<l.length;r++)(!1&a||i>=a)&&Object.keys(o.O).every((e=>o.O[e](l[r])))?l.splice(r--,1):(_=!1,a<i&&(i=a));if(_){e.splice(c--,1);var s=n();void 0!==s&&(t=s)}}return t}a=a||0;for(var c=e.length;c>0&&e[c-1][2]>a;c--)e[c]=e[c-1];e[c]=[l,n,a]},o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var l in t)o.o(t,l)&&!o.o(e,l)&&Object.defineProperty(e,l,{enumerable:!0,get:t[l]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={57:0,350:0};o.O.j=t=>0===e[t];var t=(t,l)=>{var n,a,[i,_,r]=l,s=0;if(i.some((t=>0!==e[t]))){for(n in _)o.o(_,n)&&(o.m[n]=_[n]);if(r)var c=r(o)}for(t&&t(l);s<i.length;s++)a=i[s],o.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return o.O(c)},l=globalThis.webpackChunkblog_author_profile=globalThis.webpackChunkblog_author_profile||[];l.forEach(t.bind(null,0)),l.push=t.bind(null,l.push.bind(l))})();var n=o.O(void 0,[350],(()=>o(882)));n=o.O(n)})();