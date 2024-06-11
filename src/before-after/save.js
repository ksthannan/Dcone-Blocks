
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { useEffect, useState } from '@wordpress/element';
import $ from 'jquery'; 

export default function save(props) {
	// console.log(props);
	const {attributes} = props;
	const { imageUrl, imageAlt, afterimageUrl, afterimageAlt, contentSize, wideSize } = attributes;	

	return (
		<div { ...useBlockProps.save() }>
			<div className="beer-slider" data-beer-label="before" style={{ width: contentSize, height: wideSize }}>
				{ imageUrl && (
				<img src={imageUrl} alt={imageAlt}/>
				)}
				<div className="beer-reveal" data-beer-label="after">
					{ afterimageUrl && (
					<img src={afterimageUrl} alt={afterimageAlt} />
					)}
				</div>
			</div>
		</div>
	);
}
