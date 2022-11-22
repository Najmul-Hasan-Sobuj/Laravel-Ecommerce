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

    Route::resource('brand', App\Http\Controllers\Admin\BrandController::class);
    Route::post('brand/multi-delete', [App\Http\Controllers\Admin\BrandController::class, 'multiDelete'])->name('brandMultiDelete');

    Route::resource('wareHouse', App\Http\Controllers\Admin\WarehouseController::class);
    Route::post('wareHouse/multi-delete', [App\Http\Controllers\Admin\WarehouseController::class, 'multiDelete'])->name('wareHouseMultiDelete');

    Route::resource('coupon', App\Http\Controllers\Admin\CouponController::class);
    Route::post('coupon/multi-delete', [App\Http\Controllers\Admin\CouponController::class, 'multiDelete'])->name('couponMultiDelete');

    Route::resource('pickUpPoint', App\Http\Controllers\Admin\PickUpPointController::class);
    Route::post('pickUpPoint/multi-delete', [App\Http\Controllers\Admin\PickUpPointController::class, 'multiDelete'])->name('pickUpPointMultiDelete');

    // all account settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'accountSetting'])->name('admin.accountSetting');
    Route::put('seo', [App\Http\Controllers\Admin\SettingController::class, 'seoUpdate'])->name('seo.update');
    Route::put('smtp', [App\Http\Controllers\Admin\SettingController::class, 'smtpUpdate'])->name('smtp.update');
    Route::put('webSetting', [App\Http\Controllers\Admin\SettingController::class, 'webSettingUpdate'])->name('webSetting.update');

    Route::resource('pages', App\Http\Controllers\Admin\CreatePageController::class);
});
