$(function() {
	$(window).bind('load', function(){
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_menu('menu-signup');
		init_search_bar(false);	
		init_profil_menu();
		init_footer();
		$('#step-' + step).addClass('active');	
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
	});	
});

