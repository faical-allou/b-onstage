<?php 
//print_r($tracks); echo "xxx"; 
foreach($tracks as $key => $value){
//echo $value["url"].' ';

$metadata = unserialize($value['metadata']);	
				if($metadata['Encoding'] == 'CBR'){
					$min_duration = floor($metadata['Length'] / 60);
					$sec_duration = $metadata['Length'] % 60;
					$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
				} else
					$duration ='00:00';
					
					
?><li id="track-<?=$value['id']?>" class="track clearfix" data-track-title="<?=$value['title']?>" data-stream-url="<?=$value['url']?>">
	<!--play button-->
	<span class="left">
		<a href="javascript:void(0)" class="track-play" data-track-id="track-<?=$value['id']?>" data-track-title="<?=$value['title']?>" data-url="<?=$value['url']?>"><span aria-hidden="true" class="icon-play-2 fs-10"></span></a>
	</span>
	<!--tracks title-->
	<span class="left ml-10">				
		<a href="javascript:void(0);" class="track-title" data-track-id="track-<?=$value['id']?>" data-track-title="<?=$value['title']?>" data-url="<?=$value['url']?>"><?=$value['title']?></a>
	</span>			
	
	<!--track duration-->
	<span class="right">			
		<span class="track-duration"><?=$duration?></span>
	</span>	
</li>	<?php	
}
?>

		