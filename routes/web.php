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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/", "ShopController@index");
Route::group(["middleware"=>["auth"]], function(){
  Route::get("/show", "ShopController@show")->name("show");
  Route::post("/show", "ShopController@store");
  Route::post("/destroy", "ShopController@destroy");
  Route::post("/checkout", "ShopController@checkout");
});
