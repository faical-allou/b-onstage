$(function() {
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_menu('menu-artist');
		init_profil_menu();
		init_search_bar(false);
		init_sidebar();
		init_footer();

		/**********INIT PAGE**********/
		$('#artist').artist('init',{
			page	: page,
			per_page: per_page
		});
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400, function(){
			$('#sidebar').scrollToFixed({
				marginTop	: $('#header').outerHeight() + 20,
				limit		: function(){
					var limit = $('#footer').offset().top - $(this).outerHeight(true);						
					return limit;
				}
			});
		});	
	});		
});
