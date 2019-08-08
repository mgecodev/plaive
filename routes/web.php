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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    
    $id = NULL;
    $type = NULL;


    return view('index')->with('id', $id)->with('type', $type);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
// Route::get('/home', 'HomeController@index')->redirect('/');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/SaveCourseInfo', 'CourseController@saveCourseInfo');
// Route::get('/showCourseInfo', 'CourseController@showCourseInfo');

Route::get('/class', function () {
    return view('ClassIndex');
});
Route::get('/ManageClass', 'CourseController@index');
Route::get('/OpenClass', 'OpenClassController@index');
Route::get('ClassBoard', function () {
    return view('ClassBoard');
});

Route::get('/ManageDevice', 'ChannelController@index');