<div class="container_12 mt-50 mb-50">	
	<div class="grid_4 push_4 grey-box bs-black ui-corner-all">
		<div class="p-20 clearfix">			
			<div class="fs-18 title purple mb-20"><?php echo lang("login_header") ?></div>
			<?=form_open($url_action,array('id'=>'signin-form'))?>
			<!--email-->			
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('identity'), 'identity',$attrs_label)?></div>
				<div><?=form_input($identity).form_error($identity['name'])?></div>
			</div>	
			<!--password-->
			<div class="mb-20">
				<div class="mb-5"><?=form_label($this->lang->line('password'), 'password',$attrs_label)?></div>
				<div><?=form_password($password).form_error($password['name'])?></div>
			</div>
			<!--submit signin-->
			<div class="mb-10">
				<div class="dib mr-10">
					<?=form_submit($submit)?>
				</div>
				<div class="dib">	
					<?=form_checkbox('remember', '1', FALSE, 'id="remember" style="margin-top:-3px;vertical-align:middle;"')?>
					<label class="fs-12 grey bold"><?=$this->lang->line('remember_me')?></label>
				</div>	
			</div>	
			<!--forgot password-->
			<div class="mb-10">
				<?=anchor(site_url('user/forgot_password'),$this->lang->line('forgot_password'),array('class' => 'fs-12 purple bold'))?>
			</div>	
			<!--error message-->
			<?php if($message) {?>
				<div class="fs-12 pl-10 pr-10 bold ui-state-error"><?=$message?></div>
			<?php } ?>	
			<?=form_close()?>
		</div>	
	</div>
</div>