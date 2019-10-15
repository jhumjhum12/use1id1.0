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
Route::get('/home', array('as'=>'1id.get-first-page', 'uses'=>'HomeController@getFirstPage'));
Route::post('/send-feedback', array('as'=>'send.feedback', 'uses'=>'HomeController@sendFeedback'));
Route::get('/mail/verification/{email}/{code}', array('as' => 'auth.email.verification', 'uses'=>'HomeController@verifyEmail'));

// Testing stuff, ignore..
Route::get('/lang', array('as'=>'1id.set-language', 'uses'=>'HomeController@setLanguage'));
Route::get('/dump-user', array('as'=>'test.dump.user', 'uses'=>'HomeController@dumpUser'));
Route::get('/dump-xp', array('as'=>'test.dump.xp', 'uses'=>'HomeController@dumpXp'));
Route::get('/ping-email', array('uses'=>'HomeController@emailTest'));

// Admin : translator
Route::any('/translator/view/{key?}', array('as'=>'translator', 'uses'=>'TranslatorController@show'));
Route::post('/translator/new/', array('as'=>'translator.new', 'uses'=>'TranslatorController@addNew'));
Route::post('/translator/update/{key}', array('as'=>'translator.update', 'uses'=>'TranslatorController@update'));
Route::post('/translator/compile/', array('as'=>'translator.compile', 'uses'=>'TranslatorController@compile'));
Route::post('/translator/ajax/', array('as'=>'translator.ajax', 'uses'=>'TranslatorController@ajaxUpdate'));
Route::get('/translator/yandex/{id}', array('as'=>'translator.yandex', 'uses'=>'TranslatorController@translateFromYandex'));



Route::any('Customize/', array('as'=>'customize', 'uses'=>'CustomizeController@index'));
Route::post('get-tree-data', array('uses'=>'CustomizeController@fetchdata'));
Route::post('savecountry', array('uses'=>'CustomizeController@savecountry'));

Route::get('/Customize/layout/{id}', array('as'=>'customize-layout', 'uses'=>'CustomizeController@showLayout'));
Route::post('get-layouttree-data', array('uses'=>'CustomizeController@fetchLayoutData'));
Route::post('savelayoutdata', array('uses'=>'CustomizeController@saveLayoutData'));
Route::post('deletecustomizedata', array('uses'=>'CustomizeController@deletecustomizedata'));
Route::post('get-add-layout', array('uses'=>'CustomizeController@getaddlayout'));
Route::post('addnewrow', array('uses'=>'CustomizeController@addnewrow'));
//Route::post('export', array('uses'=>'CustomizeController@tableexpport'));
Route::get('downloadcustomizetables/{type}/{tableid}', array('uses'=>'CustomizeController@downloadCustomizeTables'));

Route::post('import', array('uses'=>'CustomizeController@importdata'));
Route::get('/Customize/info/{id}', array('as'=>'customize-info', 'uses'=>'CustomizeController@getCustomizeTableInfo'));
Route::post('/Customize/opentxtareapopup', array('as'=>'customize-opentxtareapopup', 'uses'=>'CustomizeController@getTextAreaPopUp'));


// Member tools: Google Auth

Route::group(['prefix' => 'google'], function () {
    Route::get('/auth/', array('as' => 'google.auth', 'uses'=>'ContactsController@googleAuth'));
    // Route::get('/add/', array('as' => 'google.add', 'uses'=>'ContactsController@googleAddContactTest'));
    Route::get('/update/', array('as' => 'google.update', 'uses'=>'ContactsController@googleUpdateContact'));
});

// Admin tools: SCREEN BUILDER

Route::group(['prefix' => 'screenBuilder'], function () {
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


// Members tools:

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', array('as' => 'contacts.view', 'uses'=>'ContactsController@getView'));
    Route::get('/invite/', array('as' => 'contacts.invite', 'uses'=>'ContactsController@getInvite'));
    Route::get('/search-users/', array('as' => 'contacts.search', 'uses'=>'ContactsController@getSearch'));
    Route::get('/view/{id}', array('as' => 'contacts.view.details', 'uses'=>'ContactsController@getContactDetails'));
    Route::get('/accept/{email}', array('as' => 'contacts.accept-invite', 'uses'=>'ContactsController@acceptInvite'));
    Route::get('/invite/email', array('as' => 'contacts.invite.get', 'uses'=>'ContactsController@sendInvitationGet'));
    Route::post('/invite/email', array('as' => 'contacts.invite.post', 'uses'=>'ContactsController@sendInvitationPost'));
    Route::post('/update-sharing/{id}', array('as' => 'contacts.update-sharing.post', 'uses'=>'ContactsController@updateSharing'));
});

