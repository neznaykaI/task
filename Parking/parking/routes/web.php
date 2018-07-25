<?php

Route::get('/', function () {
    return view('main_page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('show_auto', 'ClientsController@on_parking_now')->name('show_auto');
Route::get('status_off/{id}', 'ClientsController@status_off');
Route::post('status_on', 'ClientsController@status_on')->name('status_on');
Route::get('get_auto', 'ClientsController@get_auto')->name('get_auto');
Route::resource('clients', 'ClientsController', ['names' => [
                                                  'create'=>'create_record',
                                                  'edit'=>'edit_record',
                                                  'destroy'=>'delete_record',
                                                  'store' => 'client_store'
                                                ]]);
                                                
