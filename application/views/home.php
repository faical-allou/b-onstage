<!-- Floating link -->
<span class="ta-c b fs-14 bold ">
<a class="contact-float contact_us p-10" href="javascript:void(0)">Contact</a>
</span>


<!--slider-->	
<div id="wrap-slider">
	<div id="slider" class="royalSlider rsBlack ">

	<!--slide6-->
		<div class="rsContent slide6 db">
			<div class="bContainer ui-corner-all p-20 db">		
				<div class=" fs-32 bold white"><?php echo lang("home_slide6_txt") ?></div>
				<div class=" fs-24 bold white"><?php echo lang("home_slide6_txt2") ?></div>				
				<div class=" fs-14 bold white mb-20"><?php echo lang("home_slide6_txt3") ?></div>				
				<span class="ui-green rsButton" style="font-size:1em;"> 
					<a href="<?=site_url('concerts/oujouer?id=28017&t=slide6')?>" >
					<?php echo lang("home_slide6_txt4") ?></a>
				</span>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-6.jpg">
		</div>


	<!--slide5--
		<div class="rsContent slide5 db">
			<div class="bContainer ui-corner-all p-20 db">		
				<div class=" fs-32 italic bold grey"><?php echo lang("home_slide5_txt") ?></div>
				<div class=" fs-24 bold grey"><?php echo lang("home_slide5_txt2") ?></div>				
				<div class=" fs-24 bold grey mb-20"><?php echo lang("home_slide5_txt3") ?></div>				
				<span class="ui-green rsButton" style="font-size:1em;"> 
					<a href="<?=site_url('concerts/?t=slide5')?>" >
					<?php echo lang("home_slide5_txt4") ?></a>
				</span>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-5.png">
		</div>


	<!--slide4--
		<div class="rsContent slide4">
			<div class="bContainer ui-corner-all p-20">		
				<div class=" fs-36 bold white"><?php echo lang("home_slide4_txt") ?></div>
				<div class=" fs-24 bold white mb-20"><?php echo lang("home_slide4_txt2") ?></div>				
				<div class="ta-c">
				<span class="ui-green rsButton" style="font-size:1em;"> 
					<a href="<?=site_url('concerts/?t=slide4')?>" >
					<?php echo lang("home_slide4_txt3") ?></a>
				</span>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-4.png" data-rsw="900" data-rsh="500">
		</div>

	<!--slide3-->
		<div class="rsContent slide3">
			<div class="bContainer ui-corner-all p-20">		
				<div class=" fs-32 bold grey"><?php echo lang("home_slide3_txt") ?></div>
				<div class=" fs-24 bold grey mb-20"><?php echo lang("home_slide3_txt2") ?></div>				
				<div class="ui-green rsButton" style="font-size:1em;"> 
					<a href="<?=site_url('signup/?t=slide3')?>" >
					<?php echo lang("home_slide3_txt3") ?></a>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-3.jpg" data-rsw="1024" data-rsh="685">
		</div>

		<!--slide2-->
<!--		<div class="rsContent slide2">
			<div class="bContainer">	
				<div class=" fs-32 bold white"><?php echo lang("home_slide2_txt2") ?></div>				
				<div class=" fs-32 bold white mb-20"><?php echo lang("home_slide2_txt3") ?></div>				
				<div class="ui-green rsButton" style="font-size:1em;">
					<a href="<?=site_url('concerts')?>" ">
					<?php echo lang("home_slide2_txt4") ?></a>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-test2.jpg" data-rsw="900" data-rsh="500">
		</div>
-->
		<!--slide1-->
		<div class="rsContent slide1">
			<div class="bContainer ui-corner-all p-20">	
				<div class=" fs-32 bold white"><?php echo lang("home_slide1_txt") ?></div>				
				<div class=" fs-32 bold white mb-20"><?php echo lang("home_slide1_txt2") ?></div>				
				<div class="ta-c">
				<div class="ui-green rsButton" style="font-size:1em;">
					<a href="<?=site_url('signup/?t=slide1')?>" >
					<?php echo lang("home_slide1_txt3") ?></a>
				</div>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade"  src="/img/slide/img-slide-test.jpg" data-rsw="900" data-rsh="500">
		</div>

	</div>	
