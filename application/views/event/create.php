<?php 
//Include config lang
include("/home/bonstage/dev.b-onstage/application/config/lang.php");
foreach($lang_counts as $key => $value){
if($this->session->userdata('lang_loaded') == $value["name"]){ $lang_id = $value["id"];}
}

?><div id="lang_loaded_id" style="display:none"><?php echo $lang_id ?></div>
<div id="validate" style="display:none"><?php echo ucfirst(lang("validate")) ?></div>
<div id="canceltxt" style="display:none"><?php echo lang("cancel") ?></div>
<div id="users_calendar_create_non_renum" style="display:none"><?php echo lang("users_calendar_create_non_renum") ?></div>
<div id="users_calendar_create_cachet" style="display:none"><?php echo lang("users_calendar_create_cachet") ?></div>
<div id="users_calendar_create_conso" style="display:none"><?php echo lang("users_calendar_create_conso") ?></div>
<div id="users_calendar_create_tickets" style="display:none"><?php echo lang("users_calendar_create_tickets") ?></div>
<div id="users_calendar_create_remb" style="display:none"><?php echo lang("users_calendar_create_remb") ?></div>
<div class="container_12" id="event">
	<div class="grid_12 mt-20 mb-20 ui-corner-all bg-white bs-black">
	<form method="post" id="<?=$form_create_event['id']?>">	
		<!--event action-->	
		<div class="ev-action top p-20 ui-corner-top">						
			<span><?=anchor(site_url('user/calendar'),lang("users_calendar_back"),array('class'=>'button-return-calendar', 'title' => lang("users_calendar_back")))?></span>
			<span class="ml-5"><button class="button-create-event ui-purple"><?php echo lang("save") ?></button></span>										
		</div>			


		<!--event content-->
		<div id="ev-content" class="mb-20">				
			<!--event title-->
			<div id="w-ev-title" class="pl-20 mt-20"><?=form_input($title)?></div>
			<!--event date-->
			<div id="w-ev-date" class="pl-20 mt-20">					
				<span>
					<span id="w-ev-date-start"><?=form_input($date_start)?></span>
					<span id="w-ev-schedule-start"><?=form_input($schedule_start)?></span>
				</span>
				<span class="mr-2 grey fs-12 bold"><?php echo lang("to2") ?></span>
				<span>				
					<span id="w-ev-schedule-end"><?=form_input($schedule_end)?></span>
					<span id="w-ev-date-end"><?=form_input($date_end)?></span>
				</span>
			</div>
			
			<!--event reccurence-->				
			<div id="w-ev-reccurence" class="pl-20 mt-20 mb-20">						
				<?=form_checkbox($reccurence)?>
				<label class="fs-13 grey bold ml-5" for="<?=$reccurence['id']?>"><?=$label_reccurence?></label>
			</div>
			
			<div id="tabs-event">
				<ul>
					<li><a href="#ev-content-1"><?=$ev_details_title?></a></li>
				</ul>
				<div id="ev-content-1">	
					<!--event details-->
					<table id="ev-details" width="100%" cellpadding="20px" class="mt-20">
						<tbody>
							<!--event location-->
							<tr>
								<td width="25%" align="right"><strong><?=form_label($label_location,$location['id'])?></strong></td>
								<td><div><?=$location['value']?></div></td>	
							</tr>	
							
							<!--event musical genre-->
							<tr>
								<td width="25%" class="va-t" align="right"><strong><?=form_label($label_musical_genre, $musical_genre['id'])?></strong></td>
								<td>
									<div><?=form_dropdown($musical_genre['name'],$musical_genre['options'],$musical_genre['selected'],$musical_genre['js'])?></div>
								</td>							
							</tr>
							<!--event payment type-->
							<tr>
								<td width="25%" align="right"><strong><?=form_label($label_payment_type, $payment_type['id'])?></strong></td>
								<td>
									<div>
										<span id="<?=$payment_type['id']?>" class="grey"><?=$payment_type['value']?></span>
										<span><a href="javascript:void(0)" id="update-payment-type" class="purple fs-12 bold pl-10"><?php echo lang("modify") ?></a></span>
									</div>	
								</td>							
							</tr>	
							<!--event reservation-->
							<tr>
								<td width="25%" align="right"><strong><?=form_label($label_reservation,$reservation['id'])?></strong></td>
								<td>
									<div><?=form_input($reservation)?><strong> € </strong></div>
								</td>		
							</tr>
							<!--event entry-->
							<tr>								
								<td width="25%" align="right"><strong><?=form_label($label_entry, $entry['id'])?></strong></td>
								<td>
									<div><?=form_input($entry)?><strong> € </strong></div>
								</td>
							</tr>
							<!--event description-->							
							<tr>								
								<td width="25%" class="va-t" align="right"><strong><?=form_label($label_description, $description['id'])?></strong></td>
								<td>
									<div><textarea id="<?=$description['id']?>"><?=$description['value']?></textarea></div>
								</td>	
							</tr>	
						</tbody>
					</table>							
				</div>	
			</div>		
		</div>	
	
		<!--event action-->	
		<div class="ev-action bottom p-20 ui-corner-bottom">						
			<span><?=anchor(site_url('user/calendar'),lang("users_calendar_back"),array('class'=>'button-return-calendar', 'title' => lang("users_calendar_back")))?></span>
			<span class="ml-5"><button class="button-create-event ui-purple"><?php echo lang("save") ?></button></span>										
		</div>				
	</form>	
	</div>
	
	<!--dialog payment type-->
	<div id="dialog-payment-type" title="<?=$label_payment_type?>">
		<form method="post" id="<?=$form_payment_type['id']?>">
		<div class="p-20">						
			<div class="mb-20">
				<?=form_checkbox($payment_type_1)?>
				<?=form_label($label_payment_type_1, $payment_type_1['id'], $attrs_label_payment_type)?>
			</div>	
			<div class="mb-20">
				<?=form_checkbox($payment_type_2)?>
				<?=form_label($label_payment_type_2, $payment_type_2['id'], $attrs_label_payment_type)?>
				<?=form_input($input_payment_type_2)?> €
			</div>
			<div class="mb-20">
				<?=form_checkbox($payment_type_3)?>
				<?=form_input($input_payment_type_3)?>
				<?=form_label($label_payment_type_3, $payment_type_3['id'], $attrs_label_payment_type)?>
			</div>
			<div class="mb-20">
				<?=form_checkbox($payment_type_4)?>
				<?=form_input($input_payment_type_4)?>
				<?=form_label($label_payment_type_4, $payment_type_4['id'], $attrs_label_payment_type)?>
			</div>
			<div class="mb-20">
				<?=form_checkbox($payment_type_5)?>
				<?=form_label($label_payment_type_5, $payment_type_5['id'], $attrs_label_payment_type)?>
			</div>
			<div class="fs-13 bold">
				<?php echo lang("resume") ?> : 
				<span id="resume-payment-type"></span>
			</div>
		</div>	
		</form>
	</div>	
</div>

<!--timepicker css-->
<link rel="stylesheet" type="text/css" href="<?=site_url('js/timepicker/jquery.timepicker.css')?>" />
<!--chosen css-->
<link rel="stylesheet" type="text/css" href="<?=site_url('js/chosen/chosen.css')?>" />
<!--redactor-->
<link rel="stylesheet" type="text/css" href="<?=site_url('js/redactor/redactor.css')?>" />
<script type="text/javascript">
var event_id = 0;
var event_status = 'new';
var add_url = '<?=$add_url?>';
var success_message = '<?=$success_message?>';
var success_url = '<?=$success_url?>';
var error_message = '<?=$error_message?>';
</script>