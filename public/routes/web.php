<?php

/*
|--------------------------------------------------------------------------
| 1id Routes
|--------------------------------------------------------------------------
|
| Project doesn't use conventional routes; we are using one central entry-point
| defined in HomeController@index that makes analysis and decides what to do next
|
*/

Auth::routes();

Route::get('/', array('as'=>'1id.get-first-page', 'uses'=>'HomeController@getFirstPage'));

// Testing stuff, ignore..
Route::get('/lang', array('as'=>'1id.set-language', 'uses'=>'HomeController@setLanguage'));
Route::get('/dump-user', array('as'=>'test.dump.user', 'uses'=>'HomeController@dumpUser'));
Route::get('/dump-xp', array('as'=>'test.dump.xp', 'uses'=>'HomeController@dumpXp'));

// Admin : translator
Route::any('/translator/view/{key?}', array('as'=>'translator', 'uses'=>'TranslatorController@show'));
Route::post('/translator/new/', array('as'=>'translator.new', 'uses'=>'TranslatorController@addNew'));
Route::post('/translator/update/{key}', array('as'=>'translator.update', 'uses'=>'TranslatorController@update'));
Route::post('/translator/compile/', array('as'=>'translator.compile', 'uses'=>'TranslatorController@compile'));
Route::post('/translator/ajax/', array('as'=>'translator.ajax', 'uses'=>'TranslatorController@ajaxUpdate'));


// Admin : SCREEN BUILDER

Route::group(['prefix' => 'screenBuilder'], function () {

    // Screen CRUD
    // Route::get('/screens', array('as'=>'builder.screens', 'uses'=>'ScreenBuilderController@getScreens'));
    // Route::get('/screens/update/{id}', array('as'=>'builder.screen.get', 'uses'=>'ScreenBuilderController@getScreen'));
    // Route::post('/update/screen/{id?}', array('as' => 'builder.screen.post', 'uses'=>'ScreenBuilderController@postScreen'));
    // Screen Segment
    // Screen Fields
    // Route::get('/fields/view/{sid}/{fid?}', array('as'=>'builder.fields', 'uses'=>'ScreenBuilderController@getScreenFields'));
    // Route::post('/fields/update/{id}', 'ScreenBuilderController@postScreenFields');

    // Angular Stuff
    Route::get('/angular/index/', array('as' => 'builder.angular.index', 'uses'=>'ScreenBuilderController@getAngularView'));
    Route::get('/angular/get/{id?}', array('as' => 'builder.angular.index.get', 'uses'=>'ScreenBuilderController@getAngularData'));
    Route::get('/angular/partial-get/{id?}', array('as' => 'builder.angular.partial.index.get', 'uses'=>'ScreenBuilderController@getAngularDataPartial'));
    Route::get('/angular/lang', array('as' => 'builder.angular.lang.get', 'uses'=>'ScreenBuilderController@getAngularTranslationData'));
    Route::post('/angular/screen/update/{id?}', array('as'=>'builder.angular.screen.post', 'uses'=>'ScreenBuilderController@postScreen'));
    Route::post('/angular/fields/update/{id?}', array('as'=>'builder.angular.fields.post', 'uses'=>'ScreenBuilderController@updateFields'));
    Route::post('/update/screenSegment/{id?}', array('as' => 'builder.screen-segment.post', 'uses'=>'ScreenBuilderController@postScreenSegment'));

    // Misc
    Route::get('/schema', array('uses'=>'ScreenBuilderController@readAllTablesAndAllFields'));

});
// Test for generating CV
Route::get('test-user/cvb/{id}/{template?}', 'TestUserController@showCVBuilder')->name('user.cvb');
Route::get('test-user/cvb-download/{id}/{template?}', 'TestUserController@downloadCV')->name('user.cvb.download');
Route::get('test-user/cvb-delete/{id}/{template}', 'TestUserController@deleteCV')->name('user.cvb.delete');
Route::put('test-template/upload/{id}', 'TestTemplateController@upload')->name('template.upload');

Route::get('{any}', 'RequestResolver@index')->where('any', '.*');
Route::post('{any}', 'RequestResolver@index')->where('any', '.*');
//Route::get('/{whatever}', 'RequestResolver@index');
//Route::post('/{whatever}', 'RequestResolver@index');


// Route::get('/home', 'HomeController@index');
