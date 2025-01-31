import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { useBlockProps } from '@wordpress/block-editor';

import './style.scss';
import Edit from './edit';
import save from './save';
import metadata from './block.json';

const productveminds_block_icon_logo_slider = (
    <svg 
        width="24" 
        height="24" 
        viewBox="0 0 1792 1792" 
        xmlns="http://www.w3.org/2000/svg"
    >
        <path d="M896 352q-148 0-273 73t-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273-73-273-198-198-273-73zm768 544q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
    </svg>
);

registerBlockType( metadata.name, {
    icon: productveminds_block_icon_logo_slider,
    edit: Edit,
    save
} );
