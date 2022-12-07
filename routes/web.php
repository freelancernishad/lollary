<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');





Auth::routes([
    // 'login'=>false,
    'register'=>false,
]);
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login.perform');



Route::group(['prefix' => 'home','middleware' => ['auth']], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::resources([
        'user' => UserController::class,
    ]);


    Route::get('/checkout', function () {
        return view('checkout');
    });

    Route::get('/checkout/success', function (Request $request) {
        $id = $request->id;
        $code = $request->code;
        $Amount = $request->Amount;

          $usercount = User::find($id);
// return $usercount->money;


        if($code===$usercount->code){
            $money = (int)$usercount->money-$Amount;
            $usercount->update(['money'=>$money]);
            return 1;
        }else{
            return 0;
        }



        return $request->all();
    });



});


