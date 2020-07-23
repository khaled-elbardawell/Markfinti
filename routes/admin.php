<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------

*/


define('PAGINATION_COUNT',2);
//
//Route::get('image-cropper','ImageCropperController@index');
//Route::post('image-cropper/upload','ImageCropperController@upload');
//


Route::get('crop-image', 'ImageController@index');

Route::post('crop-image', ['as'=>'upload.image','uses'=>'ImageController@uploadImage']);

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'auth'],function (){

############################### start profile Routes ###############################
    Route::get('/profile','profileController@edit')->name('admin.profile.edit');
    Route::post('/profile','profileController@update')->name('admin.profile.update');

    Route::post('/profile/password','profileController@changePassword')->name('admin.manger.changePassword');
############################### end   profile Routes ###############################


############################### start Manger Routes ###############################
    Route::get('/manger/create','mangerController@create')->name('admin.manger.create');
    Route::post('manger/add','mangerController@store')->name('admin.manger.store');

    Route::get('/manger/view','mangerController@index')->name('admin.manger.index');

    Route::get('/manger/edit/{id}','mangerController@edit')->name('admin.manger.edit');
    Route::post('/manger/edit/{id}','mangerController@update')->name('admin.manger.update');

    Route::post('/manger/block/{id}','mangerController@block')->name('admin.manger.block');


    Route::post('/manger/unblock/{id}','mangerController@unblock')->name('admin.manger.unblock');
    Route::get('/manger/block','mangerController@viewBlock')->name('admin.manger.viewblock');
############################### end   Manger Routes ###############################


############################### start client Routes ###############################
    Route::get('/client/create','clientController@create')->name('admin.client.create');
    Route::post('client/add','clientController@store')->name('admin.client.store');

    Route::get('/client/','clientController@index')->name('admin.client.index');
    Route::get('/client/edit/{id}','clientController@edit')->name('admin.client.edit');
    Route::post('/client/update/{id}','clientController@update')->name('admin.client.update');

############################### end   client Routes ###############################



############################### start Service Routes ###############################
    Route::get('/service/','serviceController@index')->name('admin.service.index');

    Route::post('/service/store/{id}','serviceController@store')->name('admin.service.store');

    Route::post('/service/update/{id}','serviceController@update')->name('admin.service.update');

    Route::post('/service/delete/{id}','serviceController@delete')->name('admin.service.delete');

############################### end Service Routes ###############################



############################### start Progress Routes ###############################
    Route::get('/progress/','progressController@index')->name('admin.progress.index');

    Route::post('/progress/store/{id}','progressController@store')->name('admin.progress.store');

    Route::post('/progress/update/{id}','progressController@update')->name('admin.progress.update');

    Route::post('/progress/delete/{id}','progressController@delete')->name('admin.progress.delete');

############################### end Progress Routes ###############################


############################### start Type Report Routes ###############################
    Route::get('/report-type/','typereportController@index')->name('admin.type.index');

    Route::post('/report-type/store/{id}','typereportController@store')->name('admin.type.store');

    Route::post('/report-type/update/{id}','typereportController@update')->name('admin.type.update');

    Route::post('/report-type/delete/{id}','typereportController@delete')->name('admin.type.delete');

############################### end Type Report Routes ###############################




############################### start project Routes ###############################
    Route::get('/project/','projectController@index')->name('admin.project.index');

    Route::get('/project/create','projectController@create')->name('admin.project.create');
    Route::post('/project/store','projectController@store')->name('admin.project.store');

    Route::get('/project/edit/{id}','projectController@edit')->name('admin.project.edit');
    Route::post('/project/update/{id}','projectController@update')->name('admin.project.update');

    Route::get('/project/details/{id}','projectController@details')->name('admin.project.details');

    Route::get('/project/transaction/{id}','projectController@transaction')->name('admin.project.transaction');
    Route::post('/project/transaction/add/{id}','projectController@addTransaction')->name('admin.project.transaction.add');

    Route::get('/project/message/{id}','projectController@message')->name('admin.project.message');
    Route::post('/project/message/send/{id}','projectController@add_msg')->name('admin.project.create.message');


    Route::get('/project/report/{id}','reportController@index')->name('admin.project.report');

    Route::post('/project/report/store/{id}','reportController@store')->name('admin.project.report.add');

    Route::get('download/{file_name}','reportController@getDownload')->name('admin.project.report.download');

############################### end project Routes ###############################





});


