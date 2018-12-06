<?php

Route::group([
    'middleware'    => config('file-manager.middleware'),
    'prefix'        => 'file-manager',
    'namespace'     => 'GameapAddons\FileManager\Controllers'
], function (){

    Route::get('{server}/initialize', 'FileManagerController@initialize')->name('fm.initialize');

    Route::get('{server}/content', 'FileManagerController@content')->name('fm.content');

    Route::get('{server}/tree', 'FileManagerController@tree')->name('fm.tree');

    Route::get('{server}/select-disk', 'FileManagerController@selectDisk')->name('fm.selectDisk');

    Route::post('{server}/upload', 'FileManagerController@upload')->name('fm.upload');

    Route::post('{server}/delete', 'FileManagerController@delete')->name('fm.delete');

    Route::post('{server}/paste', 'FileManagerController@paste')->name('fm.paste');

    Route::post('{server}/rename', 'FileManagerController@rename')->name('fm.rename');

    Route::get('{server}/download', 'FileManagerController@download')->name('fm.download');

    Route::get('{server}/thumbnails', 'FileManagerController@thumbnails')->name('fm.thumbnails');

    Route::get('{server}/preview', 'FileManagerController@preview')->name('fm.preview');

    Route::get('{server}/url', 'FileManagerController@url')->name('fm.url');

    Route::post('{server}/create-directory', 'FileManagerController@createDirectory')->name('fm.createDirectory');

    Route::post('{server}/create-file', 'FileManagerController@createFile')->name('fm.createFile');

    Route::post('{server}/update-file', 'FileManagerController@updateFile')->name('fm.uploadFile');

    Route::get('{server}/stream-file', 'FileManagerController@streamFile')->name('fm.streamFile');

    Route::post('{server}/zip', 'FileManagerController@zip')->name('fm.zip');

    Route::post('{server}/unzip', 'FileManagerController@unzip')->name('fm.unzip');

    // Route::get('properties', 'FileManagerController@properties');

    // Integration with editors
    Route::get('ckeditor', 'FileManagerController@ckeditor')->name('fm.cheditor');
});
