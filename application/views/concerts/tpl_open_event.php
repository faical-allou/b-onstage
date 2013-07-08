<div class="line-concert bg-white" id="<?=$event['id']?>">
	<div class="inner p-10">		
		<!--event-date + event book button + title-->
		<div class="mb-20 clearfix">		
			<div class="date-concert title left ui-state-default ui-corner-all">				
				<?=date_format($date_start, 'j')?>				
				<?=get_month(date_format($date_start, 'n'))?>				
			</div>
			<div class="schedule-concert title left ui-state-default ui-corner-all ml-10">
				<span aria-hidden="true" class="fs-16 mr-5 icon-clock"></span><?=date_format($date_start, 'G\hi')?> à <?=date_format($date_end, 'G\hi')?>
			</div>			
			<!--<div class="title-concert title purple left fs-18">
				<?=UCFirst($event['title'])?>
			</div>-->			
		</div>	
		

		<div class="mb-20">
			<table width="100%">
				<tbody>
					<tr>
						<td width="60%" class="va-t">
							<div class="left">			
								<?=img(array('src' => site_url($event['stage_avatar']), 'title' => $event['stage_company'], 'width' => '50px', 'class'=>' mr-5 bs-black-thumbnail'))?>
							</div>	
							<div class="left ml-20">
								<div class="mb-10 fs-18 title grey"><?=anchor($stage_link, $event['stage_company'], array('class' => 'purple'))?> est l'organisateur de ce Concert</div>
								<p class="fs-12 grey bold"><span aria-hidden="true" class="icon-location mr-5"></span><?=$event_location?></p>
							</div>
						</td>
						<td width="40%" class="ta-c">
							<div>
								<?php if($reserved) { ?>
									<a href="<?=site_url('user/reservations')?>" class="show-reservation ui-purple" style="font-size:1em;">Voir ma réservation</a> 
								<?php } else { ?>
									<button class="book-concert ui-purple" data-event-id="<?=$event['id']?>" data-stage-id="<?=$event['stage_id']?>" style="font-size:1em;">Demande de réservation</button>					
								<?php } ?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
		<!--event infos-->
		<div class="bg-grey-1 ui-corner-all">	
			<table width="100%">
				<tbody>
					<tr>
						<td width="25%" class="va-t ta-c fs-12 grey">							
							<div class="p-10">
								<div class="mb-10 fs-16 title">
									Rémunération artiste
								</div>
								<div>
									<?=$payment_type?>
								</div>								
							</div>	
						</td>
						<td width="25%" class="va-t ta-c fs-12 grey">							
							<div class="p-10">
								<div class="mb-10 fs-16 title">
									Genre musical
								</div>
								<div>
									<?=$event_genres?>
								</div>							
							</div>	
						</td>
						<td width="25%" class="va-t ta-c fs-12 grey">							
							<div class="p-10">
								<div class="mb-10 fs-16 title">
									Frais de réservation
								</div>
								<div class="fs-18 purple title">
									<?=round($event['reservation'], 2)?>€
								</div>							
							</div>	
						</td>
						<td width="25%" class="va-t ta-c fs-12 grey">							
							<div class="p-10">
								<div class="mb-10 fs-16 title">
									Prix entrée
								</div>
								<div class="fs-18 purple title">
									<?=$entry?>						
								</div>								
							</div>	
						</td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>
</div>		