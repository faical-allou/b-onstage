

<div class="container_12">		
	<!--description-->
	<div class="grid_8">
		<div class="clearfix mt-10">
			<div class="db left m-10">
                            </br>
                            <?=img(site_url('img/auth/icon-calendar.png'))?>
			</div>
			<?php echo lang("signup_txt2") ?>
		</div>				

		<div class="sep"></div>
		
		<div class="clearfix mt-10">			
			<div class="db left m-10">
				</br>
				<?=img(site_url('img/auth/icon-network.png'))?>
			</div>	
			<?php echo lang("signup_txt1") ?>			
		</div>

	</div>
	<!--form-->
	<div class="grid_4 grey-box bs-black ui-corner-all mb-10">						
		<div class="p-20">			
			<div class="fs-18 title purple mb-20"><?php echo lang("signup_form_header") ?></div>
			<?=form_open(site_url('signup'),array('id'=>'signup-form'))?>				
			<!--company
			<div class="mb-10">			
				<div class="mb-5"><?=form_label(lang("signup_form_artist_name"), 'company',$attrs_label)?></div>
				<div><?=form_input($company).form_error($company['name']);?></div>											
			</div>	
-->			<!--username		
			<div class="mb-10">			
				<div class="mb-5"><?=form_label($this->lang->line('username'), 'username',$attrs_label)?></div>
				<div><?=form_input($username).form_error($username['name'])?></div>					
			</div>	
-->			<!--email-->			
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('identity'), 'email',$attrs_label)?></div>
				<div><?=form_input($email).form_error($email['name'])?></div>			
			</div>	
			<!--password-->
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('password'), 'password',$attrs_label)?></div>
				<div><?=form_password($password).form_error($password['name'])?></div>
			</div>	
			<!--password-condirm
			<div class="mb-30">
				<div class="mb-5"><?=form_label($this->lang->line('password_confirm'), 'password_confirm',$attrs_label)?></div>
				<div><?=form_password($password_confirm).form_error($password_confirm['name'])?></div>
			</div>	
-->			<!--terms of services
			<div class="mb-10">
				<div>
					<label>
						<?=form_checkbox($terms_of_services)?>
						<span class="fs-12 grey bold ml-20 mb-10 db" style="line-height:19px;"><?=$text_terms_of_services?></span>
					</label>
					<?=form_error($terms_of_services['name'])?>
				</div>
-->			</div>
            		<span class="fs-12 grey bold ml-20 mb-10 db pr-5" style="line-height:19px;"><?=$text_terms_of_services?></span>

			<!--submit-->
			<div class="ta-r mb-10 mr-10">
			<?=form_submit($submit)?>
			</div>
			<?=form_close()?>
			
<!--				<div class="ta-r">
						<fb:login-button size="large" auto_logout_link="true" scope="public_profile,email";>
							login facebook
						<?=form_submit($submit)?>	
						</fb:login-button>
					</div>
-->				
			</div>
		</div>
	</div>		
</div>	
			
		
<body>

<script>
/*  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

//   This function is called when someone finishes with the Login
//   Button.  See the onlogin handler attached to it in the sample
//   code below.
//   function checkLoginState() {
//    FB.getLoginStatus(function(response) {
//      statusChangeCallback(response);
//    });
//  }

		
//    FB.getLoginStatus(function(response) {
//      statusChangeCallback(response);
//    });
//  }



  window.fbAsyncInit = function() {
  FB.init({
    appId      : '405185392913953',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
//  function testAPI() {
//    console.log('Welcome!  Fetching your information.... ');
//    FB.api('/me', function(response) {
//      console.log('Successful login for: ' + response.name);
//      document.getElementById('status').innerHTML =
//      'Thanks for logging in, ' + response.name + '!';
//    });
	  function testAPI() {
      FB.api('/me', function(response) {
        var param = document.URL.split('#')[1]
       console.log(param);
       if (param != "stop") 
       {
       window.location.href = "<?=site_url('signup')?>" + "?n=" + response.name + "&u=" + response.first_name + "&e=" + response.email + "&p=" + response.id + "&fb=TRUE" + "&#stop";
       }
        else
       {
       window.location.href = "<?=site_url('activate')?>" + "?n=" + response.name + "&u=" + response.first_name + "&e=" + response.email + "&p=" + response.id + "&fb=TRUE" + "&#stop";													
       }
      });
  
  
  
  
  
  }
  */
</script>


</div>

</body>
</html>

</div>		
	
