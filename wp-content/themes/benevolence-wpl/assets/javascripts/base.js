jQuery(document).ready(function($){
	"use strict";
	//initiating jQuery

	/* Sticky menu */
	jQuery(function(jQuery) {
		jQuery(document).ready( function() {
		//enabling stickUp on the '.navbar-wrapper' class
		jQuery('#masthead .menu').stickUp();
		});
	});

	/* Causes hover */
	jQuery("article.item").hover(function(){
		jQuery( this ).toggleClass("box-select");
	});



	/* Flexslider */
	jQuery('.flexslider-teaser').flexslider({
		animation: "fade",
		animationLoop: true,
		pauseOnAction: true,
		pauseOnHover: true,
		start: function(slider) {
			jQuery( '.flexslider-teaser' ).removeClass('loading');
		}
	});




	/* Gallery Posts Slider */
	jQuery('.flexslider-gallery').flexslider({
		animation: "fade",
		animationLoop: true,
		pauseOnAction: true,
		pauseOnHover: true,
		start: function(slider) {
			jQuery( '.flexslider-gallery' ).removeClass('loading');
		}
	});



	/* OWL Carousel */
	var owl = jQuery("#owl-sponsors");

	owl.owlCarousel({
		loop:true,
	    margin:10,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:3,
	            nav:false
	        },
	        1000:{
	            items:4,
	            nav:true,
	            loop:false
	        }
	    },
	    navText: [$('.owl.next'),$('.owl.prev')],

	});

	jQuery(".next").click(function(){
		owl.trigger('next.owl.carousel');
	})

	jQuery(".prev").click(function(){
		owl.trigger('prev.owl.carousel');
	})

	/* Mean Menu */
	jQuery('#site-navigation .container_12.non-res').meanmenu();

	/* Masonry */
	var jQuerycontainer = jQuery('.js-masonry');
	jQuerycontainer.imagesLoaded(function(){
		jQuerycontainer.masonry({
			itemSelector: '.item',
			columnWidth: 1,
			isAnimated: true,
			animationOptions: {
				duration: 750,
				easing: 'easeInOutCirc',
				queue: false
			}
		});

	});


	/* FitVids */
	// Target your .container, .wrapper, .post, etc.
	jQuery("#content, iframe").fitVids();

	/* Google Maps */
	if( $( '.wplook-google-map' ).length > 0 ) {
		$( '.wplook-google-map' ).each( function( index, element ) {
			$( element ).wplGoogleMaps();
		} );
	}

	/* Tabs */
	jQuery('.panes .tab-content').hide();
	jQuery(".tabs a:first").addClass("selected");
	jQuery(".tabs_table").each(function(){
			jQuery(this).find('.panes .tab-content:first').show();
			jQuery(this).find('a:first').addClass("selected");
	});
	jQuery('.tabs a').click(function(){
			var which = jQuery(this).attr("rel");
			jQuery(this).parents(".tabs_table").find(".selected").removeClass("selected");
			jQuery(this).addClass("selected");
			jQuery(this).parents(".tabs_table").find(".panes").find(".tab-content").hide();
			jQuery(this).parents(".tabs_table").find(".panes").find("#"+which).fadeIn(800);
	});

	/* Toggle */
	jQuery(".toggle-content .expand-button").click(function() {
		jQuery(this).toggleClass('close').parent('div').find('.expand').slideToggle(250);
	});

	/* Menu */
	// Following http://stackoverflow.com/questions/11512032/detect-if-dropdown-navigation-would-go-off-screen-and-reposition-it
	jQuery(".site-navigation.main-navigation .menu > li").on('mouseenter mouseleave', function (e) {
		if (jQuery('ul.sub-menu', this).length) {
			var elm = jQuery('li:first', this);
			var off = elm.offset();
			var l = off.left;
			var w = elm.width();
			var docW = jQuery(window).width();

			var isEntirelyVisible = (l + w <= docW);

			if (!isEntirelyVisible) {
				jQuery('ul.sub-menu', this).addClass('off-screen');
			} else {
				jQuery('ul.sub-menu', this).removeClass('off-screen');
			}
		}
	});

	/* Month selection for events */
	jQuery( '#month-selection-dropdown' ).change( function() {
		window.location.href = jQuery( this ).find( ':selected' ).data( 'url' );
	} );

	// Payment Options
	$(document).ready(function(){
		$("input[name$='payment-type']").click(function() {
			var payment = $(this).val();
			if (payment == 'paypal') {
				$(".donatenow-stripe").addClass("is-hidden").removeClass("is-visible");
				$(".donatenow-paypal").addClass("is-visible").removeClass("is-hidden");
			}
			if (payment == 'stripe') {
				$(".donatenow-paypal").addClass("is-hidden").removeClass("is-visible");;
				$(".donatenow-stripe").addClass("is-visible").removeClass("is-hidden");
			}
		});
	});

	/* Full Calendar */
	if( $( '.wplook-events-calendar' ).length > 0 ) {
		var calendar = $( '.wplook-events-calendar' );

		calendar.fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			locale: calendar.data( 'language' ),
			eventColor: calendar.data( 'color' ),
			eventSources: [
				{
					url: i18n.ajaxUrl,
					data: {
						'action': 'wplook_events_fullcalendar'
					},
					success: function( data ) {
						calendar.find( '.loading' ).removeClass( 'visible' );
						calendar.find( '.loading .loading-events' ).addClass( 'visible' );
						calendar.find( '.loading .error' ).removeClass( 'visible' );
					},
					beforeSend: function() {
						calendar.find( '.loading' ).addClass( 'visible' );
						calendar.find( '.loading .loading-events' ).addClass( 'visible' );
						calendar.find( '.loading .error' ).removeClass( 'visible' );
					},
					error: function( data ) {
						calendar.find( '.loading .error' ).addClass( 'visible' );
						calendar.find( '.loading .loading-events' ).removeClass( 'visible' );
						calendar.find( '.loading .error-contents' ).html( data.responseText );
					}
				}
			]
		});
	}

	if( $( '.wplook-google-calendar-full' ).length > 0 ) {
		var calendar = $( '.wplook-google-calendar-full' );

		calendar.fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			locale: calendar.data( 'language' ),
			eventColor: calendar.data( 'color' ),
			googleCalendarApiKey: calendar.data( 'api-key' ),
			events: calendar.data( 'calendar' ),
			eventClick: function( event ) {
				// opens events in a popup window
				window.open( event.url, 'gcalevent', 'width=800,height=700' );
				return false;
			},
			loading: function( isLoading ) {
				if( isLoading ) {
					calendar.find( '.loading' ).addClass( 'visible' );
					calendar.find( '.loading .loading-events' ).addClass( 'visible' );
					calendar.find( '.loading .error' ).removeClass( 'visible' );
				} else {
					calendar.find( '.loading' ).removeClass( 'visible' );
					calendar.find( '.loading .loading-events' ).addClass( 'visible' );
					calendar.find( '.loading .error' ).removeClass( 'visible' );
				}
			},
		});
	}

	if( $( '.wplook-google-calendar-list' ).length > 0 ) {
		$( '.wplook-google-calendar-list' ).each( function( index, element ) {
			var calendar = $( element );

			calendar.fullCalendar({
				header: {
					left: 'prev,next',
					center: '',
					right: 'title'
				},
				defaultView: 'listMonth',
				height: 350,
				locale: calendar.data( 'language' ),
				eventColor: calendar.data( 'color' ),
				googleCalendarApiKey: calendar.data( 'api-key' ),
				events: calendar.data( 'calendar' ),
				eventClick: function( event ) {
					// opens events in a popup window
					window.open( event.url, 'gcalevent', 'width=800,height=700' );
					return false;
				},
				loading: function( isLoading ) {
					if( isLoading ) {
						calendar.find( '.loading' ).addClass( 'visible' );
						calendar.find( '.loading .loading-events' ).addClass( 'visible' );
						calendar.find( '.loading .error' ).removeClass( 'visible' );
					} else {
						calendar.find( '.loading' ).removeClass( 'visible' );
						calendar.find( '.loading .loading-events' ).addClass( 'visible' );
						calendar.find( '.loading .error' ).removeClass( 'visible' );
					}
				},
			});
		});
	}


});


// Share buttons
function twwindows(object) {
	window.open( object, "twshare", "height=400,width=550,resizable=1,toolbar=0,menubar=0,status=0,location=0" )
}

function fbwindows(object) {
	window.open( object, "fbshare", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
}

function pinwindows(object) {
	window.open( object, "pinshare", "height=270,width=630,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
}

function gpwindows(object) {
	window.open( object, "pinshare", "height=600,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
}