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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| CUSTOM ROUTES - Student Management System
| -------------------------------------------------------------------------
*/

// Web Interface Routes (untuk UI)
$route['students'] = 'student/index';
$route['students/create'] = 'student/create';
$route['students/store'] = 'student/store';
$route['students/edit/(:num)'] = 'student/edit/$1';
$route['students/update/(:num)'] = 'student/update/$1';
$route['students/delete/(:num)'] = 'student/delete/$1';

// API Routes (RESTful - untuk konsumsi API)
$route['api/students'] = 'student/api_get_all';                    // GET - Ambil semua
$route['api/students/search'] = 'student/api_search';              // GET - Cari mahasiswa
$route['api/students/create'] = 'student/api_create';              // POST - Tambah baru
$route['api/students/(:num)'] = 'student/api_get/$1';              // GET - Ambil by ID
$route['api/students/update/(:num)'] = 'student/api_update/$1';    // PUT - Update
$route['api/students/delete/(:num)'] = 'student/api_delete/$1';    // DELETE - Hapus

// Backward compatibility (URL lama tetap berfungsi)
$route['student'] = 'student/index';
$route['student/(:any)'] = 'student/$1';
$route['student/(:any)/(:num)'] = 'student/$1/$2';
