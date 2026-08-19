// Registers the 'Underline' tag in the Gutenberg editor
(function(wp) {
    const { registerFormatType, toggleFormat } = wp.richText;
    const { RichTextToolbarButton } = wp.blockEditor || wp.editor;
    const { __ } = wp.i18n;
    registerFormatType('mytheme/underline', {
        title: __('Underline'),
        tagName: 'u',
        className: null,
        edit(props) {
            return wp.element.createElement(
                RichTextToolbarButton,
                {
                    icon: 'editor-underline',
                    title: __('Underline'),
                    onClick: function() {
                        props.onChange(
                            toggleFormat(
                                props.value,
                                { type: 'mytheme/underline' }
                            )
                        );
                    },
                    isActive: props.isActive
                }
            );
        }
    });
})(window.wp);

// Registers the 'Abbreviation' tag in the Gutenberg editor
(function(wp) {
	const { registerFormatType, toggleFormat, getActiveFormat } = wp.richText;
	const { RichTextToolbarButton } = wp.blockEditor;
	const { Popover, TextControl, Button } = wp.components;
	const { Fragment, useState } = wp.element;
	const { __ } = wp.i18n;

	registerFormatType( 'mytheme/abbreviation', {
		title: __( 'Abbreviation', 'mytheme' ),
		tagName: 'abbr',
		className: null,
		edit: function ( props ) {
			const { isActive, value, onChange, onFocus } = props;
			const [ isOpen, setIsOpen ] = useState( false );
			const [ definition, setDefinition ] = useState( '' );
			const activeFormat = getActiveFormat( value, 'mytheme/abbreviation' );
			const openPopover = function () {
				let existingDefinition = '';
				if (
					activeFormat &&
					activeFormat.attributes &&
					activeFormat.attributes.title
				) {
					existingDefinition = activeFormat.attributes.title;
				}
				setDefinition( existingDefinition );
				setIsOpen( true );
				onFocus();
			};
			const applyAbbreviation = function () {
				if ( ! definition.trim() ) {
					onChange(
						toggleFormat( value, { type: 'mytheme/abbreviation' } )
					);
					setIsOpen( false );
					return;
				}
				onChange(
					toggleFormat(
						value,
						{
							type: 'mytheme/abbreviation',
							attributes: { title: definition.trim() },
						}
					)
				);
				setIsOpen( false );
			};
			return wp.element.createElement(
				Fragment,
				null,
				wp.element.createElement(
					RichTextToolbarButton,
					{
						icon: 'editor-help',
						title: __( 'Abbreviation', 'mytheme' ),
						isActive: isActive,
						onClick: openPopover,
					}
				),
				isOpen &&
					wp.element.createElement(
						Popover,
						{
							position: 'bottom center',
							onClose: function () { setIsOpen( false ) },
							animate: true,
						},
						wp.element.createElement(
							'div', 
                            { style: { padding: '16px', width: '280px' } },
							wp.element.createElement(
								TextControl,
								{
									label: __( 'Abbreviation definition', 'mytheme' ),
									placeholder: __( 'Example: HyperText Markup Language', 'mytheme' ),
									onChange: setDefinition,
									onKeyDown: function ( event ) {
										if (
											event.key === 'Enter'
										) {
											event.preventDefault();
											applyAbbreviation();
										}
									},
								}
							),
							wp.element.createElement(
								Button,
								{
									variant: 'primary',
									onClick: applyAbbreviation,
									style: {
										marginTop: '8px',
									},
								},
								__(
									'Apply',
									'mytheme'
								)
							)
						)
					)
			);
		},
	});
})(window.wp);