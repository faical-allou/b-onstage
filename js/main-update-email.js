$(function() {
	//initialisation des boutons	
	$('input:submit').button();
	
	//initit search bar
	init_search_bar(false);
	
	//init_profil_menu
	init_profil_menu();
	
	//init account menu
	init_account_menu();	
	
	init_footer();
	
	$(window).bind('load', function(){
		$('#account').fadeToggle(800);
	});
});

