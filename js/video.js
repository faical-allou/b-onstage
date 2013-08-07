(function( $ ){		

	//les variables	
	var parent;
	var user_id;
	var user_state;	
	var count_video;
	var count_feed;
	
	var methods = {		
		//initialisation 
		init : function(options){		
			return this.each(function() { 				
				
				parent = $(this);
				user_id = options.user_id;
				user_state = options.user_state;					
				count_video = $('#yt-videos-list > div').size();
				count_feed = $('#yt-feeds-list > div').size();											
				
				/********* INIT YT TABS *********/
				var first_tab = $('#yt-medias > ul > li:first');
				first_tab.addClass('active');
				$(first_tab.data('content-id')).toggle();
				
				$('#yt-medias > ul > li').click(function(){										
					$($(this).parent().children('li.active').data('content-id')).toggle();
					$(this).parent().children('li.active').removeClass('active');				
					$(this).addClass('active');
					$($(this).data('content-id')).toggle();
				});
				
				/********** INIT YT VIDEO **********/
				
				
				
				if(user_state == 2){
					
					//init dialog add yt video	
					$('#dialog-add-yt-video').dialog({
						autoOpen	: false,					
						resizable	: false,
						draggable	: false,
						modal		:true,
						width		:400,
						open		: function(){												
							$('#form-add-yt-video').validate({
								submitHandler: function(form) {				
									ytUrl = $('#id-yt-video').val();									
									vUrl = ytUrl.match(/[a-z]\:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})/)[1];									
									yt_url = 'http://gdata.youtube.com/feeds/api/videos/' + vUrl;
									yt_type = $('#id-yt-video').data('type');
									$.ajax({
										url			: '/user/add_yt_video',			
										type		: 'post',
										dataType	: 'json',	
										data		: {											
											user_id		: user_id,
											url			: yt_url,
											type		: yt_type
										},
										success		: function(data){													
											switch(data.status){
												case 'SUCCESS'	:													
													$('#dialog-add-yt-video').dialog('close');
													count_video++;													
													show_servor_message(data.msg);													
													$('#count-video').empty().text(count_video);													
													$('#yt-videos-list').prepend(data.html);
													$('.delete-yt-video').button({
														text	: false,
														icons : { primary : 'ui-icon-trash' }
													});	
													break;
												case 'ERROR_BD'	:
													$('#dialog-add-yt-video').dialog('close');
													show_servor_message(data.msg);
													break;
												case 'EXIST'	:
													$('#dialog-add-yt-video').dialog('close');
													show_servor_message(data.msg);
													break;
												default : break;													
											}
										}	
									});
								}
							});
						},
						close : function(){
							$('#id-yt-video').val('');
						},
						buttons: 
						[
							{
								text: document.getElementById("validatetxt").innerHTML,					
								'class':'ui-purple',					
								click: function() {
									 $('#form-add-yt-video').submit();											 
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
					
					$('#button-add-yt-video')
					.button({icons:{primary:'ui-icon-plus'}})
					.click(function(){
						$('#dialog-add-yt-video').dialog('open');
						return false;
					});
													
					//init delete video
					$('.delete-yt-video').button({
						text	: false,
						icons : { primary : 'ui-icon-trash' }
					});	
					
					$('body')
					.on('mouseenter', '.yt-video', function(event){
						$(event.currentTarget).children('.delete-yt-video').toggle();						
					})
					.on('mouseleave', '.yt-video', function(event){
						$(event.currentTarget).children('.delete-yt-video').toggle();						
					})
					.on('click', '.delete-yt-video', function(event){
						id = $(event.currentTarget).data('id');						
						$.ajax({
							url		: '/user/delete_yt_video',
							type	: 'post',
							dataType: 'json',
							data	: {
								id		: id
							},
							success	: function(data){
							
								switch(data.status){
									case 'SUCCESS':
										count_video--;										
										$('#count-video').empty().text(count_video);
										$(event.currentTarget).parent().remove();	
										show_servor_message(data.msg);
										break;
									case 'ERROR':
										show_servor_message(data.msg);
										break;
									default : break;
								}		
								
							}
						});	
					});				
				}						
				
				
				
				/********* INIT YT FLUX *********/				
				if(user_state == 2){
				
					$('#dialog-add-yt-flux').dialog({
						autoOpen	: false,					
						resizable	: false,
						draggable	: false,
						modal		:true,
						width		:400,
						open		: function(){							
							$('#form-add-yt-flux').validate({
								submitHandler: function(form) {				
									var yt_url = 'http://gdata.youtube.com/feeds/api/users/' + $('#id-yt-flux').val();
									var yt_type = $('#id-yt-flux').data('type');									
									$.ajax({
										url			: '/user/add_yt_flux',			
										type		: 'post',
										dataType	: 'json',	
										data		: {
											user_id		: user_id,
											url			: yt_url,
											type		: yt_type
										},
										success		: function(data){													
											switch(data.status){
												case 'SUCCESS'	:
													$('#dialog-add-yt-flux').dialog('close');
													count_feed++;
													show_servor_message(data.msg);													
													$('#count-feed').empty().text(count_feed);
													$('#yt-feeds-list').prepend(data.html);													
													$('.delete-yt-feed').button({
														text	: false,
														icons : { primary : 'ui-icon-trash' }
													});
													break;
												case 'ERROR_BD'	:
													$('#dialog-add-yt-flux').dialog('close');
													show_servor_message(data.msg);
													break;
												case 'EXIST'	:
													$('#dialog-add-yt-flux').dialog('close');
													show_servor_message(data.msg);
													break;
												default : break;													
											}	
										}
									});
								}
							});
						},
						close		: function(){
							$('#id-yt-user').val('');
						},
						buttons: 
						[
							{
								text: document.getElementById("validatetxt").innerHTML,					
								'class':'ui-purple',					
								click: function() {
									 $('#form-add-yt-flux').submit();											 
								}
							},
							{
								text:document.getElementById("canceltxt").innerHTML,
								click: function() {											
									$( this ).dialog('close');	
								}
							}
						]	
					});					
				
					$('#button-add-yt-flux')
					.button({icons:{primary:'ui-icon-plus'}})
					.click(function(){
						$('#dialog-add-yt-flux').dialog('open');
						return false;
					});	
					
					//init delete feed
					
					$('.delete-yt-feed').button({
						text	: false,
						icons : { primary : 'ui-icon-trash' }
					});	
					
					$('body')
					.on('mouseenter', '.yt-title-feed', function(event){						
						$(event.currentTarget).children('.delete-yt-feed').toggle();						
					})
					.on('mouseleave', '.yt-title-feed', function(event){
						$(event.currentTarget).children('.delete-yt-feed').toggle();						
					})
					.on('click', '.delete-yt-feed', function(event){
						id = $(event.currentTarget).data('id');						
						$.ajax({
							url		: '/user/delete_yt_feed',
							type	: 'post',
							dataType: 'json',
							data	: {
								id		: id
							},
							success	: function(data){
							
								switch(data.status){
									case 'SUCCESS':
										count_feed--;										
										$('#count-feed').empty().text(count_feed);
										$(event.currentTarget).parent().parent().remove();	
										show_servor_message(data.msg);
										break;
									case 'ERROR':
										show_servor_message(data.msg);
										break;
									default : break;
								}		
								
							}
						});	
					});
					
					
				}			
				
				
				
				$('.yt-video a').fancybox({
					fitToView	: false,													
					autoSize	: true,
					closeClick	: false,
					closeBtn	: false,
					openEffect	: 'none',
					closeEffect	: 'none',
					prevEffect	: 'none',
					nextEffect	: 'none',
					helpers	: {
					media :{},
					title	: {
						type: 'outside'
					},
					overlay	: {
					opacity : 0.9,
					css : {
						'background-color' : '#000'
					}
					},
					thumbs	: {
						width	: 100,
						height	: 100
					},
					buttons	: {}
					}
				});			
			});		
		}
		
		
		
		/********** INIT YOUTUBE USER **********
		init_yt_user : function(params){		
			return this.each(function() { 				
				entry = params.entry;		
				console.log(entry);	
				username = entry.yt$username.$t;
				author_name = entry.author[0].name.$t;
				title = entry.title.$t;
				avatar_url = entry.media$thumbnail.url;
				//var description = entry.content.$t;
				console.log(author_name);
				//var count_hint = entry.gd$feedLink[4].countHint;
				upload_url = entry.gd$feedLink[4].href;
				
				//init header
				$.ajax({
					url		: '/user/init_yt_user',
					type	: 'post',
					data	: {
						avatar_url	: avatar_url,
						title		: title,
						username	: author_name
					},
					success : function(data){
						$('#yt-users').append(data);					
					
						//load upload video
						$.ajax({											
							url		: upload_url + '?alt=json&max-results=15',								
							dataType: 'jsonp',												
							type	: 'get',											
							error: function(jqXHR, textStatus, errorThrown){alert(textStatus + ' ' +errorThrown);},
							success : function(data) {											
								feed = data.feed;											
								entries = feed.entry || [];
										
								
								$.each(entries, function(key,val) {	
									username = val.author[0].name.$t;
									console.log(username);
									$.ajax({
										url		: '/user/init_yt_video',
										type	: 'post',
										data	: {
											title			: val.media$group.media$title.$t,
											view_count		: val.yt$statistics.viewCount,											
											thumbnail_url 	: val.media$group.media$thumbnail[0].url,							
											link_url		: val.media$group.media$content[0].url,
											description		: val.media$group.media$description.$t										
										},
										success	: function (data){											
											$('#yt-' + username).children('.yt-user-content').append(data);
										}
									});
								});	
									
$('<a/>',{
'class' : 'yt-user-video clearfix db ui-corner-all p-10',
rel : 'fancybox-thumb',
href : playerUrl,
title : title,
html  : '<div class="left mr-20"><img src="' + thumbnailUrl + '" width="144px" /></div>' +
'<div class=""><h3 class="fs-18 bold grey m-0">' + title + '</h3>' +
'<p class="grey fs-12 bold">' + viewCount + ' vues</p>' +
'<p class="grey fs-13">' + description + '</p>' +							
'</div>'
}).appendTo($('#content-' + appTo));	

});		
							}
						});						
					}					
				});
				
			});
		}*/
	};
	
  $.fn.video = function( method ) {

    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    } 
  };
})( jQuery );


/*add youtube user
function add_yt_user(entry){
	
	username = entry.yt$username.$t;
	authorName = entry.author[0].name.$t;
	title = entry.title.$t;
	content = entry.content.$t.substr(0,500);
	thumbnailUrl = entry.media$thumbnail.url;
	countHint = entry.gd$feedLink[4].countHint;
	uploadUrl = entry.gd$feedLink[4].href;
	userLink = $('<div/>',{
		id 		: username, 										
		'class' : 'yt-user-videos clearfix p-20',		
		html 	: '<div class="clearfix">' + 
				'<div class="left mr-20"><img src="' + thumbnailUrl + '" width="144"/></div>' +
				'<div><h3 class="fs-18 bold grey m-0">' + title + ' (' + countHint + ' vidéos )</h3>' +
				'<p class="grey fs-13">' + content + '</p>' +												
				'<div class="mt-10"><button onclick="upload_user_videos(\'' + uploadUrl + '\',\'' + username + '\');$(this).button(\'disable\');" class="button-upload-videos" >' + countHint + ' vidéos</button></div>' +	
				'</div></div>'
	});								

	userLink.appendTo($('#yt-user'));
	
	$('.button-upload-videos').button({
		icons: {			
			secondary: 'ui-icon-triangle-1-s'
		}
	});
}

/*upload user video*
function upload_user_videos(uploadUrl, appTo){		
	$('#' + appTo).addClass('active');
	
	$('<div/>', {
		'class'	: 'mt-20 clearfix ui-corner-all',
		'style'	: 'border:1px solid #eaeaea;',
		id		: 'content-' + appTo	
	}).appendTo($('#' + appTo));
	
	$.ajax({											
		url		: uploadUrl + '?alt=json&max-results=15',								
		dataType: 'jsonp',												
		type	: 'get',											
		error: function(jqXHR, textStatus, errorThrown){alert(textStatus + ' ' +errorThrown);},
		success : function(data) {											
			feed = data.feed;											
			entries = feed.entry || [];														
			$.each(entries, function(key,val) {											
				title = val.media$group.media$title.$t;	
				viewCount = val.yt$statistics.viewCount;											
				thumbnailUrl = val.media$group.media$thumbnail[0].url;							
				playerUrl = val.media$group.media$content[0].url;
				description = val.media$group.media$description.$t.substr(0,200);
				$('<a/>',{
					'class' : 'yt-user-video clearfix db ui-corner-all p-10',
					rel : 'fancybox-thumb',
					href : playerUrl,
					title : title,
					html  : '<div class="left mr-20"><img src="' + thumbnailUrl + '" width="144px" /></div>' +
							'<div class=""><h3 class="fs-18 bold grey m-0">' + title + '</h3>' +
							'<p class="grey fs-12 bold">' + viewCount + ' vues</p>' +
							'<p class="grey fs-13">' + description + '</p>' +							
							'</div>'
				}).appendTo($('#content-' + appTo));																
			});									
			
			//init fancybox	
			$('.yt-user-video').fancybox({
				fitToView	: false,													
				autoSize	: true,
				closeClick	: false,
				closeBtn	: false,
				openEffect	: 'none',
				closeEffect	: 'none',
				prevEffect	: 'none',
				nextEffect	: 'none',
				helpers	: {
					media :{},
					title	: {
						type: 'outside'
					},
					overlay	: {
						opacity : 0.9,
						css : {
							'background-color' : '#000'
						}
					},
					thumbs	: {
						width	: 100,
						height	: 100
					},
					buttons	: {}
				}
			});	
		}
	});
}*/
