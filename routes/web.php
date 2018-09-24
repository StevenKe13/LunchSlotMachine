<?php


Route::pattern('id', '[0-9]+');

Route::get('/', 'LunchController@index')->name('lunch.index');

Route::post('/ajaxGetAddress', 'LunchController@ajaxGetAddress')->name('lunch.ajaxGetAddress');


Route::group([
    'prefix' => '/item',
], function () {
    // 清單頁
    Route::get('/', 'LunchController@list')->name('lunch.item.index');

    // 新增
    Route::get('/create', 'LunchController@create')->name('lunch.item.create');

    // 儲存
    Route::post('/', 'LunchController@store')->name('lunch.item.store');

    // 編輯
    Route::get('/{id}/edit', 'LunchController@edit')->name('lunch.item.edit');

    // 更新
    Route::patch('/{id}', 'LunchController@update')->name('lunch.item.update');

    // 刪除
    Route::delete('/{id}', 'LunchController@destroy')->name('lunch.item.destroy');

    // 顯示
    Route::get('/{id}/show', 'LunchController@show')->name('lunch.item.show');

    // 修改狀態
    Route::post('/changeStatus', 'LunchController@changeStatus')->name('lunch.item.changeStatus');

});



