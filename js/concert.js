(function( $ ){

	var methods = {

		init : function(options){
			return this.each(function() {					
				/*********INIT VARS**********/
				var o = $.extend(options,{});								
				var status			= o.status,
					reservation_min	= o.reservation_min,
					reservation_max	= o.reservation_max,
					entry_min		= o.entry_min,
					entry_max		= o.entry_max,
					schedule_min	= '00:00:00',
					schedule_max	= '23:59:00',
					payment_type	= {						
						payment_amount		: 0,
						percent_drink		: 0,
						percent_entry		: 0,
						refund_fees			: 0,
						remuneration		: 0
					},					
					page			= o.page,
					genres			= '',
					order_by		= 'date_start',
					time_out_id,
					event_id,
					stage_id;
					
				/**********INIT FILTER**********/			
				//musical genre									
				$('#filter-genre').multiselect({					
					header				: false,
					multiple			: true,
					selectedList		: 5,
					height				: 'auto',
					width				: 'auto',						
					noneSelectedText	: document.getElementById("shows_sortby3").innerHTML					
				})
				.change(function(event){
					selected_options = $(this).val() || [];
					genres = selected_options.join('|');
					show();
				});
				
				
				
				//payment type
				if(status == 'open'){					
					$('#filter-payment input:checkbox').bind('change', function(event){										
						if(time_out_id)
							window.clearTimeout(time_out_id);							
					
						checked_1 = $('#filter-payment-amount').prop('checked') ? 1 : 0;	
						checked_2 = $('#filter-percent-drink').prop('checked') ? 1 : 0;
						checked_3 = $('#filter-percent-entry').prop('checked') ? 1 : 0;
						checked_4 = $('#filter-refund-fees').prop('checked') ? 1 : 0;
						checked_5 = $('#filter-remuneration').prop('checked') ? 1 : 0;				
						
						if(!checked_1 && !checked_2 && !checked_3 && !checked_4 && !checked_5){
							$('#filter-payment input:checkbox')
							.attr('disabled', false)
							.parent()
							.css('opacity',1);
						}
						else if(!checked_1 && !checked_2 && !checked_3 && !checked_4 && checked_5){						
							$('#filter-payment input:checkbox:lt(4)')
							.attr('disabled', true)
							.parent()
							.css('opacity',0.4);
						}
						else if((checked_1 || checked_2 || checked_3 || checked_4 ) && !checked_5){
							$('#filter-payment input:checkbox:last')
							.attr('disabled', true)
							.parent()
							.css('opacity',0.4);
						}
						
						payment_type.payment_amount = checked_1;
						payment_type.percent_drink = checked_2;
						payment_type.percent_entry = checked_3;
						payment_type.refund_fees = checked_4;
						payment_type.remuneration = checked_5;					
						show();
					});
						
						
					//range reservation					
					$('#slider-range-reservation').slider({
						range		: true,
						step		: 5,
						min			: reservation_min,
						max			: reservation_max,		
						values		: [reservation_min,reservation_max],	
						slide		: function( event, ui ) {		
							if(time_out_id)
								window.clearTimeout(time_out_id);

							reservation_min = ui.values[0];
							reservation_max = ui.values[1];
							$('#filter-reservation').text(reservation_min + ' - ' + reservation_max);							
							
							time_out_id = window.setTimeout(
								function(){															
									show();
								},
								1000	
							);	
						}
					});
					$('#filter-reservation').text(reservation_min + ' - ' + reservation_max );
				}
				
				//range entry								
				$('#slider-range-entry').slider({
					range		: true,
					step		: 1,
					min			: entry_min,
					max			: entry_max,		
					values		: [entry_min,entry_max],	
					slide		: function( event, ui ) {
						if(time_out_id)
							window.clearTimeout(time_out_id);
								
						entry_min = ui.values[0];
						entry_max = ui.values[1];
						$('#filter-entry').text(entry_min + ' - ' + entry_max);	
						
						time_out_id = window.setTimeout(
							function(){														
								show();
							},
							1000
						);			
					}
				});
				$('#filter-entry').text(entry_min + ' - ' + entry_max );
				
				//range schedule
				$('#slider-range-schedule').slider({
					range		: true,
					min			: 0,
					max			: 1439,
					step		: 15,
					values		: [0,1439],
					slide		: function( event, ui ) {						
						if(time_out_id)
							window.clearTimeout(time_out_id);
						
						minutes_start = String(Math.floor(ui.values[0] % 60));
						hours_start = String(Math.floor(ui.values[0] / 60 % 24));
						minutes_end = String(Math.floor(ui.values[1] % 60));
						hours_end = String(Math.floor(ui.values[1] / 60 % 24));													
						
						minutes_start = minutes_start.replace(/\d+/g, leading_zero);
						hours_start = hours_start.replace(/\d+/g, leading_zero);
						minutes_end = minutes_end.replace(/\d+/g, leading_zero);
						hours_end = hours_end.replace(/\d+/g, leading_zero);							
						
						$('#filter-schedule').text(hours_start + 'h' + minutes_start + ' - ' + hours_end + 'h' + minutes_end);																
						
						time_out_id = window.setTimeout(
							function(){							
								schedule_min = hours_start + ':' + minutes_start + ':00';
								schedule_max = hours_end + ':' + minutes_end + ':00';
								show();	
							},
							1000							
						);		
					}
				});
				$('#filter-schedule').text('00h00 - 23h59');						
				
				//sort filter
				$('#filter-sort').multiselect({					
					header			: false,
					multiple		: false,
					selectedList	: 1,	
					height			: 'auto',						
					click			: function(event, ui){
						order_by = ui.value;
					show();
					}
				});

				
				/**********INIT RECOMMENDATIONS*********/
				$('.recommendations').alert();				
				
				
				/**********INIT EVENT BUTTON**********/				
				//init show reservation
				$('.show-reservation').button();
				$('.show-concert').button();
				
				//init reservation requets
				$('.book-concert').button();
				$('body').on('click', '.book-concert', function(event){					
					stage_id = $(event.currentTarget).data('stage-id');
					event_id = $(event.currentTarget).data('event-id');					
					reservation_request($(this), event_id, stage_id);
				});				

				//init reservation requets
				$('.request-info').button();

				
				/**********INIT SHOW MORE CONCERT**********/
				$('#more-concert > button:first')
				.button()
				.bind('click', function(event){
					$('#more-concert').addClass('hidden');
					$('#loader-more-concert').show();					
					page = page + 1;
					$.ajax({
						url			: '/concerts/show',
						type		: 'POST',
						dataType	: 'json',
						data		:{							
							page				: page,
							per_page			: o.per_page,
							status				: status,
							schedule_min 		: schedule_min,
							schedule_max		: schedule_max,
							reservation_min		: reservation_min,
							reservation_max 	: reservation_max,
							payment_type		: JSON.parse(JSON.stringify(payment_type)),
							genres				: genres,
							entry_min			: entry_min,
							entry_max			: entry_max,
							order_by			: order_by
						},
						success		: function(data){
							$('#list-concert').append(data.text);
							$('.show-reservation').button();
							$('.book-concert').button();								
							$('.request-info').button();
							$('#loader-more-concert').hide();
							
							if( data.count_event >= o.per_page)
								$('#more-concert').removeClass('hidden');
						}
					});	
				});			
								
				
				/**********INIT FILTER SHOW FUNCTION**********/
				function show(){					
					$('#list-concert').animate({opacity:.2},200);
					if(!$('#more-concert').hasClass('hidden'))
						$('#more-concert').addClass('hidden');
					page = 1;					
					$.ajax({
						url			: '/concerts/show',
						type		: 'POST',
						dataType	: 'json',
						data		:{
							page				: page,
							per_page			: o.per_page,								
							status				: status,
							schedule_min 		: schedule_min,
							schedule_max		: schedule_max,
							reservation_min		: reservation_min,
							reservation_max 	: reservation_max,
							payment_type		: JSON.parse(JSON.stringify(payment_type)),
							genres				: genres,
							entry_min			: entry_min,
							entry_max			: entry_max,
							order_by			: order_by
						},
						success		: function(data){														
							text = (data.count_event == 0) ? '<h1 class="grey title fs-18 pl-20">'+document.getElementById("noresultfound").innerHTML+'</h1>' : data.text;
							$('#list-concert')
								.empty()
								.append(text)	
								.animate({opacity:1},400);	
							$('.show-reservation').button();								
							$('.book-concert').button();
							$('.request-info').button();
							$('.show-concert').button();	
							if( data.count_event >= o.per_page)
								$('#more-concert').removeClass('hidden');							
						}
					});						
				}

				function leading_zero(m){
					return '0'.substr(m.length - 1) + m;
				}	
				
				function reservation_request(button, event_id, stage_id){
					var reservation_dialog = $('<div>')
					.dialog({						
						appendTo		: 'body',	
						draggable		: false,
						resizable		: false,
						width			: 600,						
						modal			: true,
						open			: function(){							
							$.ajax({
								url			: '/reservation/request/' + event_id,
								dataType	: 'json',	
								success		: function(data){
									reservation_dialog.append(data.msg).dialog('option','position','center');
								}	
							});							
						},
						buttons: 
						[
							{
								text	: document.getElementById("validatetxt").innerHTML,								
								'class'	: 'ui-purple',									
								click: function() {									
									if($('#accept-terms').prop('checked')){
										$.ajax({
											url			: '/reservation/send/' + event_id + '/' + stage_id,
											dataType	: 'json',											
											success		: function(data){
											
												switch(data.status){
													case 'SUCCESS'  : 
														show_servor_message(data.msg);
														var parent = button.parent();
														button.remove();
														$('<a>')
														.appendTo(parent)
														.attr('style','font-size:1em')
														.attr('href', '/user/reservations')
														.addClass('show-reservation ui-purple')
														.html('Voir ma réservation')
														.button();														
														break;
													case 'ERROR'	: 
														show_servor_message(data.msg);
														break;
													default			: break;												
												}
											}
										});									
										$(this).dialog('close').remove();
									}
									else
										$('#accept-terms').parent().addClass('ui-state-error');
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
					
					$(window).resize(function(){
						reservation_dialog.dialog('option', 'position', 'center');
					});
					
				}
				
			});
		}
	};

$.fn.concert = function( method ) {

	if ( methods[method] ) {
	return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
	return methods.init.apply( this, arguments );
	} else {
	$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
	}
};
})( jQuery );