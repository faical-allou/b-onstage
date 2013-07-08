<div class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mt-20 mb-20">		
		<div class="p-r">
			<?=img(array('src' => site_url('img/how-work.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'))?>
			<ul id="about-menu">
				<li><?=anchor(site_url('about'), 'A propos', array('id' => 'about-menu-1'))?></li>
				<li><?=anchor(site_url('about_us'), 'Qui sommes-nous ?', array('id' => 'about-menu-2'))?></li>
				<li><?=anchor(site_url('how_does_this_work'), 'Comment ça marche ?', array('id' => 'about-menu-3'))?></li>
			</ul>		
		</div>
		<div class="about">	
			<ul class="about-list">
				<li><p>Nous mettons gratuitement à votre disposition une plateforme de réservation en ligne permettant de vérifier la disponibilité d’une Scène et de la réserver pour vous y produire, faire votre Concert.</p></li>			
				<li><p>Sur b-onstage vous utilisez notre outil de recherche pour trouvez les Scènes disponibles en fonction des dates et/ou des villes qui vous conviennent.</p></li>
				<li><p>Envoyer une demande de réservation pour faire un Concert sur la Scène sélectionnée.</p></li>
				<li><p>Nous vous notifierons une fois la réservation validée par la Scène.</p></li>	
				<li class="nb"><p><strong>NB :</strong> Les Scènes sont susceptibles de recevoir un grand nombre de demandes de réservation. Complétez au mieux votre profil et soyez patients, cela peut prendre du temps avant que vous ne soyez sélectionnés par la Scène.</p></li>
				<li><p>Pour valider complètement votre réservation, vous devrez procéder en ligne au paiement des frais de réservation.</p></li>
				<li class="nb">
					<p><strong>NB :</strong> Les frais de réservation permet surtout de garantir que les deux parties tiennent leurs engagements et que le Concert se déroulent dans les meilleurs conditions.</p>
					<p>Cela évite également que des Artistes peu sérieux dégradent les relations avec les Scènes, et qu’il y ait de moins en moins de lieu et de date à votre disposition.</p>					
				</li>
				<li><p>A réception du paiement des frais de réservations, tels qu’indiqués sur la page de la Scène, la réservation est définitive et vous serez notifié.</p></li>
				<li><p>Une fois réservé les détails de votre Concert s'afficheront et seront visible par le public.</p></li>
				<li><p>Afin de vous protéger, et de vous garantir les meilleures conditions, nous avons conçu des contrats Artistes/Scènes (accord de prestation) que nous pouvons mettre à disposition sur simple demande.</p></li>
				<li><p>Nous vous invitons à signer un contrat Artiste(s)/Scène, qui est un contrat de prestation avec la Scène qui pourra vous être envoyé. Ce contrat établit le lien juridique entre la Scène et l’Artiste, la société Mybandonstage n’intervenant, s’agissant de l’exécution des prestations artistiques et de location de salle, que comme intermédiaire de mise en relation via le site b-onstage.</p></li>
				<li><p>Il vous suffit de vous présenter quelques heures avant le Concert pour vous préparer et la suite dépend de vous...</p></li>	
				<li><p>Si vous voulez annuler, vous pouvez le faire sans conséquence tant que le paiement des frais de réservation n’a pas été réalisé.</p></li>
				<li class="nb"><p>NB : Au cas où vous ne vous présentez pas le jour du Concert sans avoir annulé sur le site au moins 72 heures à l’avance, nous nous réservons le droit d’afficher le statut "No-Show" sur votre profil public.</p></li>
				<li>
					<p>Une fois payé, vous pouvez annuler jusqu’à :</p>
					<ul class="sub-about-list">
						<li>Deux semaines avant la date du Concert, nous vous reverserons les frais de réservation moins nos frais de gestion.</li>						
						<li>Passée cette limite de deux semaines avant la date du Concert, vous ne pouvez plus récupérer les frais de réservation, mais nous vous demandons de procéder à l’annulation tout de même pour éviter le statut "No-Show".</li>
					</ul>
				</li>
			</ul>
		</div>	
	</div>
</div>

<script>
	var about_menu_id = 'about-menu-3';
</script>