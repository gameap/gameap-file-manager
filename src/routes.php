<?php

Route::group([
    'middleware'    => config('file-manager.middleware'),
    'prefix'        => 'file-manager',
    'namespace'     => 'GameapAddons\FileManager\Controllers'
], function (){

    Route::get('{server}/initialize', 'FileManagerController@initialize')->name('fm.initialize')->middleware('serverDisks');

    Route::get('{server}/content', 'FileManagerController@content')->name('fm.content')->middleware('serverDisks');

    Route::get('{server}/tree', 'FileManagerController@tree')->name('fm.tree')->middleware('serverDisks');

    Route::get('{server}/select-disk', 'FileManagerController@selectDisk')->name('fm.selectDisk')->middleware('serverDisks');

    Route::post('{server}/upload', 'FileManagerController@upload')->name('fm.upload')->middleware('serverDisks');

    Route::post('{server}/delete', 'FileManagerController@delete')->name('fm.delete')->middleware('serverDisks');

    Route::post('{server}/paste', 'FileManagerController@paste')->name('fm.paste')->middleware('serverDisks');

    Route::post('{server}/rename', 'FileManagerController@rename')->name('fm.rename')->middleware('serverDisks');

    Route::get('{server}/download', 'FileManagerController@download')->name('fm.download')->middleware('serverDisks');

    Route::get('{server}/thumbnails', 'FileManagerController@thumbnails')->name('fm.thumbnails')->middleware('serverDisks');

    Route::get('{server}/preview', 'FileManagerController@preview')->name('fm.preview')->middleware('serverDisks');

    Route::get('{server}/url', 'FileManagerController@url')->name('fm.url')->middleware('serverDisks');

    Route::post('{server}/create-directory', 'FileManagerController@createDirectory')->name('fm.createDirectory')->middleware('serverDisks');

    Route::post('{server}/create-file', 'FileManagerController@createFile')->name('fm.createFile')->middleware('serverDisks');

    Route::post('{server}/update-file', 'FileManagerController@updateFile')->name('fm.uploadFile')->middleware('serverDisks');

    Route::get('{server}/stream-file', 'FileManagerController@streamFile')->name('fm.streamFile')->middleware('serverDisks');

    Route::post('{server}/zip', 'FileManagerController@zip')->name('fm.zip')->middleware('serverDisks');

    Route::post('{server}/unzip', 'FileManagerController@unzip')->name('fm.unzip')->middleware('serverDisks');

    // Route::get('properties', 'FileManagerController@properties');

    // Integration with editors
    Route::get('ckeditor', 'FileManagerController@ckeditor')->name('fm.cheditor');
});
