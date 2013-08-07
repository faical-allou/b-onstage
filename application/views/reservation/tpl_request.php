<?=heading(lang("users_rese_request"), 1 ,'class="purple fs-24 title m-0"')?>
<div class="p-5 grey">
	<?php echo lang("book_req_txt1") ?>
</div>	
<div class="grey bg-grey-1 border-grey-1 ui-corner-all p-10 mb-10">
	<p><strong><?php echo lang("users_home_stage_name_short") ?> : </strong><?=$company?></p>
	<p><strong><?php echo lang("book_req_showdate") ?> : </strong><?=$date?></p>
	<p><strong><?php echo lang("users_calendar_genre") ?> : </strong><?=$genres?></p>
	<p><strong><?php echo lang("users_rese_fees") ?> : </strong><?=$reservation?></p>
	<p><strong><?php echo lang("users_rese_renumartist") ?> : </strong><?=$payment?></p>
</div>	
<div class="p-5">
	<?php echo lang("book_req_txt1") ?>
</div>
<div class="p-5 grey">	
	<?=form_checkbox($checkbox)?>
	<label class="bold" for="<?=$checkbox['id']?>"><?php echo lang("book_req_agree") ?></label>
</div>
