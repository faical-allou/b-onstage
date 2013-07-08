$(function(){
	$(window).bind('load', function(){		
		/**********INIT HEADER**********/
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});	
		init_search_bar(false);					
		init_profil_menu();
		init_footer();
	
		/*********INIT BUTTON*********/
		$('#show-artist-profil').button();
		$('#show-stage-profil').button();
		
		
		/********** INIT PLAYER**********/	
		var jPlayer;	
		$.jPlayer.timeFormat.sepMin = ' : ';
		$.jPlayer.timeFormat.sepSec = ' ';
		
		$('.jp-previous').click(function(){				
		});
		
		$('.jp-next').click(function(){									
		});							
			
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
		
		/*show hide playlist*/
		$('#button-show-playlist').click(function(){
			if($(this).hasClass('jp-show-playlist'))
				$(this).removeClass('jp-show-playlist').addClass('jp-hide-playlist');
			else
				$(this).removeClass('jp-hide-playlist').addClass('jp-show-playlist');
			
			$('.jp-audio div.jp-playlist').slideToggle();						
		});
						
		$('#tracks > li:odd').css('backgroundColor', '#f5f5f5');
		$('#tracks > li:even').css('backgroundColor', '#ffffff');				
					
		//init click track
		$('.track').bind('dblclick', function(){						
			set_playlist(jPlayer, 'tracks', $(this).index());					
		});
		$('.track-play, .track-title').bind('click', function(){										
			set_playlist(jPlayer, 'tracks', $('#' + $(this).data('track-id')).index());
		});
		$('.tracks-listen')
		.button({icons:{primary : 'ui-icon-play'}})
		.bind('click', function(){						
			set_playlist(jPlayer, 'tracks', 0);
		});	

		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);			
	});

	/********** INIT FUNCTIONS **********/
	function set_playlist(jPlayer, list_id, index, client_id){
		tracks_list = [];
		start = index;	
		$('#' + list_id + ' > li').slice(start).each(function() {		
			track = $(this);
			title = track.data('track-title');		
			stream_url = track.data('stream-url');
			tracks_list.push({ 
				title	: title,
				mp3		: stream_url	
			});
		});	
		if($('.jp-audio').hasClass('hidden'))
			$('.jp-audio').removeClass('hidden');		
		jPlayer.setPlaylist(tracks_list);
	}
	
});