<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
	function url_title($str, $separator = 'dash', $lowercase = FALSE)
	{
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						'\s+'					=> $replace,
						'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
					);

		$str = trim($str);
		$str = stripAccents($str);
		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim(stripslashes($str));
	}
function stripAccents($string){
	$string = html_entity_decode($string, ENT_COMPAT, 'ISO-8859-1');
	return strtr($string,	'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
							'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}
function jsFormat($string){
	$search1 = array("&iexcl;","&cent;","&pound;","&yen;","&sect;","&copy;","&laquo;","&not;","&reg;","&deg;","&micro;","&para;","&raquo;","&frac14;","&frac12;","&frac34;","&iquest;","&Agrave;","&Aacute;","&Acirc;","&Atilde;","&Auml;","&Aring;","&AElig;","&Ccedil;","&Egrave;","&Eacute;","&Ecirc;","&Euml;","&Igrave;","&Iacute;","&Icirc;","&Iuml;","&ETH;","&Ntilde;","&Ograve;","&Oacute;","&Ocirc;","&Otilde;","&Ouml;","&Oslash;","&Ugrave;","&Uacute;","&Ucirc;","&Uuml;","&Yacute;","&THORN;","&szlig;","&agrave;","&aacute;","&acirc;","&atilde;","&auml;","&aring;","&aelig;","&ccedil;","&egrave;","&eacute;","&ecirc;","&euml;","&igrave;","&iacute;","&icirc;","&iuml;","&eth;","&ntilde;","&ograve;","&oacute;","&ocirc;","&otilde;","&ouml;","&oslash;","&ugrave;","&uacute;","&ucirc;","&uuml;","&yacute;","&thorn;","&yuml;");
	$search2 = array("¡","¢","£","¥","§","©","«","¬","®","°","µ","¶","»","¼","½","¾","¿","À","Á","Â","Ã","Ä","Å","Æ","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ð","Ñ","Ò","Ó","Ô","Õ","Ö","Ø","Ù","Ú","Û","Ü","Ý","Þ","ß","à","á","â","ã","ä","å","æ","ç","è","é","ê","ë","ì","í","î","ï","ð","ñ","ò","ó","ô","õ","ö","ø","ù","ú","û","ü","ý","þ","ÿ");
	$replace = array("\241","\242","\243","\245","\247","\251","\253","\254","\256","\260","\265","\266","\273","\274","\275","\276","\277","\300","\301","\302","\303","\304","\305","\306","\307","\310","\311","\312","\313","\314","\315","\316","\317","\320","\321","\322","\323","\324","\325","\326","\330","\331","\332","\333","\334","\335","\336","\337","\340","\341","\342","\343","\344","\345","\346","\347","\350","\351","\352","\353","\354","\355","\356","\357","\360","\361","\362","\363","\364","\365","\366","\370","\371","\372","\373","\374","\375","\376","\377");
	$result  = str_replace($search1, $replace, $string);
	$result  = str_replace($search2, $replace, $result);
	return utf8_encode($result);
}
/* End of file url_helper.php */
/* Location: ./system/helpers/url_helper.php */