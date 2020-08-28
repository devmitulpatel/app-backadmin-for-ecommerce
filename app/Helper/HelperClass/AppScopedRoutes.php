<?php


namespace App\Helper\HelperClass;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AppScopedRoutes
{

    public static function routes(){
        self::comman();
        self::app();
        if(true)self::videoapp();
    }

    public static function app(){
        Route::match(['get'], 'product/img/get/{code}', "Product\\Product@getImage")->name('product.img.get');
        Route::middleware('auth')->group(function () {


            Route::prefix('admin')->group(function () {

                Route::get('/', 'HomeController@index')->name('home');


                //query.live

                Route::prefix('query')->group(function () {

                    Route::match(['get', 'post'], '/', "Query\\HandleLiveClients@index")->name('query.live');


                });


                Route::prefix('product')->group(function () {

                    Route::match(['get', 'post'], '/', "Product\\Product@index")->name('product.add');
                    Route::match(['post'], '/save', "Product\\Product@save")->name('product.save');
                    Route::match(['post'], '/img/upload', "Product\\Product@uploadImage")->name('product.img.upload');


                    Route::match(['get', 'post'], '/category', "Product\\Category@index")->name('product.category.manage');
                    Route::match(['post'], '/category/save', "Product\\Category@save")->name('product.category.save');
                    Route::match(['post'], '/category/delete', "Product\\Category@delete")->name('product.category.delete');
                    Route::match(['post'], '/category/edit', "Product\\Category@edit")->name('product.category.edit');

                    Route::match(['get', 'post'], '/product/subcategory', "Product\\Category@indexForSub")->name('product.subcategory.manage');
                    Route::match(['post'], '/subcategory/save', "Product\\Category@Subsave")->name('product.subcategory.save');
                    Route::match(['post'], '/subcategory/delete', "Product\\Category@Subdelete")->name('product.subcategory.delete');
                    Route::match(['post'], '/subcategory/edit', "Product\\Category@Subedit")->name('product.subcategory.edit');


                });


            });


            Route::prefix('profile')->group(function () {

                Route::match(['get', 'post'], '/', "Profile@index")->name('profile');
                Route::match(['post'], '/save', "Profile@save")->name('profile.save');


            });


            Route::prefix('settings')->group(function () {

                Route::match(['get', 'post'], '/general', "Settings\\General@index")->name('settings.general');
                Route::match(['post'], '/general/save', "Settings\\General@save")->name('settings.general.save');


                Route::match(['get', 'post'], '/website', "Settings\\Website@index")->name('settings.website');
                Route::match(['post'], '/website/save', "Settings\\Website@save")->name('settings.website.save');

                Route::match(['get', 'post'], '/product', "Settings\\Product@index")->name('settings.product');
                Route::match(['post'], '/product/save', "Settings\\Website@save")->name('settings.website.save');


                Route::match(['post'], '/product/get/units/all', "Settings\\Product@getAllUnits")->name('settings.Product.Units.all');
                Route::match(['post'], '/product/save/units', "Settings\\Product@saveUnit")->name('settings.Product.Units.save');
                Route::match(['post'], '/product/delete/units', "Settings\\Product@deleteUnit")->name('settings.Product.Units.delete');
                Route::match(['post'], '/product/edit/units', "Settings\\Product@editUnit")->name('settings.Product.Units.edit');


                Route::match(['post'], '/product/get/extra/all', "Settings\\Product@getAllExtra")->name('settings.Product.Extra.all');

                Route::match(['post'], '/product/get/category/all', "Settings\\Product@getAllCategory")->name('settings.Product.Category.all');
                Route::match(['post'], '/product/get/subcategory/all', "Settings\\Product@getAllSubCategory")->name('settings.Product.SubCategory.all');


                Route::match(['post'], '/product/save/extra', "Settings\\Product@saveExtra")->name('settings.Product.Extra.save');
                Route::match(['post'], '/product/edit/extra', "Settings\\Product@editExtra")->name('settings.Product.Extra.edit');
                Route::match(['post'], '/product/delete/extra', "Settings\\Product@deleteExtra")->name('settings.Product.Extra.delete');


                Route::match(['get', 'post'], '/tax', "Settings\\tax@index")->name('settings.tax');
                Route::match(['post'], '/tax/get/all', "Settings\\tax@getAllTaxes")->name('settings.tax.all');

                Route::match(['post'], '/tax/save', "Settings\\tax@save")->name('settings.tax.save');
                Route::match(['post'], '/tax/edit', "Settings\\tax@edit")->name('settings.tax.edit');
                Route::match(['post'], '/tax/delete', "Settings\\tax@delete")->name('settings.tax.delete');

                Route::match(['post'], '/tax/code/get/all', "Settings\\tax@getAllCodes")->name('settings.tax.code.all');

                Route::match(['post'], '/tax/code/save', "Settings\\tax@saveCode")->name('settings.tax.code.save');
                Route::match(['post'], '/tax/code/edit', "Settings\\tax@editCode")->name('settings.tax.code.edit');
                Route::match(['post'], '/tax/code/delete', "Settings\\tax@deleteCode")->name('settings.tax.code.delete');


                Route::fallback(function () {
                    return response()->json(['Sorry but we are not able find what you are looking'], 422);
                });


            });


        });


        Route::prefix('api')->group(function () {


            Route::prefix('v1')->group(function () {


                Route::prefix('front')->group(function () {

                    Route::prefix('chat')->group(function () {

                        Route::match(['post'], 'send/msg/toServer', "Chat\\HandleMsg@hasMsg")->name('api.v1.front.chat.hasMsg');

                    });
                });


            });


        });

    }

    public static function comman(){

        Route::prefix('admin')->group(function () {
            Auth::routes();
        });


    }

    public static function videoapp(){
        Route::prefix('videoapp')->group(function () {
            Route::match(['get','post'],'/feedData', 'VideoApp\MainController@allForms')->name('videoapp.allForms');

            Route::match(['post'],'/getData', 'VideoApp\MainController@getData')->name('videoapp.getData');
            Route::match(['get'],'/getFile', 'VideoApp\MainController@getFile')->name('videoapp.getFile');
            Route::match(['post'],'/feedDataIntoToDb', 'VideoApp\MainController@feedDataIntToDb')->name('videoapp.feedDataToDB');
            Route::match(['post'],'/editDataIntoToDb', 'VideoApp\MainController@editDataIntToDb')->name('videoapp.editDataToDB');

            Route::match(['post'],'/delete', 'VideoApp\MainController@deleteData')->name('videoapp.deleteData');


            Route::any('/getDataForApp.json', function (Request $request) {


                $data=[

                    'ParticleNew'=>[
                        'Frame'=>\App\Model\VideoApp\Frame::select(['name','thumbUrl','imageUrl'])->get(),

                        'Image'=>\App\Model\VideoApp\Image::select(['thumbUrl'])->get(),
                        'Sticker'=>\App\Model\VideoApp\Sticker::select(['name','thumbUrl'])->get(),

                    ],
                    'Ringtone'=>\Help\VideoApp\Doit::responseRingtone(),
                    'Category'=>\App\Model\VideoApp\RingtoneCat::select(['name','icon','sortno'])->orderBy('sortno')->get()


                ];



                return response()->json($data);





            });


        });
    }

}
