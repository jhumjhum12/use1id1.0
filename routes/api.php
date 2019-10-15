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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user/view', function (Request $request) {
		return $request->user();
	});

	// Reading list routes
	Route::get('/bookmarks/check/', ['as'=>'bookmarks.check', 'uses'=>'BookmarkController@check']);
    Route::get('/bookmarks/tags/', ['as'=>'bookmarks.tags', 'uses'=>'BookmarkController@getTagsWithUrl']);
	Route::post('/bookmarks/add/', ['as'=>'bookmarks.add', 'uses'=>'BookmarkController@add']);
	Route::post('/bookmarks/delete/', ['as'=>'bookmarks.delete', 'uses'=>'BookmarkController@delete']);
    Route::post('/bookmarks/tag-bookmark/', ['as'=>'bookmarks.tag_bookmark', 'uses'=>'BookmarkController@tagBookmark']);
    Route::post('/bookmarks/untag-bookmark/', ['as'=>'bookmarks.untag_bookmark', 'uses'=>'BookmarkController@untagBookmark']);
    Route::post('/bookmarks/add-tag/', ['as'=>'bookmarks.add_tag', 'uses'=>'BookmarkController@addTag']);
	
	// Password manager routes
	Route::get('/saved-passwords/index/', 'SavedPasswordController@index')->name('pass_manager.sites');
	Route::post('/saved-passwords/update/', 'SavedPasswordController@updateSite')->name('pass_manager.update');
	Route::post('/saved-passwords/create/', 'SavedPasswordController@createSite')->name('pass_manager.create');
});
