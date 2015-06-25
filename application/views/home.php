
<!-- Floating link -->
<span class="ta-c b fs-14 bold ">
<a class="contact-float contact_us p-10" href="javascript:void(0)">Contact</a>
</span>


<!--slider-->
<div id="wrap-slider p-f">
	<div id="slider" class=" royalSlider rsBlack">

	<!--slide8-->
		<div class="rsContent slide1 p-f">
			<div class="bContainer ui-corner-all p-20">
				<div class=" fs-48 bold white"><?php echo lang("home_slide8_txt") ?></div>
				<div class=" fs-36 bold white mb-20"><?php echo lang("home_slide8_txt1") ?></div>
				<div class="ta-c">
				<div class="ui-green link-button fs-18 p-10">
					<a href="<?=site_url('signup/?t=slide8')?>" >
					<?php echo lang("home_slide8_txt2") ?></a>
				</div>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade"  src="/img/slide/img-slide-8.png" data-rsw="900" data-rsh="500">
		</div>


		<!--slide1-->
		<div class="rsContent slide1 p-f">
			<div class="bContainer ui-corner-all p-20">
				<div class=" fs-48 bold white"><?php echo lang("home_slide1_txt") ?></div>
				<div class=" fs-36 bold white mb-20"><?php echo lang("home_slide1_txt2") ?></div>
				<div class="ta-c">
				<div class="ui-green link-button fs-18" >
					<a href="<?=site_url('signup/?t=slide1')?>" >
					<?php echo lang("home_slide1_txt3") ?></a>
				</div>
				</div>
			</div>
			<img class="rsABlock" data-move-effect="fade"  src="/img/slide/img-slide-test.jpg" data-rsw="900" data-rsh="500">
		</div>

	</div>
</div>

<!--video-->
<div class="bg-white mt-50 mb-50">
	<div class=" pt-50 ta-c">
		<div id="home-video" class="dib m-10">
			<iframe width="480" height="270" src="https://www.youtube.com/embed/kIHGjqx4ecc?border=none&color=white&modestbranding=1&rel=0&theme=light&autohide=1&autoplay=0&showinfo=0&controls=0" seamless='seamless' frameBorder="0" allowfullscreen></iframe>
		</div>

		<div class="dib m-50 ml-100">
			<div class="fs-24 ta-c bold mb-10 underline"><?php echo lang("home_howitworks_title")?></div>
			<div class="fs-16 ta-l mb-30 bold"><?php echo lang("home_howitworks_list")?></div>
			<span class="bold ui-green fs-18 link-button p-10">
			<a href="<?=site_url('about/?t=video')?>"><?php echo lang("home_howitworks_button") ?></a>
			</span>
		</div>
	</div>
</div>


