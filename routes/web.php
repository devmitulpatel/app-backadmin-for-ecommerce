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



r('p','zdemo',[\App\Http\Controllers\Product\Product::class,'index']);

Route::get('/test_lvp',function (){

dd(\App\Helper\HelperClass\Lvp\Doit::importData());
    return view('layouts.coreui-app');

});
if(false){
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
Route::any('videoapp/test',function (\Illuminate\Http\Request $r){


    $sd=getModel(\App\Model\VideoApp\Frame::class)->select(['name','imageUrl','thumbUrl','id'])->get()->toArray();

    $sd=array_map(function ($a){

        return array_values($a);
    },$sd);

    $data=[
        'data'=>$sd
    ];
  //  dd($data);
        return response()->json($data);



//    r('p','zdemo',[\App\Http\Controllers\Product\Product::class,'index']);

    return view('layouts.app');





})->middleware('api');



\App\Helper\HelperClass\AppScopedRoutes::routes();




