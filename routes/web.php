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

//首页
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//登录注册修改密码
Auth::routes();

//笔记本
Route::group(['prefix' => 'notebook'], function() {
    Route::get('/', 'NotebookController@index')->name('notebook');
    Route::post('/','NotebookController@createBook')->name('createBook');
    Route::get('/delete/{id}','NotebookController@softDeleteBook')->name('deleteBook');
    Route::get('/detail/{id}','NoteController@index')->name('notes');
    Route::get('/update/{id}','NotebookController@toUpdate')->name('toUpdateBook');
    Route::post('/update','NotebookController@updateBook')->name('updateBook');
    Route::any('/stranger/{id}/{name}','NotebookController@toStrangerBookList')->name('strangerBook');
    Route::any('/friend/{id}','NotebookController@toFriendBookList')->name('friendBook');
});

//笔记
Route::group(['prefix' => 'note'],function () {
    Route::post('/','NoteController@createNote')->name('createNote');
    Route::get('/delete/{id}','NoteController@softDeleteNote')->name('deleteNote');
    Route::get('/detail/{id}','NoteController@toDetail')->name('detailNote');
    Route::get('/update/{id}','NoteController@toUpdate')->name('toUpdateNote');
    Route::post('/update','NoteController@updateNote')->name('updateNote');
});

//用户信息
Route::group(['prefix' => 'profile'], function() {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::get('/modify', 'ProfileController@modify')->name('profileModify');
    Route::post('/modify', 'ProfileController@update')->name('updateProfile');
    Route::get('/{id}','ProfileController@showSomeonesProfile')->name('otherProfile');
});

//回收站相关
Route::group(['prefix' => 'recycle'], function (){
    Route::get('/book','NotebookController@toRecycle')->name('bookBin');
    Route::get('/book/restore/{id}','NotebookController@restoreDeletedBook')->name('bookRestore');
    Route::get('/book/restore','NotebookController@restoreAllDeletedBooks')->name('bookAllRestore');
    Route::get('/book/completely/{id}','NotebookController@deleteBookCompletely')->name('bookDeleteCompletely');
    Route::get('/book/completely','NotebookController@deleteAllBooksCompletely')->name('bookDeleteAllCompletely');
    Route::get('/note','NoteController@toRecycle')->name('noteBin');
    Route::get('/note/restore/{id}','NoteController@restoreDeletedNote')->name('noteRestore');
    Route::get('/note/restore','NoteController@restoreAllDeletedNotes')->name('noteAllRestore');
    Route::get('/note/completely/{id}','NoteController@deleteNoteCompletely')->name('noteDeleteCompletely');
    Route::get('/note/completely','NoteController@deleteAllNotesCompletely')->name('noteDeleteAllCompletely');
});

//搜索相关
Route::group(['prefix'=>'search'], function(){
    Route::any('/', 'SearchController@search')->name('search');
    Route::any('/user/{keyword}','SearchController@searchUser')->name('searchUser');
    Route::any('/book/{keyword}','SearchController@searchBook')->name('searchBook');
});

//好友相关
Route::group(['prefix'=>'friend'], function(){
    Route::any('/','FriendController@getMyFriends')->name('friendList');
    Route::any('/apply/{id}','FriendController@apply')->name('friendApply');
    Route::any('/applications','FriendController@getMyApplications')->name('applicationList');
    Route::any('/agree/{id}','FriendController@agree')->name('friendAgree');
    Route::any('/refuse/{id}','FriendController@disagree')->name('friendRefuse');
    Route::any('/delete/{id}','FriendController@deleteFriend')->name('friendDelete');
});