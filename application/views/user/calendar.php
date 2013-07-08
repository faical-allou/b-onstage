<div class="container_12 mb-20">
	<div class="grid_12 bg-white bs-black ui-corner-all">
		<!--header calendar-->
		<div class="p-20 header-calendar clearfix ui-corner-top">
			<span class="left">
				<?=$button_create_event?>
			</span>
			<span id="switch-calendar" class="right">
				<?=form_radio($switch_grid).form_label('Calendrier',$switch_grid['id'])?>
				<?=form_radio($switch_list).form_label('Liste',$switch_list['id'])?>
			</span>
			<span id="filter-calendar" class="right mr-10">
				<span id="<?=$filter_open['id']?>" data-counter="<?=$filter_open['counter']?>" data-color="<?=$filter_open['color']?>" title="<?=$filter_open['title']?>">
					<?=form_checkbox($filter_open['checkbox']).form_label($filter_open['label'], $filter_open['checkbox']['id'])?>
				</span>
				<span id="<?=$filter_pending['id']?>" data-counter="<?=$filter_pending['counter']?>" data-color="<?=$filter_pending['color']?>" title="<?=$filter_pending['title']?>">
					<?=form_checkbox($filter_pending['checkbox']).form_label($filter_pending['label'], $filter_pending['checkbox']['id'])?>
				</span>
				<span id="<?=$filter_accepted['id']?>" data-counter="<?=$filter_accepted['counter']?>" data-color="<?=$filter_accepted['color']?>" title="<?=$filter_accepted['title']?>">
					<?=form_checkbox($filter_accepted['checkbox']).form_label($filter_accepted['label'], $filter_accepted['checkbox']['id'])?>
				</span>
				<span id="<?=$filter_close['id']?>" data-counter="<?=$filter_close['counter']?>" data-color="<?=$filter_close['color']?>" title="<?=$filter_close['title']?>">
					<?=form_checkbox($filter_close['checkbox']).form_label($filter_close['label'], $filter_close['checkbox']['id'])?>
				</span>

			</span>
		</div>
		<!--calendar-->
		<div id="calendar"></div>

		<!--events list-->
		<div id="event-list">
			<?=$event_list?>
		</div>
		<!--dialog popover event--
		<div id="popover-event"></div>-->
	</div>
</div>


<link rel="stylesheet" type="text/css" href="<?=site_url('js/timepicker/jquery.timepicker.css')?>" />
<link rel="stylesheet" type="text/css" href="<?=site_url('css/fullcalendar.css')?>" />

<script type="text/javascript">
var user_group = '<?=$user_group?>';
var url_feed = '<?=$url_feed?>';
</script>