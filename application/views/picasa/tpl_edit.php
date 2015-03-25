<?php
	if(isset($entry)) {	
		if(gettype($entry) == 'string')
			$entries = json_decode($entry, true);
		else
			$entries = $entry;
		
		$count = count($entries); 	
	} else
		$count = 0;
?>	

<div class="pi-user" id="pi-user-<?=$id?>">
	<div class="pi-header clearfix">
		<!--thumbnail-->		
		<a href="<?=$link?>" class="left">
			<span class="mr-10">
				<img src="<?=$thumbnail?>" height="40px" />
			</span>
			<!--name + album count-->
			<span class="fs-12 bold grey">
				<?=$name?>			
			<span>
		</a>	
		
		<!--delete user-->
		<a href="javascript:void(0);" class="delete-pi-user right fs-12 bold grey" data-id="<?=$id?>"><?php echo lang("delete") ?></a>
		
	</div>
	<?php if(isset($entry)) { ?>
		<div class="pi-content clearfix p-5">		
			<?php foreach($entries as $e) {	?>
				<a href="<?=$e['link'][0]['href']?>" title="<?=$e['title']['$t']?>" class="pi-album bg-white">				
					<div class="pi-album-thumbnail">
						<img src="<?=$e['media$group']['media$thumbnail'][0]['url']?>"/>
					</div>	
					<div class="pi-album-description">
						<div class="fs-12 grey bold pl-10 pt-10"><?=$e['title']['$t']?></div>
						<div class="fs-12 grey-2 bold pl-10"><?=$e['gphoto$numphotos']['$t']?> <?=($e['gphoto$numphotos']['$t'] > 1 ? 'photos' : 'photo')?></div>
					</div>			
				</a>
			<?php } ?>
		</div>
	<?php } else { ?>	
		<div class="p-20">												
			<p class="fs-15 grey"><i><?php echo lang("users_page_picasa_album_notfound") ?></i></p>
		</div>	
	<?php } ?>	
</div>