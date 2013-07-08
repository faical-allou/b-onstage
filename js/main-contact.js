$(function() {
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_search_bar(false);
		init_profil_menu();
		init_account_menu('a-m-contact');
		
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
		
		/**********INIT RECOMMENDATIONS**********/
		$('.recommendations').alert();
		
		$('.contact-line:even').css('background-color', '#f5f5f5'); 
		$('.contact-link').button({icons:{primary:'ui-icon-person'}});
		$('.send-msg')
		.button({icons:{primary:'ui-icon-mail-closed'}})
		.click(function(){
			var email_to = $(this).data('email-to');
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
							$('#form-msg-subject').fieldWidth(1.0);
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
						text	: 'Envoyer',								
						'class'	: 'ui-purple',									
						click: function() {		
							$('#form-msg').submit();
						}
					},
					{
						text:'Annuler',
						click: function() {																				
							$(this).remove();															
						}
					}
				]
			});
		});	
		
		
		$('.delete-contact')
		.button({icons:{primary:'ui-icon-trash'}})
		.click(function(){
			var contact_id = $(this).data('contact-id');
			var delete_dialog = $('<div>')
			.dialog({						
				appendTo		: 'body',	
				draggable		: false,
				resizable		: false,
				width			: 600,						
				modal			: true,
				open			: function(){							
					$(this)
					.append('<p class="fs-12 bold">Voulez vous vraiment supprimer ce contact ?</p>')
					.dialog('option','position','center');
				},
				buttons: 
				[
					{
						text	: 'Supprimer',								
						'class'	: 'ui-purple',									
						click: function() {									
							$.ajax({
								url			: '/user/delete_contact',
								dataType	: 'json',	
								type		: 'post',
								data		:{
									contact_id	:contact_id
								},	
								success		: function(data){
								
									switch(data.status){
										case 'SUCCESS'  : 
											$('#contact-' + contact_id).remove();
											show_servor_message(data.msg);					
											break;
										case 'ERROR'	: 
											show_servor_message(data.msg);
											break;
										default			: break;												
									}
								}
							});									
							$(this).remove();									
						}
					},
					{
						text:'Annuler',
						click: function() {																				
							$(this).remove();															
						}
					}
				]
			});	
		});	
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);	
	});
});	