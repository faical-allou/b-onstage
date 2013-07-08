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
				<div class="p-10 fs-16 white title bg-purple ui-corner-tl">Filtrer les résultats</div>					
				<div class="inner">	
					<!--filter sort-->
					<div class="p-20">
						<div class="mb-10 purple title fs-16">Trier par</div>
						<div><?=form_dropdown($filter_sort['name'], $filter_sort['options'], $filter_sort['selected'], $filter_sort['js'])?></div>
					</div>
					<!--genre musical-->
					<div class="p-20">
						<div class="mb-10 purple title fs-16">Par genre musical</div>
						<div>
							<select id="filter-genre" name="filter-genre" multiple="multiple">						
								<?php foreach($genres as $genre){ ?>
								<option value="<?=$genre['id']?>"><?=$genre['name']?></option>
								<?php } ?>
							</select>				
						</div>
					</div>		
					<!--daterange silder-->
					<div class="p-20">
						<div class="mb-10 purple title fs-16">Par tranche</div>
						<!--reservation-->
						<div class="mb-20">
							<div class="mb-10 grey fs-12 bold">Réservation entre <span id="filter-reservation"></span></div>				
							<div class="ml-5 mr-5" id="slider-range-reservation"></div>					
						</div>					
						
						<!--entry-->				
						<div class="mb-20">
							<div class="mb-10 grey fs-12 bold">Prix entrée entre <span id="filter-entry"></span></div>
							<div class="ml-5 mr-5" id="slider-range-entry"></div>
						</div>
						
						<!--schedule-->
						<div class="mb-10">
							<div class="mb-10 grey fs-12 bold">Horaire entre <span id="filter-schedule"></span></div>
							<div class="ml-5 mr-5" id="slider-range-schedule"></div>
						</div>
					</div>

					<!--payment type-->
					<div class="p-20">					
						<div class="mb-10 purple title fs-16">Par type de rémunération</div>
						<div id="filter-payment">
							<!--payment amount-->
							<div class="fs-12 grey bold mb-10">
								<?=form_checkbox($filter_remuneration['input_filter_payment_amount'])?>
								<?=form_label($filter_remuneration['label_filter_payment_amount'], $filter_remuneration['input_filter_payment_amount']['id'])?>
							</div>					
							<!--percent drink-->
							<div class="fs-12 grey bold mb-10">
								<?=form_checkbox($filter_remuneration['input_filter_percent_drink'])?>
								<?=form_label($filter_remuneration['label_filter_percent_drink'], $filter_remuneration['input_filter_percent_drink']['id'])?>
							</div>
							<!--percent entry-->
							<div class="fs-12 grey bold mb-10">
								<?=form_checkbox($filter_remuneration['input_filter_percent_entry'])?>
								<?=form_label($filter_remuneration['label_filter_percent_entry'], $filter_remuneration['input_filter_percent_entry']['id'])?>
							</div>
							<!--refund fees-->
							<div class="fs-12 grey bold mb-10">
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
				<div class="p-10 fs-16 white title bg-purple ui-corner-tr">Résultats de la recherche</div>										
				
				<!--header-->				
				<div class="recommendations m-10">
					<div class="dt" style="width:100%;">
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24">Etape 1</div>
								<p class="grey fs-12">Choisissez une Date et cliquez sur <strong>"Demande de réservation"</strong>.</p>
							</div>	
						</div>
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24">Etape 2</div>
								<p class="grey fs-12">Une fois sélectionné par la Scène, vous avez <strong>48 heures</strong> pour valider votre réservation.</p>
							</div>	
						</div>
						<div class="dtc ta-c">
							<div class="p-10">
								<div class="title fs-24">Etape 3</div>
								<p class="grey fs-12">Le jour du Concert, présentez-vous et <strong>c'est à vous de jouer!</strong></p>
							</div>	
						</div>							
					</div>
				</div>			
					
				<!--event list-->							
				<div id="list-concert"><?=$events_list?></div>
				
				<!--footer-->
				<footer>				
					<!--if no results-->
					<?php if($count_events == 0) { ?>
						<h1 class="grey fs-18 title pl-20">Aucun résultat n'a été trouvé.</h1>
					<?php } else { ?>				
					<!--show more results-->
					<div id="more-concert" class="p-10 <?=(($count_events <= $per_page) ? 'hidden' : '')?>"><button style="width:100%;">Afficher plus de résultats</button></div>
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