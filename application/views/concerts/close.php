<?php 
//Include config lang
include("/home/bonstage/dev.b-onstage/application/config/lang.php");
//Determine row name depending on lang loaded
if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
else {
	foreach($lang_counts as $key => $value){
		if($this->session->userdata('lang_loaded') == $value["name"]){
			$rowname = '_'.$value["id"];
		}
	}
}
?><script type="text/javascript">
var status = '<?=$status?>';
var per_page = <?=$per_page?>;
var reservation_min = <?=$reservation_min?>;
var reservation_max = <?=$reservation_max?>;
var entry_min = <?=$entry_min?>;
var entry_max = <?=$entry_max?>;
</script>

<div id="concert" class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mb-20">
		<div class="clearfix">
			<!--filter sort-->
			<div class="left p-10">								
				<span><?=form_dropdown($filter_sort['name'], $filter_sort['options'], $filter_sort['selected'], $filter_sort['js'])?></span>
			</div>
			<!--genre musical-->
			<div class="left p-10">				
				<span>
					<select id="filter-genre" name="filter-genre" multiple="multiple">						
						<?php foreach($genres as $genre){ ?>
						<option value="<?=$genre['id']?>"><?=$genre['name'.$rowname]?></option>
						<?php } ?>
					</select>				
				</span>
			</div>								
		</div>
		
		<!--list-concert-->
		<div id="list-concert">
			<?php if($count_events == 0) { ?>
				<h1 class="grey fs-18 title pl-20"><?php echo lang("noresultfound") ?></h1>
			<?php }else{ ?>
				<?=$events_list?>
			<?php } ?>
		</div>
		<!--footer-->
		<div>			
			<!--show more results-->
			<div id="more-concert" class="p-10 <?=(($count_events <= $per_page) ? 'hidden' : '')?>"><button style="width:100%;"><?php echo lang("showmoreresults") ?></button></div>
			<div id="loader-more-concert" class="p-10">
				<?=img(site_url('img/loader/1.gif'))?>
			</div>					
			<!--pager-->
			<ul class="hidden">
				<?php for($i=1 ; $i <= ceil($count_events/$per_page) ; $i++){ ?>
				<li><a href="<?=site_url('concerts/'.$i)?>"><?=$i?></a></li>
				<?php } ?>
				<li><a href="<?=site_url('concerts/'.$next_page)?>"><?php echo lang("next") ?></a></li>
			</ul>			
		</div>			
	</div>
</div>