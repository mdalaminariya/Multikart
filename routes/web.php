<?php

use App\Http\Controllers\Api\Auth\OtpAuthController;
use App\Http\Controllers\Backend\AccountSettings\AccountSettingController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\Menu\MenuController;
use App\Http\Controllers\Backend\Coupon\CouponController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Frontend\carts\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\page\PageController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\HomeController\BackendController;
use App\Http\Controllers\Backend\Physical\ProductController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Backend\Physical\CategoryController;
use App\Http\Controllers\Backend\Physical\SubCategoryController;
use App\Http\Controllers\Backend\Digital\CategoryController as DigitalCategoryController;
use App\Http\Controllers\Backend\Digital\SubCategoryController as DigitalSubCategoryController;
use App\Http\Controllers\Backend\Digital\ProductController as DigitalProductController;
use App\Http\Controllers\Backend\reports\ReportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Frontend Routes start here

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Details route (for both physical and digital products)
Route::get('/product/{type}/{id}', [HomeController::class, 'productDetails'])->name('product.details');

//Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/cart/add/{type}/{id}', [CartController::class, 'add'])->name('cart.add');

    Route::get('/cart/increase/{id}', [CartController::class,'increase'])->name('cart.increase');

    Route::get('/cart/decrease/{id}', [CartController::class,'decrease'])->name('cart.decrease');

    Route::get('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

    Route::get('/cart/clear', [CartController::class,'clear'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::post('/order/store', [\App\Http\Controllers\Frontend\OrderController::class, 'placeOrder'])->name('order.store');

//User dashboard route
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::put('/dashboard/profile/update', [DashboardController::class, 'update'])->name('dashboard.profile.update');
Route::post('/dashboard/address/store', [DashboardController::class, 'store_address'])->name('dashboard.address.store');
Route::put('/dashboard/password/update', [DashboardController::class, 'update_password'])->name('dashboard.password.update');
Route::put('/dashboard/address/update', [DashboardController::class, 'update_address'])->name('dashboard.address.update');
Route::delete('/dashboard/address/delete/{id}', [DashboardController::class, 'delete_address'])->name('dashboard.address.delete');
});
// User authentication routes
Route::get('/user/login',[UserAuthenticationController::class,'login'])->name('login');
Route::post('/user/login',[UserAuthenticationController::class,'loginSubmit'])->name('login.submit');

Route::get('/user/register',[UserAuthenticationController::class,'register'])->name('register');
Route::post('/user/register',[UserAuthenticationController::class,'registerSubmit'])->name('register.submit');

Route::get('/user/logout',[UserAuthenticationController::class,'logout'])->name('logout');

Route::get('/otp/verify', [UserAuthenticationController::class, 'otpVerifyPage'])
    ->name('otp.verify.page');
Route::post('/resend-otp', [UserAuthenticationController::class, 'resendOtp'])
    ->name('otp.resend');

Route::post('/otp/verify', [UserAuthenticationController::class, 'otpVerify'])
    ->name('otp.verify');


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

    // Order routes start
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');
    Route::put('/admin/orders/{order}/status',[OrderController::class, 'updateStatus'])->name('orders.status.update');
    Route::get('/orders/{order}', [OrderController::class, 'delete'])->name('orders.delete');

    // order tracking routes
    Route::get('/admin/orders/tracking',[OrderController::class, 'tracking'])->name('orders.tracking.list');
    Route::get('/orders/{order}/tracking', [OrderController::class, 'trackingOrder'])->name('orders.tracking');

    // order details route
    Route::get('/admin/orders/{order}', [OrderController::class, 'details'])->name('orders.details');
    Route::get('/admin/orders/details', [OrderController::class, 'latestDetails'])->name('orders.details.latest');
    // order routes end
    // coupon routes
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::get('/coupons/delete/{id}', [CouponController::class, 'delete'])->name('coupons.delete');

    // pages routes
    Route::get('/pages',[PageController::class,'index'])->name('pages.index');
    Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
    Route::post('/pages/store',[PageController::class,'store'])->name('pages.store');
    Route::get('/pages/edit/{id}',[PageController::class,'edit'])->name('pages.edit');
    Route::post('/pages/update/{id}',[PageController::class,'update'])->name('pages.update');
    Route::get('/pages/delete/{id}',[PageController::class,'destroy'])->name('pages.delete');

    // Report routes
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');


    //menu routes
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

    // media routes
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');

    Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');

    Route::delete('/media/delete', [MediaController::class, 'destroy'])->name('media.delete');
    });
    // account settings
    Route::get('/account/settings', [AccountSettingController::class, 'index'])->name('account.setting');
    Route:: get('account/setting/edit',[AccountSettingController:: class, 'edit'])->name('account.setting.edit');
    Route::post('/account-settings/update', [AccountSettingController::class, 'update'])->name('account.setting.update');

    // social
    Route::post('/social/connect/{type}', [AccountSettingController::class, 'connectSocial'])->name('social.connect');
    Route::get('/auth/{provider}', [AccountSettingController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [AccountSettingController::class, 'handleProviderCallback']);

    //users create
    Route::get('/users/registration/view', [UserAuthenticationController::class, 'view'])->name('users.view');
    Route::post('/users/registration/create', [UserAuthenticationController::class, 'store'])->name('users.registration');
    Route::get('/users/registration/list', [UserAuthenticationController::class, 'list'])->name('users.list');
    Route::get('/users/registration/delete/{id}', [UserAuthenticationController::class, 'delete'])->name('users.delete');

    //vendors create
    // vendor list
    Route::get('/vendors/list', [UserAuthenticationController::class, 'index'])->name('vendors.list');

    // vendor create form
        Route::get('/vendors/create', [UserAuthenticationController::class, 'create'])->name('vendors.create');

    // vendor store
    Route::post('/vendors/create', [UserAuthenticationController::class, 'vendorStore'])->name('vendors.store');

    // vendor edit
    Route::get('/vendors/edit/{id}', [UserAuthenticationController::class, 'edit'])->name('vendors.edit');

    // vendor update
    Route::put('/vendors/update/{id}', [UserAuthenticationController::class, 'update'])->name('vendors.update');

    // vendor delete
    Route::get('/vendors/delete/{id}', [UserAuthenticationController::class, 'vendorDelete'])->name('vendors.delete');
});
//Backend Route end here

// =============================
// FORGOT PASSWORD (PUBLIC ROUTES)
// =============================

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/otp-forgot-password', [OtpAuthController::class, 'index'])
    ->name('forgot.otp.password.request');

Route::post('/send-otp', [OtpAuthController::class, 'sendOtp'])
    ->name('forgot.otp.send');

Route::post('/verify-otp', [OtpAuthController::class, 'verifyOtp'])
    ->name('forgot.otp.verify');

Route::post('/otp-reset-password', [OtpAuthController::class, 'resetPassword'])
    ->name('forgot.otp.password.reset');
