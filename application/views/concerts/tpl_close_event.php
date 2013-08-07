<div class="line-concert bg-white" id="<?=$event['id']?>">
	<div class="inner p-10">
		<div class="clearfix bg-grey-1 ui-corner-all">
			<div class="left" style="width:70%">
				<div class="p-r">
					<?=img(array('src' => site_url($event['artist_cover']), 'width' => '100%', 'class' => 'ui-corner-left'))?>			
					<div class="fs-24 p-a rgba-black-8 white title p-10 ui-corner-br ui-corner-tl" style="top:0;">
						<?=date_format($date_start, 'j')?>				
						<?=get_month(date_format($date_start, 'n'))?>
						<?php echo lang("at") ?>
						<?=date_format($date_start, 'G\hi')?>
					</div>
					<div class="fs-24 p-a rgba-black-8 white title p-10 ui-corner-right" style="top:70px;">
						<a href="<?=$artist_link?>" class="underline white"><?=$event['artist_company']?></a>
						<?php echo lang("shows_inshow") ?>
					</div>	
					<div class="fs-24 p-a rgba-black-8 white title p-10 ui-corner-right" style="top:140px;">
						<?php echo lang("scene") ?>
						<a href="<?=$stage_link?>" class="underline white"><?=$event['stage_company']?></a>
					</div>						
					<a href="<?=site_url('event/'.$event['id'])?>" class="p-a ui-purple show-concert" style="font-size:1.2em;right:20px;bottom:20px;"><?php echo lang("shows_seeshow") ?></a>								
				</div>
			</div>
			<div class="left" style="width:30%">
				<div class="fs-16 title grey p-20">									
					<div class="mb-5 fs-24 purple"><?php echo lang("shows_showinfo") ?></div>
					<div class="mb-5"></div>
					<div class="mb-5"><?php echo lang("artist") ?> : <a href="<?=$artist_link?>" class="underline purple"><?=$event['artist_company']?></a></div>	
					<div class="mb-5"><?php echo lang("scene") ?> : <a href="<?=$stage_link?>" class="underline purple"><?=$event['stage_company']?> (<?=$event_location?>)</a></div>						
					<div class="mb-5"><?php echo lang("users_calendar_genre") ?> : <span class="purple"><?=$event_genres?></span></div>	
					<div class="mb-5"><?php echo lang("users_calendar_create_price") ?> : <span class="purple"><?=$entry?></span></div>					
				</div>
			</div>
		</div>	
	</div>	
</div>