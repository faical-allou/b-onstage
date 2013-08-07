<div id="reservation-<?=$reservation['id']?>" class="accepted-reservation reservation" data-status="<?=$reservation['status']?>" data-date-modified="<?=strtotime($reservation['date_modified'])?>">
	<div class="inner" style="border-top:2px solid #8e2c86;">
		<div class="p-10 bg-grey-1 purple title fs-24"> 
			<?=date_format($start, 'j')?>				
			<?=get_month(date_format($start, 'n'))?>				
			<?php echo lang("de") ?> <?=date_format($start, 'G\hi')?> <?php echo lang("to2") ?> <?=date_format($end, 'G\hi')?>		
		</div>
		<div class="p-20 mb-20">
			<div class="mb-20">
				<table width="100%">
					<tbody>
						<tr>
							<td width="50%" class="va-t">
								<div class="left"><?=img(array('src' => site_url($reservation['stage_avatar']), 'width' => '80px'))?></div>
								<div class="left ml-20">
									<div class="mb-5"><?=anchor($stage_link, $reservation['stage_company'], array('class' => 'fs-18 title purple'))?></div>
									<div class="mb-5 grey bold fs-12"><?=$location?></div>
									<div class="mb-5"><?=anchor($stage_link, lang("seestage"), array('class' => 'fs-12 bold purple'))?></div>
								</div>							
							</td>
							<td width="50%">														
								<?php if($is_expired){ ?>
									<div class="ta-c p-10 ml-10 ui-corner-all fs-24 title red">
										<span style="border:2px solid #cf3d36;" class="ui-corner-all pl-10 pr-10"><?php echo lang("users_rese_is_expired") ?></span>
									</div>
								<?php }else{ ?>
									<div class="ta-c p-10 ml-10 ui-corner-all bg-grey-1">
										<div class="title fs-16 purple mb-10"><?php echo lang("users_rese_delayfees") ?></div>
										<div class="countdown ta-c"></div>
									</div>
								<?php } ?>							
								
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
										<?php echo lang("users_rese_renumartist") ?>
									</div>
									<div>
										<?=$payment_type?>
									</div>								
								</div>	
							</td>
							<td width="25%" class="va-t ta-c fs-12 grey">							
								<div class="p-10">
									<div class="mb-10 fs-16 title">
										<?php echo lang("users_calendar_genre") ?>
									</div>
									<div>
										<?=$musical_genre?>
									</div>							
								</div>	
							</td>
							<td width="25%" class="va-t ta-c fs-12 grey">							
								<div class="p-10">
									<div class="mb-10 fs-16 title">
										<?php echo lang("users_rese_fees") ?>
									</div>
									<div class="fs-18 purple title">
										<?=round($reservation['reservation'], 2)?>€
									</div>							
								</div>	
							</td>
							<td width="25%" class="va-t ta-c fs-12 grey">							
								<div class="p-10">
									<div class="mb-10 fs-16 title">
										<?php echo lang("users_rese_enterprice") ?>
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
			
			<?php if(!$is_expired) { ?>
				<div class="mt-20">
					<table width="100%">
						<tbody>
							<tr>
								<td width="50%">							
									<div class="mr-10">
										<button class="cancel-reservation" data-date-start="<?=$reservation['start']?>" data-reservation-id="<?=$reservation['id']?>"  data-event-id="<?=$reservation['event_id']?>" data-status="<?=$reservation['status']?>" data-reservation-artist-id="<?=$reservation['artist_id']?>" data-event-artist-id="<?=$reservation['event_artist_id']?>"><?php echo lang("users_rese_cancel") ?></button>
									</div>							
								</td>		
								<td width="50%">
									<div class="ml-10">
										<a href="<?=site_url('payonline/'.$reservation['id'].'/'.$reservation['event_id'].'/'.round($reservation['reservation'],2))?>" class="pay-reservation ui-purple"><?php echo lang("users_rese_payfees") ?></a>		
									</div>							
								</td>
							</tr>
						</tbody>		
					</table>			
				</div>
			<?php } ?>
		</div>
	</div>	
</div>