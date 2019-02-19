<?php

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::view('/admin/instastats-api', 'Admin::api.instastatsapi');
Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function () {

   

    Route::get('/admin/register', 'AdminController@registration');
    Route::post('/admin/register', 'AdminController@registration');
    Route::get('/admin/activation/{token}', 'AdminController@adminLogin');
    Route::get('/admin/login', 'AdminController@adminLogin');
    Route::post('/admin/login', 'AdminController@adminLogin');
    Route::get('/admin/resetpassword/{token}', 'AdminController@resetPassword');
    Route::post('/admin/resetpassword/{token}', 'AdminController@resetPassword');
    Route::get('/admin/forgotpassword', 'AdminController@forgotPassword');
    Route::post('/admin/forgotpassword', 'AdminController@forgotPassword');


    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/admin/dashboard', 'AdminController@adminDashboard');
        Route::post('/admin/dashboard', 'AdminController@adminDashboard');
        Route::get('/admin/logout', 'AdminController@adminLogout');
        Route::post('/admin/logout', 'AdminController@adminLogout');
        Route::get('/admin/resetpassword', 'AdminController@resetPassword');
        Route::post('/admin/resetpassword', 'AdminController@resetPassword');
        Route::get('/admin/myProfile', 'AdminController@myProfile');
        Route::post('/admin/myProfile', 'AdminController@myProfile');
        Route::get('/admin/lock', 'AdminController@lock');
        Route::post('/admin/lock', 'AdminController@lock');
        Route::get('/admin/datatable', ['uses' => 'AdminController@datatable']);
        Route::get('/admin/datatable/getposts', ['as' => 'datatable.getposts', 'uses' => 'AdminController@getPosts']);
        Route::get('/admin/changePassword', 'AdminController@changePassword');
        Route::post('/admin/changePassword', 'AdminController@changePassword');
        Route::get('/admin/update_user_status/{uid}', 'AdminController@update_user_status');


        
       





        
        /************************************************** */

        
        Route::get('/admin/EmployeeTable', 'EmplayeeController@EmployeeTable');
        Route::post('/admin/EmployeeTable', 'EmplayeeController@EmployeeTable');

        Route::get('/admin/EmployeeAjaxDatables', 'EmplayeeController@EmployeeAjaxDatables');
        Route::post('/admin/EmployeeAjaxDatables', 'EmplayeeController@EmployeeAjaxDatables');


        Route::get('/admin/deleteEmpAjaxHandler', 'EmplayeeController@deleteEmpAjaxHandler');
        Route::post('/admin/deleteEmpAjaxHandler', 'EmplayeeController@deleteEmpAjaxHandler');

        Route::get('/admin/addEmployee', 'EmplayeeController@addEmployee');
        Route::Post('/admin/addEmployee', 'EmplayeeController@addEmployee');



        Route::get('/admin/EditAjaxHandlerEmployee', 'EmplayeeController@EditAjaxHandlerEmployee');
        Route::post('/admin/EditAjaxHandlerEmployee', 'EmplayeeController@EditAjaxHandlerEmployee');

        Route::post('/admin/UpdateAjaxHandelerEmp', 'EmplayeeController@UpdateAjaxHandelerEmp');
        Route::post('/admin/getMoreEmpDetails', 'AddressController@getMoreEmpDetails');



        /************************************************** */

        Route::get('/admin/AddressTable', 'AddressController@AddressTable');
        Route::post('/admin/AddressTable', 'AddressController@AddressTable');

        Route::get('/admin/addressAjaxDatables', 'AddressController@addressAjaxDatables');
        Route::post('/admin/addressAjaxDatables', 'AddressController@addressAjaxDatables');


        Route::get('/admin/deleteAddressjaxHandler', 'AddressController@deleteAddressjaxHandler');
        Route::post('/admin/deleteAddressjaxHandler', 'AddressController@deleteAddressjaxHandler');

        Route::get('/admin/addAddress', 'AddressController@addAddress');
        Route::Post('/admin/addAddress', 'AddressController@addAddress');



        Route::get('/admin/EditAjaxHandlerAddress', 'AddressController@EditAjaxHandlerAddress');
        Route::post('/admin/EditAjaxHandlerAddress', 'AddressController@EditAjaxHandlerAddress');

        Route::post('/admin/UpdateAjaxHandelerAddress', 'AddressController@UpdateAjaxHandelerAddress');
        Route::post('/admin/getMoreDetails', 'AddressController@getMoreDetails');


        
    });
});




