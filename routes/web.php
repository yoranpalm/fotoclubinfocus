<?php


Auth::routes();

Route::get('/', 'FotoController@home');
Route::resource('/foto', 'FotoController');

Route::resource('/camera', 'CameraController')->except('index');
Route::resource('/categorie', 'CategorieController')->except(['index', "destroy"]);
Route::resource('/recensie', 'RecensieController');

Route::get('/admin', 'AdminController@index');
Route::put('/admin/{user}', 'AdminController@update');
Route::delete('/admin/{user}', 'AdminController@delete');

Route::get('/info', 'InfoController@index')->name('info');

Route::post('/search', "UserSearchController@index");

//1 controller maybe
Route::get('/profiel/{user}', 'MemberOpenController@index')->name('mOpen');

Route::get('/privacy', 'PrivacyController@index')->name('privacy');

Route::get('/instellingen', 'MemberPrivateController@index')->name('mPrivate');
Route::get('/instellingen/{user}', 'MemberPrivateController@edit')->name('mPrivateEdit');
Route::put('/instellingen/{user}', 'MemberPrivateController@update')->name('mPrivateUpdate');
Route::get('/instellingen/{user}/request', 'MemberPrivateController@requestData')->name('mPrivateRequest');

Route::get('/privacy', 'PrivacyController@index')->name('privacy');

