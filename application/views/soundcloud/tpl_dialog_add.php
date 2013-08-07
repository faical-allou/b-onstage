<div class="p-10 clearfix">	
	<div class="left">
		<?=img($avatar_url)?>
	</div>
	<div class="ml-20 left">
		<div class="mb-10 purple bold">
			<span aria-hidden="true" class="icon-soundcloud fs-20"></span>
			<span class="ml-5 fs-20"><?=$username?></span>
		</div>
		<div class="mb-10 grey bold">			
			<span aria-hidden="true" class="icon-music fs-16"></span>
			<span class="ml-5 fs-16"><?=$track_count?> <?php echo strtolower(lang("users_page_sons_track")) ?></span>			
		</div>	
		<div class="mb-10 grey bold">			
			<span aria-hidden="true" class="icon-playlist fs-16"></span>
			<span class="ml-5 fs-16"><?=$playlist_count?> <?php echo strtolower(lang("playlists")) ?></span>		
		</div>
	</div>		
</div>