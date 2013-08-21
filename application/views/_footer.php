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
		
		<div id="sc_client_id_txt" style="display:none"><?php echo SC_CLIENT_ID ?></div>
		<div id="sc_secret_id_txt" style="display:none"><?php echo SC_SECRET_ID ?></div>
		<div id="sc_redirect_uri_txt" style="display:none"><?php echo SC_REDIRECT_URL ?></div>
		<div id="html_lang_txt" style="display:none"><?php echo lang("redactor_html") ?></div>
        <div id="video_lang_txt" style="display:none"><?php echo lang("redactor_video") ?></div>
        <div id="image_lang_txt" style="display:none"><?php echo lang("redactor_image") ?></div>
        <div id="table_lang_txt" style="display:none"><?php echo lang("redactor_table") ?></div>
        <div id="link_lang_txt" style="display:none"><?php echo lang("redactor_link") ?></div>
        <div id="link_insert_lang_txt" style="display:none"><?php echo lang("redactor_link_insert") ?></div>
        <div id="unlink_lang_txt" style="display:none"><?php echo lang("redactor_unlink") ?></div>
        <div id="formatting_lang_txt" style="display:none"><?php echo lang("redactor_formatting") ?></div>
        <div id="paragraph_lang_txt" style="display:none"><?php echo lang("redactor_paragraph") ?></div>
        <div id="quote_lang_txt" style="display:none"><?php echo lang("redactor_quote") ?></div>
        <div id="code_lang_txt" style="display:none"><?php echo lang("redactor_code") ?></div>
        <div id="header1_lang_txt" style="display:none"><?php echo lang("redactor_header1") ?></div>
        <div id="header2_lang_txt" style="display:none"><?php echo lang("redactor_header2") ?></div>
        <div id="header3_lang_txt" style="display:none"><?php echo lang("redactor_header3") ?></div>
        <div id="header4_lang_txt" style="display:none"><?php echo lang("redactor_header4") ?></div>
        <div id="bold_lang_txt" style="display:none"><?php echo lang("redactor_bold") ?></div>
        <div id="italic_lang_txt" style="display:none"><?php echo lang("redactor_italic") ?></div>
        <div id="fontcolor_lang_txt" style="display:none"><?php echo lang("redactor_fontcolor") ?></div>
        <div id="backcolor_lang_txt" style="display:none"><?php echo lang("redactor_backcolor") ?></div>
        <div id="unorderedlist_lang_txt" style="display:none"><?php echo lang("redactor_unorderedlist") ?></div>
        <div id="orderedlist_lang_txt" style="display:none"><?php echo lang("redactor_orderedlist") ?></div>
        <div id="outdent_lang_txt" style="display:none"><?php echo lang("redactor_outdent") ?></div>
        <div id="indent_lang_txt" style="display:none"><?php echo lang("redactor_indent") ?></div>
        <div id="cancel_lang_txt" style="display:none"><?php echo lang("redactor_cancel") ?></div>
        <div id="insert_lang_txt" style="display:none"><?php echo lang("redactor_insert") ?></div>
        <div id="save_lang_txt" style="display:none"><?php echo lang("redactor_save") ?></div>
        <div id="_delete_lang_txt" style="display:none"><?php echo lang("redactor__delete") ?></div>
        <div id="insert_table_lang_txt" style="display:none"><?php echo lang("redactor_insert_table") ?></div>
        <div id="insert_row_above_lang_txt" style="display:none"><?php echo lang("redactor_insert_row_above") ?></div>
        <div id="insert_row_below_lang_txt" style="display:none"><?php echo lang("redactor_insert_row_below") ?></div>
        <div id="insert_column_left_lang_txt" style="display:none"><?php echo lang("redactor_insert_column_left") ?></div>
        <div id="insert_column_right_lang_txt" style="display:none"><?php echo lang("redactor_insert_column_right") ?></div>
        <div id="delete_column_lang_txt" style="display:none"><?php echo lang("redactor_delete_column") ?></div>
        <div id="delete_row_lang_txt" style="display:none"><?php echo lang("redactor_delete_row") ?></div>
        <div id="delete_table_lang_txt" style="display:none"><?php echo lang("redactor_delete_table") ?></div>
        <div id="rows_lang_txt" style="display:none"><?php echo lang("redactor_rows") ?></div>
        <div id="columns_lang_txt" style="display:none"><?php echo lang("redactor_columns") ?></div>
        <div id="add_head_lang_txt" style="display:none"><?php echo lang("redactor_add_head") ?></div>
        <div id="delete_head_lang_txt" style="display:none"><?php echo lang("redactor_delete_head") ?></div>
        <div id="title_lang_txt" style="display:none"><?php echo lang("redactor_title") ?></div>
        <div id="image_position_lang_txt" style="display:none"><?php echo lang("redactor_image_position") ?></div>
        <div id="none_lang_txt" style="display:none"><?php echo lang("redactor_none") ?></div>
        <div id="left_lang_txt" style="display:none"><?php echo lang("redactor_left") ?></div>
        <div id="right_lang_txt" style="display:none"><?php echo lang("redactor_right") ?></div>
        <div id="image_web_link_lang_txt" style="display:none"><?php echo lang("redactor_image_web_link") ?></div>
        <div id="text_lang_txt" style="display:none"><?php echo lang("redactor_text") ?></div>
        <div id="mailto_lang_txt" style="display:none"><?php echo lang("redactor_mailto") ?></div>
        <div id="web_lang_txt" style="display:none"><?php echo lang("redactor_web") ?></div>
        <div id="video_html_code_lang_txt" style="display:none"><?php echo lang("redactor_video_html_code") ?></div>
        <div id="file_lang_txt" style="display:none"><?php echo lang("redactor_file") ?></div>
        <div id="upload_lang_txt" style="display:none"><?php echo lang("redactor_upload") ?></div>
        <div id="download_lang_txt" style="display:none"><?php echo lang("redactor_download") ?></div>
        <div id="choose_lang_txt" style="display:none"><?php echo lang("redactor_choose") ?></div>
        <div id="or_choose_lang_txt" style="display:none"><?php echo lang("redactor_or_choose") ?></div>
        <div id="drop_file_here_lang_txt" style="display:none"><?php echo lang("redactor_drop_file_here") ?></div>
        <div id="align_left_lang_txt" style="display:none"><?php echo lang("redactor_align_left") ?></div>
        <div id="align_center_lang_txt" style="display:none"><?php echo lang("redactor_align_center") ?></div>
        <div id="align_right_lang_txt" style="display:none"><?php echo lang("redactor_align_right") ?></div>
        <div id="align_justify_lang_txt" style="display:none"><?php echo lang("redactor_align_justify") ?></div>
        <div id="horizontalrule_lang_txt" style="display:none"><?php echo lang("redactor_horizontalrule") ?></div>
        <div id="deleted_lang_txt" style="display:none"><?php echo lang("redactor_deleted") ?></div>
        <div id="anchor_lang_txt" style="display:none"><?php echo lang("redactor_anchor") ?></div>
        <div id="link_new_tab_lang_txt" style="display:none"><?php echo lang("redactor_link_new_tab") ?></div>
        <div id="underline_lang_txt" style="display:none"><?php echo lang("redactor_underline") ?></div>
        <div id="alignment_lang_txt" style="display:none"><?php echo lang("redactor_alignment") ?></div>
        <div id="users_contact_sendmsg" style="display:none"><?php echo lang("users_contact_sendmsg") ?></div>
        <div id="users_page_inputcity" style="display:none"><?php echo lang("users_page_inputcity") ?></div>
        <div id="choose_city" style="display:none"><?php echo lang("choose_city") ?></div>
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
		foreach($this->config->item('lang_counts') as $key => $value){
		if($this->session->userdata('lang_loaded') == $value["name"]){ $lang_id = $value["id"];}
		}
		
		//Determine row name depending on lang loaded
		if($this->session->userdata('lang_loaded') == "french"){$rowname = ''; $datepicker_lang = "fr"; $langloaded_id = 'fr';}
		else {
			foreach($this->config->item('lang_counts') as $key => $value){
				if($this->session->userdata('lang_loaded') == $value["name"]){
					$rowname = '_'.$value["id"];
					$datepicker_lang = $value["datepickerid"];
					$langloaded_id = $value["id"];
				}
			}
		}
		?>
        <div id="button_video" style="display:none"><?php echo 'button-upload-video'.$rowname.'.png'; ?></div>
        <div id="button_track" style="display:none"><?php echo 'button-upload-track'.$rowname.'.png'; ?></div>
        <div id="button_photo" style="display:none"><?php echo 'button-upload-photo'.$rowname.'.png'; ?></div>
        <div id="button_upcover" style="display:none"><?php echo 'button-upload-cover'.$rowname.'.png'; ?></div>
        <div id="datepicker_lang" style="display:none"><?php echo $datepicker_lang ?></div>
        <div id="langloaded_id" style="display:none"><?php echo $langloaded_id ?></div>
        <script src="<?=site_url('js/functions.js')?>"></script>
		<script src="<?=site_url('js/chosen/chosen.jquery.min.js')?>"></script>
		<script src="<?=site_url('js/chosen/ajax-chosen.min.js')?>"></script>
		<script src="<?=site_url('js/selectbox/jquery.selectBox.min.js')?>"></script>
		<script src="<?=site_url('js/jquery.validate.min.js')?>"></script>
		<script src="<?=site_url('js/redactor/redactor.min.js')?>"></script>
		<script src="<?=site_url('js/redactor/langs/fr.js')?>"></script>
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