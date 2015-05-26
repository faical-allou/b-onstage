//FUNCTIONS
function loading_page(){
	$(window).bind('load', function(){				
		$('#container > .content').fadeToggle(800);	
		location.reload(true);
	});	
}


function init_menu(id){
	$('#' + id).addClass('active');	
}

function init_account_menu(id){
	 $('#account-menu').scrollToFixed({
		zIndex		: 5000,
		marginTop	: $('#header').outerHeight(),			
		preFixed	: function() { $(this).removeClass('ui-corner-all').addClass('ui-corner-bottom'); },
		postFixed	: function() { $(this).removeClass('ui-corner-bottom').addClass('ui-corner-all'); }
	});
	
	if(id)
		$('#' + id).addClass('active');	
}

function init_search_bar(open){
	if(open){
		$('#search-bar').show();
	}

	/**********INIT SEARCH STATUS**********/
	$('#search-status').multiselect({
		header			: false,
		multiple		: false,
		selectedList	: 1,
		height			: 'auto',
		classes			: 'search-status'
	});

	/**********INIT DATE RANGE**********/
	$.datepicker.setDefaults($.datepicker.regional[document.getElementById("datepicker_lang").innerHTML]);

	$('#wrapper-date-start').click(function(){
		if(!$('#render-date-start').datepicker('widget').is(':visible'))
			$('#render-date-start').datepicker('show');
	});

	$('#render-date-start').datepicker({
		dateFormat		: 'dd/mm/yy',
		minDate			: Date.today(),
		altFormat		: 'yy-mm-dd',
		altField		: '#search-date-start',
		numberOfMonths	: 1,
		beforeShow		: function(input, inst){
			inst.dpDiv.css({marginTop:'5px', marginLeft:'-1px'}).addClass('bs-black');
		},
		onClose			: function( selectedDate ) {
			$('#render-date-end').datepicker('option','minDate', selectedDate );
		}
	});

	$('#wrapper-date-end').click(function(){
		if(!$('#render-date-end').datepicker('widget').is(':visible'))
			$('#render-date-end').datepicker('show');
	});

	$('#render-date-end').datepicker({
		dateFormat		: 'dd/mm/yy',
		minDate			: Date.today(),
		altFormat		: 'yy-mm-dd',
		altField		: '#search-date-end',
		numberOfMonths	: 1,
		beforeShow		: function(input, inst){
			inst.dpDiv.css({marginTop:'5px', marginLeft:'-1px'}).addClass('bs-black');
		},
		onClose			: function( selectedDate ) {
			$('#render-date-start').datepicker('option','maxDate', selectedDate );
		}
	});

	/*********INIT SEARCH CITY**********/
	$('#search-city')
	.multiselect({
		header				: true,
		multiple			: false,
		selectedList		: 1,
		selectedText 		: '# '+document.getElementById("searchbarselected").innerHTML,
		height				: 'auto',
		width				: 'auto',
		checkAllText		: document.getElementById("searchbarcheckall").innerHTML,
		uncheckAllText		: document.getElementById("searchbaruncheckall").innerHTML,
		classes				: 'search-city',
		noneSelectedText	: document.getElementById("choose_city").innerHTML
	})
	.multiselectfilter({
		label 				: '<span aria-hidden="true" class="fs-16 grey icon-search ml-5 mr-10"></span>',
		placeholder			: document.getElementById("users_page_inputcity").innerHTML
	});
	$("#search-city").multiselect("disable");	
	
	/*********INIT SEARCH COUNTRY**********/
	$('#search-country')
	.multiselect({
		header				: '',
		multiple			: false,
		selectedList		: 10,
		height				: 'auto',
		width				: 'auto',
		classes				: 'search-country',
		noneSelectedText	: document.getElementById("choose_country").innerHTML
	})
	.multiselectfilter({
		label 				: '<span aria-hidden="true" class="fs-16 grey icon-search ml-5 mr-10"></span>',
		placeholder			: document.getElementById("users_page_inputcountry").innerHTML
	});
	
	if($("#search-country").val() == null) {	
		$("#search-city").multiselect("disable");
	}
	else {
		$("#search-city").multiselect("enable");
		if($("#search-city").val() == null) {	
			$("#search-city").empty();
		}
		else {
			//$("#search-city").multiselect("disable");
		}
			$("."+$("#search-country").val()+"").each(function(){
				$('#search-city').append($('<option></option>').attr("selected",(function(){
					if($("#search-country").val() == $(this).html()) {	
						$("#search-city").multiselect("disable");
					}
					})).attr('value', $(this).html())
					.text($(this).html()));
				});
		
		$("#search-city").multiselect("refresh");
		if($("#search-city").val() == null) {	
			$("#search-city").multiselect("checkAll");
		}
		
	}
	$('#search-country').change(function(){
		
		
		
		if($("#search-country").val() == null) {	
			$("#search-city").multiselect("disable");
		}
		else {
			
			$("#search-city").multiselect("enable");
			$("#search-city").empty();
			
			
			if($("#currentcountry").val() == $("#search-country").val()){
				$(".xxx"+$("#search-country").val()+"").each(function(){
				$('#search-city').append($('<option></option>').attr('selected','selected').attr('value', $(this).html())
					.text($(this).html()));
				});
				
				$("."+$("#search-country").val()+"").each(function(){
				$('#search-city').append($('<option></option>').attr('value', $(this).html())
					.text($(this).html()));
				});
			}
			else {
				$("."+$("#search-country").val()+"").each(function(){
				$('#search-city').append($('<option></option>').attr('value', $(this).html())
					.text($(this).html()));
				});
				$("#search-city").multiselect("refresh");
				$("#search-city").multiselect("checkAll");
				
			}
												

			$("#search-city").multiselect("refresh");						
			
			
			
		}	
	});
	
	

	/**********INIT BUTTON SEARCH**********/
	$('#button-search-concert').button();
	if($("#search-city").val() == null) {	
			$('#button-search-concert').button({disabled:true});
		}
	else {
		$('#button-search-concert').button("enable");
		}
	$('#search-city').change(function(){
	if($("#search-city").val() == null) {	
			$('#button-search-concert').button({disabled:true});
		}
	else {
		$('#button-search-concert').button("enable");
		}	
	});
	$('#search-country').change(function(){
	if($("#search-city").val() == null) {	
			$('#button-search-concert').button({disabled:true});
		}
	else {
		$('#button-search-concert').button("enable");
		}	
	});
	
	
}

