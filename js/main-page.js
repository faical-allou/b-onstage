$(function() {		
	$(window).bind('load', function(){		
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 5000			
		});		
		init_profil_menu();
		init_search_bar(false);	
		init_footer();			
	
	
		$('#page')
		.page('init',{
			user_id				: user_id,
			user_state			: user_state,
			user_group			: user_group,
			active_menu_page	: active_menu_page	
		});		
		
		init_sidebar();
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400, function(){
			//fixed element
			$('#bottom-header-page').scrollToFixed({
				marginTop	: $('#header').outerHeight()
			});		
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

