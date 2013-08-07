			<!--end content-->
			</div>
		<!--end container-->
		</div>
		<!--footer-->
		<footer id="footer">
			<div class="container_12 pt-20 pb-20">						
				<div class="grid_4">
					<dl>
						<dt class="fs-16 title">b-onstage</dt>						
						<dd><?=anchor(site_url('about'),lang("aboutus_link_aboutus"))?></dd>
						<dd><?=anchor(site_url('about_us'),lang("aboutus_link_whoweare"))?></dd>
						<dd><?=anchor(site_url('how_does_this_work'),lang("aboutus_link_howitworks"))?></dd>												
						<dd><a href="javascript:void(0)" id="contact_us"><?php echo lang("footer_contactus") ?></a></dd>
					</dl>
				</div>
				<div class="grid_4">									
					<dl>
						<dt class="title fs-16"><?php echo lang("footer_followus") ?></dt>
						<dd>
							<a href="javascript:void(0);" onclick="window.open('<?=FACEBOOK_LINK?>', '_BLANK');"><span aria-hidden="true" class="icon-facebook-2 fs-28 mr-5"></span></a>
							<a href="javascript:void(0);" onclick="window.open('<?=TWITTER_LINK?>', '_BLANK');"><span aria-hidden="true" class="icon-twitter-2 fs-28 mr-5"></span></a>
							<a href="javascript:void(0);" onclick="window.open('<?=GOOGLE_PLUS_LINK?>', '_BLANK');"><span aria-hidden="true" class="icon-google-plus fs-28 mr-5"></span></a>							
						</dd>
					</dl>	
				</div>
				<div class="grid_4">		
					<dl>
						<dt class="title fs-16"><?php echo lang("footer_legal") ?></dt>
						<dd><?=anchor(site_url('terms_of_services'),lang("footer_legal_link1"))?></dd>						
						<dd><?=anchor(site_url('legal'),lang("footer_legal_link2"))?></dd>
					</dl>
				</div>
                <div class="grid_4">		
					<dl>
						<dt class="title fs-16">Language</dt>
						<dd><a href='/langswitch/switchLanguage/english'>English</a></dd>						
						<dd><a href='/langswitch/switchLanguage/french'>Francais</a></dd>						
					</dl>
				</div>
			</div>			
			<div id="footer-bottom">
				<div class="container_12">			
					<div class="grid_12">
						<p class="fs-12 bold white"><?php echo lang("footer_copyright") ?></p>					
					</div>
				</div>
			</div>
		</footer>
		
		
        <div id="noresultfound" style="display:none"><?php echo lang("noresultfound") ?></div>
        <div id="shows_sortby3" style="display:none"><?php echo lang("shows_sortby3") ?></div>
        <div id="users_page_sons_soundcloud_delconf" style="display:none"><?php echo lang("users_page_sons_soundcloud_delconf") ?></div>
        <div id="synctxt" style="display:none"><?php echo lang("sync") ?></div>
        <div id="users_page_sons_soundcloud_syncconf" style="display:none"><?php echo lang("users_page_sons_soundcloud_syncconf") ?></div>
        <div id="users_page_sons_addtrack_success" style="display:none"><?php echo lang("users_page_sons_addtrack_success") ?></div>
        <div id="addtxt" style="display:none"><?php echo lang("add") ?></div>
        <div id="calendar_year" style="display:none"><?php echo lang("calendar_year") ?></div>
        <div id="calendar_years" style="display:none"><?php echo lang("calendar_years") ?></div>
        <div id="calendar_month" style="display:none"><?php echo lang("calendar_month") ?></div>
        <div id="calendar_months" style="display:none"><?php echo lang("calendar_months") ?></div>
        <div id="calendar_week" style="display:none"><?php echo lang("calendar_week") ?></div>
        <div id="calendar_weeks" style="display:none"><?php echo lang("calendar_weeks") ?></div>
        <div id="calendar_day" style="display:none"><?php echo lang("calendar_day") ?></div>
        <div id="calendar_days" style="display:none"><?php echo lang("calendar_days") ?></div>
        <div id="calendar_hour" style="display:none"><?php echo lang("calendar_hour") ?></div>
        <div id="calendar_hours" style="display:none"><?php echo lang("calendar_hours") ?></div>
        <div id="calendar_minute" style="display:none"><?php echo lang("calendar_minute") ?></div>
        <div id="calendar_minutes" style="display:none"><?php echo lang("calendar_minutes") ?></div>
        <div id="calendar_second" style="display:none"><?php echo lang("calendar_second") ?></div>
        <div id="calendar_seconds" style="display:none"><?php echo lang("calendar_seconds") ?></div>
        <div id="calendar_y" style="display:none"><?php echo lang("calendar_y") ?></div>
        <div id="calendar_m" style="display:none"><?php echo lang("calendar_m") ?></div>
        <div id="calendar_w" style="display:none"><?php echo lang("calendar_w") ?></div>
        <div id="calendar_d" style="display:none"><?php echo lang("calendar_d") ?></div>
        <div id="refuse" style="display:none"><?php echo lang("refuse") ?></div>
        <div id="users_rese_refuse_artist" style="display:none"><?php echo lang("users_rese_refuse_artist") ?></div>
        <div id="users_rese_validate_artist" style="display:none"><?php echo lang("users_rese_validate_artist") ?></div>
        <div id="users_calendar_list_nodata" style="display:none"><?php echo lang("users_calendar_list_nodata") ?></div>
		<div id="notset" style="display:none"><?php echo lang("notset") ?></div>
        <div id="showrecom" style="display:none"><?php echo lang("showrecom") ?></div>
        <div id="users_page_picasa_delconf" style="display:none"><?php echo lang("users_page_picasa_delconf") ?></div>
        <div id="prevtxt" style="display:none"><?php echo lang("prev") ?></div>
        <div id="startslideshow" style="display:none"><?php echo lang("startslideshow") ?></div>
        <div id="nexttxt" style="display:none"><?php echo lang("next") ?></div>
        <div id="togglesize" style="display:none"><?php echo lang("togglesize") ?></div>
        <div id="closetxt" style="display:none"><?php echo lang("close") ?></div>
        <div id="requieredfield" style="display:none"><?php echo lang("requieredfield") ?></div>
        <div id="validatetxt" style="display:none"><?php echo ucfirst (lang("validate")) ?></div>
        <div id="submittxt" style="display:none"><?php echo lang("submit") ?></div>
        <div id="deletetxt" style="display:none"><?php echo lang("delete") ?></div>
        <div id="canceltxt" style="display:none"><?php echo lang("cancel") ?></div>
        <div id="users_calendar_event_del_conf" style="display:none"><?php echo lang("users_calendar_event_del_conf") ?></div>
        <div id="users_contact_del_conf" style="display:none"><?php echo lang("users_contact_del_conf") ?></div>
        
		<script src="<?=site_url('js/plugins.js')?>"></script>		
		<script src="<?=site_url('js/dropdown.js')?>"></script>
		<?php 
		//Include config lang
		include("/home/bonstage/dev.b-onstage/application/config/lang.php");
		foreach($lang_counts as $key => $value){
		if($this->session->userdata('lang_loaded') == $value["name"]){ $lang_id = $value["id"];}
		}
		
		//Determine row name depending on lang loaded
		if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
		else {
			foreach($lang_counts as $key => $value){
				if($this->session->userdata('lang_loaded') == $value["name"]){
					$rowname = '_'.$value["id"];
				}
			}
		}
		?>
        
        <script src="<?=site_url('js/functions'.$rowname.'.js')?>"></script>
		<script src="<?=site_url('js/chosen/chosen.jquery.min.js')?>"></script>
		<script src="<?=site_url('js/chosen/ajax-chosen.min.js')?>"></script>
		<script src="<?=site_url('js/selectbox/jquery.selectBox.min.js')?>"></script>
		<script src="<?=site_url('js/jquery.validate.min.js')?>"></script>
		<script src="<?=site_url('js/redactor/redactor.min.js')?>"></script>
		<script src="<?=site_url('js/redactor/langs/'.$lang_id.'.js')?>"></script>
		<script src="<?=site_url('js/date-fr-FR.js')?>"></script>	
		<script src="<?=site_url('js/badge.js')?>"></script>	
		<script src="<?=site_url('js/jquery.ui.mask.js')?>"></script>
		<script src="<?=site_url('js/timepicker/jquery.timepicker.min.js')?>"></script>
		<script src="<?=site_url('js/jquery-ui-i18n.min.js')?>"></script>	
		
		<?php if(isset($scripts)){ foreach($scripts as $script){ ?>
		<script src="<?=site_url($script)?>"></script>
		<?php }} ?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-43268260-1', 'b-onstage.com');
		  ga('send', 'pageview');
		</script>
	</body>
</html>