import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { useEffect, useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import $ from 'jquery'; 

import './editor.scss';


export default function Edit(props) {
	const { attributes, setAttributes } = props;

	const { imageUrl, imageAlt, afterimageUrl, afterimageAlt, wideSize, contentSize } = attributes;
	const { getBlocks } = useSelect(select => ({
        getBlocks: select('core/block-editor').getBlocks,
    }));
	
	useEffect(() => {
		// Editor iFrame Selector 
		var editorIframe = document.querySelector('iframe[name="editor-canvas"]');
		if (editorIframe) {
			var editorDocument = editorIframe.contentDocument;
			if (editorDocument) {

				var elements = editorDocument.querySelectorAll('.beer-slider');
				elements.forEach(function(element) {

						// Beer Slider Call 
						$.fn.BeerSlider = function (options) {
							options = options || {};
							return this.each(function() {
								new BeerSlider(this, options);
							});
						};
						$(element).BeerSlider({ start: 50 });

						// Appearrance of edit buttons
						$(element).parent().mouseenter(function(){
							var editButtonWrap = $(this).find('.dcone-editor-btns');
							$(editButtonWrap).css("opacity", "1");
						});
						$(element).parent().mouseleave(function(){
							var editButtonWrap = $(this).find('.dcone-editor-btns');
							$(editButtonWrap).css("opacity", "0");
						});

						if(attributes.layout !== undefined){
							$(element).css({
								"width": attributes.layout.contentSize,
								"height": attributes.layout.wideSize
							});
							$(element).find('.beer-reveal > img').css({
								"width": attributes.layout.contentSize,
								"height": attributes.layout.wideSize
							});
						}else{
							$(element).css({
								"width": contentSize,
								"height": wideSize
							});
							$(element).find('.beer-reveal > img').css({
								"width": contentSize,
								"height": wideSize
							});
						}
						
				});

			}
		}
    }, [imageUrl, afterimageUrl, getBlocks, attributes]);	

	const onSelectBeforeImage = (media) => {
        setAttributes({
            imageUrl: media.url,
            imageAlt: media.alt
        });
    };

    const removeBeforeImage = () => {
        setAttributes({
            imageUrl: '',
            imageAlt: ''
        });
    };
	const onSelectAfterImage = (media) => {
        setAttributes({
            afterimageUrl: media.url,
            afterimageAlt: media.alt
        });
    };

    const removeAfterImage = () => {
        setAttributes({
            afterimageUrl: '',
            afterimageAlt: ''
        });
    };

	return (
		<div { ...useBlockProps() }>
			<div className="dcone-editor-btns">
				<div className="dcone-editor-btns-inner">
					<MediaUploadCheck>
							<MediaUpload
								onSelect={onSelectBeforeImage}
								allowedTypes={['image']}
								render={({ open }) => (
									<>
										{ !imageUrl ? (
											<Button onClick={open}>
												{ __('Upload Before Image', 'dcone') }
											</Button>
										) : (
											<>
												<Button onClick={open}>
													{ __('Change Before', 'dcone') }
												</Button>
												{/* <Button onClick={removeBeforeImage} isDestructive>
													{ __('Remove', 'dcone') }
												</Button> */}
											</>
										) }
									</>
								)}
							/>
						</MediaUploadCheck>
				</div>
				<div className="dcone-editor-btns-inner">
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectAfterImage}
							allowedTypes={['image']}
							render={({ open }) => (
								<>
									{ !afterimageUrl ? (
										<Button onClick={open}>
											{ __('Upload After Image', 'dcone') }
										</Button>
									) : (
										<>
											<Button onClick={open}>
												{ __('Change After', 'dcone') }
											</Button>
											{/* <Button onClick={removeAfterImage} isDestructive>
												{ __('Remove', 'dcone') }
											</Button> */}
										</>
									) }
								</>
							)}
						/>
					</MediaUploadCheck>
				</div>
			</div>
			<div className="beer-slider" data-beer-label="before">
				{ imageUrl ? (
					<>
						<img src={imageUrl} alt={imageAlt} />
					</>
					) : (
						<>
						</>
					)
				}
				<div className="beer-reveal" data-beer-label="after">
					{ afterimageUrl ? (
					<>
						<img src={afterimageUrl} alt={afterimageAlt} />
					</>
					) : (
						<>
						</>
					)
				}
				</div>
			</div>
		</div> 
	);
	
}

