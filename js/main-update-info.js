$(function() {
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		$('input:submit').button();		
		init_search_bar(false);
		init_profil_menu();
		init_account_menu();		

		init_footer();
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);		
	});
});

