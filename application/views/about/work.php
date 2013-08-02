<div class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mt-20 mb-20">		
		<div class="p-r">
			<?php 
			// English
			if ($this->session->userdata('site_lang') == "english") { 
				echo img(array('src' => site_url('img/how-work-english.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'));
			} 
			// French - Default
			else {
				echo img(array('src' => site_url('img/how-work.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'));
			}
			?>
			<ul id="about-menu">
				<li><?=anchor(site_url('about'), lang("aboutus_link_aboutus"), array('id' => 'about-menu-1'))?></li>
				<li><?=anchor(site_url('about_us'), lang("aboutus_link_whoweare"), array('id' => 'about-menu-2'))?></li>
				<li><?=anchor(site_url('how_does_this_work'), lang("aboutus_link_howitworks"), array('id' => 'about-menu-3'))?></li>
			</ul>		
		</div>
		<div class="about">	
			<?php echo lang("aboutus_txt_howitworks") ?>
		</div>	
	</div>
</div>

<script>
	var about_menu_id = 'about-menu-3';
</script>