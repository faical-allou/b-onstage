<?php setlocale(LC_TIME, "fr_FR.UTF8");
	if(!$offset){
?>
<div class="container_12 fs-13" id="notifications">
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

	<div class="account-content-bloc grid_12 bg-white ui-corner-all bs-black mb-20">
		<?=heading($title, 2 , 'class="title grey fs-18"')?>
		<?php } if(count($notifications) > 0){ ?>
			<div id="notifications-container">
				<?php $this->load->view('user/notifications_sub', array('notifications'=>$notifications)) ?>
			</div>
			<?php if($hasmore){ ?>
				<div class="contact-line p-20 clearfix">
					<div class="ml-20 left">
						<span id="more-notifications" class="ui-purple ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
							<span class="ui-button-text">Voir plus de notifications</span></span>
					</div>
				</div>
		<?php }
			} elseif(!$offset) { ?>
			<h2 class="grey title fs-18">Aucune notification</h2>
		<?php }	if(!$offset){ ?>
	</div>
</div>
<?php } ?>