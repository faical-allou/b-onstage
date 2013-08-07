<div class="container_12">
	<div class="grid_12 mt-20 mb-20" id="read-concert">			
		<div>
			<!--date et heure-->
			<div class="title mb-20 clearfix bg-white ui-corner-all bs-black fs-24" style="padding:.6em 1em;">
				<?php echo lang("the") ?> <span class="purple"><?=$date?></span> <?php echo lang("de") ?> <span class="purple"><?=$schedule?></span>, <?=anchor($artist_link, ucfirst($concert['artist_company']), array('class' => 'purple')).' '.lang("shows_inshowat").' '.anchor($stage_link, $concert['stage_company'], array('class' => 'purple'))?>				
			</div>		
			
			<!--infos concert-->
			<div class="mb-20">
				<table width="100%">
					<tbody>
						<tr>
							<td width="75%" class="va-t ui-corner-all bg-white bs-black">
								<div class="p-20">
									<div class="mb-20 fs-18 title">
										<?php echo lang("shows_stageinfo") ?>
									</div>									
									<div class="clearfix mb-20">
										<div class="left">
											<?=img(array('src' => $concert['stage_avatar'], 'class' => 'ui-corner-all bs-black-avatar', 'width' => '100px'))?>
										</div>	
										<div class="left ml-20">
											<div class="mb-10 fs-18 title grey"><?=anchor($stage_link, $concert['stage_company'], array('class' => 'purple'))?></div>
											<p class="fs-12 grey bold"><span aria-hidden="true" class="icon-location mr-5"></span><?=$location?></p>
											<div><?=anchor($stage_link, lang("seestage"), array('id' => 'show-stage-profil','class' => 'ui-purple'))?></div>
										</div>
									</div>
								</div>
							</td>
							<td width="25%" class="va-t ta-c">
								<div class="p-20 ml-20 mb-20 ui-corner-all bg-white bs-black">
									<div class="mb-10 fs-18 title grey">
										<?php echo lang("users_rese_enterprice") ?>
									</div>
									<div class="fs-18 purple title grey">
										<?=round($concert['entry'], 2)?>€						
									</div>								
								</div>
								<div class="p-20 ml-20 ui-corner-all bg-white bs-black">
									<div class="mb-10 fs-18 title grey">
										<?php echo lang("users_calendar_genre") ?>
									</div>
									<div class="fs-18 purple title">
										<?=$genres?>
									</div>
								</div>																		
							</td>
						</tr>	
					</tbody>
				</table>
			</div>	
			
			<!--infos artistes-->
			<div>								
				<table width="100%">
					<tbody>
						<tr>
							<td width="60%" class="va-t ui-corner-all bg-white bs-black">
								<div class="p-20">	
									<div class="mb-20 fs-18 title grey"><?=$title_artist?></div>
									<div class="clearfix pb-20" style="border-bottom:1px solid #eaeaea;">
										<div class="left">
											<?=img(array('src' => $concert['artist_avatar'], 'class' => 'ui-corner-all bs-black-avatar', 'width' => '100px'))?>
										</div>	
										<div class="left ml-20">
											<div class="mb-10 fs-18 title grey"><?=anchor($artist_link, ucfirst($concert['artist_company']), array('class' => 'purple'))?></div>
											<p class="fs-12 grey bold"><span aria-hidden="true" class="icon-location mr-5"></span><?=$concert['artist_city'].', '.$concert['artist_country']?></p>
											<div><?=anchor($artist_link, lang("shows_seeartist"), array('id' => 'show-artist-profil','class' => 'ui-purple'))?></div>
										</div>
									</div>	
									<div style="border-top:1px solid #ffffff;">													
										<p class="grey fs-12"><strong><?php echo lang("users_page_website") ?> : </strong><?=$artist_website?></p>
										<p class="grey fs-12"><strong><?php echo lang("users_page_socialmed") ?> : </strong></p>
										<div>
											<?=$artist_facebook.$artist_twitter.$artist_google_plus?>
										</div>
									</div>
									<div>	
										<p class="grey fs-12"><strong><?php echo lang("desc") ?> :</strong></p>
										<p class="grey fs-12"><?=$artist_description?></p>															
									</div>
								</div>
							</td>
							<td width="40%" class="va-t">								
								<!--sound-->
								<div class="ml-20 p-20 ui-corner-all bg-white bs-black">
									<div class="fs-18 mb-10 title grey"><?php echo lang("shows_bandsound") ?></div>
									<div id="sound-player" class="jp-player ui-corner-bottom"></div>
									<div class="jp-audio hidden mb-10" style="border:none;">
										<div class="jp-type-playlist ui-corner-all border-grey-1">
											<div class="jp-gui jp-interface">
												<ul class="jp-controls">
													<li><a href="javascript:void(0);" class="jp-previous" tabindex="1">previous</a></li>
													<li><a href="javascript:void(0);" class="jp-play" tabindex="1">play</a></li>
													<li><a href="javascript:void(0);" class="jp-pause" tabindex="1">pause</a></li>
													<li><a href="javascript:void(0);" class="jp-next" tabindex="1">next</a></li>
													<li><a href="javascript:void(0);" class="jp-stop" tabindex="1">stop</a></li>
													<li><a href="javascript:void(0);" class="jp-mute" tabindex="1" title="mute">mute</a></li>
													<li><a href="javascript:void(0);" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
												</ul>
												<div class="jp-time-holder">
													<div class="jp-current-time"></div>
													<div class="jp-duration"></div>
												</div>
												<div class="jp-progress left">
													<div class="jp-seek-bar">
														<div class="jp-play-bar"></div>
													</div>
												</div>
												<div class="jp-volume-bar">
													<div class="jp-volume-bar-value"></div>
												</div>
												<ul class="jp-toggles">												
													<li><a href="javascript:void(0);" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
													<li><a href="javascript:void(0);" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
													<!--button show playlist ajouté au plugin jplayer-->
													<li><a href="javascript:void(0);" id="button-show-playlist" class="jp-show-playlist" tabindex="1" title="Show playlist">show</a></li>						
												</ul>
											</div>
											<div class="jp-playlist">
												<ul>
													<li></li>
												</ul>	
											</div>
										</div>	
									</div>
									<div>
										<?php if($nb_tracks > 0) { ?>
											<?=$tracks?>
										<?php } else { ?>
											<div class="p-10">
												<i class="fs-12"><?php echo lang("users_page_sons_nosound") ?></i>
											</div>
										<?php } ?>										
									</div>
								</div>
							</td> 
						</tr>
					</tbody>
				</table>
			</div>			
		</div>	
	</div>
</div>

<!--jPlayer-->
<link rel="stylesheet" href="<?=site_url('js/jplayer/skin/blue/jplayer.blue.css')?>" type="text/css" media="screen" />