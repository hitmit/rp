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

Route::get('/', [
    'as' => 'porn.home',
    'uses' => 'PornListsGenratorController@pornHome'
]);

Route::get('/categories', [
    'as' => 'porn.categories',
    'uses' => 'PornListsGenratorController@pornCategories'
]);

Route::get('/porn/category/{category_id}', [
    'as' => 'porn.category',
    'uses' => 'PornListsGenratorController@pornCategory'
]);

Route::get('/tags', [
    'as' => 'porn.tags',
    'uses' => 'PornListsGenratorController@pornTags'
]);

Route::get('/porn/tag/{tag_id}', [
    'as' => 'porn.tag',
    'uses' => 'PornListsGenratorController@pornTag'
]);

Route::get('/porn/video/{video_id}', [
    'as' => 'porn.video',
    'uses' => 'PornListsGenratorController@pornVideo'
]);

Route::get('/random', [
    'as' => 'porn.random',
    'uses' => 'PornListsGenratorController@pornList'
]);

Route::get('/search', [
    'as' => 'porn.search',
    'uses' => 'PornListsGenratorController@pornSearch'
]);
