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
Route::get('/{state}', function ($state) {
    setcookie('state', $state);
    return redirect('/');
});

// Route::get('/login', 'MainController@loginPage');

// Route::get('/register', 'MainController@registerPage');

// Route::post('/login', 'UserController@login');

Route::post('/user/authenticate', 'UserController@login');

Route::post('/user/register', 'UserController@create')->middleware('user-exists');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('/office_entity_types', 'OfficeEntityTypeController@getAllOfficeEntityTypes');
    Route::get('/office_entity_type/{id}','OfficeEntityTypeController@show');
    Route::post('/office_entity_type/create', 'OfficeEntityTypeController@create')->middleware('admin');
    Route::put('/office_entity_type/update/{id}', 'OfficeEntityTypeController@update')->middleware('admin');
    Route::delete('/office_entity_type/delete/{id}', 'OfficeEntityTypeController@delete')->middleware('admin');

    Route::get('/office_entities', 'OfficeEntityController@getAllEntities');
    Route::get('/office_entities/find', 'OfficeEntityController@search');
    Route::get('/office_entity/{id}', 'OfficeEntityController@show');
    Route::post('/office_entity/create', 'OfficeEntityController@create')->middleware('moderator');
    Route::put('/office_entity/update/{id}', 'OfficeEntityController@update')->middleware('moderator');
    Route::delete('/office_entity/delete/{id}', 'OfficeEntityController@delete')->middleware('moderator');

    Route::get('/items', 'ItemController@getAllItems');
    Route::get('/item/{id}', 'ItemController@getById');
    Route::post('/item/create', 'ItemController@create');
    Route::put('/item/update/{id}', 'ItemController@update');
    Route::delete('/item/delete/{id}', 'ItemController@delete');

    Route::get('/branches', 'BranchController@getAllBranches');
    Route::get('/branch/{id}', 'BranchController@getById');
    Route::post('/branch/create', 'BranchController@create')->middleware('admin');
    Route::put('/branch/update/{id}', 'BranchController@update')->middleware('admin');
    Route::delete('/branch/delete/{id}', 'BranchController@delete')->middleware('admin');

    Route::get('/vouchers', 'VoucherController@getAllVouchers');
    Route::get('/voucher/{id}', 'VoucherController@getById');
    Route::post('/voucher/create', 'VoucherController@create');
    Route::put('/voucher/update/{id}', 'VoucherController@update')->middleware('confirm-voucher-status');
    Route::delete('/voucher/delete/{id}', 'VoucherController@delete')->middleware('confirm-voucher-status');
    Route::get('/vouchers/find', 'VoucherController@searchText');
    Route::get('/vouchers/user', 'VoucherController@getUserVouchers');
    Route::get('/vouchers/office_entities', 'VoucherController@getOfficeEntityVouchers')->middleware('manage-office-entity-vouchers');
    Route::get('/vouchers/payable', 'VoucherController@getPayableVouchers')->middleware('pay-voucher');
    Route::put('/voucher/approve/{voucherId}', 'VoucherController@approveVoucher')->middleware('approve-voucher');
    Route::put('/voucher/paid/{voucherId}', 'VoucherController@hasPaidVoucher')->middleware('pay-voucher');

    Route::get('/voucher-trails', 'VoucherTrailController@getAllVoucherTrails')->middleware('admin');
    Route::get('/voucher-trails/user', 'VoucherTrailController@getUserVoucherTrails');
    Route::get('/voucher-trails/find', 'VoucherTrailController@search')->middleware('admin');

    Route::get('/users', 'UserController@getAllUsers');
    Route::get('/user/{id}', 'UserController@getById');
    Route::put('/user/update/{id}', 'UserController@update');
    Route::delete('/user/delete/{id}', 'UserController@delete')->middleware('admin');

    Route::get('/employees', 'UserController@getCategorizedEmployees');

    Route::get('/roles', 'RolesAndClaimsController@getAllRoles');

    Route::post('/role-with-claims/create', 'RolesAndClaimsController@create');
    Route::put('/role-with-claims/assign', 'RolesAndClaimsController@assignRole')->middleware('moderator');
    Route::delete('/role-with-claims/retract-user-role', 'RolesAndClaimsController@retractUserRole')->middleware('moderator');
    Route::delete('/role-with-claims/retract-user-claims', 'RolesAndClaimsController@retractUserClaims')->middleware('moderator');
    Route::delete('/role-with-claims/retract-role-claims', 'RolesAndClaimsController@retractRoleClaims')->middleware('moderator');

});