<html>
<body>
	<h1 style="font-size:18px;font-family:'Arial',sans-serif;color:#8e2c86;">Bonjour <?=$pseudo?>,</h1>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Félicitations! Votre demande de réservation suivante <strong>à été acceptée :</strong></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Code de réservation : </strong><?=$reservation_id?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Lieu : </strong><?=$stage_name?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Date : </strong><?=$event_date?></p>		
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Frais de réservation : </strong><?=$reservation?>€</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;">ATTENTION !! Vous avez 48 heures pour valider cette réservation et effectuer le paiement depuis votre espace b-onstage. Passé ce délais, votre réservation sera annulée!!</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?=anchor($url_account, 'Cliquez ici pour voir votre réservation dans votre espace b-onstage',array('style'=>'color:#8e2c86;'))?></p>	
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Maintenant..... c’est à vous de jouer!!</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;">L'équipe b-onstage.</p>
	<br />
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Merci de ne pas utiliser la fonction "Répondre" de votre messagerie.</p>	
	<br />
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Si vous rencontrez des problèmes avec notre site ou nos services, écrivez-nous à l’adresse à l'adresse support@b-onstage.com.</p>
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Afin de nous améliorer et d'essayer de rendre b-onstage le plus utile et agreable pour vous, nous vous encourageons à nous envoyez toutes vos suggestions à l'adresse suggestion@b-onstage.com.</p>
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Si vous ne souhaitez plus recevoir de mail de b-onstage, Cliquez-ici.</p>
</body>
</html>