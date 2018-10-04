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


/*
|--------------------------------------------------------------------------
| Default authorization routes for Laravel
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Registered user pages
|--------------------------------------------------------------------------
*/
//home page -> TODO: to be made public!!
Route::get('/home', 'HomeController@index')->name('home');
//first page you arrive one when logging in
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');
//route to configuration page
Route::get('/configuration', 'ConfigurationController@index')->name('configuration')->middleware('auth');
//route to customization page
Route::get('/customization', 'CustomizationController@index')->name('customization')->middleware('auth');
//adjust appointment type
Route::get('/modifyAppointmentType/{id}/{description}/{capacity}/{length}', 'CustomizationController@modifyAppointmentType')->name('modifyAppointmentType')->middleware('auth');
//create appointmenttype 
Route::get('/createAppointmentType/{description}/{length}/{capacity}', 'AppointmentsController@createAppointmentsType')->middleware('auth');
//remove appointmenttype 
Route::get('/deleteAppointmentType/{id}', 'AppointmentsController@deleteAppointmentsType')->middleware('auth');
//load all appointment types for the logged in user
Route::get('/loadAppointmentTypes','AppointmentsController@loadAppointmentTypes')->middleware('auth');
//load specific data for all appointment types for the logged in user
Route::get('/loadAppointmentTypesForSelect','AppointmentsController@loadAppointmentTypesForSelect')->middleware('auth');
//get all created appointments on a selected day from the "appointments" mysql table
Route::get('/appointmentsonday/{selectedday}', 'AppointmentsController@getAppointmentsForSelectedDay')->middleware('auth');
//create open time
Route::get('/createOpenTime/{open_times_day_php}/{start_date}/{end_date}/{start_time}/{end_time}/{appointment_types_php}','ConfigurationController@addOpeningTimes')->middleware('auth');
//remove open time for specific day removeOpenWeekday
Route::get('/removeOpenWeekday/{open_times_id}/{open_times_weekday}','ConfigurationController@removeOpeningTimesForDay')->middleware('auth');

//Admin panel for admins only
Route::get('/adminpanel', 'AdminController@index')->name('adminpanel')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Public website pages
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about','AboutController@index')->name('about');

