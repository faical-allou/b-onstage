(function( $ ){
	var event_id;
	var event_status;
	var musical_genre;
	var payment_type;	
	var methods = {
	
		/******************************/
		/**********INIT EVENT**********/
	
		init : function(options){		
			return this.each(function() { 																			
				/**********INIT VARS**********/
				event_id = options.event_id;
				event_status = options.event_status;
				musical_genre = '';
				payment_type = {
					value			: $('#ev-payment-type').data('value'),
					payment_amount	: $('#ev-payment-type').data('payment-amount'),
					percent_drink	: $('#ev-payment-type').data('percent-drink'),
					percent_entry	: $('#ev-payment-type').data('percent-entry'),
					refund_fees		: $('#ev-payment-type').data('refund-fees'),
					resume 			: $('#ev-payment-type').data('resume')
				};
					
				/**********INIT BUTTON**********/				
				$('.button-return-calendar').button({
					text : false,
					icons :
						{
							primary : 'ui-icon-back'
						}
					}
				);				
				$('.button-delete-event')
				.button()
				.click(function(){
					
					var dialog_delete_event = $('<div>')
					.dialog({
						autoOpen	:true,
						appendTo	: 'body',
						width		: 500,
						position	: ['center'],	
						resizable	: false,
						draggable	: false,						
						modal		:true,
						open		: function(event, ui){		
							switch(event_status){
								case 'open': 
									$(this).append('Voulez-vous supprimer cet évènement ?');
									break;
								default : break;
							}					
						},
						buttons: 
						[
							{
								text	: 'Supprimer',
								'class'	: 'ui-purple',								
								click: function() {	
									$.ajax({
										url		: '/event/delete',
										type	: 'post',
										dataType: 'json',
										data	:{
											event_id	: event_id,
											event_status: event_status
										},
										success : function(data){
											dialog_delete_event.remove();
											switch(data.status){
												case 'SUCCESS' :
													window.location.href = '/user/calendar';
													show_servor_message(data.msg);
													break;
												case 'ERROR' :
													show_servor_message(data.msg);
												break;
												default : break;
											}										
											
										}
									});		
								}
							},
							{
								text	:'Annuler',
								click	: function() {										
									dialog_delete_event.remove();
								}
							}
						]	
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
			
				/*****INIT TABS EVENT*****/
				$('#tabs-event').tabs();	
			
				switch(event_status){
					case 'new':
					case 'open':			
						
						/**********INIT FOCUS TITLE EVENT**********/
						$('#ev-title').focus();
						
						/**********INIT DATETIME PICKER**********/								
						$.datepicker.setDefaults($.datepicker.regional['fr']);
						$('#ev-date-start')
							.mask({
								mask: '99/99/9999'
							})
							.datepicker({
								minDate : 0,							
								onSelect: function( selectedDate, inst) {
									$('#ev-date-end').datepicker('option','minDate', selectedDate );
									selected_date = $('#ev-date-start').datepicker('getDate');														
									switch(Date.today().compareTo(selected_date)){
										case 0 :
											$('#ev-schedule-start, #ev-schedule-end').timepicker('option', 'minTime', min_time);								
											break;
										case -1 : 	
											$('#ev-schedule-start').timepicker('option', 'minTime', '0:0');								
											$('#ev-schedule-end').timepicker('option', 'minTime', $('#ev-schedule-start').val());																
											break;
										default : break;	
									}															
								},
								dateFormat: 'dd/mm/yy'
							});
						
						$('#ev-date-end')
							.mask({
								mask: '99/99/9999'
							})
							.datepicker({
								minDate : 0,						
								onSelect: function( selectedDate ) {
									//$('#ev-date-start').datepicker('option','maxDate', selectedDate );
								},
								dateFormat: 'dd/mm/yy'
							});								
										
						$('#ev-schedule-start')
							.mask({
								mask: "hh:mm",
								definitions: {
									hh: function( value ) {
										value = parseInt( value, 10 );
										if ( value >= 1 && value <= 23 ) {
											return ( value < 10 ? "0" : "" ) + value;
										}								
									},
									mm: function(value){
										value = parseInt( value, 10 );
										if ( value >= 0 && value <= 59 ) {
											return ( value < 10 ? "0" : "" ) + value;
										}
									}							
								}	
							})				
							.timepicker({									
								timeFormat: 'H:i',
								step: 15						
							})
							.on('changeTime', function() {					
								$('#ev-schedule-end').timepicker('setTime', $(this).val());
								$('#ev-schedule-end').timepicker('option', 'minTime', $(this).val());
							});				
						
						$('#ev-schedule-end')
							.mask({
								mask: "hh:mm",
								definitions: {
									hh: function( value ) {
										value = parseInt( value, 10 );
										if ( value >= 1 && value <= 23 ) {
											return ( value < 10 ? "0" : "" ) + value;
										}
									},
									mm: function(value){
										value = parseInt( value, 10 );
										if ( value >= 0 && value <= 59 ) {
											return ( value < 10 ? "0" : "" ) + value;
										}
									}							
								}	
							})
							.timepicker({																		
								timeFormat: 'H:i',
								step: 15
							})
							.on('changeTime', function(){
								date_start = $('#ev-date-start').datepicker('getDate'); 
								date_end = $('#ev-date-end').datepicker('getDate');
								gsfm_start = $('#ev-schedule-start').timepicker('getSecondsFromMidnight');
								gsfm_end = $(this).timepicker('getSecondsFromMidnight');												
						
								if(gsfm_end < gsfm_start){							
									date_end.addDays(1);							
									$('#ev-date-end').val(date_end.toString('dd/MM/yyyy'));
								}					
							});
							
						/**********INIT MUSICAL GENRE**********/				
						$('#ev-musical-genre').chosen();						
						
						/**********INIT PAYMENT TYPE**********/			
						init_payment_type();
						$('#dialog-payment-type').dialog({					
							autoOpen:false,					
							width:500,
							position:['center'],	
							resizable: false,
							draggable : false,						
							modal:true,
							open : function(event, ui){							
								init_payment_type();																		
								$('#form-payment-type').validate({
									submitHandler: function(form) {																
										$('#dialog-payment-type').dialog('close');								
									},
									errorPlacement: function(error, element) { },
									errorClass : 'ui-state-error',
									highlight: function(element, errorClass) {
										$(element).addClass(errorClass);
										$(element.form).find('label[for=' + element.id + ']').addClass('red');
									},
									unhighlight: function(element, errorClass) {
										$(element).removeClass(errorClass);
										$(element.form).find('label[for=' + element.id + ']').removeClass('red');
									}
								});						
							},					
							buttons: 
							[
								{
									text: "Valider",								
									'class':'ui-blue',
									id:'confirm-payment-type',
									click: function() {	
										$('#form-payment-type').submit();							
									}
								},
								{
									text:'Annuler',
									click: function() {										
										$( this ).dialog('close');																
									}
								}
							]	
						});
						
						$('#update-payment-type').bind('click',function(){
							$('#dialog-payment-type').dialog('open');											
						});
						
						$('#dialog-payment-type input:checkbox, #dialog-payment-type input:text').change(init_payment_type);
						
						/**********INIT DESCRIPTION**********/    				
						$('#ev-description').redactor({
							buttons : ['bold', 'italic', 'fontcolor', '|','unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'link', '|', 'alignment', '|', 'horizontalrule'],
							lang : 'fr'
						});	
					break;
					default:
						init_payment_type();
						break;
				}			
							
				
				/**********INIT FUNCTIONS**********/
				function init_payment_type(){
					
					checked_1 = $('#payment-type-1').prop('checked') ? true : false;	
					checked_2 = $('#payment-type-2').prop('checked') ? true : false;	
					checked_3 = $('#payment-type-3').prop('checked') ? true : false;	
					checked_4 = $('#payment-type-4').prop('checked') ? true : false;	
					checked_5 = $('#payment-type-5').prop('checked') ? true : false;					
					
					switch($(this).attr('id')){								
						case 'payment-type-2':
							if(checked_2){						
								$('#input-payment-type-2').addClass('required');
							}else
								$('#input-payment-type-2').removeClass('required');
							break;	
						case 'payment-type-3': 
							if(checked_3){						
								$('#input-payment-type-3').addClass('required');
							}else
								$('#input-payment-type-3').removeClass('required');
							break;	
						case 'payment-type-4': 
							if(checked_4){						
								$('#input-payment-type-4').addClass('required');
							}else
								$('#input-payment-type-4').removeClass('required');
							break;
						default :							
							break;
					}
					
					if(!checked_1 && !checked_2 && !checked_3 && !checked_4 && !checked_5){
						$('#dialog-payment-type input:checkbox, #dialog-payment-type input:text').attr('disabled', false);						
						$('#dialog-payment-type input:checkbox').parent().css('opacity',1);
						$('#dialog-payment-type input:text').val('');						
						payment_type.resume = 'Non renseigné';
						payment_type.value = 1;						
					}
					else if(checked_1 && !checked_2 && !checked_3 && !checked_4 && !checked_5){						
						$('#dialog-payment-type input:checkbox:gt(0), #dialog-payment-type input:text').attr('disabled', true);
						$('#dialog-payment-type input:checkbox:gt(0)').parent().css('opacity',0.4);
						$('#dialog-payment-type input:text').val('');
						payment_type.resume = 'Non rémunéré';
						payment_type.value = 2;
					}
					else if(!checked_1 && (checked_2 || checked_3 || checked_4 || checked_5)){
						$('#dialog-payment-type input:checkbox:first').attr('disabled', true);
						$('#dialog-payment-type input:checkbox:first').parent().css('opacity',0.4);	
						resume_2 = (checked_2) ? 'Cachet de ' + $('#input-payment-type-2').val() + ' €' + (((checked_3) || (checked_4) || (checked_5)) ? ' + ' : '') : '';						
						resume_3 = (checked_3) ? $('#input-payment-type-3').val() + ' de surcharge sur les boissons' + (((checked_4) || (checked_5)) ? ' + ' : '') : '';						
						resume_4 = (checked_4) ? $('#input-payment-type-4').val() + ' % sur la billeterie' + ((checked_5) ? ' + ' : ''): '';						
						resume_5 = (checked_5) ? 'Remboursement des frais de réservations' : '';
						payment_type.resume = resume_2 + resume_3 + resume_4 + resume_5;						
						payment_type.value = 3;
					}												
					
					payment_type.payment_amount = $('#input-payment-type-2').val();					
					payment_type.percent_drink = $('#input-payment-type-3').val();
					payment_type.percent_entry = $('#input-payment-type-4').val();
					payment_type.refund_fees = (checked_5) ? 1 : 0;			
					
					$('#ev-payment-type').data('payment-type', payment_type);
					$('#resume-payment-type, #ev-payment-type').text(payment_type.resume);									
				}		
			});	
		},
		
		/**********CREATE EVENT**********/
		create : function(options){		
			return this.each(function() { 
				/**********INIT VARS**********/
				add_url = options.add_url;
				success_message = options.success_message;
				success_url = options.success_url;
				error_message = options.error_message;
				
				/**********INIT ACTION BUTTON**********/				
				$('.button-create-event').button();									
				
				jQuery.validator.messages.required = '';
				$('#form-create-event').validate({							 
					submitHandler: function(form) {						
						title = ($('#ev-title').val() == '') ? $('#ev-title').data('default') : $('#ev-title').val();
						date_start = $('#ev-date-start').datepicker('getDate');
						time_start = $('#ev-schedule-start').val() + ':00';
						date_time_start = date_start.toString('yyyy-MM-dd') + ' ' + time_start;
						date_end = $('#ev-date-end').datepicker('getDate');									
						time_end = $('#ev-schedule-end').val() + ':00';
						date_time_end = date_end.toString('yyyy-MM-dd') + ' ' + time_end;	
						musical_genre = [];
						$('#ev-musical-genre option:selected').each(function () {							
							musical_genre.push($(this).val());
						});	
						$.ajax({
							url		: add_url,
							dataType:'json',
							type	: 'POST',
							data	: {
								ev_title			: title,
								ev_date_start		: date_time_start,
								ev_date_end			: date_time_end,
								ev_reservation		: $('#ev-reservation').val(),
								ev_entry			: $('#ev-entry').val(),
								ev_description		: $('#ev-description').getCode(),								
								ev_musical_genre	: musical_genre.length == 0 ? '0' : musical_genre.join('|'),
								ev_payment_type 	: $('#ev-payment-type').data('payment-type').value,
								ev_payment_amount	: $('#ev-payment-type').data('payment-type').payment_amount,
								ev_percent_drink	: $('#ev-payment-type').data('payment-type').percent_drink,
								ev_percent_entry	: $('#ev-payment-type').data('payment-type').percent_entry,
								ev_refund_fees		: $('#ev-payment-type').data('payment-type').refund_fees
							},
							success	: function(data){
								switch(data.status)
								{
									case true:
										show_servor_message(success_message);
										window.location.replace(success_url);										
										break;
									case false:								
										show_servor_message(error_message);
										break;										
									default:break;
								}
							}
						});						
					},
					errorPlacement: function(error, element) { },
					errorClass : 'ui-state-error',
					highlight: function(element, errorClass) {
						$(element).addClass(errorClass);
						$(element.form).find('label[for=' + element.id + ']').addClass('red');
					},
					unhighlight: function(element, errorClass) {
						$(element).removeClass(errorClass);
						$(element.form).find('label[for=' + element.id + ']').removeClass('red');
					}
				});													
				//add rules
				$('#ev-reservation').rules("add", {min: 50});
			});	
		},	
		
		/*******************************/
		/********** EDIT EVENT**********/
		edit : function(options){	
			return this.each(function() { 
				/**********INIT VARS**********/
				update_url = options.update_url;
				success_message = options.success_message;
				success_url = options.success_url;
				error_message = options.error_message;						
				
				/*****SWITCH EVENT STATUS*****/
				switch(event_status){	
					
					/*****OPEN EVENT*****/
					case 'open' :
						$('.button-update-event').button();	
						jQuery.validator.messages.required = '';
						$('#form-edit-event').validate({							 
							submitHandler: function(form) {				
								title = ($('#ev-title').val() == '') ? $('#ev-title').data('default') : $('#ev-title').val();
								date_start = $('#ev-date-start').datepicker('getDate');
								time_start = $('#ev-schedule-start').val() + ':00';
								date_time_start = date_start.toString('yyyy-MM-dd') + ' ' + time_start;
								date_end = $('#ev-date-end').datepicker('getDate');									
								time_end = $('#ev-schedule-end').val() + ':00';
								date_time_end = date_end.toString('yyyy-MM-dd') + ' ' + time_end;	
								musical_genre = [];
								$('#ev-musical-genre option:selected').each(function () {							
									musical_genre.push($(this).val());
								});						
								$.ajax({
									url		: update_url,
									dataType:'json',
									type	: 'POST',
									data	: {
										ev_id				: event_id,
										ev_title			: title,
										ev_date_start		: date_time_start,
										ev_date_end			: date_time_end,
										ev_reservation		: $('#ev-reservation').val(),
										ev_entry			: $('#ev-entry').val(),
										ev_description		: $('#ev-description').getCode(),
										ev_status			: event_status,
										ev_musical_genre	: musical_genre.length == 0 ? '0' : musical_genre.join('|'),
										ev_payment_type 	: $('#ev-payment-type').data('payment-type').value,
										ev_payment_amount	: $('#ev-payment-type').data('payment-type').payment_amount,
										ev_percent_drink	: $('#ev-payment-type').data('payment-type').percent_drink,
										ev_percent_entry	: $('#ev-payment-type').data('payment-type').percent_entry,
										ev_refund_fees		: $('#ev-payment-type').data('payment-type').refund_fees
									},
									success	: function(data){
										switch(data.status)
										{
											case true:
												show_servor_message(success_message);
												window.location.replace(success_url);										
												break;
											case false:								
												show_servor_message(error_message);
												break;										
											default:break;
										}
									}
								});						
							},
							errorPlacement: function(error, element) { },
							errorClass : 'ui-state-error',
							highlight: function(element, errorClass) {
								$(element).addClass(errorClass);
								$(element.form).find('label[for=' + element.id + ']').addClass('red');
							},
							unhighlight: function(element, errorClass) {
								$(element).removeClass(errorClass);
								$(element.form).find('label[for=' + element.id + ']').removeClass('red');
							}
						});	
						//add rules
						$('#ev-reservation').rules("add", {min: 50});
						break;
						
					/*****PENDING EVENT*****/	
					case 'pending' :			
						
						/*****INIT DIALOG VALID AND DELETE ARTIST*****/
						var row_selected;
						$('.button-valid-artist').click(function(){				
							reservation_id = $(this).data('reservation-id');							
							var dialog_valid_artist = $('<div>')
							.dialog({
								autoOpen	: true,					
								appendTo	: 'body',
								width		: 600,
								position	: ['center'],	
								resizable	: false,
								draggable	: false,						
								modal		: true,		
								open		: function(){
									$(this).append('Valider cet artiste');
								},								
								buttons		: 
								[
									{
										text	: 'Valider',								
										'class'	:'ui-purple',									
										click	: function() {																																
											$.ajax({
												url		: '/reservation/valid',		
												type 	: 'POST',
												dataType: 'json',
												data	:{												
													reservation_id : reservation_id
												},
												success : function(data){	
													switch(data.status){
														case 'SUCCESS' : 
															dialog_valid_artist.remove();																
															window.location.reload();
															//show_servor_message(data.msg);
														break;
														case 'ERROR' : 
															show_servor_message(data.msg);
															break;
														default : break;
													}
												}	
											});									
										}
									},
									{
										text	:'Annuler',
										click	: function() {										
											dialog_valid_artist.remove();													
										}
									}
								]	
							});
						});
												
						$('.button-delete-artist').click(function(){				
							reservation_id = $(this).data('reservation-id');
							row_selected = oTable.$(this).parent().parent().parent(); 
							var dialog_delete_artist = $('<div>')
							.dialog({
								appendTo	: 'body',	
								autoOpen	:true,					
								width		:600,
								position	:['center'],	
								resizable	: false,
								draggable	: false,					
								modal		:true,		
								open		: function(){
									$(this).append('Voulez-vous refuser cet artiste?');
								},
								buttons		: 
								[
									{
										text	: 'Refuser',								
										'class'	:'ui-purple',									
										click	: function() {																							
											$.ajax({
												url		: '/reservation/delete',		
												type 	: 'POST',
												dataType: 'json',
												data	:{												
													reservation_id : reservation_id
												},
												success : function(data){												
													if(data.status){
														dialog_delete_artist.remove();
														oTable.fnDeleteRow(row_selected[0]);																										
													}												
													show_servor_message(data.msg);
												}	
											});									
										}
									},
									{
										text	:'Annuler',
										click	: function() {										
											dialog_delete_artist.remove();												
										}
									}
								]	
							});	
						});	
						
						/*****INIT RESERVATION LIST*****/
						$('.table-reservations tr th').css('border', 'none');
						oTable = $('.table-reservations').dataTable({
							'sDom'			: 't',
							'bJQueryUI'		: true,
							'bAutoWidth'	: false,
							'bSort'			: false,
							'aoColumns': [
								{'bSortable': true, 'sWidth': '30%'},
								{'bSortable': true, 'sWidth': '20%'},
								{'bSortable': true, 'sWidth': '40%' },
								{'bSortable': false, 'sWidth': '10%' }							
							]							 
						});
						
					break;
					
					
					/*****ACCEPTED EVENT*****/
					case 'accepted' :
						/*****INIT RESERVATION LIST*****/
						$('.table-reservations tr th').css('border', 'none');
						$('.table-reservations tbody tr:first').addClass('selected');
						$('.table-reservations thead').addClass('hidden');
						$('.table-reservations tbody tr:gt(0)').css('opacity', 0.3);
						oTable = $('.table-reservations').dataTable({
							'sDom': '',
							'bJQueryUI': true,
							'bAutoWidth'	: false,							
							'aoColumns': [
								{'bSortable': false, 'sWidth': '30%'},
								{'bSortable': false, 'sWidth': '20%'},
								{'bSortable': false, 'sWidth': '40%' },
								{'bSortable': false, 'sWidth': '10%' }							
							]								
						});
					break;
					
					
					/*****CLOSE EVENT*****/
					case 'close' :
						/*****INIT BUTTON*****/						
						$('#button-artist-link').button();
						
						/*****INIT TABS EVENT ARTIST*****/					
						$('#tabs-ev-artist > ul > li > a:first').addClass('active');
						$('#ev-content-artist-1').show();
						$('#tabs-ev-artist > ul > li > a').bind('click', function(){
							$('#tabs-ev-artist > ul > li > a').removeClass('active');
							$(this).addClass('active');
							$('#tabs-ev-artist > div').hide();
							$($(this).data('content-id')).show();
						});					
						
						/*****INIT MEMBERS*****/
						$('#members-list > li :odd').addClass('odd');
						$('#members-list > li :even').addClass('even');						
					break;
					default : break;				
				}	
				
			});
		}		
	};
	
  $.fn.event = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );