(function( $ ){
		
	var methods = {
	
		init : function(options){		
			return this.each(function() { 												
				
				/*****INIT VARS*****/
				url_feed = options.url_feed;				
				user_group = options.user_group;
				
				/*****INIT ADD, FILTER, SWITCH, LIST BUTTON*****/
				$('#button-create-event').button();																									
				$('#filter-open')
					.badge({checkbox : true})
					.click(function(){
						filter();
					});
				$('#filter-pending')
					.badge({checkbox : true})
					.click(function(){
						filter();
					});
				$('#filter-accepted')
					.badge({checkbox : true})
					.click(function(){
						filter();
					});
				$('#filter-close')
					.badge({checkbox : true})
					.click(function(){
						filter();
					});
					
				$('#switch-calendar').buttonset();
				$('#switch-grid').button( 'option', 'icons', {primary:'ui-icon-switch-calendar'});				
				$('#switch-list').button( 'option', 'icons', {primary:'ui-icon-switch-list'});
				$('#switch-grid, #switch-list').button( 'option', 'text', false);	
					
				$('#switch-list').bind('change',function(){					
					$('#calendar').toggle(400, function(){
						$('#event-list').toggle(400);
					});					
				});
				
				$('#switch-grid').bind('change',function(){					
					$('#event-list').toggle(400, function(){
						$('#calendar').toggle(400);
					});						
				});
				/*********INIT TOOLTIP*********/
				$(document).tooltip({
						position:{
							my: 'top+10',
							at: 'bottom',
							using: function( position, feedback ) {
								$( this ).css( position );
								$('<div>')
									.addClass('ui-arrow')
									.addClass( feedback.vertical )
									.addClass( feedback.horizontal )
									.appendTo( this );
							}
						},
						tooltipClass : 'ui-dark'
					}
				);
						
				/*****INIT FULL CALENDAR*****/							
				var calendar = $('#calendar').fullCalendar({
					theme: true,
					buttonIcons:{
						prev: 'ui-icon ui-icon-carat-1-w',
						next: 'ui-icon ui-icon-carat-1-e'
					},
					disableDragging : true,
					editable: true,					
					/*loading:function (isLoading) { 
					  if (isLoading) 
						 show_servor_message('Chargement...'); 					   
					},*/					
					events:{
						url: url_feed,
						type : 'POST'			
					},					
					eventClick : function(event, jsEvent, view ){					
						event_id = event.id;												
						var dialog_popover_event = $('<div>')
						.attr('id', 'popover-event')
						.dialog({		
							autoOpen	: true,
							appendTo	: 'body',
							width		: 600,
							position	: ['center'],	
							resizable	: false,
							draggable	: false,						
							modal		:true,
							open		: function(event, ui){																
								$.ajax({
									url : '/event/popover/' + event_id,									
									success : function (data){
										$('#popover-event').append(data).dialog('option', 'position', 'center');
									}
								});
							}
						});
					},
					buttonText : {
						today : document.getElementById("today_txt").innerHTML						
					},
					monthNames : [document.getElementById("month_1_name").innerHTML, document.getElementById("month_2_name").innerHTML, document.getElementById("month_3_name").innerHTML, document.getElementById("month_4_name").innerHTML, document.getElementById("month_5_name").innerHTML, document.getElementById("month_6_name").innerHTML, document.getElementById("month_7_name").innerHTML, document.getElementById("month_8_name").innerHTML, document.getElementById("month_9_name").innerHTML, document.getElementById("month_10_name").innerHTML, document.getElementById("month_11_name").innerHTML, document.getElementById("month_12_name").innerHTML],
					monthNamesShort : [document.getElementById("shortmonth_1_name").innerHTML, document.getElementById("shortmonth_2_name").innerHTML, document.getElementById("shortmonth_3_name").innerHTML, document.getElementById("shortmonth_4_name").innerHTML, document.getElementById("shortmonth_5_name").innerHTML, document.getElementById("shortmonth_6_name").innerHTML, document.getElementById("shortmonth_7_name").innerHTML, document.getElementById("shortmonth_8_name").innerHTML, document.getElementById("shortmonth_9_name").innerHTML, document.getElementById("shortmonth_10_name").innerHTML, document.getElementById("shortmonth_11_name").innerHTML, document.getElementById("shortmonth_12_name").innerHTML],
					dayNames : [document.getElementById("day_1_name").innerHTML, document.getElementById("day_2_name").innerHTML, document.getElementById("day_3_name").innerHTML, document.getElementById("day_4_name").innerHTML, document.getElementById("day_5_name").innerHTML, document.getElementById("day_6_name").innerHTML, document.getElementById("day_7_name").innerHTML],
					dayNamesShort : [document.getElementById("shortday_1_name").innerHTML, document.getElementById("shortday_2_name").innerHTML, document.getElementById("shortday_3_name").innerHTML, document.getElementById("shortday_4_name").innerHTML, document.getElementById("shortday_5_name").innerHTML, document.getElementById("shortday_6_name").innerHTML, document.getElementById("shortday_7_name").innerHTML],
					titleFormat: {
						month: 'MMMM yyyy',
						week: "d[ MMMM][ yyyy]{ - d MMMM yyyy}",
						day: 'dddd d MMMM yyyy'
					},
					columnFormat: {
						month: 'ddd',
						week: 'ddd d',
						day: ''
					},
					axisFormat: 'H:mm',
					timeFormat: {
						'': 'H:mm',
						agenda: 'H:mm{ - H:mm}'
					},
					firstDay:1					
				});	
				
				
				/*****INIT EVENT LIST*****/				
				$('.table-event-list tr th').css('border', 'none');				
				oTable = $('.table-event-list').dataTable({
					'sDom'			: 't',
					'bJQueryUI'		: true,
					'bAutoWidth'	: false,
					'bSort'			: false,
					'aoColumns': [
						{'sWidth' 	: '20%', 'bSortable' : false},
						{'sWidth' 	: '20%', 'bSortable' : false},
						{'sWidth' 	: '52%', 'bSortable' : false},					
						{'sWidth' 	: '8%', 'bSortable' : false}					
					],
					'fnRowCallback'		: function( nRow, aData, iDisplayIndex ) {
						cell = $(nRow).children('td:first');
						status = cell.data('status');
						color = cell.data('color');
						$(nRow).addClass(color + ' event-' + status);						
					}
				});
				
				$('.link-more-info').bind('click', function(){
					icon = $(this).children('span:first');					
					if(icon.hasClass('icon-plus'))
						icon.removeClass('icon-plus').addClass('icon-minus');						
					else 
						icon.removeClass('icon-minus').addClass('icon-plus');						
					
					$(this).next().toggleClass('hidden');					
				});
				
				
				/*****INIT FUNCTIONS*****/
				function filter(){					
					filter_open = $('#checkbox-open').prop('checked') ? true : false;
					filter_pending = $('#checkbox-pending').prop('checked') ? true : false;
					filter_accepted = $('#checkbox-accepted').prop('checked') ? true : false;
					filter_close = $('#checkbox-close').prop('checked') ? true : false;
					
					if(filter_open || filter_pending || filter_accepted || filter_close){
						if(filter_open)
							$('.event-open').show();
						else
							$('.event-open').hide();
							
						if(filter_pending)
							$('.event-pending').show();
						else
							$('.event-pending').hide();
						
						if(filter_accepted)
							$('.event-accepted').show();
						else
							$('.event-accepted').hide();
						
						if(filter_close)
							$('.event-close').show();
						else
							$('.event-close').hide();													
					}
					else
						$('.event-open, .event-pending, .event-accepted, .event-close').show();
				}
				
				
			});	
		}	
	};
	
  $.fn.calendar = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );