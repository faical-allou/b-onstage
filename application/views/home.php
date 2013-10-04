
<!--slider-->	
<div id="wrap-slider" class="mb-50 bs-black">
	<div id="slider" class="royalSlider rsBlack">
		<!--slide1-->
		<div class="rsContent slide1">
			<div class="bContainer ui-corner-all p-20">	
				<div class="rsABlock fs-42 grey" data-move-effect="left" data-move-offset="500" data-easing="easeOutBack" data-speed="1000"><?php echo lang("home_slide1_txt") ?></div>				
				<div class="rsABlock fs-32 grey mb-20" data-move-effect="right" data-move-offset="500" data-easing="easeOutBack" data-delay="500" data-speed="500"><?php echo lang("home_slide1_txt2") ?></div>				
				<div class="rsABlock" data-move-effect="none" data-delay="1000" data-speed="500"><a href="<?=site_url('signup_choice')?>" class="ui-purple rsButton" style="font-size:1.6em;"><?php echo lang("home_slide1_txt3") ?></a></div>
			</div>
			<img class="rsABlock" data-move-effect="none" data-delay="1000" src="/img/slide/img-slide-1.png" data-rsw="792" data-rsh="440">
		</div>
		<!--slide2-->
		<div class="rsContent slide2">
			<div class="bContainer">	
				<div class="rsABlock fs-32 white" data-move-effect="top" data-move-offset="500" data-easing="easeOutBack" data-speed="1000"><?php echo lang("home_slide2_txt") ?></div>
				<div class="rsABlock fs-32 white" data-move-effect="right" data-move-offset="500" data-easing="easeOutBack" data-delay="1000" data-speed="1000"><?php echo lang("home_slide2_txt2") ?></div>				
				<div class="rsABlock fs-32 white mb-20" data-move-effect="left" data-move-offset="300" data-easing="easeOutBack" data-delay="1000" data-speed="500"><?php echo lang("home_slide2_txt3") ?></div>				
				<div class="rsABlock" data-move-effect="none" data-delay="1500" data-speed="500"><a href="<?=site_url('concerts')?>" class="ui-dark rsButton" style="font-size:1.6em;"><?php echo lang("home_slide2_txt4") ?></a></div>
			</div>
			<img class="rsABlock" data-move-effect="none" data-delay="1500" src="/img/slide/img-slide-2.jpg" data-rsw="900" data-rsh="500">
		</div>
	</div>	
</div>	

<div class="container_12 mb-50">
	<!--last 5 concerts-->
	<div class="grid_4 home-bloc ui-corner-all bs-black">
		<?=heading($title_concert, 2, 'class="home-title title"')?>
		<ul class="home-list">
			<?php foreach($concerts as $concert){ ?>
				<li>					
					<div class="clearfix">
						<div class="left">
							<div class="p-r" style="width:64px;height:64px;">
								<?=img(array('src' => $concert['stage_avatar'], 'class' => 'p-a d-b','style' => 'width:40px;height:40px;left:0;top:0;', 'width'	=> '40px', 'height' => '40px'))?>
								<?=img(array('src' => $concert['artist_avatar'], 'class' => 'p-a d-b','style' => 'width:40px;height:40px;left:24px;top:24px;', 'width'	=> '40px', 'height' => '40px'))?>
							</div>
						</div>
						<div class="left ml-10">
							<div>
								<a href="<?=$concert['link']?>" class="grey title fs-16 mb-5"><?=$concert['date']?> - <?=$concert['location']?></a>
							</div>
							<div class="grey bold fs-12 mb-2"><?php echo lang("scene") ?> : <a href="<?=$concert['stage_link']?>" class="purple"><?=$concert['stage_name']?></a></div>
							<div class="grey bold fs-12"><?php echo lang("artist") ?> : <a href="<?=$concert['artist_link']?>" class="purple"><?=$concert['artist_name']?></a></div>					
						</div>	
					</div>						
				</li>
			<?php } ?>
		</ul>
		<div class="p-20 ta-c">
			<a href="<?=site_url('concerts/programmation')?>" class="home-list-link"><?php echo lang("home_seeall_shows") ?></a>
		</div>
	</div>

	<!--last 5 artist-->
	<div class="grid_4 home-bloc ui-corner-all bs-black">
		<?=heading($title_artist, 2, 'class="home-title title"')?>		
		<ul class="home-list">
			<?php foreach($artists as $artist){ ?>				
				<li>					
					<div class="clearfix">
						<div class="left"><?=img(array('src' => $artist['avatar'], 'width' => '64px'))?></div>
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
			<a href="<?=site_url('artists')?>" class="home-list-link"><?php echo lang("home_seeall_artist") ?></a>
		</div>
	</div>
	
	
	<!--last 5 artist-->
	<div class="grid_4 home-bloc ui-corner-all bs-black">
		<?=heading($title_stage, 2, 'class="home-title title"')?>		
		<ul class="home-list">
			<?php foreach($stages as $stage){ ?>				
				<li>					
					<div class="clearfix">
						<div class="left"><?=img(array('src' => $stage['avatar'], 'width' => '64px'))?></div>
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
			<a href="<?=site_url('stages')?>" class="home-list-link"><?php echo lang("home_seeall_stages") ?></a>
		</div>
	</div>	
		
</div>
<div class="bg-purple">
	<div class="container_12 pt-50 pb-50">
		<div class="grid_6 ta-c">	
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/calendar.png')))?>
				<p class="fs-24 title white ta-c" style="height:70px;"><?php echo lang("home_bottom_txt") ?></p>
				<a href="<?=site_url('concerts')?>" class="ui-dark action-home" style="font-size:1em;"><?php echo lang("header_book_a_date") ?></a>			
			</div>	
		</div>
		<div class="grid_6 ta-c">			
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/network.png')))?>
				<p class="fs-24 title white ta-c" style="height:70px"><?php echo lang("home_bottom_txt2") ?></p>
				<a href="<?=site_url('signup_choice')?>" class="ui-dark action-home" style="font-size:1em;"><?php echo lang("become_member") ?></a>			
			</div>	
		</div>
	</div>
</div>	


