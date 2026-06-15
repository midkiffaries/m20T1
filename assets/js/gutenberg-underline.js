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