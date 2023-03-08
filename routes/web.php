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

Route::group(['middleware'=>'auth'], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix'=>'deposit'], function () {
        Route::get('/', 'DepositController@Index')->name('deposit');
        Route::post('deposit', 'DepositController@depositMoney')->name('money.deposit');
    });

    Route::group(['prefix'=>'withdraw'], function () {
        Route::get('/', 'WithdrawController@Index')->name('withdraw');
        Route::post('withdraw', 'WithdrawController@withdrawMoney')->name('money.withdraw');
    });

    Route::group(['prefix'=>'transfer'], function () {
        Route::get('/', 'TransferController@Index')->name('transfer');
        Route::post('transfer', 'TransferController@transferMoney')->name('money.transfer');
    });

    Route::group(['prefix'=>'statements'], function () {
        Route::get('/', 'StatementController@Index')->name('statements');
    });


    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

});
