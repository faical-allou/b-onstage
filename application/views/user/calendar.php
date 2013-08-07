<div class="container_12 mb-20">
	<div class="grid_12 bg-white bs-black ui-corner-all">
		<!--header calendar-->
		<div id="today_txt" style="display:none"><?php echo lang("today") ?></div>
		<div id="shortday_1_name" style="display:none"><?php echo lang("calendar_shortday_1") ?></div>
		<div id="shortday_2_name" style="display:none"><?php echo lang("calendar_shortday_2") ?></div>
		<div id="shortday_3_name" style="display:none"><?php echo lang("calendar_shortday_3") ?></div>
		<div id="shortday_4_name" style="display:none"><?php echo lang("calendar_shortday_4") ?></div>
		<div id="shortday_5_name" style="display:none"><?php echo lang("calendar_shortday_5") ?></div>
		<div id="shortday_6_name" style="display:none"><?php echo lang("calendar_shortday_6") ?></div>
		<div id="shortday_7_name" style="display:none"><?php echo lang("calendar_shortday_7") ?></div>
		<div id="day_1_name" style="display:none"><?php echo lang("calendar_day_1") ?></div>
		<div id="day_2_name" style="display:none"><?php echo lang("calendar_day_2") ?></div>
		<div id="day_3_name" style="display:none"><?php echo lang("calendar_day_3") ?></div>
		<div id="day_4_name" style="display:none"><?php echo lang("calendar_day_4") ?></div>
		<div id="day_5_name" style="display:none"><?php echo lang("calendar_day_5") ?></div>
		<div id="day_6_name" style="display:none"><?php echo lang("calendar_day_6") ?></div>
		<div id="day_7_name" style="display:none"><?php echo lang("calendar_day_7") ?></div>
		<div id="month_1_name" style="display:none"><?php echo lang("calendar_month_1") ?></div>
		<div id="month_2_name" style="display:none"><?php echo lang("calendar_month_2") ?></div>
		<div id="month_3_name" style="display:none"><?php echo lang("calendar_month_3") ?></div>
		<div id="month_4_name" style="display:none"><?php echo lang("calendar_month_4") ?></div>
		<div id="month_5_name" style="display:none"><?php echo lang("calendar_month_5") ?></div>
		<div id="month_6_name" style="display:none"><?php echo lang("calendar_month_6") ?></div>
		<div id="month_7_name" style="display:none"><?php echo lang("calendar_month_7") ?></div>
		<div id="month_8_name" style="display:none"><?php echo lang("calendar_month_8") ?></div>
		<div id="month_9_name" style="display:none"><?php echo lang("calendar_month_9") ?></div>
		<div id="month_10_name" style="display:none"><?php echo lang("calendar_month_10") ?></div>
		<div id="month_11_name" style="display:none"><?php echo lang("calendar_month_11") ?></div>
		<div id="month_12_name" style="display:none"><?php echo lang("calendar_month_12") ?></div>
        <div id="shortmonth_1_name" style="display:none"><?php echo lang("calendar_shortmonth_1") ?></div>
		<div id="shortmonth_2_name" style="display:none"><?php echo lang("calendar_shortmonth_2") ?></div>
		<div id="shortmonth_3_name" style="display:none"><?php echo lang("calendar_shortmonth_3") ?></div>
		<div id="shortmonth_4_name" style="display:none"><?php echo lang("calendar_shortmonth_4") ?></div>
		<div id="shortmonth_5_name" style="display:none"><?php echo lang("calendar_shortmonth_5") ?></div>
		<div id="shortmonth_6_name" style="display:none"><?php echo lang("calendar_shortmonth_6") ?></div>
		<div id="shortmonth_7_name" style="display:none"><?php echo lang("calendar_shortmonth_7") ?></div>
		<div id="shortmonth_8_name" style="display:none"><?php echo lang("calendar_shortmonth_8") ?></div>
		<div id="shortmonth_9_name" style="display:none"><?php echo lang("calendar_shortmonth_9") ?></div>
		<div id="shortmonth_10_name" style="display:none"><?php echo lang("calendar_shortmonth_10") ?></div>
		<div id="shortmonth_11_name" style="display:none"><?php echo lang("calendar_shortmonth_11") ?></div>
		<div id="shortmonth_12_name" style="display:none"><?php echo lang("calendar_shortmonth_12") ?></div>
        <div class="p-20 header-calendar clearfix ui-corner-top">
			<span class="left">
				<?=$button_create_event?>
			</span>
			<span id="switch-calendar" class="right">
				<?=form_radio($switch_grid).form_label(lang("calendar"),$switch_grid['id'])?>
				<?=form_radio($switch_list).form_label(lang("list"),$switch_list['id'])?>
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