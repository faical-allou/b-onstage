(function( $ ){

	var methods = {

		init : function(options){
			return this.each(function() {						
				/*********INIT VARS**********/
				var o = $.extend(options,{});								
				var filter	= {
						name				: '',						
						location			: ''
						//order_by			: o.order_by	
					},				
					page			= o.page,
					per_page		= o.per_page;
					//time_out_id;					

						
				/**********INIT BUTTON**********/
				init_button();
				
				/**********INIT SEARCH FORM*********/
				$('#search-form-artist').submit(function() {
					filter.name = $('#filter-name').val();
					if(filter.name.length < 2){
						filter.name = '';
						$('#filter-name').val(filter.name);
					}						
					filter.location = $('#filter-location').val();
					if(filter.location.length < 2){
						filter.location = '';
						$('#filter-location').val(filter.location);
					}
					show();
					return false;
				});
				
				/**********INIT FILTER**********/
				$('#filter-name').autocomplete({
					delay 		: 400,
					minLength	: 2,
					source		: function( request, response ) {
						$.getJSON( '/artists/get_name', {
							term: request.term
						}, response);
					},										
					select		: function( event, ui ) {
						if(ui.item){
							filter.name = ui.item.value;
							show();
						}
					}
				});
				
				$('#filter-location').autocomplete({
					delay		: 400,					
					minLength	: 2,
					source		: function( request, response ) {
						$.getJSON( '/artists/get_location', {
							term: request.term
						}, response);
					},
					select		: function( event, ui ) {
						if(ui.item){
							filter.location = ui.item.value;
							show();
						}
					}
				});
				
				
			
				
				/**********INIT SHOW MORE BUTTON**********/
				$('#show-more-artists')
				.button()
				.click(function(event){
					$(this).hide();
					$('#loader-more-artists').show();
					page++;
					$.ajax({
						url		: '/artists/show',
						type	: 'POST',
						dataType: 'json',
						data	: {
							name	: filter.name,
							location: filter.location,
							page	: page,
							per_page: per_page
						},
						success : function(data){
							$('#loader-more-artists').hide();
							$('#artists-list').append(data.text);							
							$('.button-show-profil').button();	
							$('.button-send-msg').button();	
							$('.button-add-contact').button();								
							if(data.show_more)
								$('#show-more-artists').show();							
						}						
					});				
				});
				
				//function show
				function show(){
					page = 1;
					
					$.ajax({
						url			: '/artists/show',
						type		: 'post',
						dataType	: 'json',
						data		: {
							name		: filter.name,
							location	: filter.location,
							page		: page,
							per_page	: per_page
							//order_by	: filter.order_by
						},
						success		: function(data){						
							$('#artists-list')
							.empty()
							.append(data.text)
												
							$('.button-show-profil').button();	
							$('.button-send-msg').button();	
							$('.button-add-contact').button();								
							if(data.show_more)
								$('#show-more-artists').show();													
						}					
					});				
				}				
				
				//send msg
				function send_msg(email_to){				
					var send_msg_dialog = $('<div>')
					.dialog({						
						appendTo		: 'body',	
						draggable		: false,
						resizable		: false,
						width			: 600,						
						modal			: true,
						open			: function(){							
							$.ajax({
								url		: '/user/tpl_send_msg',
								success	: function(data){
									send_msg_dialog
									.append(data)
									.dialog('option','position','center');						
									//$('#form-msg-subject').fieldWidth(1.0);
									$('#form-msg-message').redactor({
										buttons : ['bold', 'italic', 'fontcolor', '|','unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'link', '|', 'alignment', '|', 'horizontalrule'],
										lang : 'fr'
									});	
									$('#form-msg').validate({
										submitHandler: function(form) {																					
											$.ajax({
												url		: '/user/send_msg',
												dataType: 'json',
												type	: 'post',
												data	: {									
													to			: email_to,
													subject		: $('#form-msg-subject').val(),										
													message 	: $('#form-msg-message').getCode()
												},	
												success : function(data){																
													switch(data.status){
														case 'SUCCESS'	: 
															send_msg_dialog.remove();
															show_servor_message(data.msg);
															break;
														case 'ERROR'	:
															$('#form-msg-response').append(data.msg).removeClass('hidden').addClass('red');
															break;
														default : break;
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
								}
							});	
						},
						buttons: 
						[
							{
								text	: document.getElementById("submittxt").innerHTML,								
								'class'	: 'ui-purple',									
								click: function() {		
									$('#form-msg').submit();
								}
							},
							{
								text:document.getElementById("canceltxt").innerHTML,
								click: function() {																				
									$(this).remove();															
								}
							}
						]
					});
				}
				
				
				function add_contact(contact_id){
					$.ajax({
						url		: '/user/add_contact',
						type	: 'POST',
						data	:{user_contact : contact_id},	
						dataType: 'json',
						success : function(data){ 
							show_servor_message(data.msg);														
						}						
					});	
				}
				
				
				function init_button(){	
					
					//init serach artists
					$('#search-artist').button();
					
					
					//init show profil										
					$('.button-show-profil').button();
					
					//init send msg			
					$('.button-send-msg').button();
					$('body').on('click', '.button-send-msg', function(event){
						send_msg($(event.currentTarget).data('email-to'));					
					});
					
					//init add contact
					$('.button-add-contact').button();								
					$('body').on('click', '.button-add-contact', function(event){
						add_contact($(event.currentTarget).data('contact-id'));
					});	
				}				
			});
		}
	};

$.fn.artist = function( method ) {

	if ( methods[method] ) {
	return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
	return methods.init.apply( this, arguments );
	} else {
	$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
	}
};
})( jQuery );