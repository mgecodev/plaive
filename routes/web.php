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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->redirect('/');

Route::get('/home', function () {

    // return redirect()->route('');
    return view('index');
})->middleware('verified');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/SaveCourseInfo', 'CourseController@saveCourseInfo');
// Route::get('/showCourseInfo', 'CourseController@showCourseInfo');

Route::get('/class', function () {
    return view('ClassIndex');
});
Route::get('/ManageClass', function () {
    return view('ManageClass');
});
Route::get('/OpenClass', 'CourseController@index');
Route::get('ClassBoard', function () {
    return view('ClassBoard');
});
