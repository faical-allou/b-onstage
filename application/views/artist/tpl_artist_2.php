<div class="line-artist-list mb-20 bg-white bs-black ui-corner-all">
	<div class="inner">
		<div class="pl-20 pt-20 pr-20">			
			<div>
				<div class="clearfix">
					<!--principal infos-->
					<div class="left">
						<div class="left">
							<?=$avatar_link?>
						</div>
						<div class="left">
							<div>
								<?=anchor($artist_link,$company, array('class' => 'title fs-24 grey'))?>			
							</div>
							<p class="grey fs-12">
								<strong>Site officiel :</strong> <?=$website_link?>
							</p>	
							<div class="social-links mb-10">
								<?=$facebook_link?>
								<?=$twitter_link?>
							</div>
							<div>
								<ul class="action-menu">
									<li><a class="button-show-profil" href="<?=$artist_link?>">Voir profil</a></li> 
									<?php if($artist_state) {?>
										<li><a class="button-send-msg" href="javascript:void(0);" data-email-to="<?=$artist_email?>">Envoyer message</a></li>
										<li><a class="button-add-contact" href="javascript:void(0);" data-contact-id="<?=$artist_id?>">Ajouter à mes contacts</a></li>	
									<?php } ?>
								</ul>
							</div>
						</div>	
					</div>
					<div class="right">						
					</div>
				</div>	
			</div>
		</div>
		<!--other infos-->
		<div>
			<div class="dt" style="width:100%;border-spacing:20px;">
				<!--concerts-->
				<div class="dtc va-t bg-grey-1 ui-corner-all" style="width:60%;">												
					<h3 class="grey title m-0 p-10">Concerts à venir</h3>
					<?php if($nb_concerts > 0) { ?>									
						<ul class="concerts-list">
						<?php
							foreach($concerts as $concert){
							$date_concert = date_format(date_create($concert['date_start']), 'j').nbs();
							$date_concert .= get_month(date_format(date_create($concert['date_start']), 'n'));								
							$stage_link = $concert['web_address'] ? site_url($concert['web_address']) : site_url('page/'.$concert['username']);
						?>
							<li class="p-10 p-r">									
								<!--date et ville concert-->
								<h4 class="title m-0">
									<a href="<?=site_url('event/'.$concert['id'])?>" class="grey"><?=$date_concert?> à <?=$concert['city']?></a>
								</h4>
								<!--titre-->
								<!--organisteur-->										
								<div class="mt-10 grey fs-12 bold">
									<img src="<?=site_url($concert['avatar'])?>" width="32px" class="ui-corner-all" />
									Concert organisé par<a href="<?=$stage_link?>" class="purple"><?=nbs().$concert['company']?></a>
								</div>
								<a href="<?=site_url('event/'.$concert['id'])?>" class="show-concert white fs-18 title">
									<div class="p-10">
										<div>Voir concert</div>
										<div class="ta-c">
											<span aria-hidden="true" class="icon-play-2 fs-24"></span>
										</div>
									</div>
								</a>									
							</li>
						<?php } ?>
						</ul>	
						<div class="ta-r p-10"><?=anchor($artist_link,'Voir tous les concerts', array('class' => 'button-show-all-concerts'))?></div>
						<?php } else { ?>
						<div class="p-10">
							<i class="grey fs-15">Aucun concert programmé</i>
						</div>	
					<?php }?>					
				</div>					
			
				<!--sound-->
				<div class="dtc va-t bg-grey-1 ui-corner-all" style="width:40%;">				
					<h3 class="grey title m-0 p-10">Sons à écouter</h3>
					<?php if($nb_tracks > 0) { ?>							
						<ul class="tracks-list">
							<?php foreach($tracks as $track){	
								$metadata = unserialize($track['metadata']);				
							?>
							<li id="track-<?=$track['id']?>" class="track p-10 clearfix" data-track-title="<?=$track['title']?>" data-stream-url="<?=$track['url']?>">
								
								<!--play button-->
								<div class="track-play left">
									<a class="db p-2" href="javascript:void(0)" data-track-id="track-<?=$track['id']?>" data-track-title="<?=$track['title']?>" data-url="<?=$track['url']?>"><span aria-hidden="true" class="icon-play-2 grey fs-10 db"></span></a>
								</div>
								<!--tracks title-->
								<div class="track-title left">				
									<a href="javascript:void(0);" class="grey bold fs-12 db" data-track-id="track-<?=$track['id']?>" data-track-title="<?=$track['title']?>" data-url="<?=$track['url']?>">
									<?=$track['title']?></a>
								</div>			
								
								<!--track duration-->
								<?php
									if($metadata['Encoding'] == 'CBR'){
										$min_duration = floor($metadata['Length'] / 60);
										$sec_duration = $metadata['Length'] % 60;
										$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
									}
									else
										$duration ='00:00';				
								?>			
								<div class="track-duration right ta-r">			
									<span class="grey bold fs-12 db"><?=$duration?></span>
								</div>									
							</li>			
						<?php } ?>
						</ul>							
					<?php } else { ?>
						<div class="p-10">
							<i class="grey fs-15">Aucun son enregistré</i>
						</div>	
					<?php }?>					
				</div>
				
							
			</div>
		</div>
	</div>
</div>	