<?php 
foreach($this->config->item('lang_counts') as $key => $value){
if($this->session->userdata('lang_loaded') == $value["name"]){ $lang_id = $value["id"];}
}
//Set local time lang
setlocale(LC_TIME, $lang_id."_".strtoupper($lang_id).".UTF8");
?>

<div class="grid_3" id="sidebar">

			<div class="bg-white ui-corner-all bs-black mb-20 mt-20">

				<div class="title white fs-16 p-10 ui-corner-top" style="border-bottom:1px solid #eaeaea;background-color:#000000;"><?php echo lang("users_page_followus") ?></div>

				<ul id="social-followers">


					<li>	
						<a href="<?=$facebook['link']?>">
							<div>
								<span aria-hidden="true" class="icon-facebook fs-32"></span>						
								<span class="ml-20 fs-36 title purple"><?=$facebook['likes']?></span>
							</div>						
							<div class="fs-10 grey-2 bold"><?php echo lang("users_page_socmedfollowers2") ?></div>
						</a>
					</li>
					<li>
						<a href="<?=$twitter['link']?>">
							<div>
								<span aria-hidden="true" class="icon-twitter fs-32"></span>						
								<span class="ml-20 fs-36 title purple"><?=$twitter['followers']?></span>
							</div>						
							<div class="fs-10 grey-2 bold"><?php echo lang("users_page_socmedfollowers1") ?></div>											
						</a>
					</li>
					

				</ul>

			</div>			

			

			<div id="social-tabs" class="bg-white ui-corner-all bs-black mb-20">

				<ul class="clearfix" class="tabs-menu">
					<li id="tabs-menu-facebook" data-content-id="tabs-content-facebook"><span aria-hidden="true" class="icon-facebook fs-24"></span></li>
					<li id="tabs-menu-twitter" data-content-id="tabs-content-twitter" class="ui-corner-tl active"><span aria-hidden="true" class="icon-twitter fs-24"></span></li>
				</ul>

				<div class="bg-white p-10">
					<!--facebook-->
					<div id="tabs-content-facebook" class="tabs-content">

						<p class="grey fs-16 title"><?php echo lang("follow") ?> <a href="<?=$facebook['link']?>" class="purple">b-onstage</a> <?php echo lang("users_page_onsocmed2") ?></p>
                        <?php 
						foreach ($facebook['alldata'] as $item) {
							//Hide empty posts
							if(!empty($item['message'])){
								echo '<ul id="tweets-list"><li>
									<p class="grey-2 fs-12"><span class="purple">'.strftime('%d %B %Y @ %H:%I:%S',gmdate($item['created_time'])).' :</span>
									'.$item['message'].'
									</p>
								</li></ul>';
							}
						}
						?>
                        <div align="center" style="margin-top:20px;">
                        	<div class="fb-like" data-href="<?php echo $facebook['link'] ?>" data-width="200" data-layout="button_count" data-show-faces="true" data-send="true"></div>
                        </div>

					</div>
				
				
					<!--twitter-->

					<div id="tabs-content-twitter" class="tabs-content">					

						<p class="grey fs-16 title"><?php echo lang("follow") ?> <a href="<?=$twitter['link']?>" class="purple">b-onstage</a> <?php echo lang("users_page_onsocmed1") ?></p>

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

					</div>

					


					

<!--					<!--google plus-->

					<div id="tabs-content-google-plus" class="tabs-content">				

						<p class="grey fs-16 title">
						<?php echo lang("follow") ?> 
-->
<!--						<a href="<?=$google_plus['link']?>" class="purple">b-onstage</a>    -->
<!--
						<?php echo lang("users_page_onsocmed4") ?></p>
                        
                         <?php 
						
						foreach ($google_plus['google_plus_feed']->items as $item) {
							echo '<ul id="tweets-list"><li>
									<p class="grey-2 fs-12">
									<span class="purple">'.strftime('%d %B %Y @ %H:%I:%S',strtotime($item->published)).' : </span>'.
									$item->object->content.'</p>
	
								</li></ul>';
								//<span class="grey bold">'.$item->title.'</span>
							}
						?>

						<div align="center" style="margin-top:25px;"><div class="g-plus" data-width="170" data-href="https://plus.google.com/<?php echo $google_plus['id'] ?>" data-rel="publisher"></div></div>			

						<script type="text/javascript">
							window.___gcfg = {lang: '<?php 
							foreach($this->config->item('lang_counts') as $key => $value){
								if($this->session->userdata('lang_loaded') == $value["name"]){
									echo $value["id"];
								}
							}
							?>'};

							(function() {

								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;

								po.src = 'https://apis.google.com/js/plusone.js';

								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);

							})();

						</script>
                       </div>
-->
					<!--facebook-->
<!--
					<div id="facebook-feed">

						<div class="fb-activity" data-site="http://www.b-onstage.com" data-app-id="405185392913953" data-width="100%" data-height="300" data-header="true" data-recommendations="false"></div>

					</div>	
-->
				</div>

			</div>

		</div>