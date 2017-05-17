<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
/*Posts*/
Route::get('newpost', 'DashboardController@newpost')->name('newpost');
Route::post('addpost', 'DashboardController@addpost');
/*Edit posts*/
Route::get('edit/{id}', 'DashboardController@getedit')->name('edit.get');
Route::post('edit', 'DashboardController@postedit');
/*Delete posts*/
Route::get('delete/{id}','DashboardController@getdelete')->name('delete.get');
Route::post('delete/{id}','DashboardController@postdelete')->name('delete.post');

/*Comments*/
Route::get('comments','CommentsController@getcomments')->name('comments');
Route::post('acceptcomment/{id}','CommentsController@acceptcomment')->name('acceptcomment.post');
Route::post('refusecomment/{id}','CommentsController@refusecomment')->name('refusecomment.post');
Route::get('deletecomment/{id}','CommentsController@getdeletecomment')->name('deletecomment.get');
Route::post('deletecomment/{id}','CommentsController@postdeletecomment')->name('deletecomment.post');
