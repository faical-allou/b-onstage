<?php foreach($sc_users as $sc_user){ ?>
<div class="sc-user">
	<!--header-->
	<header class="clearfix p-20">
		<!--avatar-->
		<div class="sc-user-avatar">
			<?=img($sc_user['avatar_url'])?>
		</div>
		
		<div class="sc-user-infos ml-20">
			<!--username-->
			<div class="mb-10"><?=anchor($sc_user['permalink_url'],$sc_user['username'], array('class' => 'fs-18 grey bold ts-white'))?></div>													
			<div class="mb-10 grey bold">			
				<span aria-hidden="true" class="icon-music fs-14"></span>
				<span class="ml-5 fs-14"><?=$sc_track_count?> <?php echo strtolower(lang("users_page_sons_track")) ?></span>							
			</div>	
			<!--button-->			
			<div>			
				<span style="display:none"><button data-tracks-id="sc-tracks-<?=$sc_user['id']?>" class="sc-tracks-listen"><?php echo lang("listen") ?></button></span>			
			</div>			
		</div>		
	</header>
	
	
	<?php if($sc_track_count == 0) { ?>
	<div class="p-20">
		<p class="grey fs-15"><i><?php echo lang("users_page_sons_notrack") ?></i></p>
	</div>
	<?php } else {?>	
	<!--tracks-->
	<div>		
		<ul class="sc-tracks" id="sc-tracks-<?=$sc_user['id']?>">
			<?php foreach($sc_tracks as $sc_track){ 	
				if($sc_track['sc_user_id'] == $sc_user['id']){
				$data = unserialize($sc_track['data']);					
			?>
			<li id="sc-track-<?=$data['id']?>" class="sc-track clearfix" data-tracks-id="sc-tracks-<?=$data['user_id']?>" data-track-title="<?=$data['title']?>" data-stream-url="<?=$data['stream_url']?>">
				<!--play button-->
				<span class="left">
					<a href="javascript:void(0)" class="sc-track-play" data-tracks-id="sc-tracks-<?=$data['user_id']?>" data-track-id="sc-track-<?=$data['id']?>" data-track-title="<?=$data['title']?>" data-stream-url="<?=$data['stream_url']?>"><span aria-hidden="true" class="icon-play-2 fs-10"></span></a>
				</span>
				<!--tracks title-->
				<span class="left ml-10">				
					<a href="javascript:void(0);" class="sc-track-title" data-tracks-id="sc-tracks-<?=$data['user_id']?>" data-track-id="sc-track-<?=$data['id']?>" data-track-title="<?=$data['title']?>" data-stream-url="<?=$data['stream_url']?>"><?=$data['title']?></a>
				</span>				
				<span class="right">
					<?php
						//calcul duration
						$min_duration = floor($data['duration']/ 1000 / 60);
						$sec_duration = $data['duration']/ 1000 % 60;
						$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
					?>
					<span class="sc-track-duration"><?=$duration?></span>
				</span>	
			</li>			
			<?php }} ?>
		</ul>
	</div>		
	<?php } ?>
</div>
<?php } ?>

	