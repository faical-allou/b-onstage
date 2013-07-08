<div class="container_12">	
	<!--reservations-->	
	<div id="reservations" class="grid_9 bg-white bs-black ui-corner-all mb-20">
		<div>
			<ul id="reservation-menu" class="clearfix ui-corner-top">
				<li class="title fs-16 active ui-corner-tl" data-content-id="#accepted-reservations">
					En attente de paiement (<?=$nb_accepted?>)
				</li>
				<li class="title fs-16" data-content-id="#close-reservations">
					Fermée (<?=$nb_close?>)
				</li>
				<li class="title fs-16" data-content-id="#pending-reservations">
					En attente de validation (<?=$nb_pending?>)
				</li>
			</ul>			
		</div>	
		
		<!--accepted reservations-->
		<div class="reservation-content active" id="accepted-reservations">
			<div class="recommendations m-10">
				<div class="title purple fs-16">Vous avez <?=$nb_accepted?> réservations en attente de paiement des frais de réservations.</div>		
				<p class="grey fs-12 bold">Il vous est fortement conseillé de les traiter avant que le délai soit dépassé.</p>
				<p class="grey fs-12 bold">Si la mention <span class="purple">"Délai dépassé"</span> apparaît sur l'une de vos réservations cela signifie que le délai de 48h pour payer les frais de réservations est écoulé. De ce fait la réservation est annulée et est remise dans la rubrique <a href="<?=site_url('concerts')?>" class="purple bold">"Réservez date".</a></p>	
			</div>
			<?=$accepted_reservations?>
		</div>
		
		<!--close reservations-->
		<div class="reservation-content" id="close-reservations">
			<div class="recommendations m-10">
				<p class="purple">Recommendations reservation fermée</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<?=$close_reservations?>	
		</div>	

		<!--close reservations-->	
		<div class="reservation-content" id="pending-reservations">
			<div class="recommendations m-10">
				<p class="purple">Recommendations en attente de validation</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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