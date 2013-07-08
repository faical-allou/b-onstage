$(function() {	
	$(window).bind('load', function(){
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_menu('menu-signin');
		init_search_bar(false);	
		init_footer();
		$('#submit-signin').button();	
	
		/*********SHOW PAGE**********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);
	});	
	
});

