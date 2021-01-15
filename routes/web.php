<?php

use App\Http\Controllers\ProjectUserController;
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




Route::group(['middleware' => ['auth'], 'prefix' => 'admin/'], function () {


    Route::group(['prefix' => 'project'], function () {
        Route::get('/', 'ProjectController@index')->name('home');
        Route::post('store', 'ProjectController@store');
        Route::get('create', 'ProjectController@create');
        Route::get('edit/{id}', 'ProjectController@edit');
        Route::post('update/{id}', 'ProjectController@update');
        Route::get('destroy/{id}', 'ProjectController@destroy');


        Route::group(['prefix' => 'task'], function () {
            Route::get('{id}', 'TaskController@index')->name('taskHome');
            Route::get('store/{id}', 'TaskController@store');
            Route::get('create/{id}', 'TaskController@create')->name('taskCreate');
            Route::get('edit/{id}', 'TaskController@edit');
            Route::post('update/{id}', 'TaskController@update')->name('taskUpdate');
            Route::get('destroy/{id}', 'TaskController@destroy');
            Route::get('feedback/{id}', 'CalculationController@feedback');
            Route::post('add_point/{id}', 'CalculationController@calculation');
        });


        Route::group(['prefix' => 'add_member'], function () {
            Route::get('update/{id}', 'ProjectUserController@update');
            Route::post('store', 'ProjectUserController@store');
            Route::get('edit/{id}', 'ProjectUserController@edit');
        });


        Route::get('delete_select/{id}', 'ProjectUserController@deleteSelect');
        Route::get('delete_member/{id}', 'ProjectUserController@deleteMember');



        Route::get('/calculation/{id}', 'CalculationController@calculation')->middleware('auth');
    });
});