</div>	

<div class="bg-white bs-black">
	<div class="container_12 pt-50 pb-50 ta-c">
		<div id="home-video" class="grid_9 ta-c ">	
			<iframe width="480" height="270" src="https://www.youtube.com/embed/kIHGjqx4ecc?border=none&color=white&modestbranding=1&rel=0&theme=light&autohide=1&autoplay=0&showinfo=0&controls=0" seamless='seamless' frameBorder="0" allowfullscreen></iframe>
		</div>	
		
		<div class="grid_3">	
			<div class="fs-18 ta-c bold"><?php echo lang("home_howitworks_title")?></div>	 
			<div class="fs-16 ta-l mb-10 bold"><?php echo lang("home_howitworks_list")?></div>
			<div class="ta-c bold">
			<a href="<?=site_url('signup/?t=video')?>" class="ta-c ui-green action-home" style="font-size:1em;"><?php echo lang("home_slide3_txt3") ?></a>			
			</div>
		</div>	
	</div>
</div>



<div class="bg-purple">
	<div class="container_12 pt-20 pb-50 mb-30">
		<div class="grid_6 ta-c">	
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/calendar.png')))?>
				<p class="fs-24  white ta-c" style="height:auto;"><?php echo lang("home_bottom_txt") ?></p>
				<a href="<?=site_url('concerts/?t=pband')?>" class="ui-white action-home mt-10" style="font-size:1em;"><?php echo lang("header_book_a_date") ?></a>			
			</div>	
		</div>
		<div class="grid_6 ta-c">			
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/network.png')))?>
				<p class="fs-24  white ta-c" style="height:auto"><?php echo lang("home_bottom_txt2") ?></p>
				<a href="<?=site_url('signup/?t=pband')?>" class="ui-white action-home mt-10" style="font-size:1em;"><?php echo lang("become_member") ?></a>							
				</div>	
		</div>
	</div>

	
</div>	



<div class="container_12 mb-30 db">
	<!--last 5 artist-->
	<div class="grid_6 home-bloc ui-corner-all bs-black di">
		<?=heading($title_artist, 2, 'class="home-title title"')?>		
		<ul class="home-list">
			<?php foreach($artists as $artist){ ?>				
				<li>					
					<div class="clearfix">
						<div class="left"><?=img(array('src' => $artist['avatar'], 'width' => '128px'))?></div>
						<div class="left ml-10">
							<div>
								<a href="<?=$artist['link']?>" class="fs-16 title grey"><?=$artist['name']?></a>
							</div>
							<p class="fs-12 grey bold"><span class="icon-location mr-5" aria-hidden="true"></span><?=$artist['location']?></p>
						</div>
					</div>					
				</li>
			<?php } ?>
		</ul>		
		<div class="p-20 ta-r">
			<a href="<?=site_url('artists/?t=tab')?>" class="home-list-link"><?php echo lang("home_seeall_artist") ?></a>
		</div>
	</div>
	
	
	<!--last 5 stages-->
	<div class="grid_6 home-bloc ui-corner-all bs-black di">
		<?=heading($title_stage, 2, 'class="home-title title"')?>		
		<ul class="home-list">
			<?php foreach($stages as $stage){ ?>				
				<li>					
					<div class="clearfix">
						<div class="left"><?=img(array('src' => $stage['avatar'], 'width' => '128px'))?></div>
						<div class="left ml-10">
							<div>
								<a href="<?=$stage['link']?>" class="title fs-16 grey"><?=$stage['name']?></a>
							</div>
							<p class="fs-12 grey bold"><span class="icon-location mr-5" aria-hidden="true"></span><?=$stage['location']?></p>
						</div>
					</div>					
				</li>
			<?php } ?>
		</ul>		
		<div class="p-20 ta-c">
			<a href="<?=site_url('stages/?t=tab')?>" class="home-list-link"><?php echo lang("home_seeall_stages") ?></a>
		</div>
	</div>			
</div>



