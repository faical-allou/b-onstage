<div class="container_12">	
	<div class="grid_9 bg-white bs-black ui-corner-all mb-20">		
		<?php if(count($contacts) > 0){
				foreach($contacts as $contact){ ?>
					<div id="contact-<?=$contact['contact_id']?>" class="contact-line p-20 clearfix">
						<div class="left">
							<?=$contact['contact_avatar']?>
						</div>
						<div class="ml-20 left">							
							<div>
								<a href="<?=$contact['contact_link']?>" class="grey title fs-28"><?=$contact['contact_name']?></a>
							</div>
							<div class="mb-5">
								<p class="fs-12 grey bold">
									<span aria-hidden="true" class="icon-location mr-5"></span>
									<?=$contact['contact_location']?>
								</p>
							</div>								
							<div>
								<?=anchor($contact['contact_link'],lang("users_contact_seeprofile"), array('class' => 'contact-link'))?>
								<button class="send-msg" data-email-to="<?=$contact['contact_email']?>"><?php echo lang("users_contact_sendmsg") ?></button>
								<button class="delete-contact" data-contact-id="<?=$contact['contact_id']?>"><?php echo lang("delete") ?></button>
							</div>	
						</div>
					</div>
		<?php } } else {?>
			<div class="p-20">
				<p class="grey fs-15"><i><?php echo lang("users_contact_notfound") ?></i></p>
			</div>	
		<?php } ?>		
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