function init_search_form(id_search_menu){
	$('#search-menu > li').each(function(){
		if($(this).hasClass('active'))
			$(this).removeClass('active');
	});
	$('#search-form > div').each(function(){
		if(!$(this).hasClass('hidden'))
			$(this).addClass('hidden');
	});
	$('#' + id_search_menu).addClass('active');
	$('#' + id_search_menu.replace('menu','form')).removeClass('hidden');
}

function show_servor_message(message){
	$('#servor-message').empty().append(message).css('top', $(window).height() / 2 + 'px');
	$('#w-servor-message').fadeToggle().delay(5000).fadeToggle();
}

function init_profil_menu(){
	$('#dropdown-notification').dropdown('init');
	$('#dropdown-username').dropdown('init');	
	
	$("#dropdown-notification").click(function(event) {		
		$.get('/user/read_notifications', function(data) {
			$('#dropdown-notification').removeClass('priority-1 priority-2 priority-3');
			$('#dropdown-notification > div:first').text(0);
		});
	});	
}

function init_sidebar(){
	//init social tabs
	change_social_tabs('tabs-menu-twitter');
	$('#social-tabs > ul > li').bind('click',function(){	
		change_social_tabs($(this).attr('id'));	
	});
}

function change_social_tabs(id){
	$('.tabs-content').not('.hidden').addClass('hidden');	
	$('#social-tabs > ul > li.active').removeClass('active');
	$('#' + id).addClass('active');
	content_id = '#' + $('#' + id).data('content-id');
	$(content_id).removeClass('hidden');
}

function init_footer(){	

	$('.contact_us').click(function(){
		var dialog_form_contact = $('<div>').dialog({					
			autoOpen:true,					
			width:600,
			resizable: false,
			draggable : false,						
			modal:true,
			appendTo :' body',
			open : function(event, ui){			
				$.ajax({
					url		: '/user/tpl_send_email',
					success : function(data){		
						dialog_form_contact.append(data).dialog('option','position','center');						
						$('#form-contact-subject-1, #form-contact-subject-2').multiselect({
							header			: false,
							multiple		: false,
							selectedList	: 1,
							height			: 'auto'							
						});							
						//$('#form-contact input:text, #form-contact textarea').fieldWidth(1.0);
						$('#form-contact').validate({
							submitHandler: function(form) {																					
								$.ajax({
									url		: '/user/send_email',
									dataType: 'json',
									type	: 'post',
									data	: {
										name		: $('#form-contact-name').val(),
										from		: $('#form-contact-email').val(),
										to			: 'contact@b-onstage.com',
										subject_1	: $('#form-contact-subject-1').val(),
										subject_2	: $('#form-contact-subject-2').val(),
										message 	: $('#form-contact-message').val()
									},	
									success : function(data){						
										//$('#form-contact-loader').addClass('hidden');
										switch(data.status){
											case 'SUCCESS'	: 
												dialog_form_contact.remove();
												show_servor_message(data.msg);
												break;
											case 'ERROR'	:
												$('#form-contact-response').append(data.msg).removeClass('hidden').addClass('red');
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
					text: document.getElementById("users_contact_sendmsg").innerHTML,
					'class':'ui-purple',					
					click: function() {	
						$('#form-contact').submit();							
					}
				},
				{
					text:document.getElementById("canceltxt").innerHTML,
					click: function() {										
						$( this ).remove();;																
					}
				}
			]	
		});
		
		$(window).resize(function(){
			dialog_form_contact.dialog('option', 'position', 'center');
		});
	});	
}