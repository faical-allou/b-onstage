<div class="line-artist-list bg-white">
	<div class="inner clearfix p-20">			
		<div class="left">
			<?=$avatar_link?>
		</div>
		<div class="left">
			<div>
				<?=anchor($artist_link,$artist_company, array('class' => 'title fs-28 grey'))?>			
			</div>
			<div class="mb-5">
				<p class="fs-12 grey bold">
					<span class="icon-location mr-5" aria-hidden="true"></span>
					<?=$artist_location?>
				</p>					
			</div>	
			<div>
				<ul class="action-menu clearfix ui-corner-bottom">
					<li><a class="button-show-profil ui-corner-bl" href="<?=$artist_link?>">Voir profil</a></li> 
					<?php if($artist_state) {?>
						<li><a class="button-send-msg" href="javascript:void(0);" data-email-to="<?=$artist_email?>">Envoyer message</a></li>
						<li><a class="button-add-contact" href="javascript:void(0);" data-contact-id="<?=$artist_id?>">Ajouter à mes contacts</a></li>	
					<?php } ?>
				</ul>		
			</div>	
		</div>			
	</div>
</div>	