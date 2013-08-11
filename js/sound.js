(function( $ ){		
	var parent, user_id, user_state,active_track,jPlayer,sc_client_id,sc_secret_id;	
	var methods = {		
		/**********INIT FUNCTION**********/
		init : function(options){		
			return this.each(function() { 				
				
				/********** INIT VARS**********/				
				parent = $(this);
				user_id = options.user_id;
				user_state = options.user_state;																
				sc_client_id = '68139674690a8e456179aa74ca065667';	
				sc_secret_id = '8922d4688dbee416effbc0927d2280f0';
				/*
				//PROD
				sc_client_id = '5daaabb2aecacbce6f1af0c2df08fa9f';	
				sc_secret_id = '6eaa28602492e3340859b7db399cda7b';	
				*/		
				
				/********** INIT PLAYER**********/	
				parent.sound('init_player');				
				
				/**********INIT SOUND**********/				
				parent.sound('init_tracks');
				
				if(user_state == 2){
					$('#button-add-sound')
					.button({icons:{primary:'ui-icon-plus'}})
					.click(function(){						
						parent.sound('add_tracks');					
					});
				}				
				
				/**********INIT SOUNDCLOUD**********/												
				parent.sound('init_sc');
				
				if(user_state == 2){												
					$('#button-add-sc')
					.button({icons:{primary:'ui-icon-plus'}})
					.click(function(){						
						parent.sound('add_sc');		
					});					
				}			
			});
		},
		
		
		/********** INIT PLAYER **********/
		init_player : function(options){
			return this.each(function() {
				$.jPlayer.timeFormat.sepMin = ' : ';
				$.jPlayer.timeFormat.sepSec = ' ';
			
				$('.jp-previous').click(function(){				
				});
			
				$('.jp-next').click(function(){									
				});							
				
				/*init player playlist*/	
				jPlayer = new jPlayerPlaylist({
					jPlayer					: "#sound-player",
					cssSelectorAncestor		: ".jp-audio"					
				},
				[],
				{
					playlistOptions			: {
						autoPlay				: true,	
						enableRemoveControls	: true
					},					
					swfPath					: '/js/jplayer',
					supplied				: 'mp3'
				});								
								
				$('#sound-player').bind($.jPlayer.event.loadstart, function (event) {
					active_track.addClass('active');
				});
				
				$('#button-show-playlist').click(function(){
					if($(this).hasClass('jp-show-playlist'))
						$(this).removeClass('jp-show-playlist').addClass('jp-hide-playlist');
					else
						$(this).removeClass('jp-hide-playlist').addClass('jp-show-playlist');
					
					$('.jp-audio div.jp-playlist').slideToggle();						
				});
			});	
		},

		/********** SET PLAYLIST **********/
		set_playlist:function(options){			
			return this.each(function(){
				var o = $.extend({},options);
				start = o.index; 
				playlist = o.playlist;				
				sc_client_id = o.sc_client_id;				
				tracks_list = [];
				playlist.children('li').slice(start).each(function() {											
					track = $(this);					
					title = track.data('track-title');		
					stream_url = (sc_client_id == 0) ?  track.data('stream-url') : track.data('stream-url') + '?client_id=' + sc_client_id;		
					
					tracks_list.push({ 
						title	: title,
						mp3		: stream_url	
					});			
					
				});	
				
				if($('.jp-audio').hasClass('hidden'))
					$('.jp-audio').removeClass('hidden');		
					
				jPlayer.setPlaylist(tracks_list);			
			});	
		},
		
		
		/********** INIT ALL TRACKS **********/
		init_tracks: function(options){		
			return this.each(function() {
				$('.tracks')
				.on('dblclick', '.track', function(event){					
					active_track = $(event.currentTarget);					
					parent.sound('set_playlist', { playlist : active_track.parent(), index : active_track.index(), sc_client_id : 0});				
				})
				.on('click','.track-play, .track-title', function(event){												
					active_track = $(event.currentTarget).parents('.track');				
					parent.sound('set_playlist', { playlist : active_track.parents('.tracks'), index : active_track.index(), sc_client_id : 0});
				});	
				
				if(user_state == 2){					
					$('.tracks')
					.on('click','.track-delete', function(event){							
						track_id = $(event.currentTarget).data('track-id');								
						track_url = $(event.currentTarget).data('track-url');															
						parent.sound('delete_track',{track_id : track_id, track_url : track_url});
					});					
				}
				
			});
		},				
		
		
		
		/**********ADD TRACKS**********/
		add_tracks : function(options){
			return this.each(function(){
			
				var dialog_add_tracks = $('<div id="dialog-add-tracks"></div>')
				.appendTo('body')
				.dialog({
					autoOpen	:true,					
					width		: 880,						
					resizable	: false,
					draggable	: false,						
					modal		: true,							
					open		: function(event, ui) {										
						$.ajax({
							url		: '/user/dialog_add_tracks',
							success : function(data){
								dialog_add_tracks.append(data);	
								
								//init swfupload track
								$('#upload-tracks')
								.swfupload({
									upload_url: '/upload/track/' + $('#upload-tracks').data('session-id'),								
									file_post_name: 'uploadfile',
									file_size_limit : '20 MB',
									file_types : '*.mp3',
									file_types_description : 'upload tracks',
									file_upload_limit : 10,
									file_queue_limit : 10,
									flash_url : '/js/swfupload/swfupload.swf',
									button_placeholder_id : 'button-upload-tracks',
									button_image_url : '/js/swfupload/button/'+document.getElementById("button_track").innerHTML,
									button_width : 200,
									button_height : 40,
									button_cursor : SWFUpload.CURSOR.HAND,
									button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT
								})						
								.bind('swfuploadLoaded', function(event){							
								})
								.bind('fileQueued', function(event, file){		
									
									$.ajax({
										url		: '/user/upload_track',
										type	: 'post',
										data	: {
											file_id	: file.id
										},	
										success : function(data){
											$('#list-upload-tracks').append(data);
											$('#track-title-' + file.id).val(file.name.match(/(.*)\.[^.]+$/)[1]);
											$('#progressbar-' + file.id).progressbar();													
										}
									});														
									
								})
								.bind('fileQueueError', function(event, file, errorCode, message){
									$('<p/>',{												
										'class' : 'ui-state-error p-10',
										html : message
									}).appendTo($('#state-upload-' + file.id));
								})
								.bind('fileDialogStart', function(event){																
									
								})
								.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){																									
									
									$(this).swfupload('startUpload');
									
								})
								.bind('uploadStart', function(event, file){																					
									$('#button-add-tracks').hide();
								})
								.bind('uploadProgress', function(event, file, bytesLoaded, bytesTotal){								
									
									$('#upload-bytes-loaded-' + file.id).text((bytesLoaded / 1048576).toFixed(2));
									$('#upload-bytes-total-' + file.id).text((bytesTotal / 1048576).toFixed(2));
									$('#progressbar-' + file.id).progressbar('value',(bytesLoaded / bytesTotal) * 100);
									
								})
								.bind('uploadSuccess', function(event, file, serverData){
									
									dataFile = eval('(' + serverData + ')');
									
									$('#upload-track-' + file.id)
									.data('track-file-name', dataFile.file_name)
									.data('track-title', $('#track-title-' + file.id).val());											
										
									
								})
								.bind('uploadComplete', function(event, file){	

									$('#upload-infos-' + file.id).empty().append('<span aria-hidden="true" class="icon-checkmark green mr-5 fs-16"></span>'+document.getElementById("users_page_sons_addtrack_success").innerHTML);
									$('#progressbar-' + file.id).remove();
									$('#button-add-tracks').show();
									$(this).swfupload('startUpload');
									
								})
								.bind('uploadError', function(event, file, errorCode, message){			

									$('<p/>',{												
										'class' : 'ui-state-error p-10',
										html : message
									}).appendTo($('#state-upload-' + file.id));
									
								});
								
								//init validate
								$('#form-upload-tracks').validate({
									submitHandler: function(form) {
										tracks_count = $('#list-upload-tracks > li').length;
										if(tracks_count > 0){											
										
											$('#list-upload-tracks > li').each(function(){
												track_title = $(this).find(':input').val();
												track_file_name = $(this).data('track-file-name');
												$.ajax({
													url			: '/user/add_track',
													dataType	: 'json',
													type		: 'post',
													data		: {														
														title		: track_title,
														file_name	: track_file_name,														
													},
													success : function(data){
														$('#tracks-list .tracks').prepend(data.html);												
													}
												});								
											});
											$('#upload-tracks').swfupload('destroy');								
											dialog_add_tracks.remove();
										}
									
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
							}
						});
					},												
					buttons	: 
					[
						{
							text	: document.getElementById("addtxt").innerHTML,
							id		: 'button-add-tracks',						
							'class'	: 'ui-purple',									
							click	: function() {							
								$('#form-upload-tracks').submit();								
							}
						},
						{
							text	:document.getElementById("canceltxt").innerHTML,						
							click	: function() {											
								$('#upload-tracks').swfupload('destroy');										
								dialog_add_tracks.remove();										
							}
						}
					]	
				});
			});
		},
		
		
		
		/********** DELETE TRACKS **********/
		delete_track: function(options){		
			return this.each(function() {
				track_id = options.track_id;
				track_url = options.track_url;				
				$.ajax({
					url		 	: '/user/delete_track',
					dataType	: 'json',
					type		: 'post',
					data		: {
						track_id	: track_id,
						track_url	: track_url
					},
					success		: function(data){
						if (data.status){										
							$('#track-' + track_id).remove();							
						}	
					}
				});			
			});
		},
		
		
		
		//init sc user
		init_sc : function(options){		
			return this.each(function() {
				var sc_user_id;
				$('.sc-tracks')
				.on('dblclick', '.sc-track', function(event){					
					active_track = $(event.currentTarget);					
					parent.sound('set_playlist', { playlist : active_track.parent(), index : active_track.index(), sc_client_id : sc_client_id});				
				})
				.on('click','.sc-track-play, .sc-track-title', function(event){												
					active_track = $(event.currentTarget).parents('.sc-track');				
					parent.sound('set_playlist', { playlist : active_track.parents('.sc-tracks'), index : active_track.index(), sc_client_id : sc_client_id});
				});			
				
				if(user_state == 2){
					//init delete soundcloud user				
					$('.sc-delete-user')
					.button({icons : {primary : 'ui-icon-trash'}})
					.bind('click', function(){						 
						sc_user_id = $(this).data('sc-user-id');
						parent.sound('delete_sc', {sc_user_id : sc_user_id});
					});					
					
					//init synchronisation soundcloud user
					$('.sc-synchro-user')
					.button({icons : {primary : 'ui-icon-transferthick-e-w'}})
					.bind('click', function(){						 
						sc_user_id = $(this).data('sc-user-id');
						parent.sound('synchr_sc', {sc_user_id : sc_user_id});
					});
					
				}	
			});
		},	
		
		
		
		//add soundcloud user
		add_sc : function(options){		
			return this.each(function() {								
						
				var sc_user, sc_playlists, sc_tracks, sc_exist;	
				$.getScript("http://connect.soundcloud.com/sdk.js", function(data, textStatus, jqxhr) {	
							
					//initialise
					SC.initialize({
						client_id		: sc_client_id,							
						redirect_uri	: 'http://www.dev.b-onstage.com/user/redirect_sc'
					}); /*PROD : redirect_uri	: 'http://www.b-onstage.com/user/redirect_sc' */
					
					//connect and add sc
					SC.connect(function() {													
						
						//get user
						SC.get('/me', function(me) { 
							sc_user = me;								
							//user exist
							$.ajax({
								url			: '/user/exist_sc',
								type		: 'post',
								dataType	: 'json',
								data		:{
									sc_id		: sc_user.id
								},										
								success		: function(data){	
									sc_exist = data.exist;
									if(!sc_exist){
										
										$dialog_add_sc = $('<div id="dialog_add_sc"></div>');
										$('body').append($dialog_add_sc);
										
										$dialog_add_sc.dialog({
											autoOpen	:true,	
											minWidth	: 400,
											height		: 'auto',	
											resizable	: false,
											draggable	: false,						
											modal:true,							
											open		: function(event, ui) {												
												$.ajax({
													url			: '/user/dialog_add_sc',
													type		: 'POST',														
													data		:{
														sc_user 		: JSON.stringify(sc_user)
													},
													success: function(data){														
														$dialog_add_sc.append(data);
													}
												});			
											},																										
											buttons		: 
											[
												{
													text	: document.getElementById("addtxt").innerHTML,								
													'class'	: 'ui-purple',									
													click	: function() {		
														//get playlists
														SC.get('/users/' + sc_user.id + '/playlists', function(playlists){
															sc_playlists = playlists;
											
															//get tracks
															SC.get('/users/' + sc_user.id + '/tracks', function(tracks){
																sc_tracks = tracks;													

														
																$.ajax({
																	url			: '/user/add_sc',
																	type		: 'POST',
																	dataType	: 'json',
																	data		:{
																		sc_user 		: JSON.stringify(sc_user),
																		sc_playlists	: JSON.stringify(sc_playlists),
																		sc_tracks		: JSON.stringify(sc_tracks)
																	},
																	success: function(data){																																	
																		$dialog_add_sc.remove();
																		if(data.status){
																			$.ajax({
																				url			: '/user/show_add_sc',
																				type		: 'POST',																		
																				data		:{
																					sc_user 		: JSON.stringify(sc_user),
																					sc_playlists	: JSON.stringify(sc_playlists),
																					sc_tracks		: JSON.stringify(sc_tracks)
																				},	
																				success : function(data){																				
																					$('#soundcloud').prepend(data);																					
																					parent.sound('init_sc');
																				}
																			});
																		}	
																	}
																});													
															});
														});	
													}
												},
												{
													text:document.getElementById("canceltxt").innerHTML,
													click: function() {																				
														$dialog_add_sc.remove();																											
													}
												}
											]	
										})
										.appendTo('content-sound');
									}else
										alert('Cet utilisateur exite déjà');									
								}
							});
						});
					});					
				});			
			});
		},
		
		
		
		//synchronisation compte
		synchr_sc : function(options){		
			return this.each(function() {
				var sc_user_id = options.sc_user_id;			
				var sc_user, sc_playlists, sc_tracks, sc_exist;
				
				
				//add sc user
				$.getScript("http://connect.soundcloud.com/sdk.js", function(data, textStatus, jqxhr) {	
							
					//initialise
					SC.initialize({
						client_id		: sc_client_id						
					});
					
					SC.get('/users/' + sc_user_id, function(me) { 
						sc_user = me;					
						
						$dialog_synchr_sc = $('<div id="dialog-synchr-sc"><div class="p-20"><p class="grey fs-12 bold">'+document.getElementById("users_page_sons_soundcloud_syncconf").innerHTML+'</p></div></div>');
						$('body').append($dialog_synchr_sc);						
											
						$dialog_synchr_sc.dialog({
							autoOpen	:true,	
							minWidth	: 400,
							height		: 'auto',	
							resizable	: false,
							draggable	: false,						
							modal		:true,																																									
							buttons		: 
							[
								{
									text	: document.getElementById("synctxt").innerHTML,								
									'class'	: 'ui-purple',									
									click	: function() {		
										//delete sc user
										$.ajax({
											url			: '/user/delete_sc',
											dataType	: 'json',
											type		: 'post',
											data		: {
												sc_user_id	: sc_user_id								
											},
											success		: function(data){
												//get playlists	
												SC.get('/users/' + sc_user_id + '/playlists', function(playlists){																										
													sc_playlists = playlists;													
												
													//get tracks
													SC.get('/users/' + sc_user_id + '/tracks', function(tracks){
														sc_tracks = tracks;

														//add sc user												
														$.ajax({
															url			: '/user/add_sc',
															type		: 'POST',
															dataType	: 'json',
															data		: {
																sc_user 		: JSON.stringify(sc_user),
																sc_playlists	: JSON.stringify(sc_playlists),
																sc_tracks		: JSON.stringify(sc_tracks)
															},
															success: function(data){																																	
																$dialog_synchr_sc.remove();
																if(data.status){
																	//show sc user
																	$.ajax({
																		url			: '/user/show_add_sc',
																		type		: 'POST',																		
																		data		:{
																			sc_user 		: JSON.stringify(sc_user),
																			sc_playlists	: JSON.stringify(sc_playlists),
																			sc_tracks		: JSON.stringify(sc_tracks)
																		},	
																		success : function(data){
																			$('#sc-user-' + sc_user_id).remove();
																			$('#soundcloud').prepend(data);																					
																			parent.sound('init_sc');
																		}
																	});
																}	
															}
														});
													});	
												});	
											}											
										});																									
									}
								},
								{
									text:document.getElementById("canceltxt").innerHTML,
									click: function() {																				
										$dialog_synchr_sc.remove();																											
									}
								}
							]	
						})
						.appendTo('content-sound');							
						
					});	
				});	
			});
		},
		
		
		
		//delete user
		delete_sc : function(options){		
			return this.each(function() {			
				var sc_user_id = options.sc_user_id;	
				
				$dialog_delete_sc = $('<div id="dialog-delete-sc"><div class="p-20"><p class="grey fs-12 bold">'+document.getElementById("users_page_sons_soundcloud_delconf").innerHTML+'</p></div></div>');
				$('body').append($dialog_delete_sc);
				
				$dialog_delete_sc.dialog({
					autoOpen	:true,	
					minWidth	: 400,
					height		: 'auto',	
					resizable	: false,
					draggable	: false,						
					modal		:true,																																									
					buttons		: 
					[
						{
							text	: document.getElementById("deletetxt").innerHTML,								
							'class'	: 'ui-purple',									
							click	: function() {		
								$.ajax({
									url			: '/user/delete_sc',
									dataType	: 'json',
									type		: 'post',
									data		: {
										sc_user_id	: sc_user_id								
									},
									success		: function(data){	
										if(data.status){
											$('#sc-user-' + sc_user_id).remove();
										}	
										$dialog_delete_sc.remove();										
									}
								});												
							}
						},
						{
							text:document.getElementById("canceltxt").innerHTML,
							click: function() {																				
								$dialog_delete_sc.remove();																											
							}
						}
					]	
				})
				.appendTo('content-sound');				
			});
		}	
	};
	
  $.fn.sound = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );

//set playlist




//toggle visibility of track
function update_visibility_track(checkbox){	
	$.ajax({
		url			: '/user/update_visibility_track_sc',
		dataType	: 'json',
		type		: 'post',
		data		: {
			track_id	: checkbox.data('track-id'),
			visible		: (checkbox.prop('checked')) ? 1 : 0
		},
		success		: function(data){			
		}
	});
}