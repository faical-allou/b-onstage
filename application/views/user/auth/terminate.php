<div class="container_12">
	<div class="grid_6 push_3 grey fs-15 mt-20 mb-20">	
		<p class="fs-16 bold"><?php echo lang("hello") ?> <?=$user['username']?>,</p>
		<?php echo lang("signup_terminate_success") ?>
		<p><a href="<?=site_url('page/'.$user['username'])?>" class="purple"><?php echo lang("signup_terminate_success1") ?></p>
		<?php echo lang("signup_terminate_success2") ?>
	</div>
</div>	