$(function() {
	
	$(window).bind('load', function(){
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_search_bar(false);
		init_footer();	
		init_profil_menu();	
	
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
	});	
});

