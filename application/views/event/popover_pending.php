<div class="popover-event ui-corner-all">
	<div class="header clearfix">
		<div class="fs-28 title yellow mb-10"><?=$event['title']?></div>		
		<div class="title fs-16 grey"><span aria-hidden="true" class="icon-calendar fs-14"></span> <?=$event_date?></div>
		<a href="javascript:void(0);" class="close"><span aria-hidden="true" class="icon-cancel yellow fs-18"></span></a>			
	</div>
	<div class="content clearfix">
		<dl>
		<!--musical genre-->
		<dt>Genre musical</dt>
		<dd><?=$musical_genres?></dd>	
		<!--payment type-->
		<dt>Rémunération de l'artiste</dt>
		<dd><?=$payment_type?></dd>				
		<!--reservation-->
		<dt>Montant de la réservation</dt>
		<dd><?=round($event['reservation'],2)?> €</dd>	
		<!--entry-->
		<dt>Prix des entrées</dt>
		<dd><?=round($event['entry'],2)?> €</dd>
	</dl>
	</div>
	<div class="footer clearfix">	
		<span class="right"><a href="<?=site_url('/event/edit/'.$event['id'])?>" class="more-event-details ui-yellow">Voir <?=$count_reservations?> demande(s) de réservation</a></span>		
	</div>
</div>	
<script type="text/javascript">
	$('.more-event-details').button();
	$('.close').click(function(){
		$('#popover-event').remove();
	});
</script>