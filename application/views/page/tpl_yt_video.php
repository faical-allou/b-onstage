<div class="yt-video p-20 ta-c">
	<div class="dib m-10">	
	<iframe width="640" height="360" src="https://www.youtube.com/embed/<?= $yt_id ?>?border=none&color=white&modestbranding=1&rel=0&theme=light&autohide=1&autoplay=0&showinfo=1&controls=1" seamless='seamless' frameBorder="0" allowfullscreen></iframe>
	</div>
	<?php if($id){ ?>
		<button data-id="<?=$id?>" class="delete-yt-video"><?php echo lang("delete") ?></button>
	<?php } ?>	
</div>