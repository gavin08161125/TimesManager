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
    Route::get('/profile','UserController@profile');
    //專案
    Route::group(['prefix' => 'project'], function () {
        Route::get('/', 'ProjectController@index')->name('home');
        Route::post('store', 'ProjectController@store');
        Route::get('create', 'ProjectController@create');
        Route::get('edit/{id}', 'ProjectController@edit');
        Route::post('update/{id}', 'ProjectController@update');
        Route::get('destroy/{id}', 'ProjectController@destroy');

        //任務
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

        //新增成員
        Route::group(['prefix' => 'add_member'], function () {
            Route::get('update/{id}', 'ProjectUserController@update');
            Route::post('store', 'ProjectUserController@store');
            Route::get('edit/{id}', 'ProjectUserController@edit');
        });

        //刪除成員
        Route::get('delete_select/{id}', 'ProjectUserController@deleteSelect');
        Route::get('delete_member/{id}', 'ProjectUserController@deleteMember');

        //計算點數
        Route::post('/calculation/{id}', 'CalculationController@calculation')->middleware('auth');

        //將專案封存按鈕狀態變為2，讓按鈕disabled
        Route::get('/endProject/{id}', 'CalculationController@endProject');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'user/'], function () {
        //管理者權限(提高其他帳號權限、部門更新、職位、會員資訊更新)
        Route::get('/', 'UserController@index');
        Route::get('/edit/{id}', 'UserController@edit');
        Route::post('/update/{id}', 'UserController@update');
        Route::get('/destroy/{id}', 'UserController@destroy');
    });
    //點數歷程
    Route::get('/pointLog/{id}','UserController@pointLog');

    //工作日誌
    Route::get('/to_do_list/{id}','ToDoListController@index');
    Route::post('/to_do_list/create/{id}','ToDoListController@addList');
    Route::get('/to_do_list/update/{id}','ToDoListController@updateList');
    Route::get('/to_do_list/destroy/{id}','ToDoListController@deleteList');

    //小人對話
    Route::post('/talk/create/{id}','UserController@createTalk');
    Route::get('/talk/index','UserController@indexTalk');
    Route::get('/talk/destroy/{id}','UserController@deleteTalk');

    //樂透
    Route::get('/lotto/game/{id}','LottoController@lottoGame');
    Route::get('/lotto/index','LottoController@lottoIndex');

});
