<div class="container_12">	
	<div class="grid_9 bg-white bs-black ui-corner-all mb-20">
		<div class="p-10">
			<h2 class="fs-24 title purple pl-20">Paramètres généraux</h2>
			<div class="p-20 mb-20">			
				<!--email-->
				<div class="account-line fs-12 grey">			
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold">Adresse électronique</span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user['email']?></span>
							<a href="javascript:void(0)" class="purple bold">Modifier</a>					
						</div>	
					</div>	
				</div>
				<!--username-->		
				<div class="account-line fs-12 grey">
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold pl-2">Nom d'utilisateur</span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user['username']?></span>
							<a id="show-form-update-username" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-username">Modifier</a>
						</div>
					</div>	
					<div id="wrap-form-update-username" class="wrap-form p-20">
						<form id="form-update-username" data-button-show-id="#show-form-update-username">
							<div>
								<div class="mb-5"><?=form_label($label_username, $input_username['id'], $attrs_label)?></div>
								<div class="mb-10">
									<?=form_input($input_username)?>
									<span id="username-error"></span>
								</div>
								<div class="mb-10"><?=form_submit('submit-username', 'valider')?></div>																				
							</div>	
						</form>	
					</div>	
				</div>
				<!--password-->
				<div class="account-line fs-12 grey">		
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold pl-2">Mot de passe</span>
						</div>
						<div class="right">				
							<a id="show-form-update-password" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-password">Modifier</a>
						</div>	
					</div>	
					<div id="wrap-form-update-password" class="wrap-form p-20">
						<form id="form-update-password" data-button-show-id="#show-form-update-password">
							<div>
								<div class="mb-5"><?=form_label($label_old_password, $old_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($old_password)?></div>
								<div class="mb-5"><?=form_label($label_new_password, $new_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($new_password)?></div>
								<div class="mb-5"><?=form_label($label_new_confirm_password, $new_confirm_password['id'], $attrs_label)?></div>
								<div class="mb-10"><?=form_password($new_confirm_password)?></div>
								<div class="mb-10"><?=form_submit('submit-password', 'valider')?></div>													
								<div id="password-error"></div>
							</div>	
						</form>	
					</div>	
				</div>
				<!--company-->
				<div class="account-line fs-12 grey">
					<div class="clearfix mb-10">							
						<?php if($user_group == 'artist'){ ?>
						<div class="left">
							<span class="bold">Nom du groupe / artiste</span>
						</div>
						<?php }else{ ?>
						<div class="left">
							<span class="bold">Nom de la scène / bar</span>
						</div>	
						<?php }?>
						<div class="right">
							<span class="bold mr-20">
							<?php if($user_group == 'artist'){ ?>
								<?=(empty($user['company']) ? '<i class="red">Aucun nom de groupe / artiste enregistré</i>' : $user['company'])?>
							<?php }else{ ?>
								<?=(empty($user['company']) ? '<i class="red">Aucun nom de scène enregistré</i>' : $user['company'])?>
							<?php }?>
							</span>
							<a id="show-form-update-company" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-company">Modifier</a>
						</div>	
					</div>
					<div id="wrap-form-update-company" class="wrap-form p-20">
						<form id="form-update-company" data-button-show-id="#show-form-update-company">
							<div>
								<div class="mb-5"><?=form_label($label_company, $input_company['id'], $attrs_label)?></div>
								<div class="mb-10">
									<?=form_input($input_company)?>
									<span id="company-error"></span>
								</div>											
								<div class="mb-10"><?=form_submit('submit-company', 'valider')?></div>																				
							</div>	
						</form>	
					</div>									
				</div>
				<!--url page profil-->
				<div class="account-line fs-12 grey">			
					<div class="clearfix mb-10">
						<div class="left">
							<span class="bold">Url page profil</span>
						</div>
						<div class="right">
							<span class="bold mr-20"><?=$user_link?></span>
							<a id="show-form-update-url-profil" href="javascript:void(0)" class="show-form purple bold" data-show-id="#wrap-form-update-url-profil">Modifier</a>							
						</div>	
					</div>	
					<div id="wrap-form-update-url-profil" class="wrap-form p-20">
						<form id="form-update-url-profil" data-button-show-id="#show-form-update-url-profil">
							<div>
								<div class="mb-10"><label class="fs-12 grey bold"><?=$label_url_profil?></label></div>
								<div class="mb-10">
									<label><?=form_label($label_prefix_url_profil, $input_url_profil['id'], $attrs_label)?></label> 
									<?=form_input($input_url_profil)?>
									<span id="url-profil-error"></span>	
								</div>											
								<div class="mb-10"><?=form_submit('submit-url-profil', 'valider')?></div>													
							</div>	
						</form>	
					</div>
				</div>
			</div>
			
			
			<h2 class="purple fs-24 title pl-20 pr-20">Mes coordonnées</h2>			
			<div class="mb-20 p-20">										
				<!--firstname-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Prénom</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['first_name']) ? '<i class="red">Aucune prénom enregistré</i>' : $user['first_name'])?></span>						
					</div>	
				</div>
				<!--lastname-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold ">Nom</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['last_name']) ? '<i class="red">Aucun nom enregistré</i>' : $user['last_name'])?></span>						
					</div>	
				</div>
				<!--address-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Adresse</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['address']) ? '<i class="red">Aucune adresse enregistrée</i>' : $user['address'])?></span>						
					</div>	
				</div>
				<!--zip-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Code postal</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['zip']) ? '<i class="red">Aucun code postal enregistré</i>' : $user['zip'])?></span>						
					</div>	
				</div>
				<!--city-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Ville *</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['city']) ? '<i class="red">Aucune ville enregistrée</i>' : $user['city'])?></span>						
					</div>	
				</div>
				<!--country-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Pays *</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['country']) ? '<i class="red">Aucun pays renseigné</i>' : $user['country'])?></span>						
					</div>	
				</div>
				<!--téléphone-->
				<div class="account-line clearfix fs-12 grey">
					<div class="left">
						<span class="bold">Téléphone</span>
					</div>
					<div class="right">				
						<span class="bold"><?=(empty($user['phone']) ? '<i class="red">Aucun téléphone enregistré</i>' : $user['phone'])?></span>						
					</div>						
				</div>
				
				<div class="clearfix">	
					<div class="left">
						<i class="grey fs-15">(*) coordonnées visibles dans le profil.</i>						
					</div>
					<div class="right">
						<a href="<?=site_url('user/update_information')?>" class="ui-purple" id="update-information">Modifier coordonnées</a>
					</div>	
				</div>					
			</div>
		</div>
	</div>	
	
	<div id="sidebar" class="grid_3 bg-white bs-black ui-corner-all mb-20">
		<div class="p-20">
			<div class="mb-20">		
				<?=img(array('src' => site_url($user['avatar']), 'class' => 'ui-corner-all', 'width' => '100%'))?>
			</div>
			<div class="mb-20">
				<?=anchor($user_link,'Afficher mon profil', array('id' => 'show-profil', 'class'=>'ui-purple', 'style' => 'width:100%;font-size:1em;'))?>
			</div>
			<div class="recommendations">
				<p class="grey fs-12 bold">Remplissez votre profil!</p>
				<p class="grey fs-12 bold">Les profils les plus consultés sont ceux qui ont le plus de contenu...</p>
				<p class="grey fs-12 bold">...Alors, mettez des images de vous sur votre profil.</p>
				<p class="grey fs-12 bold">Pour faire leur choix, les Scènes vont vouloir vous écouter...</p>
				<p class="grey fs-12 bold">...Alors mettez votre musique.</p>
				<p class="grey fs-12 bold">Importez aussi vos photos, vos vidéos...</p>
			</div>
		</div>
	</div>
</div>