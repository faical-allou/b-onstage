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
			<div class="fs-14 mb-5 mt-5">
				<span class= "fa-stack fa">
				<i class="fa fa-users fa-stack-1x"></i>
				</span>
				<span class="fs-14 bold" style= "margin-left: -8px"><?=$room_size?></span>
					
				<span class= "fa-stack fa">
				<i class="fa fa-square-o fa-stack-1x"></i>
				</span>
				<span class="fs-14 bold" style= "margin-left: -8px"><?=$stage_size?></span>
				
				<span class= "fa-stack fa">
				<i class="fa fa-microphone fa-stack-1x"></i>
				<?php if ($stage_microphone=="") :?>
 				<i class="fa fa-ban fa-stack-2x red"></i>
				<?php endif; ?>
				</span>

				<span class= "fa-stack fa">
				<i class="fa fa-volume-off fa-stack-1x"></i>
				<?php if ($stage_speakers=="") : ?>
 				<i class="fa fa-ban fa-stack-2x red"></i>
				<?php endif; ?>
				</span>

				<span class= "fa-stack fa">
				<i class="fa fa-sliders fa-stack-1x"></i>
				<?php if ($stage_amplification=="") : ?>
 				<i class="fa fa-ban fa-stack-2x red"></i>
				<?php endif; ?>
				</span>
				
				<span class= "fa-stack fa">
				<i class="fa fa-lightbulb-o fa-stack-1x"></i>
				<?php if ($stage_lights=="") : ?>
 				<i class="fa fa-ban fa-stack-2x red"></i>
				<?php endif; ?>
				</span>
				
				
		</div>	
		
		</div>	
	</div>
</div>	