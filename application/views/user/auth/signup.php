<div class="container_12 mb-50">		
	<!--description-->
	<div class="grid_8">
		<div class="clearfix mt-50">
			<div class="db left m-10">
				</br>
				<?=img(site_url('img/auth/icon-calendar.png'))?>
			</div>
			<?php echo lang("signup_txt2") ?>
		</div>				

		<div class="sep"></div>
		
		<div class="clearfix mt-50">			
			<div class="db left m-10">
				</br>
				<?=img(site_url('img/auth/icon-network.png'))?>
			</div>	
			<?php echo lang("signup_txt1") ?>			
		</div>

	</div>
	<!--form-->
	<div class="grid_4 grey-box bs-black ui-corner-all">						
		<div class="p-20">			
			<div class="fs-18 title purple mb-20"><?php echo lang("signup_form_header") ?></div>
			<?=form_open(site_url('signup'),array('id'=>'signup-form'))?>				
			<!--company-->
			<div class="mb-10">			
				<div class="mb-5"><?=form_label(lang("signup_form_artist_name"), 'company',$attrs_label)?></div>
				<div><?=form_input($company).form_error($company['name'])?></div>					
			</div>	
			<!--username-->		
			<div class="mb-10">			
				<div class="mb-5"><?=form_label($this->lang->line('username'), 'username',$attrs_label)?></div>
				<div><?=form_input($username).form_error($username['name'])?></div>					
			</div>	
			<!--email-->			
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('identity'), 'email',$attrs_label)?></div>
				<div><?=form_input($email).form_error($email['name'])?></div>			
			</div>	
			<!--password-->
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('password'), 'password',$attrs_label)?></div>
				<div><?=form_password($password).form_error($password['name'])?></div>
			</div>	
			<!--password-condirm-->
			<div class="mb-30">
				<div class="mb-5"><?=form_label($this->lang->line('password_confirm'), 'password_confirm',$attrs_label)?></div>
				<div><?=form_password($password_confirm).form_error($password_confirm['name'])?></div>
			</div>	
			<!--terms of services-->
			<div class="mb-10">
				<div>
					<label>
						<?=form_checkbox($terms_of_services)?>
						<span class="fs-12 grey bold ml-20 mb-10 db" style="line-height:19px;"><?=$text_terms_of_services?></span>
					</label>
					<?=form_error($terms_of_services['name'])?>
				</div>
			</div>
			<!--submit-->
			<div class="ta-c"><?=form_submit($submit)?></div>
			<?=form_close()?>
		</div>	
	</div>	
</div>