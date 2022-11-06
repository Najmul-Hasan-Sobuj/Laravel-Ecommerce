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




Route::group(['middleware' => ['isadmin', 'auth'], 'prefix' => 'provider', 'as' => 'provider.'], function () {

    Route::get('admin/home', [App\Http\Controllers\Admin\HomeController::class, 'dashboard'])->name('admin.home');
    Route::get('admin/changelog', [App\Http\Controllers\Admin\HomeController::class, 'changelog'])->name('admin.changelog');
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
        Route::post('category/multi-delete', [App\Http\Controllers\Admin\CategoryController::class, 'multiDelete'])->name('categoryMultiDelete');

        Route::resource('subCategory', App\Http\Controllers\Admin\subCategoryController::class);
        Route::resource('childCategory', App\Http\Controllers\Admin\childCategoryController::class);
    });
});
