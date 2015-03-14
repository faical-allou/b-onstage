<?php include_once("analyticstracking.php") ?>
<?php 
//Include config lang
foreach($this->config->item('lang_counts') as $key => $value){
if($this->session->userdata('lang_loaded') == $value["name"]){ $lang_id = $value["id"];}
}
?><!DOCTYPE html>
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
	<style>@import url(/css/720.min.css) (max-width:800px);</style>

        <style>@import url(/css/960.css) (min-width:960px) and (max-width:1199px);</style>
	<style>@import url(/css/1200.min.css) (min-width:1200px);</style>

        
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
	  js.src = "//connect.facebook.net/<?php echo $lang_id."_".strtoupper($lang_id) ?>/all.js#xfbml=1&appId=405185392913953";
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
			<!--<div id="top_lang_bar"><?php 
			// english link : lang loaded is french
			if($this->session->userdata('lang_loaded') == "french") { 
				$lang_switch_top_link ="english";
				$lang_switch_top_txt ="English";
				?><a class="top_lang_bar_link" href='/langswitch/switchLanguage/english'>english</a><?php  }
			// french link : lang loaded is english
			else { 
				$lang_switch_top_link ="french";
				$lang_switch_top_txt ="Français";
				?><a class="top_lang_bar_link" href='/langswitch/switchLanguage/french'>français</a><?php }
			?></div>-->
            <div class="container_12">
				<div class="grid_12">
                    <!--logo-->
					<div > 
					<?=anchor(base_url(), img(site_url('img/logo.png')), array('id' => 'logo', 'class' => 'left'))?>
					</div>
					<!--menu principal-->
					<ul class="menu default left ml-10">
<!--					<li><?=anchor(base_url(), '<span aria-hidden="true" class="icon-home"></span>' , array('id' => 'menu-home'))?></li>
-->						<li><?=anchor(site_url('concerts/oujouer'), lang("header_book_date") , array('id' => 'menu-concert'))?></li>
<!--					<li><?=anchor(site_url('concerts/programmation'), lang("shows"), array('id' => 'menu-programmation'))?></li>
-->						<li><?=anchor(site_url('stages'), lang("scenes"), array('id' => 'menu-stage'))?></li>
						<li><?=anchor(site_url('artists'), lang("artists") , array('id' => 'menu-artist'))?></li>
						<li><?=anchor(site_url('about'), lang("header_aboutus") , array('id' => 'menu-about'))?></li>
					</ul>
					<!--account menu-->
					<?php if(empty($user)) { ?>
					<ul class="menu right">
						<li><?=anchor(site_url('signup'), lang("signup"), array('id' => 'menu-signup'))?></li>
						<li><?=anchor(site_url('login'), lang("login"), array('id' => 'menu-signin'))?></li>
                        <li><a href="/langswitch/switchLanguage/<?php echo $lang_switch_top_link ?>"><?php 
							echo $lang_switch_top_txt ?></a></li>
					</ul>
					<?php } else { ?>
					<ul class="profil-menu right">																		
                        <li>
							<div id="dropdown-notification" class="wrapper-dropdown ui-corner-all priority-<?=$notifications['topPriority']?>">
								<div class="fs-16 title"><?=$notifications['nbUnread']?></div>
								<ul class="dropdown">
									<li><a href="<?=site_url('user/notifications')?>" class="purple title fs-16"><?php echo lang("header_seeall_notices") ?></a></li>
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
										
											<?php 
											// no link and no notif image
											if(empty($notification['avatar']) && empty($notification['link'])){
												?><li style="cursor:default"><div class="p-20 
														<?=$class?>">
                                                   <span class="fs-12 grey bold ml-10"><?=$notification['description']?></span>
												</div></li><?php
                                                }
											
											// normal notif (w/ image and link)
											else {
													?><li><div onclick="window.open('<?=$notification['link']?>','_SELF');" class="p-20 
														<?=$class?>">												
													<img src="<?=site_url($notification['avatar'])?>" width="48px" 
                                                    	class="ui-corner-all" />
													<span class="fs-12 grey bold ml-10"><?=$notification['description']?></span>
												</div></li><?php
												}
											?>										
										
									<?php } ?>									
								</ul>
							</div>
						</li>
						<li class="ml-5">
							<div id="dropdown-username" class="wrapper-dropdown ui-corner-all">
								<div><?php
                                if(isset($terminate_avatar)){
									echo img(array('src' => site_url($terminate_avatar.'?'.time()),'class' => 'ui-corner-all db left','width' => '34px')); }
								else{
									echo img(array('src' => site_url($user['avatar'].'?'.time()),'class' => 'ui-corner-all db left','width' => '34px')); }
								?><span class="ml-5 fs-16 title"><?=$user['username']?></span></div>
								<ul class="dropdown">
									<li><?=anchor(site_url('user'),'<span aria-hidden="true" class=" fs-14 icon-cog mr-10"></span>'.lang("header_myaccount"), array('class' => 'ui-corner-top'))?></li>
									<?php if($user_group == 'stage') { ?>
										<li><?=anchor(site_url('user/calendar'),'<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>'.lang("header_mycalendar"))?></li>
									<?php } else { ?>
										<li><?=anchor(site_url('user/reservations'),'<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>'.lang("header_mybookings"))?></li>
									<?php } ?>									
									<li><?=anchor($user_link,'<span aria-hidden="true" class="fs-14 icon-user mr-10"></span>'.lang("header_myprofile"))?></li>		
									<li><?=anchor(site_url('user/contact'),'<span aria-hidden="true" class="fs-14 icon-plus mr-10"></span>'.lang("header_mycontacts"))?></li>		
									<li><?=anchor(site_url('logout'),'<span aria-hidden="true" class="fs-14 icon-exit mr-10"></span>'.lang("logout"), array('class' => 'ui-corner-bottom'))?></li>
								</ul>
							</div>
						</li>	
						<!--<li><a href="#notifications-list" id="menu-notification" class="ui-corner-all priority-<?=$notifications['topPriority']?>"><?=$notifications['nbUnread']?></a></li>-->
						
						<li class="ml-5"><div onMouseOver="logged_lan_lnk.style.color='#8e2c86'" 
                                          onMouseOut="logged_lan_lnk.style.color='#fff'"
                                          onClick="window.location.href = '/langswitch/switchLanguage/<?php 
										  	echo $lang_switch_top_link ?>'" 
                                              id="top_lang_bar_logged" class="ui-corner-all"><a 
                                           id="logged_lan_lnk" class="fs-16 title" 
                                           href="/langswitch/switchLanguage/<?php echo $lang_switch_top_link ?>"><?php
							echo $lang_switch_top_txt ?></a></div></li>
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
				<div class="grid_12 mb-10 mt-10 ta-r">
					<form action="/concerts" method="post">
						<!--search status-->
