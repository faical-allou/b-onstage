<div class="container_12">	
	<div class="grid_9 bg-white bs-black ui-corner-all mb-20">
		<div class="p-10">
			<h2 class="fs-24 title purple pl-20"><?php echo lang("users_home_title1") ?></h2>
			<div class="p-20 mb-20">			
				<div id="modify_txt" style="display:none"><?php echo lang("modify") ?></div>
				<div id="hide_txt" style="display:none"><?php echo lang("hide") ?></div>
				<div id="requiered_txt" style="display:none"><?php echo lang("requieredfield") ?></div>
				<div id="mincharacters_txt" style="display:none"><?php echo lang("mincharacters") ?></div>
				<div id="maxcharacters_txt" style="display:none"><?php echo lang("maxcharacters") ?></div>
				<div id="characters_txt" style="display:none"><?php echo lang("characters") ?></div>
                <!--email-->
				<div class="account-line fs-12 grey">			
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold"><?php echo lang("users_home_email") ?></span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user['email']?></span>
							<a href="javascript:void(0)" class="purple bold"><?php echo lang("modify") ?></a>					
						</div>	
					</div>	
				</div>
				<!--username-->		
				<div class="account-line fs-12 grey">
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold pl-2"><?php echo lang("username") ?></span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user['username']?></span>
							<a id="show-form-update-username" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-username"><?php echo lang("modify") ?></a>
						</div>
					</div>	
					<div id="wrap-form-update-username" class="wrap-form p-20">
						<form id="form-update-username" data-button-show-id="#show-form-update-username">
							<div>
								<div class="mb-5"><?=form_label($label_username, $input_username['id'], $attrs_label)?></div>
								<div class="mb-10">
									<?=form_input($input_username)?>
									<span id="username-error"></span>
								</div>
								<div class="mb-10"><?=form_submit('submit-username', lang("validate"))?></div>																				
							</div>	
						</form>	
					</div>	
				</div>
				<!--password-->
				<div class="account-line fs-12 grey">		
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold pl-2"><?php echo lang("password") ?></span>
						</div>
						<div class="right">				
							<a id="show-form-update-password" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-password"><?php echo lang("modify") ?></a>
						</div>	
					</div>	
					<div id="wrap-form-update-password" class="wrap-form p-20">
						<form id="form-update-password" data-button-show-id="#show-form-update-password">
							<div>
								<div class="mb-5"><?=form_label($label_old_password, $old_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($old_password)?></div>
								<div class="mb-5"><?=form_label($label_new_password, $new_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($new_password)?></div>
								<div class="mb-5"><?=form_label($label_new_confirm_password, $new_confirm_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($new_confirm_password)?></div>
								<div class="mb-10"><?=form_submit('submit-password', lang("validate"))?></div>													
								<div id="password-error"></div>
							</div>	
						</form>	
					</div>	
				</div>
				<!--company-->
				<div class="account-line fs-12 grey">
					<div class="clearfix mb-10">							
						<?php if($user_group == 'artist'){ ?>
						<div class="left">
							<span class="bold"><?php echo lang("users_home_artist_name") ?></span>
						</div>
						<?php }else{ ?>
						<div class="left">
							<span class="bold"><?php echo lang("users_home_stage_name") ?></span>
						</div>	
						<?php }?>
						<div class="right">
							<span class="bold mr-20">
							<?php if($user_group == 'artist'){ ?>
								<?=(empty($user['company']) ? '<i class="red">'.lang("users_home_input_artist_name_error2").'</i>' : $user['company'])?>
							<?php }else{ ?>
								<?=(empty($user['company']) ? '<i class="red">'.lang("users_home_input_artist_name_error3").'</i>' : $user['company'])?>
							<?php }?>
							</span>
							<a id="show-form-update-company" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-company"><?php echo lang("modify") ?></a>
						</div>	
					</div>
					<div id="wrap-form-update-company" class="wrap-form p-20">
						<form id="form-update-company" data-button-show-id="#show-form-update-company">
							<div>
								<div class="mb-5"><?=form_label($label_company, $input_company['id'], $attrs_label)?></div>
								<div class="mb-10">
									<?=form_input($input_company)?>
									<span id="company-error"></span>
								</div>											
								<div class="mb-10"><?=form_submit('submit-company', lang("validate"))?></div>																				
							</div>	
						</form>	
					</div>									
				</div>
				<!--url page profil-->
				<div class="account-line fs-12 grey">			
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold"><?php echo lang("users_home_url") ?></span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user_link?></span>
							<a id="show-form-update-url-profil" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-url-profil"><?php echo lang("modify") ?></a>							
						</div>	
					</div>	
					<div id="wrap-form-update-url-profil" class="wrap-form p-20">
						<form id="form-update-url-profil" data-button-show-id="#show-form-update-url-profil">
							<div>
								<div class="mb-10"><label class="fs-12 grey bold"><?=$label_url_profil?></label></div>
								<div class="mb-10">
									<label><?=form_label($label_prefix_url_profil, $input_url_profil['id'], $attrs_label)?></label> 
									<?=form_input($input_url_profil)?>
									<span id="url-profil-error"></span>	
								</div>											
								<div class="mb-10"><?=form_submit('submit-url-profil', lang("validate"))?></div>													
							</div>	
						</form>	
					</div>
				</div>
			</div>
			
			
			<h2 class="purple fs-24 title pl-20 pr-20"><?php echo lang("users_home_title2") ?></h2>			
			<div class="mb-20 p-20">										
				<!--firstname-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("first_name") ?></span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['first_name']) ? '<i class="red">'.lang("users_home_no_fname").'</i>' : $user['first_name'])?></span>						
					</div>	
				</div>
				<!--lastname-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold "><?php echo lang("last_name") ?></span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['last_name']) ? '<i class="red">'.lang("users_home_no_lname").'</i>' : $user['last_name'])?></span>						
					</div>	
				</div>
				<!--address-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("address") ?></span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['address']) ? '<i class="red">'.lang("users_home_no_addr").'</i>' : $user['address'])?></span>						
					</div>	
				</div>
				<!--zip-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("postalcode") ?></span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['zip']) ? '<i class="red">'.lang("users_home_no_pcode").'</i>' : $user['zip'])?></span>						
					</div>	
				</div>
				<!--city-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("city") ?> *</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['city']) ? '<i class="red">'.lang("users_home_no_city").'</i>' : $user['city'])?></span>						
					</div>	
				</div>
				<!--country-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("country") ?> *</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['country']) ? '<i class="red">'.lang("users_home_no_country").'</i>' : $user['country'])?></span>						
					</div>	
				</div>
				<!--téléphone-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold"><?php echo lang("phone") ?></span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['phone']) ? '<i class="red">'.lang("users_home_no_tel").'</i>' : $user['phone'])?></span>						
					</div>						
				</div>
				
				<div class="clearfix">	
					<div class="left">
						<i class="grey fs-15">(*) <?php echo lang("users_home_txt_bottom") ?></i>						
					</div>
					<div class="right">
						<a href="<?=site_url('user/update_information')?>" class="ui-purple" id="update-information"><?php echo lang("users_home_modify") ?></a>
					</div>	
				</div>					
			</div>
		</div>
	</div>	
	
	<div id="sidebar" class="grid_3 bg-white bs-black ui-corner-all mb-20">
		<div class="p-20">
			<div class="mb-20">		
				<?=img(array('src' => site_url($user['avatar']), 'class' => 'ui-corner-all', 'width' => '100%'))?>
			</div>
			<div class="mb-20">
				<?=anchor($user_link,lang("users_home_show_profile"), array('id' => 'show-profil', 'class'=>'ui-purple', 'style' => 'width:100%;font-size:1em;'))?>
			</div>
			<div class="recommendations">
				<?php echo lang("users_home_profile_txt") ?>
			</div>
		</div>
	</div>
</div>