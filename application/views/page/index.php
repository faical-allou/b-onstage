<div id="page" class="container_12 mt-20 mb-20">
	<div class="grid_9 clearfix ui-corner-top">					
		<!--header-->
		<header class="bs-black bg-white mb-20 ui-corner-all">			
			
			<!--header page-->
			<div id="top-header-page">			
				<!--cover page-->
				<div id="cover-page">		
					<?=img(array('src' => site_url($user_page['cover'].'?'.time()), 'width' => '100%', 'title' => 'Photo de couverture','id' => 'img-cover', 'class' => 'ui-corner-top'))?>				
					<?php if($user_state == 2){?>					
						<div id="update-upload-cover" class="title fs-18 white rgba-black-8">Modifier la photo de couverture</div>						
					<?php } ?>
				</div>
				
				<!--avatar page-->
				<div id="avatar-page" class="ui-corner-all">
					<?=img(array('src' => site_url($user_page['avatar'].'?'.time()),'width' => '100%', 'title' => 'Photo de profil', 'id'=>'img-avatar', 'class' => 'ui-corner-all'))?>
					<?php if($user_state == 2){ ?>
						<div id="update-upload-avatar" class="title fs-18 white rgba-black-8 ui-corner-bottom">Modifier avatar</div>
					<?php } ?>
				</div>	

				<?php if($user_state==0){ ?>
					<div id="auth-page" class="p-a rgba-white-8 p-10 ui-corner-all">
						<h3 class=" m-0 title grey"><?=$user_page['company']?> est sur b-onstage</h3>
						<p class="grey fs-12 bold">Communiquez avec <?=$user_page['company']?> en vous inscrivant.</p>
						<div class="mt-10">
							<span>
								<a href="<?=site_url('signup_choice')?>" class="ui-dark">Inscription</a>
							</span>
							<span class="ml-5">								
								<?=anchor(site_url('login/'.urlencode(uri_string())), 'Connexion', array('class'=>'ui-purple'))?>								
							</span>	
						</div>
					</div>
				<?php } ?>	
					
			</div>						
			
			<!--title page-->
			<div id="center-header-page" class="bg-white">
				<?=heading($user_page['company'],1, 'class="title gery fs-28 m-0"')?>
			</div>						
			
			<div id="bottom-header-page" class="clearfix ui-corner-bottom">
				<!--menu page-->
				<div id="menu-page" class="left">
					<ul>
						<li><a href="javascript:void(0);" id="menu-page-profil" data-content-id="content-profil" class="grey fs-16 ui-corner-bl">Profil</a></li>						
						<li><a href="javascript:void(0);" id="menu-page-concert" data-content-id="content-concert" class="grey fs-16">Concerts</a></li>						
						<?php if($user_group_page == 'artist') { ?>
						<li><a href="javascript:void(0);" id="menu-page-sound" data-content-id="content-sound" class="grey fs-16">Sons</a></li>						
						<?php } ?>
						<li><a href="javascript:void(0);" id="menu-page-video" data-content-id="content-video" class="grey fs-16">Vidéos</a></li>						
						<li><a href="javascript:void(0);" id="menu-page-photo" data-content-id="content-photo" class="grey fs-16">Photos</a></li>						
					</ul>
				</div>
				
				<!--action page-->
				<div id="action-page" class="right">
				<?php if($user_state == 1){ ?>
					<div id="dropdown-plus" class="wrapper-dropdown">
						<div><span class="fs-16 title">Plus</span></div>
						<ul class="dropdown ui-corner-all">
							<li><a href="javascript:void(0);" id="button-send-msg" data-email-to="<?=$user_page['email']?>"><span aria-hidden="true" class="fs-14 icon-mail-3 mr-10"></span>Envoyer message</a></li>
							<li><a href="javascript:void(0);" id="button-add-contact"><span aria-hidden="true" class="fs-14 icon-plus mr-10"></span>Ajouter à mes contacts</a></li>				
						</ul>
					</div>				
				<?php } else if($user_state == 2){?>
					<a href="javascript:void(0);" id="button-edit-profile" class="grey fs-16 ui-corner-br">
						<span class="icon-pencil fs-14 mr-5" aria-hidden="true"></span>Modifier profil
					</a>					
				<?php } ?>
				</div>
			</div>	
			
			<!--sound player-->
			<?php if($user_group_page =='artist') { ?>
			<div id="sound-player" class="jp-player ui-corner-bottom"></div>
			<div class="jp-audio hidden">
				<div class="jp-type-playlist">
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
						<div class="jp-progress">
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
			<?php } ?>
		</header>	
		

		<!--finish mode edit-->
		<div id="finished-editing" class="ui-corner-all bs-black mb-20">
			<div class="clearfix p-10">				
				<span class="right ml-5"><button id="button-finished-editing" class="ui-dark">Modifications terminées</button></span>	
				<span class="right white fs-12 bold" style="padding:.6em 1em;">Cliquez sur la partie de votre profil que vous voulez modifier</span>
			</div>	
		</div>
		
		
		<!--contenu de la page-->
		<div id="content-page">
			
			<!--page profil-->
			<div class="clearfix bloc-page" id="content-profil">				
						
				<!--read mode-->
				<!--bloc informations-->
				<div class="ui-corner-all mb-20 bg-white bs-black">
					<?=$title_infos?>					
					<div class="p-20">
						<?php if($empty_infos) { ?>
							<p class="grey fs-15"><i>Aucune informations disponibles</i></p>							
						<?php } ?>					

						<?php foreach($infos as $info) { ?>							
							<div class="read-bloc p-10 fs-16 title grey clearfix" id="read-bloc-<?=$info['id']?>" data-val="<?=$info['val']?>">
								<div class="left ta-r bold" style="width:20%;"><?=$info['title']?></div>
								<?php if($info['type'] == 'url') { ?>
									<a href="<?=site_url($info['val'])?>" class="read-bloc-val purple db left ml-20" data-type="<?=$info['type']?>"><?=$info['val']?></a>
								<?php } else { ?>	
									<div class="read-bloc-val left ml-20" data-type="<?=$info['type']?>"><?=$info['val']?></div>
								<?php } ?>									
							</div>
							<?php if($user_state==2){ ?>
								<div class="edit-bloc p-10 fs-12 bold clearfix" id="edit-bloc-<?=$info['id']?>">
									<div class="left ta-r" style="width:20%;"><span aria-hidden="true" class="icon-pencil mr-10"></span><strong><?=$info['title']?></strong></div>
									<div class="left ml-20 edit-bloc-val"><?=(($info['val']) ? $info['val'] : $info['msg'])?></div>
									<div class="dialog-update-info" id="dialog-update-info-<?=$info['id']?>" title="<?=$info['msg']?>">										
										<div class="p-10">
											<form action="" method="get"  id="form-update-info-<?=$info['id']?>">
												<div>
													<label class="fs-12 grey bold" for="<?=$info['id']?>"><?=$info['form_label']?></label>
												</div>
												<div class="pt-10">
													<?=form_input(array('type' => $info['input_type'], 'id' => $info['id'], 'name' => $info ['id'], 'value' => $info['val'], 'class' => 'mb-5 required input'))?>
												</div>
												<div>
													<p class="fs-12 grey"><i><?=$info['form_msg']?></i></p>
												</div>
											</form>
										</div>
									</div>
								</div>											
						<?php } } ?>
					</div>
				</div>
				
				<!--bloc social links-->
				<div class="ui-corner-all mb-20 bg-white bs-black">
					<?=$title_social_links?>
					<div class="p-20">
						<?php if($empty_social_links) { ?>							
							<p class="grey fs-15"><i>Aucun liens sociaux disponibles</i></p>							
						<?php } ?>							
							<ul class="social-links">
							<?php foreach($social_links as $social_link) { ?>							
								<li class="read-bloc di ml-20" id="read-bloc-<?=$social_link['id']?>" data-val="<?=$social_link['val']?>">																	
									<a href="<?=$social_link['val']?>"><?=$social_link['logo']?></a>
									<div class="hidden read-bloc-val" data-type="<?=$social_link['type']?>"><?=$social_link['val']?></div>
								</li>							
							<?php } ?>
							</ul>							
							<?php if($user_state==2){ ?>
								<?php foreach($social_links as $social_link) { ?>
								<div class="edit-bloc p-10 fs-12 bold grey clearfix" id="edit-bloc-<?=$social_link['id']?>">
									<div class="left ta-r" style="width:20%;"><span aria-hidden="true" class="icon-pencil mr-10"></span><?=$social_link['title']?></div>									
									<div class="left ml-20 edit-bloc-val"><?=(($social_link['val']) ? $social_link['val'] : $social_link['msg'])?></div>									
									<div class="dialog-update-info" id="dialog-update-info-<?=$social_link['id']?>" title="<?=$social_link['msg']?>">										
										<div class="p-10">
											<form action="" method="get"  id="form-update-info-<?=$social_link['id']?>">
												<div>
													<label class="fs-12 grey bold" for="<?=$social_link['id']?>"><?=$social_link['form_label']?></label>
												</div>
												<div class="pt-10">
													<?=form_input(array('type' => $social_link['input_type'], 'id' => $social_link['id'], 'name' => $social_link['id'],'value' => $social_link['val'], 'class' => 'mb-5 required input'))?>
												</div>
												<div>
													<p class="fs-12 grey"><i><?=$social_link['form_msg']?></i></p>
												</div>
											</form>
										</div>
									</div>
								</div>					
						<?php } }?>
					</div>	
				</div>			
				
				<!--bloc description-->
				<div class="ui-corner-all bg-white bs-black">
					<?=$title_description?>				
					<div class="p-20">							
						<?php if(empty($description)) { ?>
							<p class="grey fs-15"><i>Aucune description disponible</i></p>														
						<?php } ?>																
						<div id="description-page">
							<?=$description?>							
						</div>
					</div>	
				</div>				
			</div>		
			
			
			<!--concert-->
			<div class="bloc-page" id="content-concert">	
				<div class="bs-black bg-white ui-corner-all">
					<div class="title-page"><?=$title_concerts?></div>					
					<?php if($nb_concerts > 0) { ?>						
						<div>
							<?=$list_concerts?>						
						</div>	
					<?php } else { ?>
						<div class="p-20">
							<p class="fs-15 grey"><i>Aucun concert à venir pour le moment</i></p>
						</div>
					<?php } ?>
					
				</div>				
			</div>
			
			
			
			<!--media-->
			<div id="media">			
				
				<!-- sound -->
				<div class="clearfix bloc-page" id="content-sound">																										
					
					<!--sound-->
					<div class="bg-white bs-black ui-corner-all mb-20">	
						<?=$title_sounds?>						
						<?php if($user_state == 2){?>
							<div class="recommendations m-10">
								<div class="title fs-16 purple">Recommendations pour ajouter de la musique</div>
								<p class="grey fs-12 bold">Afin de vous démarquer, il est important que les Scènes puissent vous écouter.</p>
								<p class="grey fs-12 bold">Ajoutez vos sons à votre profil. Pour cela, il y a deux façons de faire:</p>
								<ul style="list-style:square;margin-left:20px;">	
									<li class="purple fs-12 bold"><span class="grey">Depuis votre Ordinateur: cliquez sur J'ajoute des pistes audio, choisissez le fichiers sur votre ordinateur. Seuls les fichiers MP3 de moins de 20Mo sont acceptés.</span></li>
									<li class="purple fs-12 bold"><span class="grey">Depuis votre compte Soundcloud: cliquez sur J'ajoute un compte Souncloud, entrez vos informations Soundcloud.</span></li>
								</ul>	
								<p class="grey fs-12 bold">Rappelez-vous, les profils les plus visités restent ceux qui ont le plus de contenu.</p> 
							</div>
						<?php } ?>
						<!--all sound-->
						<div id="sound">
							<ul class="sound-menu clearfix">								
								<li class="active" data-content-id="#sound-tracks">Pistes (<span id="count-tracks"><?=$sound['count_tracks']?></span>)</li>								
							</ul>
							
							<!--tracks-->
							<div class="sound-content active" id="sound-tracks">																	
								<?php if($user_state == 2){?>									
									<div class="wrap-button-action p-10">								
										<div><button id="button-add-sound">J'ajoute des pistes audio</button></div>								
									</div>																
								<?php }?>
								<?php if($user_state != 2 && $sound['count_tracks'] == 0){ ?>
									<div class="p-20">
										<?=$sound['tracks']?>
									</div>
								<?php } else { ?>	
									<div id="tracks-list">
										<ul class="tracks">
											<?=$sound['tracks']?>
										</ul>	
									</div>	
								<?php } ?>	
							</div>	
							
							<!--albums-->
							
							
							
							
							<!--playlists-->
							
						</div>
					</div>
					
					<!--soundcloud-->
					<div class="bg-white bs-black ui-corner-all">	
						<?=$title_soundcloud?>
						<?php if($user_state == 2){?>									
							<div class="wrap-button-action p-10">								
								<div><button id="button-add-sc">J'ajoute un compte Soundcloud</button></div>								
							</div>							
						<?php }?>	
						<div id="soundcloud">
							<?=$sc_sounds?>
						</div>
					</div>				
				</div>	
				
				<!--vidéo-->
				<div class="clearfix bloc-page" id="content-video">									
					<!--youtube videos-->
					<div class="ui-corner-all bg-white bs-black">
						<!--title video-->						
						<?=$title_videos?>																		
						<!--recommendations-->
						<?php if($user_state == 2){?>
							<div class="recommendations m-10">
								<p class="title purple fs-16">Recommendations pour ajouter une vidéo</p>
								<p class="grey fs-12 bold">Ajoutez vos vidéos à votre profil. Vous pouvez par exemple y mettre des vidéos de vos concerts, de vos clips, etc.</p> 
								<p class="grey fs-12 bold">Cliquez sur J'ajoute une vidéo. Copiez l'adresse du lien vidéo Youtube.</p> 
								<p class="grey fs-12 bold">Rappelez-vous, les profils les plus visités restent ceux qui ont le plus de contenu.</p>								
							</div>
						<?php } ?>	
						
						<div id="yt-medias">
							<ul class="clearfix">								
								<li data-content-id="#yt-videos">Vidéos (<span id="count-video"><?=$videos['yt_video_count']?></span>)</li>
								<li data-content-id="#yt-feeds">Flux (<span id="count-feed"><?=$videos['yt_feed_count']?></span>)</li>
							</ul>
							<div>
								<!--yt videos-->
								<div id="yt-videos">
									<?php if($user_state == 2){?>									
										<div class="wrap-button-action p-10">								
											<div><button id="button-add-yt-video">J'ajoute une vidéo</button></div>								
										</div>												
										<div id="dialog-add-yt-video" title="Ajouter une vidéo Youtube">										
											<p class="mt-5 grey bold fs-12">Saisir l'url de votre vidéo Youtube.</p>
											<div class="p-10">
												<form action="" method="get" id="form-add-yt-video">
													<div class="pt-5 pb-10">														
														<?=form_input(array('id'=>'id-yt-video', 'data-type' => 'video', 'name'=>'id-yt-video', 'class' => 'ml-5 required input ui-corner-all', 'style' => 'width:90%;'))?>			
													</div>
													<div><p class="grey fs-12"><i>Ex: https://www.youtube.com/watch?v=Mr4hGHC3o1A</i></p></div>												
												<?=form_close()?>
											</div>
										</div>
									<?php }?>									
									<div id="yt-videos-list">
										<?php if(($user_state != 2) && ($videos['yt_video_count'] == 0)) { ?>
											<div class="p-20">												
												<p class="fs-15 grey"><i>Aucune vidéo enregistré</i></p>
											</div>	
										<?php } else { ?>										
											<?=$videos['yt_videos']?>
										<?php } ?>
									</div>	
								</div>	
								
								<!--yt-flux-->
								<div id="yt-feeds">
									<?php if($user_state == 2){?>
										<div class="wrap-button-action p-10">
											<div><button id="button-add-yt-flux">J'ajoute un flux de vidéos</button></div>
										</div>
										<div id="dialog-add-yt-flux" title="Ajouter un utilisateur Youtube">										
											<p class="mt-5 grey bold fs-12">Saisir le nom d'utilisateur situé dans l'url de la page Youtube.</p>												
											<div class="p-10">												
												<form action="" method="get" id="form-add-yt-flux">												
													<div class="pt-5 pb-10">
														<label class="fs-12 purple bold" for="id-yt-flux">http://www.youtube.com/user/</label>													
														<?=form_input(array('id'=>'id-yt-flux', 'data-type' => 'feed', 'name'=>'id-yt-flux', 'class' => 'required input ui-corner-all'))?>
													</div>
													<div><p class="grey fs-12"><i>Ex: http://www.youtube.com/user/iamdieudo</i></p></div>
												<?=form_close()?>
											</div>
										</div>
									<?php } ?>
									<div id="yt-feeds-list">
										<?php if(($user_state != 2) && ($videos['yt_feed_count'] == 0)) { ?>
											<div class="p-20">
												<p class="fs-15 grey"><i>Aucun flux enregistré</i></p>
											</div>	
										<?php } else { ?>										
											<?=$videos['yt_feeds']?>
										<?php } ?>
									</div>	
								</div>	
							</div>	
						</div>
					</div>
				</div>	
				
				<!--photo-->
				<div class="clearfix bloc-page" id="content-photo">
					<!--<div class="bloc ui-corner-all mb-20 bg-white bs-black">
						<!--title photos--
						<?=$title_photos?>
						
						<!--dialog import album photo--
						<?php if($user_state==2) { ?>
							<div class="wrap-button-action p-10">
								<div><button id="button-add-photo">J'ajoute des photos</button></div>
							</div>								
						<?php } ?>
							
						<!--albums photos--
						<div id="albums-photos" class="clearfix">
							<?=$albums_photos?>
						</div>
					</div>-->				
					
					
					<!--picasa web photos-->
					<div class="bloc ui-corner-all bg-white bs-black mb-20">
						<!--title picasa photos-->
						<?=$photos['pi_title']?>
						
						<?php if($user_state == 2){?>								
							<!--recommendations-->						
							<div class="recommendations m-10">
								<p class="title purple fs-16">Recommendations pour ajouter des photos</p>
								<p class="grey fs-12 bold">Ajoutez vos photos à votre profil. Vous pouvez par exemple y mettre des photos de votre groupe, de vos concerts, etc.</p>
								<p class="grey fs-12 bold">Cliquez sur J'ajoute un compte Picasa. Entrez l'adresse mail de votre compte Picasa.</p> 
								<p class="grey fs-12 bold">Rappelez-vous, les profils les plus visités restent ceux qui ont le plus de contenu.</p>
							</div>					
						
							<div class="wrap-button-action p-10">										
								<div><button id="button-add-pi">J'ajoute un compte Picasa</button></div>								
							</div>		
							
							<!--dialog add picasa user-->
							<div id="dialog-add-pi" title="Ajouter un compte picasa">								
								<div class="p-10">
									<form action="" method="get" id="form-add-pi-user">
									<div><label class="fs-12 grey bold" for="id-pi-user">Saisir l'adresse mail de votre compte Picasa</label></div>
									<div class="pt-10"><?=form_input(array('id'=>'id-pi-user', 'data-type' => 'user', 'name'=>'id-pi-user', 'type' => 'email', 'class' => 'required input input-text w-1 ui-corner-all', 'style' => 'width:90%;'))?></div>
									<div><p class="fs-12 grey"><i>Ex : b-onstage@gmail.com</i></p></div>
									<?=form_close()?>
								</div>
							</div>				
						<?php } ?>	
						
						<!--user picasa-->
						<?php if(($user_state != 2) && ($photos['pi_users_count'] == 0)) { ?>
							<div class="p-20">
								<p class="fs-15 grey"><i>Aucun compte picasa enregistré</i></p>
							</div>	
						<?php } else { ?>										
							<div id="pi-photos" class="clearfix">						
								<?=$photos['pi_photos']?>
							</div>
						<?php } ?>	
					</div>

					
					
					
					<!--instagram--
					<div class="bloc ui-corner-all bg-white bs-black mb-20">
						<!--title instagram--
						<?=$title_in_photos?>
						<?php if($user_state == 2){?>		
							<div class="wrap-button-action p-10">								
								<div><button id="button-add-in">J'ajoute un compte Instagram</button></div>								
							</div>		
						<?php } ?>
					</div>-->
					
					<!--flicker--
					<div class="bloc ui-corner-all bg-white bs-black">
						<!--title instagram--
						<?=$title_fl_photos?>
						<?php if($user_state == 2){?>		
							<div class="wrap-button-action p-10">								
								<div><button id="button-add-fl">J'ajoute un compte Flickr</button></div>								
							</div>		
						<?php } ?>
					</div>-->
				</div>			
			</div>
			
		</div>
	</div>
	
	
	<!--sidebar page-->
	<div id="sidebar" class="grid_3">		
		<div class="bg-white ui-corner-all bs-black mb-20">
			<div class="title white fs-16 p-10 ui-corner-top" style="border-bottom:1px solid #eaeaea;background-color:#3a3a3a;">Suivez b-onstage</div>
			<ul id="social-followers">
				<li>
					<a href="<?=$twitter['link']?>">
						<div>
							<span aria-hidden="true" class="icon-twitter fs-32"></span>						
							<span class="ml-20 fs-36 title purple"><?=$twitter['followers']?></span>
						</div>						
						<div class="fs-10 grey-2 bold">Twitter Followers</div>											
					</a>
				</li>
				<li>	
					<a href="<?=$facebook['link']?>">
						<div>
							<span aria-hidden="true" class="icon-facebook fs-32"></span>						
							<span class="ml-20 fs-36 title purple"><?=$facebook['likes']?></span>
						</div>						
						<div class="fs-10 grey-2 bold">Facebook Fans</div>
					</a>
				</li>
				<li>	
					<a href="<?=$google_plus['link']?>">
						<div>
							<span aria-hidden="true" class="icon-google-plus fs-32"></span>						
							<span class="ml-20 fs-36 title purple">0</span>
						</div>						
						<div class="fs-10 grey-2 bold">Google + Followers</div>
					</a>	
				</li>
			</ul>
		</div>			
		
		<div id="social-tabs" class="bg-white ui-corner-all bs-black mb-20">
			<ul class="clearfix" class="tabs-menu">
				<li id="tabs-menu-twitter" data-content-id="tabs-content-twitter" class="ui-corner-tl active"><span aria-hidden="true" class="icon-twitter fs-24"></span></li>
				<li id="tabs-menu-facebook" data-content-id="tabs-content-facebook"><span aria-hidden="true" class="icon-facebook fs-24"></span></li>
				<li id="tabs-menu-google-plus" data-content-id="tabs-content-google-plus"><span aria-hidden="true" class="icon-google-plus-2 fs-24"></span></li>
			</ul>
			<div class="bg-white p-10">
				<!--twitter-->
				<div id="tabs-content-twitter" class="tabs-content">					
					<p class="grey fs-16 title">Suivre <a href="<?=$twitter['link']?>" class="purple">b-onstage</a> sur Twitter</p>
					<!--display tweets-->
					<ul id="tweets-list">
					<?php foreach($twitter['tweets'] as $tweet) { ?>
						<li>							
							<p class="grey-2 fs-12">
								<a href="https://twitter.com/<?=$tweet->user->screen_name?>" class="bold">
									<span class="grey"><?=$tweet->user->name?></span>										
									<span class="purple">@<?=$tweet->user->screen_name?> :</span>
								</a>							
								<?=$tweet->text?>
							</p>
						</li>							
					<? } ?>	
					</ul>
				</div>
				
				<div id="tabs-content-facebook" class="tabs-content">
					<p class="grey fs-16 title">Suivre <a href="<?=$facebook['link']?>" class="purple">b-onstage</a> sur Facebook</p>
				</div>
				
				<!--google plus-->
				<div id="tabs-content-google-plus" class="tabs-content">				
					<p class="grey fs-16 title">Suivre <a href="<?=$google_plus['link']?>" class="purple">b-onstage</a> sur Google+</p>
					<div class="g-plus" data-width="200" data-href="https://plus.google.com/111325374571248434709" data-rel="publisher"></div>					
					<script type="text/javascript">
						window.___gcfg = {lang: 'fr'};
						(function() {
							var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							po.src = 'https://apis.google.com/js/plusone.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						})();
					</script>
				</div>
				<!--facebook-->				
			</div>
		</div>		
	</div>	
</div>

<!--jPlayer-->
<link rel="stylesheet" href="<?=site_url('js/jplayer/skin/blue/jplayer.blue.css')?>" type="text/css" media="screen" />

<!--fancybox-->
<link rel="stylesheet" href="<?=site_url('js/fancybox/source/jquery.fancybox.css?v=2.0.6')?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=site_url('js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2')?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=site_url('js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=2.0.6')?>" type="text/css" media="screen" />

<!--redactor-->
<link rel="stylesheet" href="<?=site_url('js/redactor/redactor.css')?>" type="text/css" media="screen" />

<!--jcrop-->
<link rel="stylesheet" href="<?=site_url('js/jcrop/jquery.Jcrop.min.css')?>" type="text/css" media="screen" />

<script type="text/javascript">
var user_id = <?=$user_page['id']?>;
var user_state = <?=$user_state?>;
var user_group = '<?=$user_group_page?>';	
var active_menu_page = '<?=$active_menu_page?>';
</script>