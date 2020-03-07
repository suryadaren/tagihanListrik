<?php

Route::get('/', 'homeController@index');
Route::get('/register', 'homeController@register');
Route::post('/checkLogin', 'homeController@checkLogin');
Route::post('/inputRegister', 'homeController@inputRegister');

Route::group(['prefix' => 'admin'], function(){

	Route::get('/', 'adminController@notifikasi');
	Route::get('/lihat_notifikasi/{kategori}/{id}', 'adminController@lihat_notifikasi');
	Route::post('/hapus_notifikasi', 'adminController@hapus_notifikasi');

	Route::get('/kolektor', 'adminController@kolektor');
	Route::post('/kolektor/setujui', 'adminController@setujui');
	Route::post('/kolektor/hapus', 'adminController@hapus');
	
	Route::get('/tagihan', 'adminController@tagihan');
	Route::get('/tagihan/edit/{id}', 'adminController@edit');
	Route::put('/tagihan/update_tagihan/{id}', 'adminController@update_tagihan');

	Route::get('/pembayaran', 'adminController@pembayaran');
	Route::get('/laporan', 'adminController@laporan');

});


Route::group(['prefix' => 'kolektor'], function(){

	Route::get('/', 'kolektorController@notifikasi');
	Route::get('/lihat_notifikasi/{kategori}/{id}', 'kolektorController@lihat_notifikasi');
	Route::post('/hapus_notifikasi', 'kolektorController@hapus_notifikasi');

	Route::get('/anggota', 'kolektorController@anggota');
	Route::get('/tambah_anggota', 'kolektorController@tambah_anggota');
	Route::get('/anggota/edit/{id}', 'kolektorController@edit_anggota');
	
	Route::get('/tagihan_anggota', 'kolektorController@tagihan_anggota');
	Route::get('/tagihan/edit_tagihan/{id}', 'kolektorController@edit_tagihan');

	Route::get('/pembayaran_anggota', 'kolektorController@pembayaran_anggota');
	Route::get('/pembayaran_kepada_admin', 'kolektorController@pembayaran_kepada_admin');

	Route::get('/laporan', 'kolektorController@laporan');

	Route::get('/logout', 'kolektorController@logout');

});

Route::group(['prefix' => 'anggota'], function(){

	Route::get('/', 'anggotaController@notifikasi');

	Route::get('/pembayaran', 'anggotaController@pembayaran');
	
	Route::get('/laporan', 'kolektorController@laporan');

});