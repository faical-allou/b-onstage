<li id="track-<?=$track['id']?>" class="track clearfix" data-track-title="<?=$track['title']?>" data-stream-url="<?=$track['url']?>">
	<!--play button-->
	<span class="left">
		<a href="javascript:void(0)" class="track-play" data-track-id="track-<?=$track['id']?>" data-track-title="<?=$track['title']?>" data-url="<?=$track['url']?>"><span aria-hidden="true" class="icon-play-2 fs-10"></span></a>
	</span>
	<!--tracks title-->
	<span class="left ml-10">				
		<a href="javascript:void(0);" class="track-title" data-track-id="track-<?=$track['id']?>" data-track-title="<?=$track['title']?>" data-url="<?=$track['url']?>"><?=$track['title']?></a>
	</span>
	
	<!--delete-->
	<span class="right">
		<a href="javascript:void(0)" class="track-delete" data-track-id="<?=$track['id']?>" data-track-url="<?=$track['url']?>"><span aria-hidden="true" class="icon-remove-2 fs-10"></span></a> 				
	</span>				
	<!--track duration-->
	<span class="right mr-15">			
		<span class="track-duration"><?=$duration?></span>
	</span>	
</li>