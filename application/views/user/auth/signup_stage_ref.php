<div class="container_12">
	
	
	<!--description-->
	
	<div class="grid_6 push_1 mb-20">	
		<ul class="signup-list-ref fs-16 mb-50">
			<?php echo lang("signup_stage_step_1_txt_ref") ?>						
		</ul>
	<div class="ta-c bold purple">	
	<a href="/forstages"><?php echo lang("signup_stage_step_1_link_ref") ?></a>
	</div>
	</div>
	
	
	<!--form-->
	<div class="grid_4 push_2 grey-box bs-black ui-corner-all mb-20">
		<div class="p-20">			
			<div class="fs-18 title purple mb-20"><?php echo lang("signup_stage_step_1_form_title_ref") ?></div>
			<?=form_open(site_url('signup_stage_ref'),array('id'=>'signup-form'))?>
			
			<!--ambassador-->
			
			<div class="mb-10">			
				<div class="mb-5"><?=form_label(lang("signup_stage_step_1_form_field0_ref"), 'ambassador',$attrs_label)?></div>
				<div><?=form_input($ambassador).form_error($ambassador['name'])?></div>					
			</div>	
			
			<div class="border-grey-1 p-5 ta-c mb-10">	
				<!--company-->
				<div class="mb-10">			
					<div class="mb-5"><?=form_label(lang("signup_stage_step_1_form_field1_ref"), 'company',$attrs_label)?></div>
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
			</div>
			
			<!--submit-->
			<div class="ta-r"><?=form_submit($submit)?></div>
			<?=form_close()?>
		</div>	
	</div>
</div>