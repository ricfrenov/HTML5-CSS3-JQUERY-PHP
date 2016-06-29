function bdParseRel( obj ) {
    var objrel = jQuery( obj ).attr( 'rel' );
    objrel = objrel.split( ';' );
    var objret = {};
    for ( var i = 0; i < objrel.length; i++ ) {
        if ( objrel[i].replace(/\s/gi, '') != '' ) {
            var relattr = objrel[i].split( ':' );
            objret[relattr[0]] = relattr[1];
        }
    }
    return objret;
}

function bdTimesLinks() {
    if ( typeof( bdAjax ) != 'undefined' ) {
        jQuery( 'a.ajax_time_link' ).click( function () {
            jQuery( this ).parents( 'ul.nav-tabs' ).find( 'li.active' ).removeClass( 'active' );
            jQuery( this ).parents( 'ul.nav-tabs li' ).addClass( 'active' );
            var tid = bdParseRel(this).timeID;
            if ( tid ) {
                jQuery( 'div.ajax_time_posts' ).css( 'opacity', .5 );
                jQuery.get(
                    bdAjax.ajaxurl,
                    {
                        action: 'timePosts',
                        timeID: tid
                    },
                    function ( responseMarkup ) {
                        jQuery( 'div.ajax_time_posts' ).html( responseMarkup ).css( 'opacity', 1 );
                        if ( typeof( 'sliderNav' ) != 'undefined' ) sliderNav( jQuery );
                    }
                );
                return false;
            }
        } );
    }
}

jQuery(document).ready( bdTimesLinks );

