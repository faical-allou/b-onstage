<div class="container_12" id="event">	
	<div class="grid_12 mb-20 mt-20 ui-corner-all bg-white bs-black">		
		<!--event-->
		<div>	
			<!--event action-->	
			<div class="ev-action top p-20 ui-corner-top">						
				<span><?=anchor(site_url('user/calendar'),lang("users_calendar_back"),array('class'=>'button-return-calendar', 'title' => lang("users_calendar_back")))?></span>				
				<span class="ml-5"><?=anchor(site_url('user/calendar'),lang("delete"),array('class'=>'button-delete-event'))?></span>
			</div>	
			
			<!--event content-->
			<div id="ev-content" class="mb-20">				
				<!--event title-->
				<div class="pl-20 orange"><?=$title?></div>
				<!--event date-->
				<div class="pl-20 mb-20"><?=$event_date?></div>
					
				<div id="tabs-event">
					<ul>					
						<li><a href="#ev-content-1"><?=$ev_reservations_title?></a></li>
						<li><a href="#ev-content-2"><?=$ev_details_title?></a></li>							
					</ul>	

					<!--accepted artist-->
					<div id="ev-content-1">
						<div id="ev-reservations" class="mt-20">																												
							<?=$ev_reservations?>
						</div>
					</div>				
					
					<!--event details-->
					<div id="ev-content-2">						
						<table id="ev-details" width="100%" cellpadding="20px" class="mt-20">
							<tbody>
								<!--event location-->
								<tr>
									<td width="25%" align="right"><strong><?=$label_location?></strong></td>
									<td><span class="orange bold"><?=$location['value']?></span></td>	
								</tr>							
								<!--event musical genre-->
								<tr>
									<td width="25%" class="va-t" align="right"><strong><?=$label_musical_genre?></strong></td>
									<td><span class="orange bold"><?=$musical_genres?></span></td>							
								</tr>
								<!--event payment type-->
								<tr>
									<td width="25%" class="va-t" align="right"><strong><?=$label_payment_type?></strong></td>
									<td><span class="orange bold"><?=$payment_type?></span></td>							
								</tr>	
								<!--event reservation-->
								<tr>
									<td width="25%" align="right"><strong><?=$label_reservation?></strong></td>
									<td><span class="orange bold"><?=$reservation?></span></td>		
								</tr>
								<!--event entry-->
								<tr>								
									<td width="25%" align="right"><strong><?=$label_entry?></strong></td>
									<td><span class="orange bold"><?=$entry?></span></td>
								</tr>
								<!--event description-->							
								<tr>								
									<td width="25%" class="va-t" align="right"><strong><?=$label_description?></strong></td>
									<td><div><?=$description?></div></td>	
								</tr>	
							</tbody>
						</table>									
					</div>				
				</div>	
			</div>
			
			<!--event action-->	
			<div class="ev-action bottom p-20 ui-corner-bottom">						
				<span><?=anchor(site_url('user/calendar'),lang("users_calendar_back"),array('class'=>'button-return-calendar', 'title' => lang("users_calendar_back")))?></span>				
				<span class="ml-5"><?=anchor(site_url('user/calendar'),lang("delete"),array('class'=>'button-delete-event'))?></span>
			</div>	
		</div>	
	</div>
	
 </div>

<script type="text/javascript">
var event_id = <?=$event['id']?>;
var event_status = '<?=$event['status']?>';
var update_url = '<?=$update_url?>';
var success_message = '<?=$success_message?>';
var success_url = '<?=$success_url?>';
var error_message = '<?=$error_message?>';
</script>