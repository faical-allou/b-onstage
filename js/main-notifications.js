var notificationsOffset = 10;
$(function(){

	init_profil_menu();
	init_search_bar(false);
	init_footer();
	
	
	$.get('/user/read_notifications');	
	$('#more-notifications').click(function(){
		$.get('/user/notifications/'+notificationsOffset, function(data){
			if(data)
				$('#notifications-container').append(data);
			else
				$('#more-notifications').remove();
		});
		notificationsOffset += 10;
	});
	
	$('.loading').hide();
	$('.content').show();
	
});
