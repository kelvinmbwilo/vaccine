<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login');
});


Route::get('home', function()
{
    return View::make('dashboard');
});

Route::post('home', function()
{
    return View::make('dashboard');
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing user actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//validating user during login
Route::post('login',array('as'=>'login', 'uses'=>'UserController@validate'));

//logging a user out
Route::get('logout',array('as'=>'logout', 'uses'=>'UserController@logout'));

//display a form to add new user
Route::get('user/add',array('as'=>'adduser', 'uses'=>'UserController@create'));

//display a list of users
Route::get('user/list',array('uses'=>'UserController@userlist'));

//adding new user
Route::post('user/add',array('as'=>'adduser1', 'uses'=>'UserController@store'));

//viewing list of users
Route::get('users',array('as'=>'listuser', 'uses'=>'UserController@index'));

//display a form to edit users information
Route::get('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@edit'));

//editng users information
Route::post('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@update'));

//deleting user
Route::post('user/delete/{id}',array('as'=>'deleteuser', 'uses'=>'UserController@destroy'));

//display a system usage log for a user
Route::get('user/log/{id}',array('as'=>'userlog', 'uses'=>'UserController@show'));

//check for a regions district...
Route::post('user/region_check/{id}',array('uses'=>'UserController@check_region'));

//check for a regions district...
Route::post('user/region_check1/{id}',array('uses'=>'UserController@check_region1'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Vaccines actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('vaccine/add',array('uses'=>'VaccineController@create'));

//display a list of vaccines
Route::get('vaccine/list',array('uses'=>'VaccineController@lists'));

//adding new vaccine
Route::post('vaccine/add',array('uses'=>'VaccineController@store'));

//viewing index page
Route::get('vaccine',array('uses'=>'VaccineController@index'));

//display a form to edit vaccine information
Route::get('vaccine/edit/{id}',array('uses'=>'VaccineController@edit'));

//editng vaccine information
Route::post('vaccine/edit/{id}',array('uses'=>'VaccineController@update'));

//deleting vaccine
Route::post('vaccine/delete/{id}',array('uses'=>'VaccineController@destroy'));


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Diluents actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('diluent/add',array('uses'=>'DiluentController@create'));

//display a list of vaccines
Route::get('diluent/list',array('uses'=>'DiluentController@lists'));

//adding new vaccine
Route::post('diluent/add',array('uses'=>'DiluentController@store'));

//viewing index page
Route::get('diluent',array('uses'=>'DiluentController@index'));

//display a form to edit vaccine information
Route::get('diluent/edit/{id}',array('uses'=>'DiluentController@edit'));

//editng vaccine information
Route::post('diluent/edit/{id}',array('uses'=>'DiluentController@update'));

//deleting vaccine
Route::post('diluent/delete/{id}',array('uses'=>'DiluentController@destroy'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Manufacturer actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('manufacture/add',array('uses'=>'ManufactureController@create'));

//display a list of vaccines
Route::get('manufacture/list',array('uses'=>'ManufactureController@lists'));

//adding new vaccine
Route::post('manufacture/add',array('uses'=>'ManufactureController@store'));

//viewing index page
Route::get('manufacture',array('uses'=>'ManufactureController@index'));

//display a form to edit vaccine information
Route::get('manufacture/edit/{id}',array('uses'=>'ManufactureController@edit'));

//editng vaccine information
Route::post('manufacture/edit/{id}',array('uses'=>'ManufactureController@update'));

//deleting vaccine
Route::post('manufacture/delete/{id}',array('uses'=>'ManufactureController@destroy'));




////////////////////////////////////////////////////////////////////////////////////////
////manage profile routes
///////////////////////////////////////////////////////////////////////////////////////

//route to display profile
Route::get('profile',array('as'=>'profile', 'uses'=>'UserController@profile'));

//route to display profile info
Route::get('profileInfo',array('as'=>'profileInfo', 'uses'=>'UserController@profileInfo'));

//route to display profile edit
Route::get('profileEdit',array('as'=>'profileEdit', 'uses'=>'UserController@profileEdit'));


//////////////////////////////////////////////////////////////////////////////////////////
/// managing roles
//////////////////////////////////////////////////////////////////////////////////////////

//display a form to add new role
Route::get('roles/add',array('uses'=>'RoleController@create'));

//display a list of vaccines
Route::get('roles/list',array('uses'=>'RoleController@lists'));

//adding new vaccine
Route::post('roles/add',array('uses'=>'RoleController@store'));

//viewing index page
Route::get('roles',array('uses'=>'RoleController@index'));

//display a form to edit vaccine information
Route::get('roles/edit/{id}',array('uses'=>'RoleController@edit'));

//editng vaccine information
Route::post('roles/edit/{id}',array('uses'=>'RoleController@update'));

//deleting vaccine
Route::post('roles/delete/{id}',array('uses'=>'RoleController@destroy'));


///////////////////////////////////////////////////////////////////////////////////
////// Routes for Nationl package management
///////////////////////////////////////////////////////////////////////////////////


//display a form to add new role
//Route::get('package/index',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('package/receive/national',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('package/national/stock',array('uses'=>'PackageController@viewstock'));

//display a list of vaccines
Route::get('package/national/sent',array('uses'=>'PackageController@viewsent'));

//display a list of vaccines
Route::post('package/receive/sscc/{id}',array('uses'=>'PackageController@checksscc'));

//display a list of vaccines
Route::post('package/receive/confirm/{id}',array('uses'=>'PackageController@confirmpackage'));

//display a list of vaccines
Route::get('package/receive/list',array('uses'=>'PackageController@listrecieved'));

//display a list of vaccines
Route::get('package/receive/form',array('uses'=>'PackageController@fillform'));

//viewing index page
Route::get('package/send/national',array('uses'=>'PackageController@sendPackage'));

//viewing index page
Route::get('package/send/list/{id}',array('uses'=>'PackageController@sendPackageList'));


//display a list of vaccines
Route::post('package/prepare/{id}',array('uses'=>'PackageController@prepareform'));

//display a list of vaccines
Route::post('package/prepare/add',array('uses'=>'PackageController@addpackage'));

//display a list of vaccines
Route::post('package/addpack',array('uses'=>'PackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('package/send',array('uses'=>'PackageController@edit'));

//display a form to edit vaccine information
Route::post('package/national/listed/delete/{id}',array('uses'=>'PackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('package/national/confirmsend/{id}',array('uses'=>'PackageController@confirmsend'));

//display a form to edit vaccine information
Route::post('package/national/prepared/delete/{id}',array('uses'=>'PackageController@deletprepared'));


////////////////////////////////////////////////////////////////////////////////////////////////
///////////Managing region stock
///////////Using RegionPackageController
////////////////////////////////////////////////////////////////////////////////////////////////
//display a list of vaccines
Route::get('region_package/receive/national',array('uses'=>'RegionPackageController@index'));

//display a list of vaccines
Route::get('region_package/national/stock',array('uses'=>'RegionPackageController@viewstock'));

//display a list of vaccines
Route::get('region_package/national/sent',array('uses'=>'RegionPackageController@viewsent'));

//display a list of vaccines
Route::post('region_package/receive/sscc/{id}',array('uses'=>'RegionPackageController@checksscc'));

//display a list of vaccines
Route::post('region_package/receive/confirm/{id}',array('uses'=>'RegionPackageController@confirmpackage'));

//display a list of vaccines
Route::get('region_package/receive/list',array('uses'=>'RegionPackageController@listrecieved'));

//display a list of vaccines
Route::get('region_package/receive/form',array('uses'=>'RegionPackageController@fillform'));

//viewing index page
Route::get('region_package/send/national',array('uses'=>'RegionPackageController@sendPackage'));

//viewing index page
Route::get('region_package/send/list/{id}',array('uses'=>'RegionPackageController@sendPackageList'));


//display a list of vaccines
Route::post('region_package/prepare/{id}',array('uses'=>'RegionPackageController@prepareform'));

//display a list of vaccines
Route::post('region_package/prepare/add',array('uses'=>'RegionPackageController@addpackage'));

//display a list of vaccines
Route::post('region_package/addpack',array('uses'=>'RegionPackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('region_package/national/listed/delete/{id}',array('uses'=>'RegionPackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('region_package/national/confirmsend/{id}',array('uses'=>'RegionPackageController@confirmsend'));

//display a form to edit vaccine information
Route::post('region_package/national/prepared/delete/{id}',array('uses'=>'RegionPackageController@deletprepared'));


////////////////////////////////////////////////////////////////////////////////////////////////
///////////Managing region stock
///////////Using RegionPackageController
////////////////////////////////////////////////////////////////////////////////////////////////
//display a list of vaccines
Route::get('district_package/receive/national',array('uses'=>'DistrictPackageController@index'));

//display a list of vaccines
Route::get('district_package/national/stock',array('uses'=>'DistrictPackageController@viewstock'));

//display a list of vaccines
Route::get('district_package/national/sent',array('uses'=>'DistrictPackageController@viewsent'));

//display a list of vaccines
Route::post('district_package/receive/sscc/{id}',array('uses'=>'DistrictPackageController@checksscc'));

//display a list of vaccines
Route::post('district_package/receive/confirm/{id}',array('uses'=>'DistrictPackageController@confirmpackage'));

//display a list of vaccines
Route::get('district_package/receive/list',array('uses'=>'PackageController@listrecieved'));

//display a list of vaccines
Route::get('district_package/receive/form',array('uses'=>'DistrictPackageController@fillform'));

//viewing index page
Route::get('district_package/send/national',array('uses'=>'DistrictPackageController@sendPackage'));

//viewing index page
Route::get('district_package/send/list/{id}',array('uses'=>'DistrictPackageController@sendPackageList'));


//display a list of vaccines
Route::post('district_package/prepare/{id}',array('uses'=>'DistrictPackageController@prepareform'));

//display a list of vaccines
Route::post('district_package/prepare/add',array('uses'=>'DistrictPackageController@addpackage'));

//display a list of vaccines
Route::post('district_package/addpack',array('uses'=>'DistrictPackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('district_package/national/listed/delete/{id}',array('uses'=>'DistrictPackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('district_package/national/confirmsend/{id}',array('uses'=>'DistrictPackageController@confirmsend'));

//display a form to edit vaccine information
Route::post('district_package/national/prepared/delete/{id}',array('uses'=>'DistrictPackageController@deletprepared'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Manufacture Barcodes actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('manubarcode/add/',array('uses'=>'ManuBarController@create'));

//display a list of vaccines
Route::get('manubarcode/list',array('uses'=>'ManuBarController@lists'));

//adding new vaccine
Route::post('manubarcode/add',array('uses'=>'ManuBarController@store'));

//viewing index page
Route::get('manubarcode',array('uses'=>'ManuBarController@index'));

//display a form to edit vaccine information
Route::get('manubarcode/edit/{id}',array('uses'=>'ManuBarController@edit'));

//editng vaccine information
Route::post('manubarcode/edit/{id}',array('uses'=>'ManuBarController@update'));

//deleting vaccine
Route::post('manubarcode/delete/{id}',array('uses'=>'ManuBarController@destroy'));

