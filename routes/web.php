<?php

use App\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use \App\Model\Settings\Product\Units;
use Yajra\DataTables\Facades\DataTables;

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


if(true){
    Broadcast::routes();

    Route::get('/', function () {
        return view('layouts.front');


    });


    Route::get('/test5', function (Request $request) {

        dd(\Illuminate\Support\Facades\Auth::user()->getRememberToken());
        return view('vendor.passport.authorize')->with('client', []);


    });
    Route::get('/test2', function (Request $request) {

        session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'grant_type' => 'authaction_code',
            'client_id' => '91566191-9189-4220-826e-b0f36e63a426',
            'client_secret' => 'iVUpHnND2wGEBn4ct2LQiJjfj7iktpucMJ7AO4Jf',
            'redirect_uri' => redirect('/test3'),
            'response_type' => 200,
            'scope' => '',
            'state' => $state,
        ]);

        //  return redirect('/test?'.$query);
        return redirect('/oauth/authorize?' . $query);
    });


    Route::any('/test4', function (\Illuminate\Http\Request $r) {
        dd($r->all());
    });
    Route::any('/test3', function (\Illuminate\Http\Request $r) {
        session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => '91566191-9189-4220-826e-b0f36e63a426',
            'redirect_uri' => redirect('/test4'),
            'response_type' => 'token',
            'client_secret' => 'iVUpHnND2wGEBn4ct2LQiJjfj7iktpucMJ7AO4Jf',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect('oauth/authorize?' . $query);

    });
}
Route::any('/test',function (\Illuminate\Http\Request $r){


    $m=getModel(\App\Model\VideoApp\RingtoneCat::class)->get();

    foreach ($m as $model){
        $model->sortno=$model->id;
        if($model->isDirty())$model->save();

    }
    die();

    $users = \App\Model\VideoApp\Frame::select(['id','name','thumbUrl','imageUrl']);

    return Datatables::of($users)->make();

  //  dd(\Help\VideoApp\Doit::importData());



    $request=$r;
    $state = session()->pull('state');

    $dData= [
        'grant_type' => 'password',
        'client_id' => '915691c5-d1ea-4a35-a3e2-b8a081618c73',
        'client_secret' => 'YhgFGdCh3U3Jefp6w2jVj1Ky1ElvazgTcan1B4dG',
        'username' => 'test@admin.ms',
        'password' => '123456789',
        'scope' => '',

    ];


//    throw_unless(
//        strlen($state) > 0 && $state === $request->state,
//        InvalidArgumentException::class
//    );





    $http = new GuzzleHttp\Client;

    $response = $http->post(url('/oauth/token'), [
        'form_params' =>$dData,
    ]);

    return json_decode((string) $response->getBody(), true);

    return view('vendor.passport.authorize');
   // $str=\Help\Secret::encode(\Illuminate\Support\Str::random(rand(1,100)));
    $data['rawStr']=\Illuminate\Support\Str::random(256)."~!@#$%^&*()_+";
    $data['rawStrCount']=strlen($data['rawStr']);

    $data['encodedstr']=\Help\Secret::encode($data['rawStr']);
    $data['encodedstrCount']=strlen($data['encodedstr']);
    $data['decpdedstr']=\Help\Secret::decode($data['encodedstr']);
    $data['decpdedstr']=\Help\Secret::decode($data['encodedstr']);
    $data['decpdedstrCount']=strlen($data['decpdedstr']);
    dd($data);
       return true;

    $m=getModel(\App\Model\Product\Product::class);
    $pdata=[
        'review'=>424,
        'totalOrders'=>55,
        'rating'=>3
    ];
    $product=$m->first()->toArray();
    $product['pimgs']=json_decode($product['pimgs']);
    $product['pimgs']=array_map(function ($v){
        return url($v);
    },$product['pimgs']);
    return view('front.Product.ProductPage')->with('p',$product)->with('pD',$pdata);

   // $m=\App\Model\Settings\General::_();
    //$m=\App\Model\Settings\General::_()->_update(['id'=>'1'],['CompanyName'=>\Illuminate\Support\Str::random(4)]);

    $m=getModel(\App\Model\Product\Product::class);
   // dd($m->_()->_add(['name'=>\Illuminate\Support\Str::random(4)]));


    $process1=$m->_()->_add(['name'=>\Illuminate\Support\Str::random(4)])->_2A();
    $process2=$m->_()->_update(['id'=>$process1['data']['id']],['name'=>\Illuminate\Support\Str::random(4)])->_2A();
    $process3=$m->_()->_delete(['id'=>$process1['data']['id']])->_2A();
    \Debugbar::info($process1);
    \Debugbar::info($process2);
    \Debugbar::info($process3);

  //  $setin=settings('general');

    return response('hello');



   $setin=settings('general');
   $setin2=settings('website');
   $setin3=settings('product');
    \Debugbar::info($setin);
    \Debugbar::info($setin2);
    \Debugbar::info($setin3);

    return response()->json(['fileName'=>'test.jpg','uploaded'=> 1,'url'=>asset('img/test.jpg')]);

    return view('layouts.app');
})->middleware('api');


if(true){
    Route::match(['get'], 'product/img/get/{code}', "Product\\Product@getImage")->name('product.img.get');


    Route::prefix('admin')->group(function () {
        Auth::routes();
    });


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

