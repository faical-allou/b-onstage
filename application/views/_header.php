<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?=$title?></title>
	<meta name="description" content="<?=$description?>">	
	<meta name="viewport" content="width = device-width, initial-scale = 1.0" />
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<!--css-->
	<?=link_tag(site_url('css/default/jquery-ui-1.9.0.custom.css'), 'stylesheet')?>
	<?=link_tag(site_url('js/chosen/chosen.css'), 'stylesheet')?>		
	<?=link_tag(site_url('js/selectbox/jquery.selectBox.css'), 'stylesheet')?>
	<?=link_tag(site_url('js/royalslider/royalslider.css'), 'stylesheet')?>
	<?=link_tag(site_url('js/royalslider/skins/black/rs-black.css'), 'stylesheet')?>
	<?=link_tag(site_url('css/normalize.css'), 'stylesheet')?>
	<?=link_tag(site_url('css/main.css'), 'stylesheet')?>
	<style>@import url(/css/960.min.css) (max-width:1279px);</style>
	<style>@import url(/css/1200.min.css) (min-width:1280px);</style>
	
	<!--jquery, jquery ui-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="<?=site_url('js/jquery-ui-1.9.0.custom.min.js')?>"></script>
	<script src="<?=site_url('js/vendor/modernizr-2.6.2.min.js')?>"></script>
	
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Open+Sans+Condensed:700:latin' ] }
		};
		(function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>	
	
	<script>
		var searchDateStart = <?=(isset($search['search-date-start'])) ? "'".$search['search-date-start']."'" : 'null'?>;
		var searchDateEnd	= <?=(isset($search['search-date-end'])) ? "'".$search['search-date-end']."'"	: 'null'?>;
	</script>

</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=405185392913953";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<!--servor message-->
	<div id="w-servor-message">
		<div id="servor-message" class="fs-18 title white ui-corner-all bs-black"></div>
	</div>

	<!--header-->
	<div id="header">
		<!--menu principal-->
		<div id="w-menu">
			<div class="container_12">
				<div class="grid_12">
					<!--logo-->
					<?=anchor(base_url(), img(site_url('img/logo.png')), array('id' => 'logo', 'class' => 'left'))?>
					<!--menu principal-->
					<ul class="menu default left ml-30">
						<li><?=anchor(base_url(), '<span aria-hidden="true" class="icon-home"></span>' , array('id' => 'menu-home'))?></li>
						<li><?=anchor(site_url('concerts/oujouer'), 'Réserver date' , array('id' => 'menu-concert'))?></li>
						<li><?=anchor(site_url('concerts/programmation'), 'Concerts' , array('id' => 'menu-programmation'))?></li>
						<li><?=anchor(site_url('stages'), 'Scènes', array('id' => 'menu-stage'))?></li>
						<li><?=anchor(site_url('artists'), 'Artistes' , array('id' => 'menu-artist'))?></li>
						<li><?=anchor(site_url('about'), 'A propos' , array('id' => 'menu-about'))?></li>
					</ul>
					<!--account menu-->
					<?php if(empty($user)) { ?>
					<ul class="menu right">
						<li><?=anchor(site_url('signup_choice'), 'S\'inscrire', array('id' => 'menu-signup'))?></li>
						<li><?=anchor(site_url('login'), 'Se connecter', array('id' => 'menu-signin'))?></li>
					</ul>
					<?php } else { ?>
					<ul class="profil-menu right">																		
						<li>
							<div id="dropdown-notification" class="wrapper-dropdown ui-corner-all priority-<?=$notifications['topPriority']?>">
								<div class="fs-16 title"><?=$notifications['nbUnread']?></div>
								<ul class="dropdown">
									<li><a href="<?=site_url('user/notifications')?>" class="purple title fs-16">Voir toutes les notifications</a></li>
									<?php foreach ($notifications['notifications'] as $notification) {
										switch ($notification['priority']) {
											case 1:
												$class='priority-1';
												break;
											case 2:
												$class='priority-2';
												break;
											default:
												$class='priority-3';
												break;
										}
										$class .= $notification['read'] ? ' read' : ' unread';
									?>
										<li>
											<div onclick="window.open('<?=$notification['link']?>','_SELF');" class="p-20 <?=$class?>">												
												<img src="<?=site_url($notification['avatar'])?>" width="48px" class="ui-corner-all" />
												<span class="fs-12 grey bold ml-10"><?=$notification['description']?></span>
											</div>										
										</li>
									<?php } ?>									
								</ul>
							</div>
						</li>
						<li class="ml-5">
							<div id="dropdown-username" class="wrapper-dropdown ui-corner-all">
								<div><?=img(array('src' => site_url($user['avatar'].'?'.time()),'class' => 'ui-corner-all db left','width' => '34px'))?><span class="ml-5 fs-16 title"><?=$user['username']?></span></div>
								<ul class="dropdown">
									<li><?=anchor(site_url('user'),'<span aria-hidden="true" class=" fs-14 icon-cog mr-10"></span>Mon compte', array('class' => 'ui-corner-top'))?></li>
									<?php if($user_group == 'stage') { ?>
										<li><?=anchor(site_url('user/calendar'),'<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>Mon calendrier')?></li>
									<?php } else { ?>
										<li><?=anchor(site_url('user/reservations'),'<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>Mes réservations')?></li>
									<?php } ?>									
									<li><?=anchor($user_link,'<span aria-hidden="true" class="fs-14 icon-user mr-10"></span>Mon profil')?></li>		
									<li><?=anchor(site_url('user/contact'),'<span aria-hidden="true" class="fs-14 icon-plus mr-10"></span>Mes contacts')?></li>		
									<li><?=anchor(site_url('logout'),'<span aria-hidden="true" class="fs-14 icon-exit mr-10"></span>Se déconnecter', array('class' => 'ui-corner-bottom'))?></li>
								</ul>
							</div>
						</li>	
						<!--<li><a href="#notifications-list" id="menu-notification" class="ui-corner-all priority-<?=$notifications['topPriority']?>"><?=$notifications['nbUnread']?></a></li>-->
						
					</ul>
					<?php } ?>					
				</div>
			</div>
		</div>
	</div>	
	
	<div id="container">
		<div class="loading">
			<img src="<?=site_url('img/loading.gif')?>" />
		</div>
		<div class="content">
			<!--search bar-->
			<div id="search-bar" class="container_12">
				<div class="grid_12 mb-20 mt-20">
					<form action="/concerts" method="post">
						<!--search status-->
						<span>
							<select name="search-status" id="search-status" multiple="multiple">
								<option value="open" <?=($search['search-status']=='open') ? 'selected' : ''?>>Réservez une Date</option>
								<option value="close" <?=($search['search-status']=='close') ? 'selected' : ''?>>Assister à un Concert</option>
							</select>
						</span>
						<span class="fs-16 grey bold ml-2 mr-2">du</span>
						<!--date range -->
						<div id="wrapper-date-start" class="wrapper-search-date bg-white ui-corner-all">
							<input class="ui-corner-left" type="text" size="8" maxlength="10" name="render-date-start" id="render-date-start" readonly="readonly" value="<?=date('d/m/Y', strtotime($search['search-date-start']))?>" />
							<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>
							<input type="hidden" name="search-date-start" id="search-date-start" value="<?=$search['search-date-start']?>" />
						</div>
						<span class="fs-16 grey bold ml-2 mr-2">au</span>
						<div id="wrapper-date-end" class="wrapper-search-date bg-white ui-corner-all">
							<input class="ui-corner-left" type="text" size="8" maxlength="10" name="render-date-end" id="render-date-end" readonly="readonly" value="<?=date('d/m/Y', strtotime($search['search-date-end']))?>" />
							<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>
							<input type="hidden" name="search-date-end" id="search-date-end" value="<?=$search['search-date-end']?>" />
						</div>
						<!--search city-->
						<span class="fs-16 grey bold ml-2 mr-2">à</span>
						<span>
							<select name="search-city[]" id="search-city" multiple="multiple">
								<?php if(isset($search['search-city'])) {
									$tab = explode(',', $search['search-city']);
									foreach($tab as $city){ ?>
									<option value="<?=$city?>" selected><?=$city?></option>
								<?php
								}
								}
								foreach($cities as $city){
									if(empty($city['city']) or @in_array($city['city'],$tab)) continue;
								?>
									<option value="<?=$city['city']?>"><?=$city['city']?></option>
								<?php } ?>
							</select>
						</span>
						<span>
							<button id="button-search-concert" class="ui-dark"><span aria-hidden="true" class="fs-16 icon-search"></span></button>
						</span>
					</form>
				</div>
			</div>