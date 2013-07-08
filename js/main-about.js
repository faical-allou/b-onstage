$(function(){
	$(window).bind('load', function(){		
		
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_menu('menu-about');
		init_profil_menu();
		init_menu(about_menu_id);	
		init_search_bar(false);
		init_footer();
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);
	});
});