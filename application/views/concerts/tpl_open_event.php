<div class="line-concert bg-white bold" id="<?=$event['id']?>">
	<div class="inner p-10">		
		<!--event-date + event book button + title-->
		<div class="mb-20 clearfix">		
			<div class="date-concert title left">				
				<?=lang("calendar_day_".date_format($date_start, "w"))." ", date_format($date_start, "j")?>							
				<?=get_month(date_format($date_start, 'n'))?>				
			</div>
			<div class="schedule-concert title left ml-10">
				<span aria-hidden="true" class="mr-5 icon-clock"></span><?=date_format($date_start, 'G\hi')?> <?php echo lang("to2") ?> <?=date_format($date_end, 'G\hi')?>
			</div>			
			<div class="title-concert title left ml-10">
				<span aria-hidden="true" class="mr-5 icon-music"></span><?=UCFirst($event['title'])?>
			</div>			
		</div>	
		

		<div class="mb-20">
			<table width="100%">
				<tbody>
					<tr>
						<td width="60%" class="va-t">
							<div class="left">			
								<?=img(array('src' => site_url($event['stage_avatar']), 'title' => $event['stage_company'], 'width' => '128px', 'class'=>' mr-5 bs-black-thumbnail'))?>
							</div>	
							<div class="left ml-20">
								<div class="mb-10 fs-18 title grey"><?=anchor($stage_link, $event['stage_company'], array('class' => 'purple'))?> <?php echo lang("book_organiser") ?></div>
								<p class="fs-12 grey bold"><span aria-hidden="true" class="icon-location mr-5"></span><?=$event_location?></p>
							</div>
						</td>
						<td width="40%" class="ta-l">
							<div>
								<?php if($reserved) { ?>
									<a href="<?=site_url('user/reservations')?>" class="show-reservation ui-purple" style="font-size:1em;"><?php echo lang("book_button1") ?></a> 
								<?php } else { ?>
									<button class="book-concert ui-green" data-event-id="<?=$event['id']?>" data-stage-id="<?=$event['stage_id']?>" style="font-size:1em;"><?php echo lang("book_button2") ?></button>					
								<?php } ?>
								</br> 
									<button class="request-info ui-purple mt-10" href="javascript:void(0)" id="contact_us"><?php echo lang("request_info") ?></a> 
								
								
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
									<?php echo lang("users_rese_renumartist") ?>
								</div>
								<div class="fs-18 purple title">
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
									<?=$event_genres?>
								</div>							
							</div>	
						</td>
						<td width="25%" class="va-t ta-c fs-12 grey">							
							<div class="p-10">
								<div class="mb-10 fs-16 title">
									<?php echo lang("users_cost_ifselected") ?>
								</div>
								<div class="fs-18 purple title">
									<?=round($event['reservation'], 2)?>€
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
	</div>
</div>		