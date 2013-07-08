<div class="container_12">
	<!--description-->
	<div class="grid_6 push_1 mt-50 mb-20">	
		<ul class="signup-list fs-16">
			<li><span class="grey title">Vous voulez que votre établissement devienne une Scène sur le réseau b-onstage? Remplissez le formulaire ci-contre.</span></li>		
			<li><span class="grey title">Vous serez ensuite contacté par notre équipe, afin notamment de vous aider à créer un profil qui ressemble à votre scène.</span></li>		
			<li><span class="grey title">Nous mettons à votre disposition un espace pour créer vos évènements, trouver les Artistes qui se produiront sur votre Scène et gérer le tout depuis votre profil.</span></li>						
		</ul>
	</div>
	<!--form-->
	<div class="grid_4 push_2 grey-box bs-black ui-corner-all mb-20">
		<div class="p-20">			
			<div class="fs-18 title purple mb-20">Je m'inscris en tant que scène</div>
			<?=form_open(site_url('signup_stage'),array('id'=>'signup-form'))?>
			<!--company-->
			<div class="mb-10">			
				<div class="mb-5"><?=form_label('Nom d\'établissement', 'company',$attrs_label)?></div>
				<div><?=form_input($company).form_error($company['name'])?></div>					
			</div>	
			<!--email-->			
			<div class="mb-10">
				<div class="mb-5"><?=form_label($this->lang->line('identity'), 'email',$attrs_label)?></div>
				<div><?=form_input($email).form_error($email['name'])?></div>			
			</div>	
			<!--tel-->			
			<div class="mb-20">
				<div class="mb-5"><?=form_label('Téléphone (facultatif)', 'tel',$attrs_label)?></div>
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