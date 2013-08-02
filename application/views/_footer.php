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
	
		<script src="<?=site_url('js/plugins.js')?>"></script>		
		<script src="<?=site_url('js/dropdown.js')?>"></script>
		<?php 
        if ($this->session->userdata('site_lang') == "english") {
           ?><script src="<?=site_url('js/functions_en.js')?>"></script><?php
        } 
		// Default FRENCH
		else {
           ?><script src="<?=site_url('js/functions.js')?>"></script><?php
        }
		?>
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
	</body>
</html>