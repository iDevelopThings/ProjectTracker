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

Route::redirect('/', '/login');

Auth::routes();

Route::get('/p/{uid}', 'ProjectController@publicView')->name('public-project-view');


Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

});

Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');


    Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
        Route::post('', 'ProjectController@create')->name('create');
        Route::get('{project}', 'ProjectController@view')->name('view');
        Route::post('{project}/times', 'TimeEntryController@create')->name('add-entry');
    });

});
