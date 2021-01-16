<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout');
Route::redirect('home', '/');
Route::get('/', 'Admin\StudentController@index');
Route::get('courses', 'CourseController@index');
Route::get('courses/{id}', 'CourseController@show');
Route::redirect('programmes', '/admin/programmes');

// New version with prefix and group
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/courses');
    Route::resource('programmes', 'Admin\ProgrammeController');
    Route::post('programmes/{id}', 'CourseController@add');

});
