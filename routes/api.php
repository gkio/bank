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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customer/new/{name}', 'API\CustomerController@new_customer')->middleware('log');

Route::group(['prefix' => 'transaction', 'middleware' => 'log'], function () {
    Route::get('new/{customerId}/{amount}', 'API\TransactionController@new_transaction');
    Route::get('find/{customerId}/{transactionId}', 'API\TransactionController@find_transaction');

    // localhost/api/transaction/filtered/2/500/2018-01-18/1/1
    Route::get('filtered/{customerId}/{amount}/{date}/{offset}/{limit}', 'API\TransactionController@filter_transactions');

    Route::get('delete/{transactionId}', 'API\TransactionController@delete_transaction');
    Route::get('update/{transactionId}/{amount}', 'API\TransactionController@update_transaction');
});

