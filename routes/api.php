<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */


Route::group(['middleware' => ['ApiAuth']], function() {
    Route::any('/profile', 'ProfileController@index');
    Route::any('/profile/update', 'ProfileController@editProfile');
    Route::any('/images/upload', 'ProfileController@imagesUpdate');
    Route::any('/questions', 'QusansController@getAllQuestions');
    Route::any('search', 'SearchController@index');
    Route::any('lastActive', 'ProfileController@lastActive');
    Route::any('saveLikeDislike', 'FlopsController@saveLikeDislike'); 
    Route::any('getLikedDisliked', 'FlopsController@getLikedDisliked'); 
    Route::any('getMatchedProfile', 'FlopsController@matchedProfiles'); 
    
    
});
Route::any('pages', 'PagesController@getAllPages');
Route::any('register', 'UsersController@register');


