/* globals wp, jQuery, CodeMirror, _simpleCustomCSSCustomizerExports */
/* exported simpleCustomCSSCustomizer */
var simpleCustomCSSCustomizer = ( function( api, $ ) {
	var self = {
		editor: {},
		textarea: {},
		section: '',
		control: '',
		element: ''
	};

	// Exports must be used to fill the previewData.
	if ( 'undefined' !== typeof _simpleCustomCSSCustomizerExports ) {
		$.extend( self, _simpleCustomCSSCustomizerExports );
	}

	self.init = function() {
		$( document ).ready( function() {
			var control;
			control = api.control.instance( self.control );

			// When our Customizer section is expanded, load CodeMirror.
			api.section( control.section() ).container.on( 'expanded', function() {
				self.textarea = document.getElementById( self.element );
				self.editor = CodeMirror.fromTextArea(
					self.textarea,
					{
						lineNumbers: false,
						lineWrapping: true
					}
				);
				self.editor.on( 'change', function( cm ) {
					var editorVal, changeEvent;
					editorVal = cm.getValue();
					self.textarea.value = editorVal;

					changeEvent = new UIEvent( 'change' );
					self.textarea.dispatchEvent( changeEvent );
				});
			});
		});
	};

	return self;

})( wp.customize, jQuery );
