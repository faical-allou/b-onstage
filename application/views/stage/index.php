<script type="text/javascript">
	var page = <?=$page?>;
	var per_page = <?=$per_page?>;
</script>

<div id="stage">
	<div class="container_12">
		<div class="grid_12 mt-20 mb-20">		
			<!--filter name-->			
			<form action="" id="search-form-stage">
				<?=form_input($filter_name)?>
				<?=form_input($filter_location)?>
				<button type="submit" id="search-stage" class="ui-purple"><span aria-hidden="true" class="icon-search fs-16 pl-20 pr-20"></span></button>			
			</form>		
		</div>
	</div>
	<div class="container_12">	
		<div class="grid_9 mb-20">	
			<!--artists list-->
			<div class="bs-black">
				<div class="fs-16 p-10 white title bg-purple ui-corner-top"><?php echo lang("artists_searchresutls") ?></div> 
				<div id="stages-list">
					<?=$stages_list?>
				</div>	
			</div>	
			
			<!--show more artists-->
			<?php if($nb_pages > 1) {?>
			<div class="mt-20">
				<button id="show-more-stages" style="width:100%;"><?php echo lang("stages_searchshowmore") ?></button>
				<div id="loader-more-stages" style="display:none;" class="p-10 ta-c">
					<?=img(site_url('img/loader/1.gif'))?>
				</div>
			</div>
			<?php } ?>
			
			<!--pager-->
			<div style="display:none;">
				<ul>
					<?php
					$i = 1;
					for($i=1; $i<=$nb_pages; $i++) 
						echo '<li>'.anchor(site_url('stages/'.$i), $i).'</li>';
					?>	
				</ul>
			</div>
		</div>
		<?php echo $social_sidebar ?>

	</div>	

</div>