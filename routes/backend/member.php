<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename member.php
 * @LastModified 20/06/2020, 01:56
 */

Route::group([
    'middleware' => [
        'prevent.back.history'
    ],
    'prefix'     => 'members'
], function () {
    //Resource Route
    Route::get('', 'MemberController@index')
        ->name('member.index')->middleware('sentinel.permission:member.show');

    Route::get('/create', 'MemberController@create')
        ->name('member.create')->middleware('sentinel.permission:member.create');

    Route::post('', 'MemberController@store')
        ->name('member.store')->middleware('sentinel.permission:member.create');

    Route::get('/{id}/show', 'MemberController@show')
        ->name('member.show')->middleware('sentinel.permission:member.show');

    Route::get('/{id}/edit', 'MemberController@edit')
        ->name('member.edit')->middleware('sentinel.permission:member.edit');

    Route::put('/{id}', 'MemberController@update')
        ->name('member.update')->middleware('sentinel.permission:member.edit');

    // For Datatables
    Route::get('/ajax/data', 'MemberController@datatable')
        ->name('member.ajax.data')->middleware('sentinel.permission:member.show');

    //Select2 Route
    Route::get('/ajax/select2', 'MemberController@select2')
        ->name('member.ajax.select2')->middleware('sentinel.permission:member.show');

    Route::get('/ajax/email/select2', 'MemberController@select2Email')
        ->name('member.email.ajax.select2')->middleware('sentinel.permission:member.show');

    //Excel
    Route::get('/excel/import', 'MemberController@excelImport')
        ->name('member.excel.import')->middleware('sentinel.permission:member_excel.import');

    Route::post('/excel/import/store', 'MemberController@excelImportStore')
        ->name('member.excel.import.store')->middleware('sentinel.permission:member_excel.import');

    Route::get('/excel/export', 'MemberController@excelExport')
        ->name('member.excel.export')->middleware('sentinel.permission:member_excel.export');

    Route::post('/excel/export/store', 'MemberController@excelExportStore')
        ->name('member.excel.export.store')->middleware('sentinel.permission:member_excel.export');

    Route::get('/{id}/chat/show', 'MemberController@chat_show')
        ->name('member.chat.show')->middleware('sentinel.permission:member.show');

    Route::post('/chat/store', 'MemberController@store_chat')
        ->name('member.chat.store')->middleware('sentinel.permission:member.show');

    Route::post('/chat/image/store', 'MemberController@store_chat_image')
        ->name('member.chat.image.store')->middleware('sentinel.permission:member.show');

    Route::post('/chat/document/store', 'MemberController@store_chat_document')
        ->name('member.chat.document.store')->middleware('sentinel.permission:member.show');

    Route::post('/chat/template/store', 'MemberController@store_chat_template')
        ->name('member.chat.template.store')->middleware('sentinel.permission:member.show');

    Route::get('guest/{id}/chat/show', 'MemberController@guest_chat_show')
        ->name('member.guest.chat.show')->middleware('sentinel.permission:member.show');

    Route::post('guest/chat/store', 'MemberController@guest_store_chat')
        ->name('member.guest.chat.store')->middleware('sentinel.permission:member.show');

    Route::post('guest/chat/image/store', 'MemberController@guest_store_chat_image')
        ->name('member.guest.chat.image.store')->middleware('sentinel.permission:member.show');

    Route::post('guest/chat/document/store', 'MemberController@guest_store_chat_document')
        ->name('member.guest.chat.document.store')->middleware('sentinel.permission:member.show');

    Route::post('guest/chat/template/store', 'MemberController@guest_store_chat_template')
        ->name('member.guest.chat.template.store')->middleware('sentinel.permission:member.show');

    Route::post('chat/upload/images', 'MemberController@uploadImage')
        ->name('member.chat.upload.image')->middleware('sentinel.permission:member.show');

    Route::post('chat/upload/images/destroy', 'MemberController@destroyImage')
        ->name('member.chat.upload.image.destroy')->middleware('sentinel.permission:member.show');
});
