
<!--slider-->	
<div id="wrap-slider" class="mb-50 bs-black">
	<div id="slider" class="royalSlider rsBlack">

	<!--slide3-->
		<div class="rsContent slide3">
			<div class="bContainer ui-corner-all p-20">		
				<div class=" fs-36 bold grey"><?php echo lang("home_slide3_txt") ?></div>
				<div class=" fs-36 bold grey mb-20"><?php echo lang("home_slide3_txt2") ?></div>				
				<div class="ui-green rsButton" style="font-size:1em;"> 
					<a href="<?=site_url('signup')?>" >
					<?php echo lang("home_slide3_txt3") ?></a>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-3.jpg" data-rsw="792" data-rsh="440">
		</div>

		<!--slide1-->
		<div class="rsContent slide1">
			<div class="bContainer ui-corner-all p-20">	
				<div class=" fs-36 bold grey"><?php echo lang("home_slide1_txt") ?></div>				
				<div class=" fs-36 bold grey mb-20"><?php echo lang("home_slide1_txt2") ?></div>				
				<div class="ui-green rsButton" style="font-size:1em;">
					<a href="<?=site_url('signup')?>" >
					<?php echo lang("home_slide1_txt3") ?></a>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade"  src="/img/slide/img-slide-1.png" data-rsw="792" data-rsh="440">
		</div>
		<!--slide2-->
		<div class="rsContent slide2">
			<div class="bContainer">	
				<div class=" fs-32 bold white"><?php echo lang("home_slide2_txt") ?></div>
				<div class=" fs-32 bold white"><?php echo lang("home_slide2_txt2") ?></div>				
				<div class=" fs-32 bold white mb-20"><?php echo lang("home_slide2_txt3") ?></div>				
				<div class="ui-white rsButton" style="font-size:1em;">
					<a href="<?=site_url('concerts')?>" ">
					<?php echo lang("home_slide2_txt4") ?></a>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade" src="/img/slide/img-slide-2.jpg" data-rsw="900" data-rsh="500">
		</div>
	
	</div>	
</div>	

<div class="container_12 mb-50">

	<!--last 5 artist-->
	<div class="grid_6 home-bloc ui-corner-all bs-black">
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
			<a href="<?=site_url('artists')?>" class="home-list-link"><?php echo lang("home_seeall_artist") ?></a>
		</div>
	</div>
	
	
	<!--last 5 stages-->
	<div class="grid_6 home-bloc ui-corner-all bs-black">
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
			<a href="<?=site_url('stages')?>" class="home-list-link"><?php echo lang("home_seeall_stages") ?></a>
		</div>
	</div>	

		
</div>
<div class="bg-purple">
	<div class="container_12 pt-50 pb-50">
		<div class="grid_6 ta-c">	
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/calendar.png')))?>
				<p class="fs-24  white ta-c" style="height:70px;"><?php echo lang("home_bottom_txt") ?></p>
				<a href="<?=site_url('concerts')?>" class="ui-white action-home" style="font-size:1em;"><?php echo lang("header_book_a_date") ?></a>			
			</div>	
		</div>
		<div class="grid_6 ta-c">			
			<div class="p-20">
				<?=img(array('src' => site_url('img/icons/home/network.png')))?>
				<p class="fs-24  white ta-c" style="height:70px"><?php echo lang("home_bottom_txt2") ?></p>
				<a href="<?=site_url('signup')?>" class="ui-white action-home" style="font-size:1em;"><?php echo lang("become_member") ?></a>			
			</div>	
		</div>
	</div>
</div>	