<!--						<span>
							<select name="search-status" id="search-status" multiple="multiple">
								<option value="open" <?=($search['search-status']=='open') ? 'selected' : ''?>><?php echo lang("header_book_a_date") ?></option>
								<option value="close" <?=($search['search-status']=='close') ? 'selected' : ''?>><?php echo lang("header_attend_show") ?></option>
							</select>
-->						</span>
						<span class="fs-16 grey bold ml-2 mr-2"><?php echo lang("search_from") ?></span>
						<!--date range -->
						<div id="wrapper-date-start" class="wrapper-search-date bg-white ui-corner-all">
							<input class="ui-corner-left" type="text" size="8" maxlength="10" name="render-date-start" id="render-date-start" readonly value="<?=date('d/m/Y', strtotime($search['search-date-start']))?>" />
							<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>
							<input type="hidden" name="search-date-start" id="search-date-start" value="<?=$search['search-date-start']?>" />
						</div>
						<span class="fs-16 grey bold ml-2 mr-2"><?php echo lang("to") ?></span>
						<div id="wrapper-date-end" class="wrapper-search-date bg-white ui-corner-all">
							<input class="ui-corner-left" type="text" size="8" maxlength="10" name="render-date-end" id="render-date-end" readonly value="<?=date('d/m/Y', strtotime($search['search-date-end']))?>" />
							<span aria-hidden="true" class="fs-14 icon-calendar mr-10"></span>
							<input type="hidden" name="search-date-end" id="search-date-end" value="<?=$search['search-date-end']?>" />
						</div>

						<!--search city-->
						<span class="fs-16 grey bold ml-2 mr-2"><?php echo lang("where") ?></span>
						
						
						<span>
							<select name="search-country[]" id="search-country" multiple="multiple">
								<?php
								foreach($countries as $country){
								?>
									<option value="<?=$country['country']?>"<?php 
										if(isset($search['search-country']) && $search['search-country'] == $country['country']) { 
										?> selected<?php 
										} 
										?>><?=$country['country']?></option>
								<?php } ?>
							</select>
                            
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
									<!--<option value="<?=$city['city']?>"><?=$city['city']?></option>-->
								<?php } ?>
							</select>
                            <?php if (isset($search['search-country'])){
							?><input type="hidden" id="currentcountry" value="<?php echo $search['search-country'] ?>"><?php 
							} ?> 
                            <?php 
							foreach($city_by_country as $city_by_countries){
								if(isset($search['search-city'])) {
									if (strpos($search['search-city'],$city_by_countries['city']) === false) {
										echo "<div id=\"".$city_by_countries['country']."\" class=\"".$city_by_countries['country']."\" style=\"display:none\">".$city_by_countries['city']."</div>";
										}
									else {
										echo "<div id=\"".$city_by_countries['country']."\" class=\"xxx".$city_by_countries['country']."\" style=\"display:none\">".$city_by_countries['city']."</div>";
										}	
									
								}
								else {
									echo "<div id=\"".$city_by_countries['country']."\" class=\"".$city_by_countries['country']."\" style=\"display:none\">".$city_by_countries['city']."</div>";
								}
							}
							?>
                            
						</span>
						
						<span>
							<button id="button-search-concert" class="ui-dark"><span aria-hidden="true" class="fs-10 bold icon-search"></span></button>
						</span>
					</form>
				</div>
			</div>
