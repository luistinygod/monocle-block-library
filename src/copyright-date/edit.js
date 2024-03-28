import { __ } from '@wordpress/i18n';

import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl  } from '@wordpress/components';

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { copyrightText, showStartingYear, startingYear } = attributes;

	const currentYear = new Date().getFullYear().toString();

	let displayDate;

	if ( showStartingYear && startingYear ) {
		displayDate = startingYear + '–' + currentYear;
	} else {
		displayDate = currentYear;
	}
	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'monocle-copyright-date')} initialOpen>
					<ToggleControl
						checked={ !! showStartingYear }
						label={ __( 'Show starting year', 'copyright-date-block' ) }
						onChange={ () => setAttributes( { showStartingYear: ! showStartingYear } )}
					/>
					{showStartingYear && (
						<TextControl
							label={__('Starting year', 'copyright-date')}
							value={startingYear || ''}
							onChange={(value) =>
								setAttributes({ startingYear: value })
							}
						/>
					)}
					<TextControl
							label={__('Extra content', 'copyright-date')}
							value={copyrightText || ''}
							onChange={(value) =>
								setAttributes({ copyrightText: value })
							}
						/>
				</PanelBody>
			</InspectorControls>
			<p {...useBlockProps()}>© {displayDate} { copyrightText }</p>
		</>
	)
}
