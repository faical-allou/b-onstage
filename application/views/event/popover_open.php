<div class="popover-event ui-corner-all">
	<div class="header clearfix">
		<div class="fs-28 title blue mb-10"><?=$event['title']?></div>		
		<div class="title fs-16 grey"><span aria-hidden="true" class="icon-calendar fs-14"></span> <?=$event_date?></div>
		<a href="javascript:void(0);" class="close"><span aria-hidden="true" class="icon-cancel blue fs-18"></span></a>			
	</div>
	<div class="content clearfix">
		<dl>
			<!--musical genre-->
			<dt><?php echo lang("users_calendar_genre") ?></dt>
			<dd><?=$musical_genres?></dd>	
			<!--payment type-->
			<dt><?php echo lang("users_calendar_create_payment") ?></dt>
			<dd><?=$payment_type?></dd>		
			<!--reservation-->
			<dt><?php echo lang("users_calendar_create_book") ?></dt>
			<dd><?=round($event['reservation'],2)?></dd>	
			<!--entry-->
			<dt><?php echo lang("users_calendar_create_price") ?></dt>
			<dd><?=round($event['entry'],2)?></dd>		
		</dl>
	</div>
	<div class="footer clearfix">		
		<span class="right"><a href="<?=site_url('/event/edit/'.$event['id'])?>" class="more-event-details ui-blue"><?php echo lang("users_calendar_event_mod_del") ?></a></span>
	</div>
</div>	
<script type="text/javascript">
	$('.more-event-details, .delete-event').button();
	$('.close').click(function(){
		$('#popover-event').remove();
	});
</script>
