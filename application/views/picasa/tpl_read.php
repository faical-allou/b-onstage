<?php
	if(isset($entry)){
		$entries = $entry;
		$count = count($entry); 
	
	}	
	else
		$count = 0;
?>	

<div class="pi-user">
	<!-- <div class="pi-header">
		thumbnail
		<a href="<?=$link?>">
			<span class="mr-10">
				<img src="<?=$thumbnail?>" height="40px" />
			</span>
			<!--name + album count--
			<span class="fs-12 bold grey">
				<?=$name?>
			<span>
		</a>	
	</div>	-->
	<?php if(isset($entry)){ ?>		
		<div class="pi-content clearfix p-5">	
			<?php foreach($entries as $e) { 

				if ($e['title']['$t'] == $user_page['company']) {?>
				<a href="<?=$e['link'][0]['href']?>" title="<?=$e['title']['$t']?>" class="pi-album bg-white">				
					<div class="pi-album-thumbnail">
						<img src="<?=$e['media$group']['media$thumbnail'][0]['url']?>"/>
					</div>	
					<div class="pi-album-description">
						<div class="fs-12 grey bold pl-10 pt-10"><?=$e['title']['$t']?></div>
						<div class="fs-12 grey-2 bold pl-10"><?=$e['gphoto$numphotos']['$t']?> <?=($e['gphoto$numphotos']['$t'] > 1 ? 'photos' : 'photo')?></div>
					</div>			
				</a>
			<?php }} ?>		
		</div>	
	<?php } else { ?>	
		<div class="p-20">												
			<p class="fs-15 grey"><i><?php echo lang("users_page_picasa_album_notfound") ?></i></p>
		</div>	
	<?php } ?>
</div>