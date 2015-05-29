<div class="line-concert bg-white bold" id="<?=$event['id']?>">
	<div class="inner p-5">		
		

		<div class="mb-10 dt  " style='width:100%'>
			<div class="  dtc p-10" style='width:35%;  white-space:nowrap;'>			
				<?=img(array('src' => site_url($event['stage_avatar']), 'title' => $event['stage_company'], 'width' => '100%','style'=>'max-width:240px', 'class'=>' mr-5 bs-black'))?>
			</div>	
			<div class="  dtc va-t" style='width:65%'>				
				<table width="100%">
					<tbody>
						<tr>
							<td width="100%" class="va-t ta-l">
						<!--event-date + event book button + title-->
								<div class="mb-5 clearfix db">		
									<div class="schedule-concert title right ml-10">
										<span aria-hidden="true" class="mr-5 icon-clock"></span><?=date_format($date_start, 'G\hi')?> <?php echo lang("to2") ?> <?=date_format($date_end, 'G\hi')?>
									</div>			
								
									<div class="date-concert title right">				
										<?=lang("calendar_day_".date_format($date_start, "w"))." ".date_format($date_start, "j")?>							
										<?=get_month(date_format($date_start, 'n'))?>				
									</div>
								</div>
		 					</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
						<tr>
							<!--location equipment-->
							<td width="80%" class="va-t ta-l">
								<div class="left ml-20">
									<div class="mb-10 fs-18 title grey"><?=anchor($stage_link, $event['stage_company'], array('class' => 'purple'))?> <?php echo lang("book_organiser") ?></div>
									<p class="fs-12 grey bold"><span aria-hidden="true" class="icon-location mr-5"></span><?=$event_location?></p>
									<div class="fs-14 mb-5 mt-5">
									<span class= "fa-stack fa">
									<i class="fa fa-users fa-stack-1x"></i>
									</span>
									<span class="fs-14 bold" style= "margin-left: -8px"><?=$event['stage_room_size']?></span>
										
									<span class= "fa-stack fa">
									<i class="fa fa-square-o fa-stack-1x"></i>
									</span>
									<span class="fs-14 bold" style= "margin-left: -8px"><?=$event['stage_stage_size']?></span>
									
									<span class= "fa-stack fa">
									<i class="fa fa-microphone fa-stack-1x"></i>
									<?php if ($event['stage_microphone']=="") :?>
					 				<i class="fa fa-ban fa-stack-2x red"></i>
									<?php endif; ?>
									</span>
					
									<span class= "fa-stack fa">
									<i class="fa fa-volume-off fa-stack-1x"></i>
									<?php if ($event['stage_speakers']=="") : ?>
					 				<i class="fa fa-ban fa-stack-2x red"></i>
									<?php endif; ?>
									</span>
					
									<span class= "fa-stack fa">
									<i class="fa fa-sliders fa-stack-1x"></i>
									<?php if ($event['stage_amplification']=="") : ?>
					 				<i class="fa fa-ban fa-stack-2x red"></i>
									<?php endif; ?>
									</span>
									
									<span class= "fa-stack fa">
									<i class="fa fa-lightbulb-o fa-stack-1x"></i>
									<?php if ($event['stage_lights']=="") : ?>
					 				<i class="fa fa-ban fa-stack-2x red"></i>
									<?php endif; ?>
									</span>
								</div>
								</div>
								
							</td>
								
							
							<td width="20%" class="ta-l va-t">
								<div>
									<?php if($reserved) { ?>
										<a href="<?=site_url('user/reservations')?>" class="show-reservation ui-purple""><?php echo lang("book_button1") ?></a> 
									<?php } else { ?>
										<button class="book-concert ui-green" data-event-id="<?=$event['id']?>" data-stage-id="<?=$event['stage_id']?>" style="font-size:1em;"><?php echo lang("book_button2") ?></button>					
									<?php } ?>
									</br> 
										<button class="request-info ui-purple mt-10 contact_us" href="javascript:void(0)"><?php echo lang("request_info") ?></a> 
								</div>
							</td>
						</tr>
					</tbody>
				</table>
		
		
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
											<?=$entry?>€						
										</div>								
									</div>	
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>		