<div class="container_12 mb-50">
	<div class="grid_12">
		<img src="<?php 
			//Determine row name depending on lang loaded
			if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
			else {
				$rowname = '-'.$this->session->userdata('lang_loaded');
			}
			echo site_url('img/signup-choice'.$rowname.'.png');
			?>" width="100%" />
	</div>	
	
	<!--inscription artiste-->
	<div class="grid_6">		
		<div class="ta-c">
			<a href="<?=site_url('signup')?>" id="button-signup-artist" class="ui-purple" style="font-size:1.2em;width:80%;"><?php echo lang("signup_choice_link1") ?></a>	
		</div>				
	</div>

	
	<!--inscription scène-->
	<div class="grid_6">		
		<div class="ta-c">
			<a href="<?=site_url('signup_stage')?>" id="button-signup-stage" class="ui-dark" style="font-size:1.2em;width:80%;"><?php echo lang("signup_choice_link2") ?></a>	
		</div>				
	</div>
	
</div>