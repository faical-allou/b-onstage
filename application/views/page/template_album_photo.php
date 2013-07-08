<div class="album-photo clearfix" id="album-photo-<?=$id?>">
	<div class="clearfix p-20">
		<div class="thumb-album-photo bs-black-thumbnail ui-corner-all left mr-20">
			<?=img($thumb_url)?>
		</div>																			
		<div class="description-album-photo">	
			<div class="title-album-photo grey fs-12 bold mb-10">
				<?=$title?> - 		
				<?=$count_photo?> photo(s)
			</div>
			<p class="grey fs-12"><?=$description?></p>																
			<div class="mb-10"><button class="button-show-album-photo" data-album-id="<?=$id?>">Voir l'album</button></div>											
		</div>
	</div>	
</div>			