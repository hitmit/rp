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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['guest']], function() {
	Route::get('porn/home', [
	    'as' => 'api.porn.home',
	    'uses' => 'ApiPornListsGenratorController@apiPornHome'
	]);

	Route::get('random/porn', [
	    'as' => 'api.random.porn',
	    'uses' => 'ApiPornListsGenratorController@apiPornList'
	]);

	Route::get('porn/category/{category_id}', [
	    'as' => 'api.porn.category',
	    'uses' => 'ApiPornListsGenratorController@apiPornCategory'
	]);

	Route::get('porn/tag/{tag_id}', [
	    'as' => 'api.porn.tag',
	    'uses' => 'ApiPornListsGenratorController@apiPornTag'
	]);

	Route::get('porn/video/{video_id}', [
	    'as' => 'api.porn.video',
	    'uses' => 'ApiPornListsGenratorController@apiPornVideo'
	]);
});