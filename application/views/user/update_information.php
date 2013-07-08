<div class="container_12 mb-20">	
	<!--content user account-->
	<div class="grid_12 bg-white ui-corner-all bs-black">		
		<h2 class="fs-24 title purple pt-10 pl-20"><?=$title?></h2>		
		<div class="p-20">	
			<?=form_open('user/update_information')?>		
			<div class="mb-5"><?=form_label('Prénom','first_name',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($first_name).form_error($first_name['name'])?></div>		
			<div class="mb-5"><?=form_label('Nom','last_name',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($last_name).form_error($last_name['name'])?></div>
			<div class="mb-5"><?=form_label('Adresse','address',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($address).form_error($address['name'])?></div>
			<div class="mb-5"><?=form_label('Ville','city',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($city).form_error($city['name'])?></div>		
			<div class="mb-5"><?=form_label('Code Postal','zip',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($zip).form_error($zip['name'])?></div>
			<div class="mb-5"><?=form_label('Pays','country',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($country).form_error($country['name'])?></div>
			<div class="mb-5"><?=form_label('Téléphone','phone',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($phone).form_error($phone['name'])?></div>			
			<div class="mb-5"><?=form_input($user_id)?></div>
			<div class="mb-10"><?=form_input(array('type' =>'submit','value'=>'Modifier', 'class'=>'ui-purple'))?></div>
			<div class="red fs-12 bold"><?=$message?></div>					
			<?=form_close()?>
		</div>	
	</div>
</div>