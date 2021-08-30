<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\MainUController;
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
Route::get('login',[LoginController::class,'getLogin']);
Route::post('login',[LoginController::class,'postLogin']);

Route::middleware(['auth'])->group(function () {
  

    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);  

        #menu
        Route::prefix('menu')->group(function(){
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'postCreate']);

            Route::get('list',[MenuController::class,'getList']);
            Route::get('delete/{id}',[MenuController::class,'deleteList']);
            
            Route::get('edit/{menu}',[MenuController::class,'getEdit']);
            Route::post('edit/{menu}',[MenuController::class,'postEdit']);
        });

        #product
        Route::prefix('products')->group(function(){
            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'postCreate']);
            Route::get('list',[ProductController::class,'getList']);
            Route::get('edit/{product}',[ProductController::class,'getEdit']);
            Route::post('edit/{product}',[ProductController::class,'postEdit']);
            Route::get('delete/{product}',[ProductController::class,'destroy']);
            
        });

        #slider
        Route::prefix('sliders')->group(function(){
            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'postCreate']);
            Route::get('list',[SliderController::class,'getList']);
            Route::get('edit/{slider}',[SliderController::class,'getEdit']);
            Route::post('edit/{slider}',[SliderController::class,'postEdit']);
            Route::get('delete/{slider}',[SliderController::class,'destroy']);
            
        });

        #upload
        Route::post('upload/services',[UploadController::class,'store']);
    });
});

Route::get('mainU',[MainUController::class,'index']);