Route::group(['prefix' => 'companies'], function () {
    Route::get('/view', array('as' => 'companies.view', 'uses'=>'ContactsController@getCompaniesView'));
    Route::get('/search-companies/', array('as' => 'contacts.companies.search', 'uses'=>'ContactsController@getSearchCompanies'));
    Route::post('/invite/company/{id}', array('as' => 'contacts.company.post', 'uses'=>'ContactsController@contactCompanyPost'));
});


Route::group(['prefix' => 'biography'], function () {
    Route::get('/', array('as' => 'biography.version', 'uses'=>'BiographyController@version'));
    Route::post('/post-version-data', 'BiographyController@saveversiondata');
    Route::post('/get-version-data', 'BiographyController@getversiondata');
	Route::post('/edit-version-data', 'BiographyController@editversiondata');
	Route::post('/delete-version-data', 'BiographyController@deleteversiondata');
	Route::post('/copy-version-data', 'BiographyController@copyversiondata');
	Route::post('/postcopy-version-data', 'BiographyController@postcopyversiondata');
	Route::post('/getdataversionwise', 'BiographyController@getdataversionwise');
});

Route::post('/biography/getVersion', 'BiographyController@getVersion');
Route::post('/getversiondetails', 'BiographyController@getversiondetails');

Route::group(['prefix' => 'loyalty-cards'], function () {
    Route::get('/', array('as' => 'loyalty.view', 'uses'=>'LoyaltyController@getView'));
});

// Test for generating CV
// Route::get('resume-generator/', 'ResumeTemplateController@showResumeGenerator')->name('resume_template.view');
// Route::get('resume-generator/download/{template}/{version}', 'ResumeTemplateController@downloadResume')->name('resume_template.download');
// Route::get('resume-generator/delete/{template}', 'ResumeTemplateController@deleteResume')->name('resume_template.delete');
// Route::post('resume-generator/upload/', 'ResumeTemplateController@upload')->name('resume_template.upload');
// Route::get('resume-generator/download-example/', function () {
	// $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		// 'Content-Disposition: attachment;filename="Example_Template.docx"'];
	// $fullPath = storage_path() . '/Example_Template.docx';
	// return response()->download($fullPath, "Example_Template.docx", $headers);
// })->name("example_template.download");
// Route::get('resume-generator/download-example2/', function () {
	// $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		// 'Content-Disposition: attachment;filename="Example_Two_Rows.docx"'];
	// $fullPath = storage_path() . '/Example_Two_Rows.docx';
	// return response()->download($fullPath, "Example_Two_Rows.docx", $headers);
// })->name("example_template2.download");



//////2.9.19//////


Route::get('resume-generator/', 'ResumeTemplateController@showResumeGeneratornew')->name('resume_template.resume-generator-new');
Route::get('resume-generator-new/download/{template}/{version}/{popupid}', 'ResumeTemplateController@downloadResumeNew')->name('resume_template_new.download');
Route::get('resume-generator-new/delete/{template}', 'ResumeTemplateController@deletenewResume')->name('resume_template_new.delete');
Route::post('resume-generator-new/upload/', 'ResumeTemplateController@upload')->name('resume_template.upload');
Route::get('resume-generator-new/download-example/', function () {
	$headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'Content-Disposition: attachment;filename="Example_Template.docx"'];
	$fullPath = storage_path() . '/Example_Template.docx';
	return response()->download($fullPath, "Example_Template.docx", $headers);
})->name("example_template.download");
Route::get('resume-generator-new/download-example2/', function () {
	$headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'Content-Disposition: attachment;filename="Example_Two_Rows.docx"'];
	$fullPath = storage_path() . '/Example_Two_Rows.docx';
	return response()->download($fullPath, "Example_Two_Rows.docx", $headers);
})->name("example_template2.download");

Route::post('/post-resume-template', 'ResumeTemplateController@posttemplate');
Route::post('/get-template', 'ResumeTemplateController@gettemplate');

Route::get('social/google', ['as'=>'google.contacts', 'uses'=>'ContactsController@googleContacts']);

Route::get('{any}', 'RequestResolver@index')->where('any', '.*');
Route::post('{any}', 'RequestResolver@index')->where('any', '.*');



