<?php

use App\Http\Controllers\Backend\AccountSettings\AccountSettingController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\HomeController\BackendController;
use App\Http\Controllers\Backend\Physical\ProductController;
use App\Http\Controllers\Frontend\Auth\UserAuthenticationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\Physical\CategoryController;
use App\Http\Controllers\Backend\Physical\SubCategoryController;
use App\Http\Controllers\Backend\Digital\CategoryController as DigitalCategoryController;
use App\Http\Controllers\Backend\Digital\SubCategoryController as DigitalSubCategoryController;
use App\Http\Controllers\Backend\Digital\ProductController as DigitalProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Frontend Routes start here

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');
// User authentication routes
Route::get('/user/login',[UserAuthenticationController::class,'login'])->name('login');
Route::post('/user/login',[UserAuthenticationController::class,'loginSubmit'])->name('login.submit');

Route::get('/user/register',[UserAuthenticationController::class,'register'])->name('register');
Route::post('/user/register',[UserAuthenticationController::class,'registerSubmit'])->name('register.submit');

Route::get('/user/logout',[UserAuthenticationController::class,'logout'])->name('logout');

// Password reset routes

// Email verification routes
Route::get('/email/verify', function () {
    return view('frontend.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [UserAuthenticationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Frontend Route end here

//Backend Route start here
Route::group(['prefix' => 'admin','as' => 'admin.','middleware' => ['auth','verified']], function () {
    Route::get('/', [BackendController::class, 'index'])->name('dashboard');

    Route::middleware(['rolecheck'])->group(function () {
        //products physical
    //category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //subcategory routes
    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

    //Add Product routes
    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/view',[ProductController::class,'view'])->name('product.view');
    Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/update/{id}',[ProductController::class,'update'])->name('product.update');
    Route::get('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('product/details/{id}',[ProductController::class,'details'])->name('product.details');

    //Digital Physical
    Route::get('/digital/category', [DigitalCategoryController::class, 'index'])->name('digital.category.index');
    Route::post('/digital/category/store', [DigitalCategoryController::class, 'store'])->name('digital.category.store');
    Route::get('/digital/category/edit/{id}', [DigitalCategoryController::class, 'edit'])->name('digital.category.edit');
    Route::post('/digital/category/update/{id}', [DigitalCategoryController::class, 'update'])->name('digital.category.update');
    Route::get('/digital/category/delete/{id}', [DigitalCategoryController::class, 'delete'])->name('digital.category.delete');

    //subcategory routes
    Route::get('/digital/subcategory', [DigitalSubCategoryController::class, 'index'])->name('digital.subcategory.index');
    Route::post('/digital/subcategory/store', [DigitalSubCategoryController::class, 'store'])->name('digital.subcategory.store');
    Route::get('/digital/subcategory/edit/{id}', [DigitalSubCategoryController::class, 'edit'])->name('digital.subcategory.edit');
    Route::post('/digital/subcategory/update/{id}', [DigitalSubCategoryController::class, 'update'])->name('digital.subcategory.update');
    Route::get('/digital/subcategory/delete/{id}', [DigitalSubCategoryController::class, 'delete'])->name('digital.subcategory.delete');

    //Add Product routes
    Route::get('/digital/product',[DigitalProductController::class,'index'])->name('digital.product.index');
    Route::post('/digital/product/store',[DigitalProductController::class,'store'])->name('digital.product.store');
    Route::post('/digital/product/upload', [DigitalProductController::class, 'upload'])->name('digital.product.upload');
    Route::get('/digital/product/view',[DigitalProductController::class,'view'])->name('digital.product.view');
    Route::get('/digital/product/edit/{id}',[DigitalProductController::class, 'edit'])->name('digital.product.edit');
    Route::put('/digitalproduct/update/{id}',[DigitalProductController::class,'update'])->name('digital.product.update');
    Route::get('/digitalproduct/delete/{id}',[DigitalProductController::class,'delete'])->name('digital.product.delete');
    Route::get('/digitalproduct/details/{id}',[DigitalProductController::class,'details'])->name('digital.product.details');
    });
    // account settings
    Route::get('/account-settings', [AccountSettingController::class, 'index'])->name('account.setting');
    Route:: get('account/setting/edit',[AccountSettingController:: class, 'edit'])->name('account.setting.edit');
    Route::post('/account-settings/update', [AccountSettingController::class, 'update'])->name('account.settings.update');

    // social
    Route::post('/social/connect/{type}', [AccountSettingController::class, 'connectSocial'])->name('social.connect');
    Route::get('/auth/{provider}', [AccountSettingController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [AccountSettingController::class, 'handleProviderCallback']);
});
//Backend Route end here
