<?php
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return view('admin.login');
});



//tem url for delete related like dilike
Route::get('/farziUrl/{id}', function ($id) {
        DB::table('flops')->where('user_id',$id)->delete();
        echo 'All clear!!!';
    });

Route::get('miles', 'TestController@miles');
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin', function () {
        return view('admin.login');
    });
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('questions', 'QusansController@index');
    Route::resource('qusans', 'QusansController');
    Route::get('users', 'UsersController@index');
    Route::resource('users', 'UsersController');
    Route::resource('pages', 'PagesController');
    Route::get('/dashboard', function () {
        $males = DB::table('users')->where('role','<>','143')->where(['gender' => 'male'])->count();
        $females = DB::table('users')->where('role','<>','143')->where(['gender' => 'female'])->count();
        $totalmf = DB::table('users')->where('role','<>','143')->count();
        return view('dashboard', compact('males', 'females', 'totalmf'));
    });
    Route::get('/logout', 'Auth\LoginController@logout');
});
Auth::routes();
