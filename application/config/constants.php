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
define('SC_CLIENT_ID', '63d6b7f211eb4199561feba72475cfeb');
define('SC_SECRET_ID', 'f054c325af966fb78a6d116961ef06d2');
//DEV
//define('SC_REDIRECT_URL', 'http://trans.b-onstage.com/user/redirect_sc');
//PROD
define('SC_REDIRECT_URL', 'http://master.b-onstage.com/user/redirect_sc');



/*facebook*/

define('FACEBOOK_LINK','http://www.facebook.com/pages/B-onstage/146854152153423');

define('FACEBOOK_ID','146854152153423');

define('FACEBOOK_APP_ID','167676780084738');

define('FACEBOOK_SECRET_ID','d108291a4d518f9bc1549fa6934862f1');



/*twitter*/

define('TWITTER_LINK','https://twitter.com/b_onstage');
define('TWITTER_SCREEN_NAME','b_onstage');
define('TWITTER_CONKEY','8HJ0jop92zxgKP4WKZuJpA');
define('TWITTER_CONSEC','0acpR6OYrTJOzcrSSD8CthqJcmRp2w5U0f3MWb908rA');
define('TWITTER_ACCTOK','1345303700-SOy4ZKduPfGaihD9haNieTeKj7wrh0X54Ale7zx');
define('TWITTER_ACCSEC','2SeKRVA6p6sZXezfksll4nxG4kK1YAKCtIFZZ9F7Fs');


/*google*/

define('GOOGLE_PLUS_LINK','https://plus.google.com/109498236972306503560/posts');

define('GOOGLE_ID','109498236972306503560');

define('GOOGLE_API_KEY', 'AIzaSyAhFb_7ULRR3RQ3OwVgRxe7fqSOGEZIGY0');