<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return view('index');
});

$router->group(['prefix' => 'api'], function () use($router){
    $router->get('/office_entity_types', 'OfficeEntityTypeController@index');
    $router->get('/office_entity_type/{id}','OfficeEntityTypeController@show');
    $router->post('/office_entity_type/create', 'OfficeEntityTypeController@create');
    $router->put('/office_entity_type/update/{id}', 'OfficeEntityTypeController@update');
    $router->delete('/office_entity_type/delete/{id}', 'OfficeEntityTypeController@delete');

    $router->get('/office_entities', 'OfficeEntityController@index');
    $router->get('/office_entity/{id}', 'OfficeEntityController@show');
    $router->post('/office_entity/create', 'OfficeEntityController@create');
    $router->put('/office_entity/update/{id}', 'OfficeEntityController@update');
    $router->delete('/office_entity/delete/{id}', 'OfficeEntityController@delete');

    $router->get('/items', 'ItemController@getAllItems');
    $router->get('/item/{id}', 'ItemController@getById');
    $router->post('/item/create', 'ItemController@create');
    $router->put('/item/update/{id}', 'ItemController@update');
    $router->delete('/item/delete/{id}', 'ItemController@delete');

    $router->get('/branches', 'BranchController@getAllBranches');
    $router->get('/branch/{id}', 'BranchController@getById');
    $router->post('/branch/create', 'BranchController@create');
    $router->put('/branch/update/{id}', 'BranchController@update');
    $router->delete('/branch/delete/{id}', 'BranchController@delete');

    $router->get('/vouchers', 'VoucherController@getAllVouchers');
    $router->get('/voucher/{id}', 'VoucherController@getById');
    $router->post('/voucher/create', 'VoucherController@create');
    $router->put('/voucher/update/{id}', 'VoucherController@update');
    $router->delete('/voucher/delete/{id}', 'VoucherController@delete');
    $router->get('/vouchers/user', 'VoucherController@getUserVouchers');
    $router->get('/vouchers/office_entities', 'VoucherController@getOfficeEntityVouchers');
    $router->get('/vouchers/payable', 'VoucherController@getPayableVouchers');
    $router->put('/voucher/approve/{voucherId}', 'VoucherController@approveVoucher');
    $router->put('/voucher/paid/{voucherId}', 'VoucherController@hasPaidVoucher');

    $router->get('/users', 'UserController@getAllUsers');
    $router->get('/user/{id}', 'UserController@getById');
    $router->put('/user/update/{id}', 'UserController@update');
    $router->delete('/user/delete/{id}', 'UserController@delete');


});


