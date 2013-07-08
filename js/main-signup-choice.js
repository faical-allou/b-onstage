$(function(){
	$(window).bind('load', function(){
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_menu('menu-signup');
		init_search_bar(false);		
		$('#button-signup-stage, #button-signup-artist').button();
		init_footer();
		
		/**********SHOW PAGE**********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(800);
	});	
});