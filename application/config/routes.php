<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'c2p_controller/page/home';

// Connecting2People
$route['c2p/(:any)'] = 'C2p_controller/page/$1';
$route['ajax/(:any)'] = 'Ajax_controller/code/$1';
$route['oneway/(:any)'] = 'Oneway_controller/page/$1';
$route['mobile/(:any)'] = 'Mobile_controller/page/$1';
$route['returnee/(:any)'] = 'Returnee_controller/page/$1';
$route['member/(:any)'] = 'Member_controller/page/$1';
$route['sponsor/(:any)'] = 'Sponsor_controller/page/$1';
$route['gatekeeper/(:any)'] = 'Gatekeeper_controller/page/$1';
$route['citywatch/(:any)'] = 'Citywatch_controller/page/$1';
$route['reports/(:any)'] = 'Reports_controller/page/$1';
$route['sysadmin/(:any)'] = 'Sysadmin_controller/page/$1';
$route['manager/(:any)'] = 'Manager_controller/page/$1';
$route['clicklink/(:any)'] = 'Clicklink_controller/ClickLink/$1';
$route['code/(:any)'] = 'Code_controller/code/$1';
$route['testing/(:any)'] = 'Testing_controller/page/$1';
// LINC Ministries
$route['linc/(:any)'] = 'Linc_controller/page/$1';
//Default 
$route['(:any)'] = 'C2p_controller/page/$1';
$route['default_controller'] = 'C2p_controller';
// User the falling default values on the ChinaContact.net site
//$route['(:any)'] = 'code_controller/code/$1';
//$route['default_controller'] = 'code_controller/code/home';
//$route['default_controller'] = 'Welcome';

//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

