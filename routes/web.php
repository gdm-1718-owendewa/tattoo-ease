<?php

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



Auth::routes();
Route::get('/', 'ProfileController@index')->name('base')->middleware('auth');

Route::get('/home', 'ProfileController@index')->name('home');
Route::get('/logout', 'LogoutController@logout')->name('logout');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit/{id}', 'ProfileController@getEditPage')->name('profileEditPage');
Route::post('/profile/save/contract/{id}', 'ProfileController@saveContract')->name('saveprofilecontract');
Route::post('/profile/save/{id}', 'ProfileController@save')->name('saveprofile');

Route::get('/contract', 'ContractController@index')->name('contract');
Route::post('/contract/create/{id}', 'ContractController@create')->name('createcontract');

Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::get('/contacts/remove/{id}', 'ContactController@removeContact')->name('removecontact');
Route::get('/contacts/add/{id}', 'ContactController@addContact')->name('addcontact');

Route::get('/info-page/{id}', 'InfopageController@index')->name('info-page');
Route::get('/gallery', 'GalleryController@index')->name('gallery');
Route::post('/gallery/add', 'GalleryController@addDesign')->name('galleryAddDesign');
Route::get('/gallery/choosedesign/{clientid}', 'GalleryController@choosedesign')->name('gallerychoosedesigns');
Route::get('/gallery/choosedesign/senddesign/{clientid}/{designid}', 'GalleryController@senddesign')->name('gallerysenddesign');
Route::get('/gallery/edit/{designid}', 'GalleryController@edit')->name('galleryeditdesign');
Route::post('/gallery/save/{id}', 'GalleryController@save')->name('savegallery');

Route::get('/notifications', 'NotificationsController@index')->name('notifications');

Route::post('/decline-design/{notification_id}/{artist_id}/{design_id}/{client_id}', 'NotificationsController@declineDesign')->name('declineDesign');
Route::get('/accept-design/{notification_id}/{artist_id}/{design_id}/{client_id}', 'NotificationsController@acceptDesign')->name('acceptDesign');

Route::get('/admin-dash', 'AdminController@index')->name('admin-dash');
Route::get('/admin/users', 'AdminController@users')->name('admin-users');
Route::get('/admin/users/edit/{id}', 'AdminController@usersEdit')->name('admin-users-edit');
Route::get('/admin/users/remove/{id}', 'AdminController@usersDelete')->name('admin-users-delete');

Route::get('/admin/designs', 'AdminController@designs')->name('admin-designs');
Route::get('/admin/designs/delete/{designid}', 'AdminController@designsDelete')->name('admin-designs-delete');
