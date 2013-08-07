<div class="line-stage-list bg-white">
	<div class="inner clearfix p-20">				
		<div class="left">
			<?=$avatar_link?>
		</div>
		<div class="left">
			<div>
				<?=anchor($stage_link,$stage_company, array('class' => 'title fs-28 grey'))?>											
			</div>						
			<div class="mb-5">
				<p class="fs-12 grey bold">
					<span class="icon-location mr-5" aria-hidden="true"></span>
					<?=$stage_location?>
				</p>
			</div>	
			<div>
				<ul class="action-menu clearfix ui-corner-bottom">
					<li><a class="button-show-profil ui-corner-bl" href="<?=$stage_link?>"><?php echo lang("users_contact_seeprofile") ?></a></li> 
					<?php if($stage_state) {?>
						<li><a class="button-send-msg" href="javascript:void(0);" data-email-to="<?=$stage_email?>"><?php echo lang("users_contact_sendmsg") ?></a></li>
						<li><a class="button-add-contact" href="javascript:void(0);" data-contact-id="<?=$stage_id?>"><?php echo lang("users_contact_add") ?></a></li>	
					<?php } ?>
				</ul>
			</div>
		</div>	
	</div>
</div>	