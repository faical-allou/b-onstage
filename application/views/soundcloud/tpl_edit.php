<?php foreach($sc_users as $sc_user){ ?>
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
				<span class="ml-5 mr-10 fs-14"><?=$sc_user['track_count']?> pistes</span>			
			</div>	
			<!--button-->			
			<div>			
				<span><button data-tracks-id="sc-tracks-<?=$sc_user['id']?>" class="sc-tracks-listen">Ecouter</button></span>
				<span><button class="sc-synchro-user" data-sc-user-id="<?=$sc_user['id']?>">Synchroniser</button></span>
				<span><button class="sc-delete-user" data-sc-user-id="<?=$sc_user['id']?>">Supprimer</button></span>
			</div>		
		</div>		
	</header>
	
	<?php if($sc_user['track_count'] == 0) { ?>
	<div class="p-20">
		<p class="grey fs-15"><i>Aucune pistes disponibles.</i></p>
	</div>
	<?php } else {?>	
	
	<!--tracks-->
	<div>
		<div class="m-10 fs-12 bold clearfix">			
			<span class="right">Afficher</span>	
		</div>	
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
				<!--checkbox visible-->
				<span class="right">
					<?php
						$checkbox = array(
							'name'				=> 'track-visible-'.$data['id'],
							'id'				=> 'track-visible-'.$data['id'],
							'value'				=> true,
							'checked'			=> $sc_track['visible'],
							'data-track-id'		=> $data['id'],
							'onchange'			=> 'update_visibility_track($(this));return false;'
						);
						echo form_checkbox($checkbox);
					?>		
				</span>	
				<span class="right mr-15">
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