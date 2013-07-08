<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*is ajax*/
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/*soundcloud*/
define('SC_CLIENT_ID', '5daaabb2aecacbce6f1af0c2df08fa9f');
define('SC_SECRET_ID', '6eaa28602492e3340859b7db399cda7b');
define('SC_REDIRECT_URL', 'http://www.b-onstage.com/user/redirect_sc');

/*facebook*/
define('FACEBOOK_LINK','http://www.facebook.com/pages/B-onstage/146854152153423');
define('FACEBOOK_ID','146854152153423');
define('FACEBOOK_APP_ID','405185392913953');
define('FACEBOOK_SECRET_ID','e6cb1dbd000c7a401153e3d0a2bcdf61');

/*twitter*/
define('TWITTER_LINK','https://twitter.com/b_onstage');
define('TWITTER_SCREEN_NAME','b_onstage');

/*google*/
define('GOOGLE_PLUS_LINK','https://plus.google.com/109498236972306503560/posts');
define('GOOGLE_ID','109498236972306503560');
define('GOOGLE_API_KEY', '4RV25Vor8uM1Fgq6gbeoNjkg');