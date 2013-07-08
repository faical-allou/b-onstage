(function( $ ){		

	//les variables	
	var parent;
	var user_id;
	var user_state;	
	
	var methods = {		
		//initialisation 
		init : function(options){		
			return this.each(function() { 				
				
				/*********INIT VARS**********/	
				parent = $(this);
				user_id = options.user_id;
				user_state = options.user_state;
				
				
				
				
				/*fl_client_id = '60b4976bf07a36d7a91ad3fa27c51863';
				fl_secret_id = 'dfbec659b96ebe3c';
				
				
				
				
				
				$('.button-show-album-photo').each(function(){
					album_id = $(this).data('album-id');
					$(this).button().bind('click', {album_id : album_id}, show_album_photo);				
				});*/					

				
				
				
				
				
				
				
				/*if(user_state == 2){					
					
					/*****INIT IMPORT PHOTO*****				
					$('#button-add-photo')
					.button({icons:{primary:'ui-icon-plus'}})
					.click(function(){					
					
						$dialog_add_photos = $('<div id="dialog-add-photos"></div>');
						$('body').append($dialog_add_photos);		
						
						$dialog_add_photos.dialog({				
							autoOpen	: true,					
							resizable	: false,
							draggable	: false,
							modal		:true,
							width		:960,
							open		: function(){
								$.ajax({
									url		: '/user/dialog_add_photos',
									success : function(data){
										$dialog_add_photos.append(data);						
						
										$('#title-albums-photos').selectBox();
										$('#title-albums-photos').selectBox('value', 'no');
										
										$('#description-album-photo').redactor({						
											buttons : ['bold', 'italic', 'fontcolor', '|','unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'link', '|', 'alignment', '|', 'horizontalrule']							
										});
										
										$('#upload-photo').swfupload({
											upload_url: '/upload/photo/' + $('#upload-photo').data('session-id'),								
											file_post_name: 'uploadfile',
											file_size_limit : '5 MB',
											file_types : '*.jpg;*.gif;*.png;*.jpeg',
											file_types_description : 'upload photos',
											file_upload_limit : 10,
											file_queue_limit : 10,
											flash_url : '/js/swfupload/swfupload.swf',
											button_placeholder_id : 'button-upload-photo',
											button_image_url : '/js/swfupload/button/button-upload-photo.png',
											button_width : 200,
											button_height : 40,
											button_cursor : SWFUpload.CURSOR.HAND,
											button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT
										})
										.bind('swfuploadLoaded', function(event){						
										})
										.bind('fileQueued', function(event, file){		

											$('<li/>',{
											id		: file.id,
											'class'	: 'p-5 clearfix m-10 ui-corner-all bs-black'
											}).appendTo($('#list-upload-photo'));																

											$('<span/>',{
											'aria-hidden'	: true,
											'class'			: 'icon-camera fs-80',
											style			: 'color:#eaeaea;'	
											}).appendTo($('#' + file.id));								

											$('<div/>',{									
											id		: 'progressbar-' + file.id,
											'class'	: 'progressbar-photo'
											})
											.appendTo($('#' + file.id))
											.progressbar();																	

										})
										.bind('fileQueueError', function(event, file, errorCode, message){
											$('<span/>',{
											'class' : 'ui-state-error m-10 p-10',
											html : message
											}).appendTo($('#state-upload-photo'));
										})
										.bind('fileDialogStart', function(event){																
										})
										.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){																															
											$(this).swfupload('startUpload');

										})
										.bind('uploadStart', function(event, file){										

										})
										.bind('uploadProgress', function(event, file, bytesLoaded, bytesTotal){									

										$('#progressbar-' + file.id).progressbar('value',(bytesLoaded / bytesTotal) * 100);								

										})
										.bind('uploadSuccess', function(event, file, serverData){									

											$('#' + file.id).empty();

											dataFile = eval('(' + serverData + ')');

											$('<img/>',{										
											'data-img-name'		: dataFile.file_name,
											'data-thumb-name'	: dataFile.raw_name + '_thumb' + dataFile.file_ext,
											src					: '/temp/' + dataFile.raw_name + '_thumb' + dataFile.file_ext
											}).appendTo($('#' + file.id));				

										})
										.bind('uploadComplete', function(event, file){																				
											$(this).swfupload('startUpload');

										})
										.bind('uploadError', function(event, file, errorCode, message){			

											//dialog.parent().find('.ui-dialog-buttonpane').append('<li class="ui-state-error">'+message+'</li>');

										});												
									}	
								});
							},	
							buttons		:
							[
								{
									text	: 'Valider',					
									'class'	: 'ui-purple',										
									click	: function() {			
										try
										{
											album_id = 0;										
											
											if(($('#title-album-photo').val() == '') && ($('#title-albums-photos').val() == 'no'))
												throw 'ERROR_TITLE';									
											

											if($('#title-album-photo').val() != ''){
												$.ajax({
													url			: '/user/add_album_photo',
													type		: 'POST',
													dataType	: 'json',
													data		: {
														title		: $('#title-album-photo').val(),												
														description	: $('#description-album-photo').getCode(),
														count_photo : $('#list-upload-photo > li > img').length
													},										
													success		: function(data){													
														switch(data.status){
															case true:
																album_id = data.id;
																
																$('<option/>',{
																	value	: album_id,
																	html	: data.title
																}).appendTo($('#title-albums-photos'));
																
																$('#list-upload-photo > li > img').each(function(){			
																	img_name = $(this).data('img-name');
																	thumb_name = $(this).data('thumb-name');															
																	add_photo(album_id, img_name, thumb_name);	
																});
																break;													
															case false:
																throw data.msg;													
																break;
															default:break;
														}
													},
													complete	: function(){												
														$.ajax({
															url			: '/user/show_album_photo',
															type 		: 'POST',
															dataType	: 'json',
															data		: {																	
																album_id	: album_id
															},
															success		: function(data){
																switch(data.status){
																	case true:
																		$('#albums-photos').prepend(data.text);
																		$('#albums-photos > div:first .button-show-album-photo').button().bind('click', {album_id : album_id}, show_album_photo);																		
																		$('#upload-photo').swfupload('destroy');
																		$dialog_add_photos.remove();
																	break;
																	case false: break;
																	default : break;
																}
															}
														});			
													}
												});		
											}
											else if($('#title-albums-photos').val() != 'no'){
												$.ajax({
													url			: '/user/update_album_count_photo',
													type		: 'POST',
													dataType	: 'json',
													data		: {							
														album_id	: $('#title-albums-photos').val(),
														count_photo	: $('#list-upload-photo > li > img').length
													},										
													success		: function(data){
														switch(data.status){
															case true:
																album_id = data.id;																														
																$('#list-upload-photo > li > img').each(function(){			
																	img_name = $(this).data('img-name');
																	thumb_name = $(this).data('thumb-name');															
																	add_photo(album_id, img_name, thumb_name);	
																});															
																break;
															case false:
																throw data.msg;
																break;
															default : break;		
														}
													}, 
													complete	: function(){
														$.ajax({
															url			: '/user/show_album_photo',
															type 		: 'POST',
															dataType	: 'json',
															data		: {																	
																album_id	: album_id
															},
															success		: function(data){
																switch(data.status){
																	case true:
																		$('#album-photo-' + album_id).remove();
																		$('#albums-photos').prepend(data.text);
																		$('#albums-photos > div:first .button-show-album-photo').button().bind('click', {album_id : album_id}, show_album_photo);																		
																		$('#upload-photo').swfupload('destroy');
																		$dialog_add_photos.remove();
																	break;
																	case false: break;
																	default : break;
																}
															}
														});	
													}
												});
											}
										}
										catch(err){
											switch(err){
												case 'ERROR_BD'			: alert('Erreur base de données');break;
												case 'ERROR_REPERTORY'	: alert('Erreur création du répertoire');break;	
												case 'ERROR_FILE'		: alert('Impossible de renommer le fichier');break;												
												case 'ERROR_TITLE'		: 
													$('#title-album-photo').addClass('ui-state-error');
													break;
												default : break;
											}									
										}
									}
								},
								{
									text:'Annuler',
									click: function() {			
										$('#upload-photo').swfupload('destroy');								
										$dialog_add_photos.remove();
									}
								}
							]	
						});										
					});
					
				}*/
				
				
				
				/********************* PICASA ********************/					
				
				//init show pi album
				$('body').on('click', 'a.pi-album', function(event){				
					event.preventDefault();
					albumUrl = $(this).attr('href');
					$.ajax({
						url			: albumUrl,
						dataType	: 'jsonp',
						type		: 'get',
						success		: function(data){							
							entries = data.feed.entry;
							photos = [];
							$.each(entries, function(key,val) {									
								photos.push({
									fitToView	: false,													
									autoSize	: true,	
									closeClick	: false,
									closeBtn	: false,
									openEffect	: 'none',
									closeEffect	: 'none',
									prevEffect	: 'none',
									nextEffect	: 'none',
									helpers		: {
										media		:{},
										title		: {
											type		: 'outside'
										},
										overlay		: {
											opacity		: 0.9,
											css			: {
												'background-color' : '#000'
											}
										},
										thumbs		: {
											width		: 100,
											height		: 100
										},
										buttons		: {}
									},
									href		: val.content.src,
									title		: val.title.$t
								});
							});
							$.fancybox(photos);								
						}
					});	
				});		
				
				
				if(user_state == 2){
				
					//init add pi user
					$('#dialog-add-pi').dialog({
						autoOpen: false,					
						resizable: false,
						draggable : false,
						modal:true,
						width:400,
						open: function(event, ui) {						
							jQuery.validator.messages.required = '';							
							$('#form-add-pi-user').validate({
								submitHandler: function(form) {				
									piUrl = 'https://picasaweb.google.com/data/feed/api/user/' + $('#id-pi-user').val();																		
									$.ajax({					
										url			: piUrl + '?alt=json',
										dataType	: 'jsonp',												
										type		: 'get',	
										success		: function(data) {										
											feed = data.feed;										
											name = feed.author[0].name.$t;
											link = feed.author[0].uri.$t;
											thumbnail = feed.gphoto$thumbnail.$t;															
											entry = feed.entry;																	
											
											$.ajax({
												url			: '/user/add_pi_user',			
												dataType	:'json',
												type		: 'post',
												data		: {
													user_id		: user_id,
													url			: piUrl
												},	
												success		: function(data){												
													insertId = data.id;											
													switch(data.status){
														case 'SUCCESS':														
															$('#dialog-add-pi').dialog('close');
															show_servor_message(data.msg);
															$.ajax({
																url		: '/user/show_pi_user',
																type	: 'post',																
																data	: {
																	id			: insertId,
																	name		: name,
																	link		: link,
																	thumbnail	: thumbnail,
																	entry		: JSON.stringify(entry)
																},	
																success	: function(response){
																	$('#pi-photos').append(response);																					
																}
															});	
															break;
															
														case 'EXIST':
															$('#dialog-add-pi').dialog('close');
															show_servor_message(data.msg);
															break;
															
														case 'ERROR_BD':
															$('#dialog-add-pi').dialog('close');
															show_servor_message(data.msg);
															break;
															
														default:break;
													}
												}
											});																																					
										},										
									});							
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
						close: function(){
							$('#id-pi-user').val('');
						},
						buttons: 
						[
							{
								text: 'Valider',					
								'class':'ui-purple',					
								click: function() {
									 $('#form-add-pi-user').submit();											 
								}
							},
							{
								text:'Annuler',
								click: function() {											
									$( this ).dialog( "close" );	
								}
							}
						]	
					});
					
					$('#button-add-pi')
						.button({icons:{primary:'ui-icon-plus'}})
						.click(function(){$('#dialog-add-pi').dialog('open');return false;});		
				
				
					//init delete pi user
					$('body').on('click', 'a.delete-pi-user', function(event){						
						event.preventDefault();
						piUserId = $(this).data('id');
						var dialogDeletePiUser = $('<div><p class="fs-16 title grey">Supprimer ce compte picasa ?</div>')
						.dialog({
							autoOpen	: true,
							resizable	: false,
							draggable	: false,
							modal		: true,
							width		: 400,
							buttons: 
							[
								{
									text: 'Supprimer',					
									'class':'ui-purple',					
									click: function() {
										$.ajax({
											url			: '/user/delete_pi_user',
											type		: 'POST',
											dataType	: 'json',
											data		: {
												id	:	piUserId
											},
											success		: function(data){
												switch(data.status){
													case 'SUCCESS'	: 
														$('#pi-user-' + piUserId).fadeToggle(400, function() {
															dialogDeletePiUser.remove();
															show_servor_message(data.msg);
														});
														break;
													case 'ERROR'	:
														dialogDeletePiUser.remove();
														show_servor_message(data.msg);	
														break;
													default			:
														break;												
												}												
											}
										});
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
					

					/**********INIT INSTAGRAM**********/
					$('#button-add-in')
					.button({icons:{primary:'ui-icon-plus'}});

					
					
					/**********INIT FLICKR**********/
					$('#button-add-fl')
					.button({icons:{primary:'ui-icon-plus'}});
				}				
			});	
		}
	};
	
  $.fn.photo = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );

/**********PHOTOS**********/
function add_photo(album_id, img_name, thumb_name){
	$.ajax({
		url			: '/user/add_photo',
		type 		: 'POST',
		dataType	: 'json',
		data		: {																	
			album_id	: album_id,
			img_name	: img_name,
			thumb_name	: thumb_name
		},
		success		: function(data){
			switch(data.status){
				case true :																		
					break;
				case false :
					throw data.msg;
					break;
				default : break;
			}
		}	
	});
}
