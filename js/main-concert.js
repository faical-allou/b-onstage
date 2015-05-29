$(function() {	
	$(window).bind('load', function(){					
		
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex:9999
		});
		init_menu((status=='open') ? 'menu-concert' : 'menu-programmation');
		init_profil_menu();
		init_search_bar(true);
		white_search_bar(true);
		init_footer();
		
		/**********INIT PAGE CONCERT**********/
		$('#concert').concert('init',{
			status				: status,
			page				: 1,
			per_page			: per_page,
			reservation_min		: reservation_min,
			reservation_max		: reservation_max,
			entry_min			: entry_min,
			entry_max			: entry_max	
		});
			
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400, function(){		
			if(status == 'open')
				$('.filter-concert > .inner').scrollToFixed({
					marginTop	: $('#header').outerHeight(),
					limit		: function(){
						var limit = $('#footer').offset().top - $(this).outerHeight(true);						
						return limit;
					}	
				});				
		});	
	});	
});

