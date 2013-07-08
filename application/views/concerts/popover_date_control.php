<div id="popover-date-control" class="bs-black ui-corner-all">
	<div id="form-date-control" class="left p-10">
		<form action="" method="post">
			<label for="date-start" id="date-start-lbl" class="active">Date de début:
				<span id="w-date-start">
					<input type="text" class="input input-text w-2 ui-corner-all" id="date-start" name="date-start" value="<?=@$date_start?>" />
				</span></label>
			<br>
			<label for="date-end" id="date-end-lbl">Date de fin:
				<span id="w-date-end">
					<input type="text" class="input input-text w-2 ui-corner-all" id="date-end" name="date-end"  value="<?=@$date_end?>" />
				</span></label>
			<br>
			<button class="date-result-concert fs-12 ui-blue ui-state-default ui-corner-all">Rechercher</button>
		</form>
	</div>
	<div id="calendar-date-control" class="left p-10"></div>
	<div>
		<form action="" method="post" class="right">
			<input type="hidden" name="date-start" value="<?=date('d/m/Y')?>">
			<input type="hidden" name="date-end" value="<?=date('d/m/Y', mktime(0,0,0,12,31,date('Y')))?>">
			<button class="date-result-concert fs-12 ui-blue ui-state-default ui-corner-all">Cette Année</button>
		</form>
		<form action="" method="post" class="right">
			<input type="hidden" name="date-start" value="<?=date('d/m/Y', mktime(0,0,0,date('m')+1,1,date('Y')))?>">
			<input type="hidden" name="date-end" value="<?=date('d/m/Y', mktime(0,0,0,date('m')+1,date('t'),date('Y')))?>">
			<button class="date-result-concert fs-12 ui-blue ui-state-default ui-corner-all">Le Mois Prochain</button>
		</form>
		<form action="" method="post" class="right">
			<input type="hidden" name="date-start" value="<?=date('d/m/Y')?>">
			<input type="hidden" name="date-end" value="<?=date('d/m/Y', mktime(0,0,0,date('m'),date('t'),date('Y')))?>">
			<button class="date-result-concert fs-12 ui-blue ui-state-default ui-corner-all">Ce Mois</button>
		</form>
		<form action="" method="post" class="right">
			<input type="hidden" name="date-start" value="<?=date('d/m/Y')?>">
			<input type="hidden" name="date-end" value="<?=date('d/m/Y', strtotime("+1 weeks"))?>">
			<button class="date-result-concert fs-12 ui-blue ui-state-default ui-corner-all">7 Prochains Jours</button>
		</form>
	</div>
</div>
<script type="text/javascript">
$.datepicker.setDefaults($.datepicker.regional['fr']);
var nbCalClick = 0;
$('#calendar-date-control').datepicker({
	numberOfMonths: 3,
	minDate: '+0d',
	onSelect: function(dateText, inst){
		var inputDate	= ( nbCalClick%2 ) ? '#date-end' : '#date-start';
		var otherDate	= ( nbCalClick%2 ) ? '#date-start' : '#date-end';
		var minMax		= ( nbCalClick%2 ) ? 'minDate' : 'maxDate';
		$(inputDate).val(dateText);
		$(inputDate+'-lbl').removeClass('active');
		$(otherDate+'-lbl').addClass('active');
		$( ".selector" ).datepicker( "option", minMax, dateText );
		nbCalClick++;
	}
});
</script>