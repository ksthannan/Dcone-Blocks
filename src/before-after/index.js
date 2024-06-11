import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';
import metadata from './block.json';

registerBlockType( metadata.name, {
	attributes: {
		imageUrl: {
			'type': 'string',
			'default': dconeBlocks.imageUrl
		},
		imageAlt: {
			'type': 'string',
			'default': 'Dcon Blocks Before'
		},
		afterimageUrl: {
			'type': 'string',
			'default': dconeBlocks.afterImageUrl
		},
		afterimageAlt: {
			'type': 'string',
			'default': 'Dcon Blocks After'
		},
		contentSize:{
			type: 'string',
			default: 'auto',
		},
		wideSize:{
			type: 'string',
			default: 'auto',
		}
	},
	edit: Edit,
	save,
	
} );
