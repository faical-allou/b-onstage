<div class="container_12">
	<!--description-->
	<div class="grid_6 push_1 mt-50 mb-20">	
		<ul class="signup-list fs-16">
			<?php echo lang("signup_stage_step_1_txt") ?>						
		</ul>
	</div>
	<!--form-->
	<div class="grid_4 push_2 grey-box bs-black ui-corner-all mb-20">
		<div class="p-20">			
			<div class="fs-18 title purple mb-20"><?php echo lang("signup_stage_step_1_form_title") ?></div>
			<?=form_open(site_url('signup_stage'),array('id'=>'signup-form'))?>
			<!--company-->
			<div class="mb-10">			
				<div class="mb-5"><?=form_label(lang("signup_stage_step_1_form_field1"), 'company',$attrs_label)?></div>
				<div><?=form_input($company).form_error($company['name'])?></div>					
			</div>	
			<!--email-->			
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('identity'), 'email',$attrs_label)?></div>
				<div><?=form_input($email).form_error($email['name'])?></div>			
			</div>	
			<!--tel-->			
			<div class="mb-20">
				<div class="mb-5"><?=form_label(lang("signup_stage_step_1_form_field3"), 'tel',$attrs_label)?></div>
				<div><?=form_input($tel).form_error($tel['name'])?></div>			
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
			<div class="ta-r"><?=form_submit($submit)?></div>
			<?=form_close()?>
		</div>	
	</div>
</div>