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

//LOGIN * REGISTRATION
Auth::routes();

//SEHIFE
Route::get('/', 'IndexController@init')->name('home');

Route::get('/lisenziya','IndexController@license');


//EMAIL TESTIQLEME
Route::get('/istifadeci/testiqleme/{token}', 'IndexController@confirm')->name('confirmation')->middleware('email');


//ADMIN
Route::group(['middleware' => ['auth', 'admin']],function(){
	Route::get('admin','AdminController@index')->name('admin.index');

	//Kateqoriyalar
	Route::post('kateqoriyalar/get','KateqoriyalarController@getToEdit')->name('kateqoriya-get');
	Route::post('kateqoriyalar/deyisdir','KateqoriyalarController@deyisdir')->name('kateqoriya-deyisdir');
	Route::delete('kateqoriyalar/sil','KateqoriyalarController@sil')->name('kateqoriya-sil');
	Route::resource('/kateqoriyalar','KateqoriyalarController', [
		'names'=>[
			'index'=>'kateqoriyalar.index'
		],
		'only'=>[
			'index','store'
		]
	]);

	//Multi-kateqoriyalar
	Route::post('multi-kateqoriyalar/get','MultiKateqoriyalarController@getToEdit')->name('multi-kateqoriya-get');
	Route::post('multi-kateqoriyalar/deyisdir','MultiKateqoriyalarController@deyisdir')->name('multi-kateqoriya-deyisdir');
	Route::delete('multi-kateqoriyalar/sil','MultiKateqoriyalarController@sil')->name('multi-kateqoriya-sil');
	Route::resource('/multi-kateqoriyalar','MultiKateqoriyalarController', [
		'names'=>[
			'index'=>'multi-kateqoriyalar.index'
		],
		'only'=>[
			'index','store'
		]
	]);

	//Mallar
	Route::resource('/mallar','MallarController', [
		'names'=>[
			'index'=>'mallar.index',
			'create'=>'mallar.elaveet-form',
			'store'=>'mallar.elaveet',
			'show'=>'mallar.bax',
			'edit'=>'mallar.deyis-form',
			'update'=>'mallar.deyis',
			'destroy'=>'mallar.sil'
		],
	]);

	Route::resource('/slide','SlideController',[
		'only'=>[
			'index','create','destroy','store'
		]
	]);
});

//HESAB
Route::group(['middleware'=>['auth']],function(){
	Route::get('hesabim','UserController@init')->name('hesabim');
});

//mala baxis ucun
Route::group(['prefix' => 'bax'], function() {
	Route::get('/{id}','MalController@show')->name('baxis');
});

//kateqoriyalara gore mallara baxmaq
Route::get('kateqoriya/{id}','KateqoriyalarController@goster')->name('kat');
Route::get('altkateqoriya/{id}','MultiKateqoriyalarController@goster')->name('multikat');

//axtaris
Route::get('axtaris','MalController@axtaris')->name('axtaris');

//daha cox
Route::get('/enson','IndexController@dahacox')->name('dahacox');

//Route::get('admin','AdminController@init')->middleware('auth'); profil ucun ancaq