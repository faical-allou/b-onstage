<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//get month
function get_month($num_month=''){
	$month = array(
		'0'		=> 'Mois',
		'1'		=> 'Janvier',
		'2'		=> 'Février',
		'3' 	=> 'Mars',
		'4'		=> 'Avril',
		'5'	 	=> 'Mai',
		'6' 	=> 'Juin',
		'7' 	=> 'Juillet',
		'8' 	=> 'Août',
		'9' 	=> 'Septembre',
		'10' 	=> 'Octobre',
		'11'	=> 'Novembre',
		'12'	=> 'Décembre'
	);
	return $month[$num_month];
}