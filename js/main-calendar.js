$(function() {
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_search_bar(false);	
		init_profil_menu();	
		init_account_menu('a-m-calendar');
		
		init_footer();						
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
		
		
		/********** INIT CALENDAR **********/
		$('#calendar').calendar('init',{
			user_group : user_group,
			url_feed : url_feed			
		});
	});
});

