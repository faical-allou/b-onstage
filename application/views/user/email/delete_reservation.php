<html>
<body>
	<h1 style="font-size:18px;font-family:'Arial',sans-serif;color:#8e2c86;">Bonjour <?=$pseudo?>,</h1>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Désolé! Votre demande de réservation suivante <strong>n’a pas été retenue:</strong></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Code de réservation : </strong><?=$reservation_id?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Lieu : </strong><?=$stage_name?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong>Date : </strong><?=$event_date?></p>		
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?=anchor($url_new_reservation, 'Cliquez ici pour faire une nouvelle réservation',array('style'=>'color:#8e2c86;'))?></p>	
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">En attendant votre prochaine réservation, pensez à améliorer votre profil. Vous pouvez y ajouter votre musique , vos vidéos, vos photos, etc.</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Pensez à bien vous présenter et n’oubliez pas que c’est votre vitrine!</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;">Pour vous rendre sur votre profil, <?=anchor($url_profil,'cliquez ici',array('style'=>'color:#8e2c86;'))?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;">À bientôt.</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;">L'équipe b-onstage.</p>
	<br />
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;">Merci de ne pas utiliser la fonction "Répondre" de votre messagerie.</p>	
	<br />
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Si vous rencontrez des problèmes avec notre site ou nos services, écrivez-nous à l’adresse à l'adresse support@b-onstage.com.</p>
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Afin de nous améliorer et d'essayer de rendre b-onstage le plus utile et agreable pour vous, nous vous encourageons à nous envoyez toutes vos suggestions à l'adresse suggestion@b-onstage.com.</p>
	<p style="font-size:11px;font-weight:bold;font-family:'Arial',sans-serif;color:#3a3a3a;">Si vous ne souhaitez plus recevoir de mail de b-onstage, Cliquez-ici.</p>
</body>
</html>