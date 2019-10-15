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

	Route::get('/bookmarks/index', array('as'=>'bookmarks.index', 'uses'=>'BookmarkController@index'));
	Route::get('/bookmarks/check/', array('as'=>'bookmarks.check', 'uses'=>'BookmarkController@check'));
    Route::get('/bookmarks/tags/', array('as'=>'bookmarks.tags', 'uses'=>'BookmarkController@getTagsWithUrl'));
	Route::post('/bookmarks/add/', array('as'=>'bookmarks.add', 'uses'=>'BookmarkController@add'));
	Route::post('/bookmarks/delete/', array('as'=>'bookmarks.delete', 'uses'=>'BookmarkController@delete'));
    Route::post('/bookmarks/tag-bookmark/', array('as'=>'bookmarks.tag_bookmark', 'uses'=>'BookmarkController@tagBookmark'));
    Route::post('/bookmarks/untag-bookmark/', array('as'=>'bookmarks.untag_bookmark', 'uses'=>'BookmarkController@untagBookmark'));
    Route::post('/bookmarks/add-tag/', array('as'=>'bookmarks.add_tag', 'uses'=>'BookmarkController@addTag'));
});
