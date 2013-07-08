<li id="upload-track-<?=$file_id?>" class="p-10">
	<div>
		<span class="mr-10"><?=form_input(array('id' => 'track-title-'. $file_id, 'name' => 'track-title-'. $file_id, 'class' => 'input required ui-corner-all'))?></span>
		<span id="upload-infos-<?=$file_id?>" class="fs-15 grey bold">			
			<span><span id="upload-bytes-loaded-<?=$file_id?>">0</span> MB sur <span id="upload-bytes-total-<?=$file_id?>">0</span> MB</span>			
		</span>
	</div>	
	<div id="progressbar-<?=$file_id?>" class="mt-10"></div>  			
	<div id="state-upload-<?=$file_id?>"></div>	
</li>	