<div class="p-20 ui-corner-all" style="background-color:#f5f5f5;">									
	<!--title-->								
	<div class="mb-20">
		<?=form_input($title_album_photo)?>																				
	</div>	
	
	<!--exist album-->
	<div class="mb-20">		
		<?=form_dropdown($title_albums_photos['name'],$title_albums_photos['options'], $title_albums_photos['selected'], $title_albums_photos['js'])?>
	</div>
	
	<!--description-->
	<div class="mb-20">
		<textarea id="description-album-photo">		
		</textarea>						
	</div>	
						
	<!--button upload-->
	<div id="wrap-upload-photo">
		<div id="upload-photo" data-session-id="<?=$this->session->userdata('session_id')?>" >																			
			<input type="button" id="button-upload-photo" />															
		</div>																																																	
	</div>	
	<ul id="list-upload-photo">
	</ul>
	<div id="state-upload-photo">
	</div>
</div>	