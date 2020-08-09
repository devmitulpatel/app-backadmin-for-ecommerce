<?php

use Illuminate\Support\Facades\Route;
use \App\Model\Settings\Product\Units;

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
Route::get('/test',function (){
   $setin=settings('general');
   $setin2=settings('website');
   $setin3=settings('product');
    \Debugbar::info($setin);
    \Debugbar::info($setin2);
    \Debugbar::info($setin3);

    return view('layouts.app');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {



    Route::prefix('profile')->group(function () {

        Route::match(['get','post'],'/',"Profile@index")->name('profile');
        Route::match(['post'],'/save',"Profile@save")->name('profile.save');



    });

    Route::prefix('product')->group(function () {

        Route::match(['get','post'],'/product',"Product\\Product@index")->name('product.add');


        Route::match(['get','post'],'/product/category',"Product\\Category@index")->name('product.category.manage');
        Route::match(['post'],'/category/save',"Product\\Category@save")->name('product.category.save');
        Route::match(['post'],'/category/delete',"Product\\Category@delete")->name('product.category.delete');
        Route::match(['post'],'/category/edit',"Product\\Category@edit")->name('product.category.edit');

        Route::match(['get','post'],'/product/subcategory',"Product\\Category@indexForSub")->name('product.subcategory.manage');
        Route::match(['post'],'/subcategory/save',"Product\\Category@Subsave")->name('product.subcategory.save');
        Route::match(['post'],'/subcategory/delete',"Product\\Category@Subdelete")->name('product.subcategory.delete');
        Route::match(['post'],'/subcategory/edit',"Product\\Category@Subedit")->name('product.subcategory.edit');




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


        Route::match(['post'],'/product/get/extra/all',"Settings\\Product@getAllExtra")->name('settings.Product.Extra.all');

        Route::match(['post'],'/product/get/category/all',"Settings\\Product@getAllCategory")->name('settings.Product.Category.all');
        Route::match(['post'],'/product/get/subcategory/all',"Settings\\Product@getAllSubCategory")->name('settings.Product.SubCategory.all');


        Route::match(['post'],'/product/save/extra',"Settings\\Product@saveExtra")->name('settings.Product.Extra.save');
        Route::match(['post'],'/product/edit/extra',"Settings\\Product@editExtra")->name('settings.Product.Extra.edit');
        Route::match(['post'],'/product/delete/extra',"Settings\\Product@deleteExtra")->name('settings.Product.Extra.delete');



        Route::match(['get','post'],'/tax',"Settings\\tax@index")->name('settings.tax');
        Route::match(['post'],'/tax/get/all',"Settings\\tax@getAllTaxes")->name('settings.tax.all');

        Route::match(['post'],'/tax/save',"Settings\\tax@save")->name('settings.tax.save');
        Route::match(['post'],'/tax/edit',"Settings\\tax@edit")->name('settings.tax.edit');
        Route::match(['post'],'/tax/delete',"Settings\\tax@delete")->name('settings.tax.delete');





        Route::fallback(function (){
                return response()->json(['Sorry but we are not able find what you are looking'],422);
            });


    });





});

