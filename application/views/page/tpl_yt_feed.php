<div class="yt-feed">			
	<div class="yt-title-feed p-20">		
		<img src="<?=$avatar_url?>" />
		<div>
			<div class="mb-5">
				<a href="<?=$feed_url?>" class="title fs-16 grey"><?=$feed_title?></a>
			</div>
			<div class="fs-12 purple bold"><?=$feed_count.' vidéos'?></div>		
		</div>	
		<button data-id="<?=$id?>" class="delete-yt-feed">Supprimer</button>
	</div>		
	<div class="yt-content-feed">
		<?=$feed?>
	</div>		
</div>