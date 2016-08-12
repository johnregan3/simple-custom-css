/* globals jQuery, CodeMirror */
( function( $ ) {
	$( document ).ready( function() {
		var textarea, editor;
		textarea = document.getElementById( 'sccss_settings[sccss-content]' );
		editor = CodeMirror.fromTextArea(
			textarea,
			{
				lineNumbers: true,
				lineWrapping: true
			}
		);
	});
})( jQuery );
