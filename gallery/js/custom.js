/**
 * custom.js
 *
 * Custom scripts.
 */

( function( $ ) {

	jQuery( document ).ready(function($){

		var $masonry_boxes = $( '.masonry-entry' );
		$masonry_boxes.hide();

		var $container = $( '#masonry-loop' );
		$container.imagesLoaded( function(){
			$masonry_boxes.fadeIn( 'slow' );
			$container.masonry({
				itemSelector : '.masonry-entry'
			});
		});

	});

	$( document ).ready(function($){

		// Implment popup for image in masonry
		$( '#masonry-loop' ).photobox('a.popup-link',{
			time:0,
			zoomable:false,
			single: true
		});

		// Implment popup for images in single page
		$( 'div.entry-content' ).photobox('a[href$=\'jpg\'],a[href$=\'jpeg\'],a[href$=\'png\'],a[href$=\'bmp\'],a[href$=\'gif\'],a[href$=\'JPG\'],a[href$=\'JPEG\'],a[href$=\'PNG\'],a[href$=\'BMP\'],a[href$=\'GIF\']',{
			zoomable:false
		});

		// Implement go to top.
		var $scroll_obj = $( '#btn-scrollup' );
		if ( $scroll_obj.length > 0 ) {

			$( window ).scroll(function(){
				if ($( this ).scrollTop() > 100) {
					$scroll_obj.fadeIn();
				} else {
					$scroll_obj.fadeOut();
				}
			});

			$scroll_obj.click(function(){
				$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
				return false;
			});
		}

	});

} )( jQuery );
