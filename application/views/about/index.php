<div class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mt-20 mb-20">		
		<div class="p-r">
			<?php 
			// English
			if ($this->session->userdata('site_lang') == "english") { 
				echo img(array('src' => site_url('img/about-english.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'));
			} 
			// French - Default
			else {
				echo img(array('src' => site_url('img/about.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'));
			}
			?><ul id="about-menu">
				<li><?=anchor(site_url('about'), lang("aboutus_link_aboutus"), array('id' => 'about-menu-1'))?></li>
				<li><?=anchor(site_url('about_us'), lang("aboutus_link_whoweare"), array('id' => 'about-menu-2'))?></li>
				<li><?=anchor(site_url('how_does_this_work'), lang("aboutus_link_howitworks"), array('id' => 'about-menu-3'))?></li>
			</ul>		
		</div>	
		<div class="about">
			<?=heading(lang("aboutus_header_aboutus"), 2, 'class="fs-24 title grey"')?>
			<?php echo lang("aboutus_txt1_aboutus"); ?>
			<?=heading(lang("aboutus_header2_aboutus"), 2, 'class="fs-24 title grey"')?>
			<?php echo lang("aboutus_txt2_aboutus"); ?>
			<?=heading(anchor(site_url('signup_choice'),lang("aboutus_header3_aboutus"), array('class' => 'purple')).' '.lang("aboutus_header4_aboutus"), 2, 'class="fs-24 title grey"')?>	
		</div>
	</div>		
</div>
<script>
	var about_menu_id = 'about-menu-1';
</script>