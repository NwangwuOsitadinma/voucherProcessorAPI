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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'MainController@index')->middleware('auth');

// Route::get('/login', 'MainController@loginPage');

// Route::get('/register', 'MainController@registerPage');

// Route::post('/login', 'UserController@login');

Route::post('/user/authenticate', 'UserController@login');

Route::post('/user/register', 'UserController@create');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('/office_entity_types', 'OfficeEntityTypeController@getAllOfficeEntityTypes');
    Route::get('/office_entity_type/{id}','OfficeEntityTypeController@show');
    Route::post('/office_entity_type/create', 'OfficeEntityTypeController@create');
    Route::put('/office_entity_type/update/{id}', 'OfficeEntityTypeController@update');
    Route::delete('/office_entity_type/delete/{id}', 'OfficeEntityTypeController@delete');

    Route::get('/office_entities', 'OfficeEntityController@getAllEntities');
    Route::get('/office_entity/{id}', 'OfficeEntityController@show');
    Route::post('/office_entity/create', 'OfficeEntityController@create');
    Route::put('/office_entity/update/{id}', 'OfficeEntityController@update');
    Route::delete('/office_entity/delete/{id}', 'OfficeEntityController@delete');

    Route::get('/items', 'ItemController@getAllItems');
    Route::get('/item/{id}', 'ItemController@getById');
    Route::post('/item/create', 'ItemController@create');
    Route::put('/item/update/{id}', 'ItemController@update');
    Route::delete('/item/delete/{id}', 'ItemController@delete');

    Route::get('/branches', 'BranchController@getAllBranches');
    Route::get('/branch/{id}', 'BranchController@getById');
    Route::post('/branch/create', 'BranchController@create');
    Route::put('/branch/update/{id}', 'BranchController@update');
    Route::delete('/branch/delete/{id}', 'BranchController@delete');

    Route::get('/vouchers', 'VoucherController@getAllVouchers');
    Route::get('/voucher/{id}', 'VoucherController@getById');
    Route::post('/voucher/create', 'VoucherController@create');
    Route::put('/voucher/update/{id}', 'VoucherController@update');
    Route::delete('/voucher/delete/{id}', 'VoucherController@delete');
    Route::get('/vouchers/user', 'VoucherController@getUserVouchers');
    Route::get('/vouchers/office_entities', 'VoucherController@getOfficeEntityVouchers');
    Route::get('/vouchers/payable', 'VoucherController@getPayableVouchers');
    Route::put('/voucher/approve/{voucherId}', 'VoucherController@approveVoucher');
    Route::put('/voucher/paid/{voucherId}', 'VoucherController@hasPaidVoucher');

    Route::get('/users', 'UserController@getAllUsers');
    Route::get('/user/{id}', 'UserController@getById');
    Route::put('/user/update/{id}', 'UserController@update');
    Route::delete('/user/delete/{id}', 'UserController@delete');


});