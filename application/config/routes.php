<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['scaffolding_trigger'] = "";

$route['login'] = 'user/login';
$route['login/(:any)'] = 'user/login/$1';
$route['logout'] = 'user/logout';
$route['signup_choice'] = 'user/signup_choice';
$route['signup_stage'] = 'user/signup_stage/1';
$route['registration_completed_stage'] = 'user/signup_stage/2';
$route['signup'] = 'user/signup/1';
$route['activate'] = 'user/signup/2';
$route['registration_completed'] = 'user/signup/3';
$route['404_override'] = 'page/index';
$route['page/(:any)'] = 'page/index/$1';
$route['page/(:any)/(:any)'] = 'page/index/$1/$2';
$route['event/(:num)'] = 'event/index/$1';
$route['concerts'] = 'concerts/index/1/';
$route['concerts/oujouer'] = 'concerts/index/1/oujouer';
$route['concerts/programmation'] = 'concerts/index/1/programmation';
$route['concerts/(:num)'] = 'concerts/index/$1';
$route['stages'] = 'stages/index/1';
$route['stages/(:num)'] = 'stages/index/$1';
$route['artists'] = 'artists/index/1';
$route['artists/(:num)'] = 'artists/index/$1';
$route['uploader/(:any)'] = 'uploader/index/$1';
$route['uploader/(:any)/(:any)'] = 'uploader/index/$1/$2';
$route['about'] = 'about/index';
$route['about_us'] = 'about/about_us';
$route['how_does_it_work'] = 'about/how_does_it_work';
$route['how_i_make_money'] = 'about/how_i_make_money';
$route['payonline/(:any)/(:any)'] = 'payonline/index/$1/$2';
$route['legal'] = 'main/legal';
$route['terms_of_services'] = 'main/terms_of_services';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
