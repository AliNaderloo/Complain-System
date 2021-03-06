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
//Route::get('/', 'MainController@test');
Route::get('Barname/{id}', 'MainController@barname');

Route::get('/', 'MainController@loginForm')->name('login');
Route::get('/Logout', 'MainController@logout')->name('logout');
Route::post('/Login', 'MainController@login');

Route::group(['middleware' => ['auth']], function () {
	Route::get('newComplaint', 'MainController@newComplaint');
	Route::get('/Add', 'MainController@addComplaint');
	Route::get('All', 'MainController@allComplaint')->name('allComplaint');
	Route::get('Complain/{id}', 'MainController@showComplaint');
	Route::post('editComplaint', 'MainController@editComplaint');
	Route::get('ChangeLevel', 'MainController@changeLevel');
	Route::get('Subjects', 'MainController@allSubject');
	Route::get('ComplainSubject/{id}', 'MainController@ComplainSubject');
	Route::get('EditSubject', 'MainController@editComplaintSubject');
	Route::get('addSubject', 'MainController@addComplaintSubject');
	Route::get('RemoveSubject', 'MainController@RemoveSubject');
	Route::get('Admins', 'MainController@showAdmins');
	Route::get('AddAdmin','MainController@addAdmin');
	Route::get('ChangeAdmin','MainController@changeAdmin');
	Route::get('DeleteAdmin','MainController@deleteAdmin');
	Route::post('ProfilePicture','MainController@changePicture');
	Route::get('RemoveComplaint','MainController@removeComplaint');
	Route::get('ComplaintHistory','MainController@complaintHistory');
});


