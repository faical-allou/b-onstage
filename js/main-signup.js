$(function() {		
	$(window).bind('load',function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});		
		init_search_bar(false);	
		init_footer();
		$('#step-' + step).addClass('active');
		//$('#groups-menu').selectBox();
		$('#submit-signup').button();	
		
		/*********SHOW PAGE*********/		
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
	});	
	
	
	/**********INIT TOOLTIP**********/
	$('#signup-form').tooltip({
		position:{
			my: 'right-10',
			at: 'left',
			using: function( position, feedback ) {
				$( this ).css( position );
			}
		},
		tooltipClass : 'ui-dark'
	});

});