<div class=" mb-50 db ">
	<!--last 12 artist-->
	<div class="grid_12 home-bloc ui-corner-all di mb-30">
		<?=heading($title_artist, 2, 'class="home-title title"')?>
		<ul class="home-list ta-c mb-30">
			<?php foreach($artists as $artist){
					$artist_name = $artist['name'];
					if (strlen($artist_name) > 30) {
					$artist_name_short = substr($artist_name,0,27)."...";
					} else {
						$artist_name_short = $artist_name;
					};
					$artist_desc = strip_tags($artist['description']);
					if (strlen($artist_desc) > 200) {
						$artist_desc_short = substr($artist_desc,0,197)."...";
					} else {
						$artist_desc_short = $artist_desc;
					};
					?>
				<li>
				  <div class="flip_container">
				  <div class="flip_card">
					<div class="clearfix front face">
						<div class="db p-r"><?=img(array('src' => $artist['avatar'], 'width' => '240px'))?></div>
						<div class="mt--30 white-box p-2 p-a ta-c" >
							<div>
								<a href="<?=$artist['link']?>" class="fs-16 title grey"><?=$artist_name_short?></a>
							</div>
							<div class="fs-12 grey bold ">
								<span class="icon-location mr-5" aria-hidden="true"></span>
								<?=$artist['location']?>
							</div>
						</div>
					</div>
					<div class="back face ">
						<a href="<?=$artist['link']?>?t=flip" class="fs-16 title white"><?php echo $artist_desc_short ?></a>
						<div class="mt-10 ml--10 white-box p-2 p-a ta-c" >
							<div>
								<a href="<?=$artist['link']?>" class="fs-16 title grey"><?=$artist_name_short?></a>
							</div>
							<div class="fs-12 grey bold ">
								<span class="icon-location mr-5" aria-hidden="true"></span>
								<?=$artist['location']?>
							</div>
						</div>
						</div>
				  </div>
				  </div>
				</li>
			<?php } ?>
		</ul>
		<div class="p-20 ta-c">
			<a href="<?=site_url('artists?t=tab')?>" class="link-button ui-green fs-18 p-10"><?php echo lang("home_seeall_artist") ?></a>
		</div>
	</div>


	<!--last 12 stages-->
	<div class="grid_12 home-bloc ui-corner-all di mb-50">
		<?=heading($title_stage, 2, 'class="home-title title"')?>
		<ul class="home-list ta-c mb-30">
			<?php foreach($stages as $stage){
					$stage_name = $stage['name'];
					if (strlen($stage_name) > 30) {
					$stage_name_short = substr($stage_name,0,27)."...";
					} else {
						$stage_name_short = $stage_name;
					};
					$stage_desc = strip_tags($stage['description']);
					if (strlen($stage_desc) > 200) {
						$stage_desc_short = substr($stage_desc,0,197)."...";
					} else {
						$stage_desc_short = $stage_desc;
					};
					?>

				<li>
				  <div class="flip_container">
				  <div class="flip_card">
					<div class="clearfix front face">
						<div class="db"><?=img(array('src' => $stage['avatar'], 'width' => '240px'))?></div>
						<div class="mt--30  white-box p-2 p-a ta-c">
							<div>

								<a href="<?=$stage['link']?>" class="title fs-16 grey"><?=$stage_name_short?></a>
							</div>
							<div class="fs-12 grey bold">
								<span class="icon-location mr-5" aria-hidden="true"></span>
								<?=$stage['location']?>
							</div>
						</div>
					</div>
					<div class="back face ">
						<a href="<?=$stage['link']?>?t=flip" class="fs-16 title white"><?php echo $stage_desc_short ?></a>
						<div class="mt-10 ml--10 white-box p-2 p-a ta-c">
							<div>

								<a href="<?=$stage['link']?>" class="title fs-16 grey"><?=$stage_name_short?></a>
							</div>
							<div class="fs-12 grey bold">
								<span class="icon-location mr-5" aria-hidden="true"></span>
								<?=$stage['location']?>
							</div>
						</div>
						</div>
				  </div>
				  </div>
				</li>
			<?php } ?>
		</ul>
		<div class="p-20 ta-c">
			<a href="<?=site_url('stages/?t=tab')?>" class="link-button ui-green fs-18 p-10"><?php echo lang("home_seeall_stages") ?></a>
		</div>
	</div>
</div>

<!-- referral program -->
<div class="ta-c p-10 bs-black wrap-ref-program white-box">
					<span class="fs-24 bold">  <?php echo lang("referral_program") ?> </span>
					<span class="fs-32 bold">  <?php echo lang("referral_program2") ?> </span>

	<div class="container_12 ta-c mb-10 mt-30 p-10 ">
					<div class="dib">
						<div class="grid_4 ta-c">
							<div class="p-5">
								<i class="fa fa-glass fa-4x purple"></i>
								<p class="grey fs-14 bold"><?php echo lang("referral_program_step1") ?></p>
							</div>
						</div>

						<div class="grid_4 ta-c">
							<div class="p-5">
								<i class="fa fa-list-alt fa-4x purple"></i>
								<p class="grey fs-14 bold"><?php echo lang("referral_program_step2") ?></p>
							</div>
						</div>

						<div class="grid_4 ta-c">
							<div class="p-5">
								<i class="fa fa-money fa-4x purple"></i>
								<p class="grey fs-14 bold"><?php echo lang("referral_program_step3") ?></p>
							</div>
						</div>
					</div>
	</div>
<a href="<?=site_url('signup_stage_ref')?>" class="ui-green link-button mb-50 p-10" style="font-size:1em;"><?php echo lang("referral_program_button") ?></a>
</div>
