<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Auth\AuthController@getLogin');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('/acl', array('uses' => 'Site\HomeController@acl_test'));

//Route::resource('ad/ad-set', 'AdManager\AdSetController');

Route::group(['middleware' => ['auth']], function()
{

   #member routes
   Route::get('/home', array('uses' => 'Site\HomeController@index'));
   Route::get('/member', array('uses' => 'Member\MemberController@index'));
   Route::get('/member/create', array('uses' => 'Member\MemberController@create'));
   Route::post('/member/store', array('uses' => 'Member\MemberController@store'));
   Route::get('/member/edit/{id}', array('uses' => 'Member\MemberController@edit'));
   Route::patch('/member/edit/{id}', array('uses' => 'Member\MemberController@update'));
   Route::get('/member/delete/{id}', array('uses' => 'Member\MemberController@show'));
   Route::delete('/member/destroy/{id}', array('uses' => 'Member\MemberController@destroy'));

   #company routes
   Route::get('/company/create', array('uses' => 'Company\CompanyController@create'));
   Route::post('/company/store', array('uses' => 'Company\CompanyController@store'));


});


#api Routes



#ajax routes
