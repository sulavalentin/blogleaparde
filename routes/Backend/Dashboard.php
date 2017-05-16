<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
/*Posts*/
Route::get('newpost', 'DashboardController@newpost');
Route::post('addpost', 'DashboardController@addpost');
/*Edit posts*/
Route::get('edit/{id}', 'DashboardController@getedit');
Route::post('edit', 'DashboardController@postedit');
/*Delete posts*/
Route::get('delete/{id}','DashboardController@getdelete');
Route::post('delete/{id}','DashboardController@postdelete');

/*Comments*/
Route::get('comments','CommentsController@getcomments');
Route::post('acceptcomment/{id}','CommentsController@acceptcomment');
Route::post('refusecomment/{id}','CommentsController@refusecomment');
Route::get('deletecomment/{id}','CommentsController@getdeletecomment');
Route::post('deletecomment/{id}','CommentsController@postdeletecomment');
