( function( $ ) {

	$( document ).ready(function($){

	    // Catogary toggle.
	    $( ".nav-list-btn" ).click(function(){
	        $( ".category-list-wrapper" ).toggle( 'slow' );
	        if( $(".wrap-menu-content").is(":visible") )
	        	$( ".wrap-menu-content" ).toggle( 'slow' );

	    });

	    $( ".menu-toggle" ).click(function(){
	        $( ".wrap-menu-content" ).toggle( 'slow' );
	        if( $(".category-list-wrapper").is(":visible") )
	        	$( ".category-list-wrapper" ).toggle( 'slow' );
	    });

		function initMainNavigation( container ) {
		    // Add dropdown toggle that display child menu items.
		    container.find( '.sub-menu' ).before( '<button class="dropdown-toggle" aria-expanded="false">' + PhotoPerfectScreenReaderText.expand + '</button>' );
		    container.find( '.children' ).before( '<button class="dropdown-toggle" aria-expanded="false">' + PhotoPerfectScreenReaderText.expand + '</button>' );

		    // Toggle buttons and submenu items with active children menu items.
		    container.find( '.current-menu-ancestor > button' ).addClass( 'toggle-on' );
		    container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		    container.find( '.dropdown-toggle' ).click( function( e ) {
				var _this = $( this );
				e.preventDefault();
				_this.toggleClass( 'toggle-on' );
				_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
				_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				_this.html( _this.html() === PhotoPerfectScreenReaderText.expand ? PhotoPerfectScreenReaderText.collapse : PhotoPerfectScreenReaderText.expand );
		    } );
		}
		  initMainNavigation( $( '.header-navigation' ) );
	});

} )( jQuery );
