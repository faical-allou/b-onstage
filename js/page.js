(function( $ ){
	//var
	var parent;
	var user_state, user_id, user_group;
	var mode_edit = false;
	var id_info;
	var editor;
	
	var methods = {
	
		init : function(options){		
			return this.each(function() { 												
				
				/*******************INIT VARS**************
				***************************************************/
				parent = $(this);
				user_id = options.user_id;
				user_state = options.user_state;	
				user_group = options.user_group;
				active_menu_page = options.active_menu_page;		
				
				/*******************INIT ACTION PAGE**************
				***************************************************/				
				if(user_state ==0){
					$('#auth-page a').button();
				}
				
				if(user_state == 1){

					$('#dropdown-plus').dropdown('init');					
					
					$('#button-send-msg').click(function(){
						email_to = $(this).data('email-to');
						send_msg(email_to);
					});
					
					$('#button-add-contact').click(function(){
						add_contact(user_id);						
					});								
				}			
				
				/********** INIT RECOMMENDATION**********/
				if(user_state == 2){
					$('.recommendations').alert();
				}
					
				
				/*******************INIT MENU PAGE*****************
				***************************************************/												
				change_page(active_menu_page);
				$('#menu-page > ul > li > a').bind('click',function(){	
					change_page($(this).attr('id'));	
				});
				
				/******************* INIT SHARE THIS ***************
				****************************************************/		
				$('#button-share-page').click(function(){
					$('#share-this').slideToggle();
				});
				/******************* INIT BLOC INFOS ***************
				****************************************************/		
				/*bloc infos*/
				$('.read-bloc').each(function(){
					elem = $(this).children('.read-bloc-val');
					val = $(this).data('val');		
					if(!val)
						$(this).hide();								
					else if(val && (elem.data('type') =='url'))										
						elem.html(val.replace(/.*?:\/\//g, ""));							
				});						
				
				/******************* INIT MODE EDIT *****************
				***************************************************/	
				if(user_state == 2){				
					var jcrop_avatar;	
					var jcrop_api;	
					var img_avatar;	
					var img_cover;
					/**********INIT UPLOAD COVER**********/																						
					$('#update-upload-cover').click(function(){
						var dialog_upload_cover = $('<div id="dialog-upload-cover"></div>')
						.appendTo('body')
						.dialog({
							autoOpen	: true,					
							width		: 'auto',						
							resizable	: false,
							draggable	: false,						
							modal		: true,										
							open		: function(event, ui) {										
								$.ajax({
									url		: '/user/dialog_upload_cover',
									success : function(data){
										dialog_upload_cover.append(data);			
										dialog_upload_cover.dialog('option', 'position', 'center');										
										$('#progressbar-cover').progressbar();										
										$('#confirm-update-cover').hide();										
										$('#upload-cover').swfupload({
											upload_url				: '/upload/cover/' + $('#upload-cover').data('session-id'),								
											file_post_name			: 'uploadfile',
											file_size_limit			: '5 MB',
											file_types				: '*.jpg;*.gif;*.png;*.jpeg',
											file_types_description	: 'cover image',
											file_upload_limit		: 10,
											file_queue_limit		: 1,
											flash_url				: '/js/swfupload/swfupload.swf',
											button_placeholder_id	: 'button-upload-cover',
											button_image_url		: '/js/swfupload/button/'+document.getElementById("button_upcover").innerHTML,
											button_width			: 200,
											button_height			: 40,
											button_cursor			: SWFUpload.CURSOR.HAND,
											button_window_mode		: SWFUpload.WINDOW_MODE.TRANSPARENT
										})
										.bind('swfuploadLoaded', function(event){									
										})
										.bind('fileQueued', function(event, file){
											$('#state-upload-cover').empty();
											$('#progressbar-cover').show();								
											$('#upload-cover').swfupload('startUpload');
										})
										.bind('fileQueueError', function(event, file, errorCode, message){
											$('#state-upload-cover').append('<li class="ui-state-error">'+message+'</li>');
										})
										.bind('fileDialogStart', function(event){																
										})
										.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){

										})
										.bind('uploadStart', function(event, file){										
											$('#progressbar-cover').progressbar('value',0);
										})
										.bind('uploadProgress', function(event, file, bytesLoaded, bytesTotal){			
											$('#progressbar-cover').progressbar('value',(bytesLoaded / bytesTotal) * 100);								
										})
										.bind('uploadSuccess', function(event, file, serverData){									
											dataFile = eval('(' + serverData + ')');																	
											$('#upload-cover').hide();
											$('#progressbar-cover').remove();	
											$('#img-crop-cover').show();											
											img_cover = $('<img />')
											.attr('src', '/temp/' + dataFile.file_name + '?' + new Date().getTime())
											.data('file-name', 	dataFile.file_name)
											.Jcrop({
												setSelect:   [ 0, 0, 880, 300 ],
												aspectRatio: 880/300,
												onSelect : function(pos){
													img_cover.data('x',pos.x).data('y',pos.y).data('w',pos.x2-pos.x).data('h',pos.y2-pos.y);
												}
											},function(){
												jcrop_api = this;															
												$('#dialog-upload-cover').dialog('option', 'position', 'center');
												$('#confirm-update-cover').show();
											}).appendTo('#img-crop-cover');								
											
										})
										.bind('uploadComplete', function(event, file){									
											
										})
										.bind('uploadError', function(event, file, errorCode, message){			
											$('#state-upload-cover').append('<li class="ui-state-error">'+message+'</li>');
										});
									}
								});			
							},
							buttons: 
							[
								{
									text	: document.getElementById("validatetxt").innerHTML,
									id		: 'confirm-update-cover',	
									'class'	: 'ui-purple',									
									click	: function() {			
										
										$.ajax({
											url			: '/user/update_cover',
											type		: 'POST',
											dataType	: 'json',
											data		: {
												filename	: img_cover.data('file-name'),
												x			: img_cover.data('x'),
												y			: img_cover.data('y'),
												w			: img_cover.data('w'),
												h			: img_cover.data('h'),
															
											},	
											success		: function(data){														
												if(data.status == 'OK'){
													$('#img-cover').attr('src', data.file + '?' + new Date().getTime());
												}
												
												jcrop_api.destroy();												
												$('#upload-cover').swfupload('destroy');												
												dialog_upload_cover.remove();												
												console.log('3');
												show_servor_message(data.msg);	
											}
										});													
									}
								},
								{
									text:document.getElementById("canceltxt").innerHTML,
									click: function() {	
										if(jcrop_api)
											jcrop_api.destroy();
										$('#upload-cover').swfupload('destroy');										
										dialog_upload_cover.remove();
									}
								}
							]
						});				
					});				
					
					$('#cover-page').hover(function(){
						if(mode_edit == false)
							$('#update-upload-cover').show();											
						},
						function(){
							if(mode_edit == false)
							$('#update-upload-cover').hide();			
						}
					);					
					
					
					
					/**********INIT UPLOAD AVATAR**********/				
					$('#update-upload-avatar').click(function(event){
						var dialog_upload_avatar = $('<div id="dialog-upload-avatar"></div>')	
						.appendTo('body')	
						.dialog({
							title		: 'Modifier avatar',
							autoOpen	: true,					
							width		: 'auto',						
							resizable	: false,
							draggable	: false,						
							modal		: true,										
							open		: function(event, ui) {										
								$.ajax({
									url		: '/user/dialog_upload_avatar',
									success : function(data){
										dialog_upload_avatar.append(data);			
										dialog_upload_avatar.dialog('option', 'position', 'center');										
										$('#progressbar-avatar').progressbar();										
										$('#confirm-update-avatar').hide();
										$('#upload-avatar').swfupload({
											upload_url: '/upload/avatar/' + $('#upload-avatar').data('session-id'),								
											file_post_name: 'uploadfile',
											file_size_limit : '5 MB',
											file_types : '*.jpg;*.gif;*.png;*.jpeg',
											file_types_description : 'avatar image',
											file_upload_limit : 10,
											file_queue_limit : 1,
											flash_swf_url : '/js/swfupload/swfupload.swf',
											button_placeholder_id : 'button-upload-avatar',
											button_image_url : '/js/swfupload/button/'+document.getElementById("button_upcover").innerHTML,
											button_width : 200,
											button_height : 40,
											button_cursor : SWFUpload.CURSOR.HAND,
											button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT  */
										})
										.bind('swfuploadLoaded', function(event){									
										})
										.bind('fileQueued', function(event, file){
											$('#state-upload-avatar').empty();
											$('#progressbar-avatar').show();								
											$('#upload-avatar').swfupload('startUpload');
										})
										.bind('fileQueueError', function(event, file, errorCode, message){
											$('#state-upload-avatar').append('<li class="ui-state-error">'+message+'</li>');
										})
										.bind('fileDialogStart', function(event){																
										})
										.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){

										})
										.bind('uploadStart', function(event, file){										
											$('#progressbar-avatar').progressbar('value',0);
										})
										.bind('uploadProgress', function(event, file, bytesLoaded, bytesTotal){			
											$('#progressbar-avatar').progressbar('value',(bytesLoaded / bytesTotal) * 100);								
										})
										.bind('uploadSuccess', function(event, file, serverData){									
											dataFile = eval('(' + serverData + ')');																	
											$('#upload-avatar').hide();
											$('#progressbar-avatar').remove();	
											$('#img-crop-avatar').show();											
											img_avatar = $('<img />')
											.attr('src', '/temp/' + dataFile.file_name + '?' + new Date().getTime())
											.data('file-name', 	dataFile.file_name)
											.Jcrop({
												setSelect:   [ 0, 0, 240, 240 ],
												aspectRatio: 1,
												onSelect : function(pos){
													img_avatar.data('x',pos.x).data('y',pos.y).data('w',pos.x2-pos.x).data('h',pos.y2-pos.y);
												}
											},function(){
												jcrop_avatar = this;															
												$('#dialog-upload-avatar').dialog('option', 'position', 'center');
												$('#confirm-update-avatar').show();
											}).appendTo('#img-crop-avatar');								
											
										})
										.bind('uploadComplete', function(event, file){									
											
										})
										.bind('uploadError', function(event, file, errorCode, message){			
											$('#state-upload-avatar').append('<li class="ui-state-error">'+message+'</li>');
										});
									
									}
								});			
							},
							close	: function(){								
								if(jcrop_avatar)
									jcrop_avatar.destroy();
								$('#upload-avatar').swfupload('destroy');																				
								console.log('1');
								dialog_upload_avatar.dialog('destroy').remove();
								console.log('2');
							},							
							buttons: 
							[
								{
									text	: document.getElementById("validatetxt").innerHTML,
									id		: 'confirm-update-avatar',	
									'class'	: 'ui-purple',									
									click: function() {			
										
										$.ajax({
											url			: '/user/update_avatar',
											type		: 'POST',
											dataType	: 'json',
											data		: {
												filename	: img_avatar.data('file-name'),
												x			: img_avatar.data('x'),
												y			: img_avatar.data('y'),
												w			: img_avatar.data('w'),
												h			: img_avatar.data('h'),
																	},	
											success		: function(data){														
												if(data.status == 'OK'){
													$('#img-avatar').attr('src', data.file + '?' + new Date().getTime());
												}
												dialog_upload_avatar.dialog('close');
												show_servor_message(data.msg);	
											}
										});													
									}
								},
								{
									text	:document.getElementById("canceltxt").innerHTML,
									click	: function() {											
										dialog_upload_avatar.dialog('close');
									}
								}
							]							
						});				
					});
							
					
					
					if(mode_edit == false){
						$('#avatar-page').hover(function(){
								if(mode_edit == false)	
									$('#update-upload-avatar').show();											
							},
							function(){
								if(mode_edit == false)
									$('#update-upload-avatar').hide();			
							}
						);
					}	

					
					/**********INIT EDIT PROFILE**********/						
					$('.dialog-update-info').dialog({
						autoOpen: false,					
						resizable: false,
						draggable : false,
						modal:true,
						width:400,
						open: function(event, ui) {												
							input = $(this).find('input');														
							input.val($('#read-bloc-' + id_info).data('val'));	
							jQuery.validator.messages.required = '';							
							$('#form-update-info-' + id_info).validate({
								submitHandler: function(form) {
									val = $('#' + id_info).val();												
									$.getJSON(
										'/user/ajax_update',
										{
											'user_id' : user_id,
											'id_info' : id_info,
											'val' : val
										},
										function(response){
											switch(response.status)
											{
												case true:																					
													$('#dialog-update-info-' + id_info).dialog('close');	
													$('#read-bloc-' + id_info).data('val', val);														
													$('#read-bloc-' + id_info).children('.read-bloc-val').html(val);														
													$('#edit-bloc-' + id_info).children('.edit-bloc-val').html(val);														
													break;
												case false:								
													$('#dialog-update-info-' + id_info).append('<p class="red bold fs-12">Erreur</p>');
													break;										
												default:break;
											}
										}
									);
								},
								errorPlacement: function(error, element) {									
								},
								errorClass : 'ui-state-error',
								highlight: function(element, errorClass) {
									$(element).addClass(errorClass);									
								},
								unhighlight: function(element, errorClass) {
									$(element).removeClass(errorClass);									
								}								
							});				
						},
						buttons: 
						[
							{
								text: document.getElementById("validatetxt").innerHTML,					
								'class':'ui-purple',					
								click: function() {
									 $('#form-update-info-' + id_info).submit();											 
								}
							},
							{
								text:document.getElementById("canceltxt").innerHTML,
								click: function() {											
									$( this ).dialog( "close" );	
								}
							}
						]	
					});
					
					//init event
					$('#button-edit-profile').click(function(){
						mode_edit = true;
						$('#action-page').hide();			
						$('#finished-editing').show();
						$('#update-upload-cover').show();
						$('#update-upload-avatar').show();
						$('.read-bloc').hide();
						$('.edit-bloc').show();						
						$('#description-page').redactor({
							buttons : ['bold', 'italic', 'fontcolor', '|','unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'link', '|', 'alignment', '|', 'horizontalrule'],
							lang : 'fr',
							fixed	: true
						});						
					});		
					
					
					$('.edit-bloc').bind('click',function(){
						id_info = $(this).attr('id').replace('edit-bloc-','');			
						$('#dialog-update-info-' + id_info).dialog('open');		
					});
					
					$('#button-finished-editing').button().click(function(){			
						mode_edit = false;
						$('#finished-editing').hide();
						$('#update-upload-cover').hide();
						$('#update-upload-avatar').hide();
						$('.edit-bloc').hide();			
						$('.read-bloc').each(function(){
							elem = $(this).children('.read-bloc-val');
							val = $(this).data('val');										
							if(val){
								switch(elem.data('type')){
									case 'url' :	
										elem.attr('href',val);
										elem.html(val.replace(/.*?:\/\//g, ""));										
										break;
									case 'logo' :
										$(this).children(':first-child').attr('href', val);
										break;
									default : break;	
								}								
								$(this).show();
							}				
						});											
						
						$.getJSON(
							'/user/ajax_update',
							{
								user_id	: user_id,
								id_info : 'description',
								val		: ($('#description-page').text() != '') ? $('#description-page').getCode() : ''
							},
							function(data){
								$('#description-page').destroyEditor();
								if(!data.status)
									alert('Une erreur s\'est produite');									
							}
						);												
						$('#action-page').show();	
					});										
				}				

				
				
				/**********INIT CONCERTS**********/					
				$('.show-concert').button();
				
				
				
				/***********INIT MEDIA**********/
				$('#media').media('init', {user_id :user_id, user_state : user_state});	

				
				/***********INIT buttons**********/
				//init reservation requets
				$('.book-concert').button();
				$('body').on('click', '.book-concert', function(event){					
					stage_id = $(event.currentTarget).data('stage-id');
					event_id = $(event.currentTarget).data('event-id');					
					reservation_request($(this), event_id, stage_id);					
				});				

				//init reservation requets
				$('.request-info').button();

				
				
			});
		}
	};

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
		
	};	
	
	
  $.fn.page = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );

//change page 
function change_page(id_menu_page){		
	$('.bloc-page').not('.hidden').addClass('hidden');	
	$('#menu-page ul li a.active').removeClass('active');
	$('#' + id_menu_page).addClass('active');
	content_id = '#' + $('#' + id_menu_page).data('content-id');
	$(content_id).removeClass('hidden');
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
