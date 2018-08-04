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

//Route::pattern('id', '[0-9]+');


Route::get('/', [
    'as' => 'lunch.index',
    'uses' => 'LunchController@index'
]);

Route::post('/ajaxGetAddress', [
    'as' => 'lunch.ajaxGetAddress',
    'uses' => 'LunchController@ajaxGetAddress'
]);


Route::group([
    'prefix' => '/item',
], function () {
    // 清單頁
    Route::get('/', [
        'as' => 'lunch.item.index',
        'uses' => 'LunchController@list'
    ]);
    // 新增
    Route::get('create', [
        'as' => 'lunch.item.create',
        'uses' => 'LunchController@create'
    ]);
    // 儲存
    Route::post('/', [
        'as' => 'lunch.item.store',
        'uses' => 'LunchController@store'
    ]);
    // 編輯
    Route::get('{id}/edit', [
        'as' => 'lunch.item.edit',
        'uses' => 'LunchController@edit'
    ]);
    // 更新
    Route::patch('{id}', [
        'as' => 'lunch.item.update',
        'uses' => 'LunchController@update'
    ]);
    // 刪除
    Route::delete('{id}', [
        'as' => 'lunch.item.destroy',
        'uses' => 'LunchController@destroy'
    ]);
});



