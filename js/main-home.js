$(function() {	
	
	/**********INIT HEADER**********/
	$('#header').scrollToFixed();
	init_menu('menu-home');	
	init_search_bar(true);	
	init_profil_menu();
	
	
	init_footer();
	
	//init all buttons
	$('.home-list-link').button();	
	
	$('.action-home').button();		
	
	$('#slider .rsButton').button();
	
	$('#container > .loading').toggle();
	$('#container > .content').fadeToggle(800);
	
	
	//init slider	
	jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.855, 1.235, 0.000, 1.650)';
	$('#slider').royalSlider({
		arrowsNav: true,
		arrowsNavAutoHide: false,		
		fadeinLoadedSlide: false,
		controlNavigationSpacing: 0,
		controlNavigation: 'bullets',
		imageScaleMode: 'none',
		imageAlignCenter:false,
		blockLoop: true,
		loop: true,
		numImagesToPreload: 4,
		transitionType: 'fade',
		keyboardNavEnabled: true,
		block: {
			delay: 400
		},
		autoPlay: {
			delay: 8000,
			enabled: true,
			pauseOnHover: true
		}
	});
});

