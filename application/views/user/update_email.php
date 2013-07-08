<div class="container_12 fs-13" id="account">
	<div id="account-menu" class="grid_12 ui-corner-all bs-black mb-20">
		<ul>
			<li><?=anchor(site_url('user'), '<span aria-hidden="true" class="icon-cog mr-5"></span>MON COMPTE' , array('id' => 'a-m-home', 'class' => 'ui-corner-left'))?></li>
			<?php if($user_group == 'stage') { ?>			
				<li><?=anchor(site_url('user/calendar'), '<span aria-hidden="true" class="icon-calendar mr-5"></span>MON CALENDRIER' , array('id' => 'a-m-calendar'))?></li>
			<?php } else { ?>
				<li><?=anchor(site_url('user/reservations'), '<span aria-hidden="true" class="icon-calendar mr-5"></span>MES RESERVATIONS' , array('id' => 'a-m-reservation'))?></li>
			<?php } ?>	
			<li><?=anchor(site_url('user/contact'), '<span aria-hidden="true" class="icon-user mr-5"></span>MES CONTACTS' , array('id' => 'a-m-contact'))?></li>
			<li><?=anchor(site_url('user/notifications'), '<span aria-hidden="true" class="icon-comments mr-5"></span>MES NOTIFICATIONS' , array('id' => 'a-m-notification'))?></li>
		</ul>
	</div>
	
	<!--content user account-->
	<div class="account-content-bloc grid_12 bg-white ui-corner-all bs-black mb-20">
		<?=heading($title, 2 , 'class="title grey fs-18"')?>		
		<div class="p-20">
			<?=form_open('user/update_email')?>		
			<div class="mb-5"><?=form_label('Votre E-mail','old',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($old_email).form_error($old_email['name'])?></div>		
			<div class="mb-5"><?=form_label('Votre nouvel E-mail','new',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($new_email).form_error($new_email['name'])?></div>
			<div class="mb-5"><?=form_label('Confirmation du nouvel E-mail','new_confirm',$attrs_label)?></div>
			<div class="mb-10"><?=form_input($new_email_confirm).form_error($new_email_confirm['name'])?></div>
			<div class="mb-5"><?=form_input($user_id)?></div>
			<div class="mb-10"><?=form_input(array('type' =>'submit','value'=>'Modifier', 'class'=>'ui-blue'))?></div>
			<div class="red fs-12 bold"><?=$message?></div>
			<?=form_close()?>
		</div>	
	</div>
</div>