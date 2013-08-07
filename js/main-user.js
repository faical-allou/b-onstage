$(function() {
	$(window).bind('load', function(){	
		/**********INIT HEADER**********/		
		$('#header').scrollToFixed({
			zIndex		: 9999			
		});
		init_search_bar(false);
		init_profil_menu();	
		init_account_menu('a-m-home');
	
		$('#sidebar').scrollToFixed({
			marginTop	: $('#header').outerHeight() + 70,
			limit		: function(){
				var limit = $('#footer').offset().top - $(this).outerHeight(true);						
				return limit;
			}
		});
		
		//init button
		$('#show-profil').button();
		$('#update-information').button();
	
	
		//init accordion
		$('.show-form').on('click',function(event){
			$($(event.target).data('show-id')).toggle('slide',{direction:'up'},200,function(){
				if(event.target.innerHTML == document.getElementById("modify_txt").innerHTML)
					$(event.target).empty().html(document.getElementById("hide_txt").innerHTML);
				else
					$(event.target).empty().html(document.getElementById("modify_txt").innerHTML);
			});
		});	
	
		//init validate form
		$('.wrap-form').find('input:submit').button();
		
		//form update username
		var form_update_username = $('#form-update-username').validate({
			submitHandler: function(form) {																			
				$.ajax({
					url		: '/user/update_username',
					dataType: 'json',
					type	: 'post',
					data	: {
						username: $('#input-username').val()					
					},	
					success : function(data){											
						switch(data.status){
							case 'SUCCESS'	: 
								show_servor_message(data.msg);
								$('#username-error').empty();							
								$($(form).data('button-show-id'))
								.trigger('click')
								.prev()
								.text($('#input-username').val());
								break;
							default : 							
								$('#username-error').empty();
								$('<label>')
								.addClass('ui-corner-all ui-state-error p-5')
								.html(data.msg)
								.appendTo($('#username-error'));							
								break;
						}		
					}
				});
			},
			rules: {
				'input-username'	:{
					required	: true,
					minlength	: 5,
					maxlength	: 25
				}
			},
			messages: {
				'input-username'	:{
					required	: document.getElementById("requiered_txt").innerHTML,
					minlength	: jQuery.format(document.getElementById("mincharacters_txt").innerHTML+' {0} '+document.getElementById("characters_txt").innerHTML),
					maxlength	: jQuery.format(document.getElementById("maxcharacters_txt").innerHTML+' {0} '+document.getElementById("characters_txt").innerHTML)
				}
			},		
			errorPlacement: function(error, element) {
				$('#username-error').empty().html(error);
			},
			errorClass : 'ui-corner-all ui-state-error p-5',
			highlight: function(element, errorClass) {
				$(element).addClass('ui-state-error');			
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass('ui-state-error');			
			}
		});
		
		
		//form change password
		$('#form-update-password').validate({
			submitHandler: function(form) {																
				$.ajax({
					url		: '/user/change_password',
					dataType: 'json',
					type	: 'post',
					data	: {
						old_password: $('#old-password').val(),					
						new_password: $('#new-password').val()					
					},	
					success : function(data){											
						switch(data.status){
							case 'SUCCESS'	: 
								show_servor_message(data.msg);
								$('#password-error').empty();
								$($(form).data('button-show-id')).trigger('click');
								break;
							default :
								$('#password-error').empty();
								$('<label>')
								.addClass('ui-corner-all ui-state-error p-5')
								.html(data.msg)
								.appendTo($('#password-error'));							
								break;												
						}		
					}
				});
			},
			rules: {
				'old-password'	:{
					required	: true,
					minlength	: 6,
					maxlength	: 12
				},
				'new-password'	:{
					required	: true,
					minlength	: 6,
					maxlength	: 12
				},
				'new-confirm-password'	:{
					required	: true,
					equalto		: '#new-password',
					minlength	: 6,
					maxlength	: 12
				}
				
			},
			messages: {
				'old-password'	:{
					required	: 'Ce champ est obligatoire',
					minlength	: jQuery.format('Ce champ doit contenir au minimum {0} caractères'),
					maxlength	: jQuery.format('Ce champ doit contenir au maximum {0} caractères')
				},
				'new-password'	:{
					required	: 'Ce champ est obligatoire',
					minlength	: jQuery.format('Ce champ doit contenir au minimum {0} caractères'),
					maxlength	: jQuery.format('Ce champ doit contenir au maximum {0} caractères')
				},
				'new-confirm-password'	:{
					required	: 'Ce champ est obligatoire',				
					equalto		: 'Doit etre egal',
					minlength	: jQuery.format('Ce champ doit contenir au minimum {0} caractères'),
					maxlength	: jQuery.format('Ce champ doit contenir au maximum {0} caractères')
				}			
			},		
			errorPlacement: function(error, element) {
				//$('#password-error').empty().html(error);
			},
			errorClass : 'ui-corner-all ui-state-error p-5',
			highlight: function(element, errorClass) {
				//$(element).addClass('ui-state-error');			
			},
			unhighlight: function(element, errorClass) {
				//$(element).removeClass('ui-state-error');			
			}
		});
		
		
		//form update company
		$('#form-update-company').validate({
			submitHandler: function(form) {																
				$.ajax({
					url		: '/user/update_company',
					dataType: 'json',
					type	: 'post',
					data	: {
						company: $('#input-company').val()					
					},	
					success : function(data){											
						switch(data.status){
							case 'SUCCESS'	: 
								show_servor_message(data.msg);
								$('#company-error').empty();
								$($(form).data('button-show-id'))
								.trigger('click')
								.prev()
								.text($('#input-company').val());
								break;
							default : 							
								$('#company-error').empty();
								$('<label>')
								.addClass('ui-corner-all ui-state-error p-5')
								.html(data.msg)
								.appendTo($('#company-error'));							
								break;
						}		
					}
				});
			},
			rules: {
				'input-company'	:{
					required	: true,
					minlength	: 1,
					maxlength	: 50
				}
			},
			messages: {
				'input-company'	:{
					required	: document.getElementById("requiered_txt").innerHTML,
					minlength	: jQuery.format(document.getElementById("mincharacters_txt").innerHTML+' {0} '+document.getElementById("characters_txt").innerHTML),
					maxlength	: jQuery.format(document.getElementById("maxcharacters_txt").innerHTML+' {0} '+document.getElementById("characters_txt").innerHTML)
				}
			},		
			errorPlacement: function(error, element) {
				$('#company-error').empty().html(error);
			},
			errorClass : 'ui-corner-all ui-state-error p-5',
			highlight: function(element, errorClass) {
				$(element).addClass('ui-state-error');			
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass('ui-state-error');			
			}
		});
		
		//form update url profil
		$('#form-update-url-profil').validate({
			submitHandler: function(form) {																
				$.ajax({
					url		: '/user/update_url_profil',
					dataType: 'json',
					type	: 'post',
					data	: {
						web_address: $('#input-url-profil').val()					
					},	
					success : function(data){											
						switch(data.status){
							case 'SUCCESS'	: 
								show_servor_message(data.msg);
								$('#url-profil-error').empty();
								$($(form).data('button-show-id'))
								.trigger('click')
								.prev()
								.text('http://www.b-onstage.com/' + $('#input-url-profil').val());
								break;
							default : 							
								$('#url-profil-error').empty();
								$('<label>')
								.addClass('ui-corner-all ui-state-error p-5')
								.html(data.msg)
								.appendTo($('#url-profil-error'));							
								break;
						}		
					}
				});
			},
			rules: {
				'input-url-profil'	:{
					required	: true				
				}
			},
			messages: {
				'input-url-profil'	:{
					required	: document.getElementById("requiered_txt").innerHTML				
				}
			},		
			errorPlacement: function(error, element) {
				$('#url-profil-error').empty().html(error);
			},
			errorClass : 'ui-corner-all ui-state-error p-5',
			highlight: function(element, errorClass) {
				$(element).addClass('ui-state-error');			
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass('ui-state-error');			
			}
			
			
		});
		
		
		/**********INIT RECOMMENDATIONS**********/
		$('.recommendations').alert();
		
		/********** SHOW PAGE *********/
		$('#container > .loading').toggle();
		$('#container > .content').fadeToggle(400);		
	});		
});