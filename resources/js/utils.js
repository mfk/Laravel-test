( function( $, window ) {
    $.fn.loadingButton = function( enabled ) {
        var self, $option;

        self = this;

        if ( typeof enabled == 'undefined' || enabled ) {
            $( self ).attr( 'data-text', $( self ).text() );
            $( self ).html( 'Loading ...' ).prop( 'disabled', true );
        } else {
            $( self ).text( $( self ).attr( 'data-text' ) ).prop( 'disabled', false ).removeAttr( 'data-text' );
        }
    };
} )( jQuery, window );