<div class="sc-user" id="sc-user-<?=$sc_user['id']?>">
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
				<span class="ml-5 mr-10 fs-14"><?=$sc_user['track_count']?> <?php echo strtolower(lang("users_page_sons_track")) ?></span>			
			</div>														
			<!--button-->			
			<div>			
				<span style="display:none"><button data-tracks-id="sc-tracks-<?=$sc_user['id']?>" class="sc-tracks-listen"><?php echo lang("listen") ?></button></span>
				<span><button class="sc-synchro-user" data-sc-user-id="<?=$sc_user['id']?>"><?php echo lang("sync") ?></button></span>
				<span><button class="sc-delete-user" data-sc-user-id="<?=$sc_user['id']?>"><?php echo lang("delete") ?></button></span>
			</div>		
		</div>		
	</header>
	
	
	<?php if($sc_user['track_count'] == 0) { ?>
	<div class="p-20">
		<p class="grey fs-15"><i><?php echo lang("users_page_sons_notrack") ?></i></p>
	</div>
	<?php } else {?>
	
	<!--tracks-->
	<div>
		<div class="m-10 fs-12 bold clearfix">			
			<span class="right"><?php echo lang("show") ?></span>	
		</div>	
		<ul class="sc-tracks" id="sc-tracks-<?=$sc_user['id']?>">
			<?php foreach($sc_tracks as $sc_track){	?>
			<li id="sc-track-<?=$sc_track['id']?>" class="sc-track clearfix" data-tracks-id="sc-tracks-<?=$sc_track['user_id']?>" data-track-title="<?=$sc_track['title']?>" data-stream-url="<?=$sc_track['stream_url']?>">
				<!--play button-->
				<span class="left">
					<a href="javascript:void(0)" class="sc-track-play" data-tracks-id="sc-tracks-<?=$sc_track['user_id']?>" data-track-id="sc-track-<?=$sc_track['id']?>" data-track-title="<?=$sc_track['title']?>" data-stream-url="<?=$sc_track['stream_url']?>"><span aria-hidden="true" class="icon-play-2 fs-10"></span></a>
				</span>
				<!--tracks title-->
				<span class="left ml-10">				
					<a href="javascript:void(0);" class="sc-track-title" data-tracks-id="sc-tracks-<?=$sc_track['user_id']?>" data-track-id="sc-track-<?=$sc_track['id']?>" data-track-title="<?=$sc_track['title']?>" data-stream-url="<?=$sc_track['stream_url']?>"><?=$sc_track['title']?></a>
				</span>
				<!--checkbox visible-->
				<span class="right">
					<?php
						$checkbox = array(
							'name'				=> 'track-visible-'.$sc_track['id'],
							'id'				=> 'track-visible-'.$sc_track['id'],
							'value'				=> true,
							'checked'			=> true,
							'data-track-id'		=> $sc_track['id'],
							'onchange'			=> 'update_visibility_track($(this));return false;'
						);
						echo form_checkbox($checkbox);
					?>		
				</span>	
				<span class="right mr-15">
					<?php
						//calcul duration
						$min_duration = floor($sc_track['duration']/ 1000 / 60);
						$sec_duration = $sc_track['duration']/ 1000 % 60;
						$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
					?>
					<span class="sc-track-duration"><?=$duration?></span>
				</span>	
			</li>			
			<?php } ?>
		</ul>
	</div>	
	<?php } ?>	
</div>
<!--dailog delete sc user-->
<div id="dialog-delete-sc-user">
	<div class="p-20">
		<p class="grey fs-12 bold"><?php echo lang("users_page_sons_soundcloud_delconf") ?></p>
	</div>	
</div>
	