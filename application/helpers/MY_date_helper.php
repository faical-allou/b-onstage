<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//get month
function get_month($num_month=''){
	$month = array(
		'0'		=> lang("calendar_month"),
		'1'		=> lang("calendar_month_1"),
		'2'		=> lang("calendar_month_2"),
		'3' 	=> lang("calendar_month_3"),
		'4'		=> lang("calendar_month_4"),
		'5'	 	=> lang("calendar_month_5"),
		'6' 	=> lang("calendar_month_6"),
		'7' 	=> lang("calendar_month_7"),
		'8' 	=> lang("calendar_month_8"),
		'9' 	=> lang("calendar_month_9"),
		'10' 	=> lang("calendar_month_10"),
		'11'	=> lang("calendar_month_11"),
		'12'	=> lang("calendar_month_12")
	);
	return $month[$num_month];
}