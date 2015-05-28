<?php 
//Determine row name depending on lang loaded
if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
else {
	foreach($this->config->item('lang_counts') as $key => $value){
		if($this->session->userdata('lang_loaded') == $value["name"]){
			$rowname = '_'.$value["id"];
		}
	}
}
?>
<script type="text/javascript">
var status = '<?=$status?>';
var per_page = <?=$per_page?>;
var reservation_min = <?=$reservation_min?>;
var reservation_max = <?=$reservation_max?>;			
var entry_min = <?=$entry_min?>;
var entry_max = <?=$entry_max?>;
</script>

<div id="concert" class="container_12">
	<div class="grid_12 ui-corner-all bs-black bg-white mb-20">
		<table width="100%"><tbody><tr>
			<td class="filter-concert">				
				<div class="p-10 fs-16 white title bg-black ui-corner-tl"><?php echo lang("book_filterresults") ?></div>					
				<div class="inner">	

<!-- Removing filters until relevant and fixed
					<!--filter sort 
					<div class="p-20">
						<div class="mb-10 purple title fs-16"><?php echo lang("sortby") ?></div>
						<div><?=form_dropdown($filter_sort['name'], $filter_sort['options'], $filter_sort['selected'], $filter_sort['js'])?></div>
					</div>
					<!--genre musical
					<div class="p-20">
						<div class="mb-10 purple title fs-16"><?php echo lang("book_bysort1") ?></div>
						<div>
							<select id="filter-genre" name="filter-genre" multiple="multiple">						
								<?php foreach($genres as $genre){ ?>
								<option value="<?=$genre['id']?>"><?=$genre['name'.$rowname]?></option>
								<?php } ?>
							</select>				
						</div>
					</div>		
					<!--daterange silder
					<div class="p-20">
						<div class="mb-10 purple title fs-16"><?php echo lang("book_bysort2") ?></div>
						<!--reservation
						<div class="mb-20">
							<div class="mb-10 grey fs-12 bold"><?php echo lang("book_bysort2_1") ?> <span id="filter-reservation"></span></div>				
							<div class="ml-5 mr-5" id="slider-range-reservation"></div>					
						</div>					
						
						<!--entry				
						<div class="mb-20">
							<div class="mb-10 grey fs-12 bold"><?php echo lang("book_bysort2_2") ?> <span id="filter-entry"></span></div>
							<div class="ml-5 mr-5" id="slider-range-entry"></div>
						</div>
						
						<!--schedule
						<div class="mb-10">
							<div class="mb-10 grey fs-12 bold"><?php echo lang("book_bysort2_3") ?> <span id="filter-schedule"></span></div>
							<div class="ml-5 mr-5" id="slider-range-schedule"></div>
						</div>
					</div>
-->
					<!--payment type-->
					<div class="p-20">					
						<div class="mb-10 purple title fs-16"><?php echo lang("book_bysort3") ?></div>
						<div id="filter-payment">
							<!--payment amount-->
							<div class="fs-12 grey bold mb-20 mt-20">
								<?=form_checkbox($filter_remuneration['input_filter_payment_amount'])?>
								<?=form_label($filter_remuneration['label_filter_payment_amount'], $filter_remuneration['input_filter_payment_amount']['id'])?>
							</div>					
							<!--percent drink-->
							<div class="fs-12 grey bold mb-20">
								<?=form_checkbox($filter_remuneration['input_filter_percent_drink'])?>
								<?=form_label($filter_remuneration['label_filter_percent_drink'], $filter_remuneration['input_filter_percent_drink']['id'])?>
							</div>
							<!--percent entry-->
							<div class="fs-12 grey bold mb-20">
								<?=form_checkbox($filter_remuneration['input_filter_percent_entry'])?>
								<?=form_label($filter_remuneration['label_filter_percent_entry'], $filter_remuneration['input_filter_percent_entry']['id'])?>
							</div>
							<!--refund fees-->
							<div class="fs-12 grey bold mb-20">
								<?=form_checkbox($filter_remuneration['input_filter_refund_fees'])?>
								<?=form_label($filter_remuneration['label_filter_refund_fees'], $filter_remuneration['input_filter_refund_fees']['id'])?>
							</div>
							<!--remuneration-->
							<div class="fs-12 grey bold">
								<?=form_checkbox($filter_remuneration['input_filter_remuneration'])?>
								<?=form_label($filter_remuneration['label_filter_remuneration'], $filter_remuneration['input_filter_remuneration']['id'])?>
							</div>
						</div>						
					</div>					
				

				</div>
			</td>	
			<td class="result-concert">
					
				
				<!--title-->
				<div class="p-10 fs-16 white title bg-black ui-corner-tr"><?php echo lang("artists_searchresutls") ?></div>										
				
				<!--legend-->
				<div class="recommendations p-10">
					<span class="dt">  <?php echo lang("legend") ?> </span>
					<div class="dt">
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-users"></i>
								<p class="grey fs-12"><?php echo lang("room_size_legend") ?></p>
							</div>	
						</div>
						
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-square-o"></i>
								<p class="grey fs-12"><?php echo lang("stage_size_legend") ?></p>
							</div>	
						</div>
						
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-microphone"></i>
								<p class="grey fs-12"><?php echo lang("microphone_legend") ?></p>
							</div>	
						</div>
						
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-volume-off"></i>
								<p class="grey fs-12"><?php echo lang("speakers_legend") ?></p>
							</div>	
						</div>
						
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-sliders"></i>
								<p class="grey fs-12"><?php echo lang("amplification_legend") ?></p>
							</div>	
						</div>
						
						<div class="dtc ta-c">
							<div class="p-5">
								<i class="fa fa-lightbulb-o"></i>
								<p class="grey fs-12"><?php echo lang("lights_legend") ?></p>
							</div>	
						</div>
												
					</div>
				</div>
				<!--header removing recommendations			
				<div class="recommendations m-10">
					<div class="dt" style="width:100%;">
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24"><?php echo lang("step") ?> 1</div>
								<p class="grey fs-12"><?php echo lang("book_steptxt1") ?></p>
							</div>	
						</div>
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24"><?php echo lang("step") ?> 2</div>
								<p class="grey fs-12"><?php echo lang("book_steptxt2") ?></p>
							</div>	
						</div>
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24"><?php echo lang("step") ?> 3</div>
								<p class="grey fs-12"><?php echo lang("book_steptxt3") ?></p>
							</div>	
						</div>							
					</div>
				</div>			
-->					
				<!--event list-->							
				<div id="list-concert" class="bold" ><?=$events_list?></div>
				
				<!--footer-->
				<footer>				
					<!--if no results-->
					<?php if($count_events == 0) { ?>
						<h1 class="grey fs-18 title pl-20"><?php echo lang("noresultfound") ?></h1>
					<?php } else { ?>				
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
						<li><a href="<?=site_url('concerts/'.$next_page)?>">Suivant</a></li>
					</ul>					
					<?php } ?>
				</footer>				
			</td>
		</tr></tbody></table>
	</div>
</div>