$(function() {		
	$(window).bind('load', function(){		
		/**********INIT HEADER**********/	
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});		
		init_profil_menu();		
		init_search_bar(false);

		init_footer();	
		
		/********** INIT EVENT **********/
		$('#event').event('init', {			
			event_id : event_id,
			event_status : event_status
		});
		
		$('#event').event('edit',{
			update_url : update_url,
			success_message : success_message,
			success_url : success_url,
			error_message : error_message
		});	
	
	
		/********** SHOW PAGE *********/	
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);			
	});
	
});

