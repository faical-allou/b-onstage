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
								<?=anchor($contact['contact_link'],'Voir profil', array('class' => 'contact-link'))?>
								<button class="send-msg" data-email-to="<?=$contact['contact_email']?>">Envoyer message</button>
								<button class="delete-contact" data-contact-id="<?=$contact['contact_id']?>">Supprimer</button>
							</div>	
						</div>
					</div>
		<?php } } else {?>
			<div class="p-20">
				<p class="grey fs-15"><i>Aucun contact enregistré.</i></p>
			</div>	
		<?php } ?>		
	</div>
	
	<div id="sidebar" class="grid_3 bg-white bs-black ui-corner-all mb-20">
		<div class="p-20">
			<div class="mb-20">		
				<?=img(array('src' => site_url($user['avatar']), 'class' => 'ui-corner-all', 'width' => '100%'))?>
			</div>
			<div class="mb-20">
				<?=anchor($user_link,'Afficher mon profil', array('id' => 'show-profil', 'class'=>'ui-purple', 'style' => 'width:100%;font-size:1em;'))?>
			</div>
			<div class="recommendations">
				<p class="grey fs-12 bold">Remplissez votre profil!</p>
				<p class="grey fs-12 bold">Les profils les plus consultés sont ceux qui ont le plus de contenu...</p>
				<p class="grey fs-12 bold">...Alors, mettez des images de vous sur votre profil.</p>
				<p class="grey fs-12 bold">Pour faire leur choix, les Scènes vont vouloir vous écouter...</p>
				<p class="grey fs-12 bold">...Alors mettez votre musique.</p>
				<p class="grey fs-12 bold">Importez aussi vos photos, vos vidéos...</p>
			</div>
		</div>
	</div>
	
</div>