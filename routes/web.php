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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/role', [App\Http\Controllers\HomeController::class, 'barev'])->name('user.role');
//
Route::group(['middleware'=>['admin']], function (){
    Route::get('/role', [App\Http\Controllers\HomeController::class, 'barev'])->name('admin.products');
    Route::get('/products-panel', [App\Http\Controllers\ProductController::class, 'index'])->name('admin.products');
    Route::get('/category-panel', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/category-panel/create', [App\Http\Controllers\CategoryController::class,'store'])->name('admin.category.create');
    Route::post('/category-panel/edit', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.category.update');
//    dd(Auth::user());

});
