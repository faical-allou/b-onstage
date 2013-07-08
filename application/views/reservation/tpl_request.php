<?=heading('Demande de Réservation', 1 ,'class="purple fs-24 title m-0"')?>
<div class="p-5 grey">
	<p class="bold">Vous êtes sur le point d’envoyer une demande de réservation pour vous produire en concert.</p>
	<p class="bold">Voici les détails de la date que souhaitez réserver :</p>
</div>	
<div class="grey bg-grey-1 border-grey-1 ui-corner-all p-10 mb-10">
	<p><strong>Nom de la scène : </strong><?=$company?></p>
	<p><strong>Date du concert : </strong><?=$date?></p>
	<p><strong>Genre musical : </strong><?=$genres?></p>
	<p><strong>Frais de réservation : </strong><?=$reservation?></p>
	<p><strong>Rémunération de l’artiste : </strong><?=$payment?></p>
</div>	
<div class="p-5">
	<p class="bold">Une fois validée votre demande de réservation sera envoyée à la scène. Vous ne devrez payer les frais de réservation qu’une fois votre demande de réservation acceptée par la scène. Vous recevrez alors un email (et une notification sur votre profil) lorsque votre demande aura été acceptée.</p>
</div>
<div class="p-5 grey">	
	<?=form_checkbox($checkbox)?>
	<label class="bold" for="<?=$checkbox['id']?>">En cochant cette case, je reconnais avoir lu et accepté <a href="#" class="purple">les conditions d’utilisations.</a></label>
</div>
