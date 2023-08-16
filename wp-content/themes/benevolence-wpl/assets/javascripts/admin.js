jQuery( document ).ready( function( $ ) {

	// Activate color picker
	if( $('.wplook-admin-color-picker').length > 0 ) {
		$('.wplook-admin-color-picker').wpColorPicker();

		$( document ).ajaxComplete( function( event ) {
			$( '.wplook-admin-color-picker' ).each( function( index, element ) {
				$( element ).wpColorPicker();

				if( $( element ).parents( '.widget-content' ).find( '.wp-picker-container' ).length == 2 ) {
					$( element ).parents( '.widget-content' ).find( '.wp-color-result:first' ).css( 'display', 'none' );
				}
			});
		});
	}

});