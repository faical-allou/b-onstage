<div class="container_12">	
	<!--reservations-->	
	<div id="reservations" class="grid_9 bg-white bs-black ui-corner-all mb-20">
		<div>
			<ul id="reservation-menu" class="clearfix ui-corner-top">
				<li class="title fs-16 active ui-corner-tl" data-content-id="#accepted-reservations">
					<?php echo lang("users_rese_status1") ?> (<?=$nb_accepted?>)
				</li>
				<li class="title fs-16" data-content-id="#close-reservations">
					<?php echo lang("users_rese_status2") ?> (<?=$nb_close?>)
				</li>
				<li class="title fs-16" data-content-id="#pending-reservations">
					<?php echo lang("users_rese_status3") ?> (<?=$nb_pending?>)
				</li>
			</ul>			
		</div>	
		
		<!--accepted reservations-->
		<div class="reservation-content active" id="accepted-reservations">
			<div class="recommendations m-10">
				<div class="title purple fs-16"><?php echo lang("youhave") ?> <?=$nb_accepted?> <?php echo lang("users_rese_needpay") ?></div>		
				<?php echo lang("users_rese_needpaytxt") ?>	
			</div>
			<?=$accepted_reservations?>
		</div>
		
		<!--close reservations-->
		<div class="reservation-content" id="close-reservations">
			<div class="recommendations m-10">
				<?php echo lang("users_rese_closedtxt") ?>	
			</div>
			<?=$close_reservations?>	
		</div>	

		<!--close reservations-->	
		<div class="reservation-content" id="pending-reservations">
			<div class="recommendations m-10">
				<?php echo lang("users_rese_tovalidatetxt") ?>	
			</div>
			<?=$pending_reservations?>				
		</div>	
	</div>
	
	
	<div class="grid_3 bg-white bs-black ui-corner-all mb-20" id="sidebar">
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