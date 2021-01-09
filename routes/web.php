<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', function () {
    return "seee";
 })->middleware('verified');

Route::get('/authorities', 'AuthorityController@index');


Route::get('/project', 'ProjectController@index');


Route::group(['middleware' =>['auth'],'prefix'=>'admin/'], function () {
   Route::group(['prefix' => 'project'], function () {
        Route::get('/', 'ProjectController@index')->name('home');
        Route::post('store', 'ProjectController@store');
        Route::get('create', 'ProjectController@create');
        Route::get('edit/{id}','ProjectController@edit');
        Route::post('update/{id}','ProjectController@update');
        Route::get('destroy/{id}','ProjectController@destroy');
    });

    Route::group(['prefix' => 'task'], function () {
        Route::get('/', 'TaskController@index')->name('home');

        Route::post('store','TaskController@store');
        Route::get('create','TaskController@create');

        Route::get('edit/{id}','TaskController@edit');
        Route::post('update/{id}','TaskController@update');

        Route::get('destroy/{id}','TaskController@destroy');


    });
});
