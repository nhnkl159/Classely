<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::Routes();


/**
 * //TODO:
 */


/**
* Users Controllers Global
* Global user functions usage like login regiser index and more.
*/

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/settings', 'WebsiteController@viewsettings');

//Auth
Route::get('/login', 'Auth\AuthController@showLogin')->name('login');
Route::get('/logout', 'Auth\AuthController@logoutUser')->name('logout');
Route::get('/register', 'Auth\AuthController@showRegister')->name('register');

/**
* Global Controllers Global
* Global routes.
*/

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/attendance', 'AttendanceController@index')->name('attendance');
Route::get('/settings', 'UsersController@indexsettings');
Route::get('/noticeboard', 'NoticeboardController@index')->name('noticeboard');
Route::get('/teachers', 'TeachersController@index')->name('teachers');
Route::get('/studentscontact', 'UsersController@indextudentscontact')->name('studentscontact');
Route::get('/routine', 'RouteController@index')->name('routine');
Route::get('/behaviour', 'BehaviourController@index')->name('behaviour');
/**
* API Controllers Global
* Global api functions and routes.
* This routes are used in ajax.
*/

Route::post('/api/login', 'Auth\AuthController@loginUser');
Route::post('/api/register', 'Auth\AuthController@registerUser');
Route::post('/api/settings', 'UsersController@updatesettings');
Route::post('/api/notice_json', 'APIController@notice_json');
Route::post('/api/noticeboard_json', 'APIController@noticeboard_json');
Route::get('/api/teachers_json', 'APIController@teachers_json');
Route::get('/api/studentscontact_json', 'APIController@studentscontact_json');
Route::get('/api/routine_json', 'APIController@routine_json');
Route::get('/api/attendance_json', 'APIController@attendance_json');
Route::get('/api/behaviour_json', 'APIController@behaviour_json');
Route::get('/api/behavior_chart', 'APIController@behavior_chart');

