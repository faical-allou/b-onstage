<div class="yt-video p-20">
	<a href="<?=$player_url?>" class="yt-thumbnail-video video" title="<?=$title?>" rel="fancybox-thumb">
		<?=img($thumbnail_url)?>
	</a>
	<div class="yt-content-video">
		<div class="mb-5">
			<a href="<?=$player_url?>" class="title grey video fs-16" title="<?=$title?>" rel="fancybox-thumb"><?=$title?></a>
		</div>
		<div class="fs-12 grey bold">
			<?=$view_count?> <?php echo lang("views") ?>
		</div>
		<p class="grey-2 bold fs-12"><?=$description?></p>		
	</div>
	<?php if($id){ ?>
		<button data-id="<?=$id?>" class="delete-yt-video"><?php echo lang("delete") ?></button>
	<?php } ?>	
</div>