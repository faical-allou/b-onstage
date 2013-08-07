$(function(){	
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_search_bar(false);	
		init_profil_menu();		
		init_account_menu('a-m-reservation');			
	
		init_footer();
		
		$('#sidebar').scrollToFixed({
			marginTop	: $('#header').outerHeight() + 70,
			limit		: function(){
				var limit = $('#footer').offset().top - $(this).outerHeight(true);						
				return limit;
			}
		});
		
		/**********INIT BUTTON**********/
		$('#show-profil').button();
		
		/**********INIT TABS RESERVATIONS**********/
		$('#reservation-menu > li').click(function(){
			if(!$(this).hasClass('active')){
				$('#reservation-menu > li.active').removeClass('active');
				$('.reservation-content.active').removeClass('active');
				content_id = $(this).data('content-id');
				
				$(this).addClass('active')
				$(content_id).addClass('active');
			}	
		});
		
		
		/**********INIT RECOMMENDATIONS**********/
		$('.recommendations').alert();
		
		
		$.countdown.regional['fr'] = {
			labels: [document.getElementById("calendar_years").innerHTML, document.getElementById("calendar_months").innerHTML, document.getElementById("calendar_weeks").innerHTML, document.getElementById("calendar_days").innerHTML, document.getElementById("calendar_hours").innerHTML, document.getElementById("calendar_minutes").innerHTML, document.getElementById("calendar_seconds").innerHTML],
			labels1: [document.getElementById("calendar_year").innerHTML, document.getElementById("calendar_month").innerHTML, document.getElementById("calendar_week").innerHTML, document.getElementById("calendar_day").innerHTML, document.getElementById("calendar_hour").innerHTML, document.getElementById("calendar_minute").innerHTML, document.getElementById("calendar_second").innerHTML],
			compactLabels: [document.getElementById("calendar_y").innerHTML, document.getElementById("calendar_m").innerHTML, document.getElementById("calendar_w").innerHTML, document.getElementById("calendar_d").innerHTML],
			whichLabels: function(amount) {
				return (amount > 1 ? 0 : 1);
			},
			digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
			timeSeparator: ':', isRTL: false};
		$.countdown.setDefaults($.countdown.regional['fr']);
		
		//init compteur 
		var nbr_pending_reservation = $('.pending-reservation').length;
		var nbr_accepted_reservation = $('.accepted-reservation').length;
		var nbr_close_reservation = $('.close-reservation').length;
			
		
		$('.reservation').each(function(){
			switch($(this).data('status')){
				case 'pending' :			
					break;
					
				case 'accepted' :		
					cancel_date = new Date($(this).data('date-modified')*1000).add({hours:48});						
					$(this).find('.countdown').countdown({until:new Date(cancel_date.getFullYear(), cancel_date.getMonth(),cancel_date.getDate(), cancel_date.getHours(),cancel_date.getMinutes(),cancel_date.getSeconds()), format: 'HMS', description: ''});
					break;
				
				case 'close' : 
					date_start = new Date($(this).data('date-start')*1000);
					$(this).find('.countdown').countdown({until:new Date(date_start.getFullYear(), date_start.getMonth(),date_start.getDate(), date_start.getHours(),date_start.getMinutes(),date_start.getSeconds()), format: 'DHMS', description: ''});
					break;
				default : break;
			}
		});	
		
		$('.cancel-reservation')
		.button()
		.click(function(){
			reservation_id = $(this).data('reservation-id');
			event_id = $(this).data('event-id');
			event_status = $(this).data('status');
			reservation_artist_id = $(this).data('reservation-artist-id');
			event_artist_id = $(this).data('event-artist-id');
			date_start = $(this).data('date-start');
			cancel_reservation(reservation_id,event_id,event_status,reservation_artist_id, event_artist_id, date_start);
		});
		$('.pay-reservation').button();
		$('.show-concert').button();
				
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
	});
	
	
	
	/********** INIT FUNCTIONS*********/
	function cancel_reservation(reservation_id, event_id, event_status, reservation_artist_id, event_artist_id, date_start){
		var cancel_dialog = $('<div>')
		.dialog({						
			appendTo		: 'body',	
			draggable		: false,
			resizable		: false,
			width			: 600,						
			modal			: true,
			open			: function(){							
				$.ajax({
					url			: '/reservation/warning_msg',
					type		: 'post',
					dataType	: 'json',
					data		: {
						reservation_id			: reservation_id,
						event_id				: event_id,
						event_status			: event_status,
						reservation_artist_id	: reservation_artist_id,
						event_artist_id			: event_artist_id,
						date_start				: date_start	
					},
					success		: function(data){
						cancel_dialog.html(data.msg);
					}
				});	
			},
			buttons: 
			[
				{
					text	: document.getElementById("validatetxt").innerHTML,								
					'class'	: 'ui-purple',									
					click: function() {									
						$.ajax({
							url			: '/reservation/cancel',
							type		: 'post',
							dataType	: 'json',
							data		: {
								reservation_id			: reservation_id,
								event_id				: event_id,
								event_status			: event_status,
								reservation_artist_id	: reservation_artist_id,
								event_artist_id			: event_artist_id,
								date_start				: date_start		
							},
							success		: function(data){							
								if(data.status=='SUCCESS')
									$('#reservation-' + reservation_id).remove();
								show_servor_message(data.msg);
							}
						});									
						$(this).dialog('close').remove();
					}		
				},
				{
					text:document.getElementById("canceltxt").innerHTML,
					click: function() {																				
						$(this).dialog('close').remove();															
					}
				}
			]
		});
	}

});