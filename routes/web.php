<?php

use Illuminate\Support\Facades\Route;

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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/',function (){
   return view('layouts.front');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {



    Route::prefix('profile')->group(function () {

        Route::match(['get','post'],'/',"Profile@index")->name('profile');
        Route::match(['post'],'/save',"Profile@save")->name('profile.save');



    });



    Route::prefix('settings')->group(function () {

            Route::match(['get','post'],'/general',"Settings\\General@index")->name('settings.general');
            Route::match(['post'],'/general/save',"Settings\\General@save")->name('settings.general.save');


            Route::match(['get','post'],'/website',"Settings\\Website@index")->name('settings.website');
            Route::match(['post'],'/website/save',"Settings\\Website@save")->name('settings.website.save');

            Route::match(['get','post'],'/product',"Settings\\Product@index")->name('settings.product');
            Route::match(['post'],'/product/save',"Settings\\Website@save")->name('settings.website.save');

            Route::match(['post'],'/product/get/units/all',"Settings\\Product@getAllUnits")->name('settings.Product.Units.all');
            Route::match(['post'],'/product/save/units',"Settings\\Product@saveUnit")->name('settings.Product.Units.save');
            Route::match(['post'],'/product/delete/units',"Settings\\Product@deleteUnit")->name('settings.Product.Units.delete');
            Route::match(['post'],'/product/edit/units',"Settings\\Product@editUnit")->name('settings.Product.Units.edit');



            Route::fallback(function (){
                return response()->json(['Sorry but we are not able find what you are looking'],422);
            });


    });





});

