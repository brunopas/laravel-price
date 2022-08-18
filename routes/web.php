<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OfferLikeController;
use App\Http\Controllers\OfferCommentController;

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

Route::get('/', [OfferController::class, 'index']);

Route::prefix('/offers')->group(function () {
    Route::get('/', function () {
        return redirect('/');
    });

    Route::get('top', [OfferController::class, 'indexTop']);
    Route::get('manage', [OfferController::class, 'manage'])->middleware(['auth']);

    Route::get('create', [OfferController::class, 'create'])->middleware(['auth']);
    Route::post('', [OfferController::class, 'store'])->middleware(['auth']);

    Route::get('{offer:slug}/show', [OfferController::class, 'show']);
    Route::get('{offer:slug}/edit', [OfferController::class, 'edit'])->middleware(['auth']);

    Route::put('{offer:slug}', [OfferController::class, 'update'])->middleware(['auth']);
    Route::delete('{offer:slug}', [OfferController::class, 'destroy'])->middleware(['auth']);

    Route::post('{offer:slug}/comment', [OfferCommentController::class, 'store'])->middleware(['auth']);
    Route::post('{offer:slug}/like', [OfferLikeController::class, 'store'])->middleware(['auth']);
});

Route::prefix('/coupons')->group(function () {
    Route::get('/', [CouponController::class, 'index']);

    Route::get('create', [CouponController::class, 'create'])->middleware(['auth']);
    Route::post('', [CouponController::class, 'store'])->middleware(['auth']);

    Route::get('{coupon:id}/show', [CouponController::class, 'show']);
    Route::get('{coupon:id}/edit', [CouponController::class, 'edit'])->middleware(['auth']);

    Route::put('{coupon:id}', [CouponController::class, 'update'])->middleware(['auth']);
    Route::delete('{coupon:id}', [CouponController::class, 'destroy'])->middleware(['auth']);
});

Route::prefix('/store')->group(function () {
    Route::get('/coupons', [StoreController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [UserController::class, 'login'])->name('login');
        Route::post('login', [UserController::class, 'authenticate']);

        Route::get('register', [UserController::class, 'create'])->name('register');
        Route::post('register', [UserController::class, 'store']);
    });
});
