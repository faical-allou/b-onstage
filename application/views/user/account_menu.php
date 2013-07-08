<div class="container_12 mb-20">	
	<div id="account-menu" class="grid_12 ui-corner-all bs-black">
		<ul>
			<li><?=anchor(site_url('user'), '<span aria-hidden="true" class="icon-cog mr-5"></span>Mon compte' , array('id' => 'a-m-home', 'class' => 'ui-corner-left'))?></li>
			<?php if($user_group == 'stage') { ?>			
				<li><?=anchor(site_url('user/calendar'), '<span aria-hidden="true" class="icon-calendar mr-5"></span>Mon calendrier' , array('id' => 'a-m-calendar'))?></li>
			<?php } else { ?>
				<li><?=anchor(site_url('user/reservations'), '<span aria-hidden="true" class="icon-calendar mr-5"></span>Mes réservations' , array('id' => 'a-m-reservation'))?></li>
			<?php } ?>	
			<li><?=anchor(site_url('user/contact'), '<span aria-hidden="true" class="icon-user mr-5"></span>Mes contacts' , array('id' => 'a-m-contact'))?></li>
			<li><?=anchor(site_url('user/notifications'), '<span aria-hidden="true" class="icon-comments mr-5"></span>Mes notifications' , array('id' => 'a-m-notification'))?></li>
		</ul>
	</div>
</div>	