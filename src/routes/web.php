<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

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
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/login', function () {
    return view('auth.login');
});


// Route::get('/email/verify', [VerificationController::class, 'show']);
// Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'create'])
        ->middleware('verified');
    Route::put('/mypage/profile', [ProfileController::class, 'store']);

    Route::get('/purchase/{item_id}', [ItemController::class, 'purchaseForm']);
    Route::post('/purchase/{item_id}', [ItemController::class, 'buy']);
    Route::get('/purchase/address/{item_id}', [ItemController::class, 'editAddress']);
    Route::put('/purchase/address/{item_id}', [ItemController::class, 'updateAddress']);
    // Checkout成功/キャンセル（ビューは作らず /mypage に戻す）
    Route::get('/purchase/success/{item_id}', [ItemController::class, 'checkoutSuccess'])
    ->name('purchase.success');
    Route::get('/purchase/cancel/{item_id}', [ItemController::class, 'checkoutCancel'])
    ->name('purchase.cancel');

    Route::post('/item/{item_id}/like', [ItemController::class, 'like']);
    Route::post('/item/{item_id}/review', [ItemController::class, 'review']);

    // プロフィール（マイページ）
    Route::get('/mypage', [ProfileController::class, 'show']);
    Route::get('/mypage/profile/edit', [ProfileController::class, 'edit']);
    Route::put('/mypage/profile/edit', [ProfileController::class, 'update']);

    Route::get('/sell', [ItemController::class, 'create']);
    Route::post('/sell', [ItemController::class, 'store']);

});

// Route::get('/mypage/profile', function () {
//     return view('mypage.profile');
// })->middleware(['auth', 'verified']);





// // ('/?page=mylist');

// ('/item/{item_id}');
// ('/purchase/{item_id}');
// ('/purchase/address/{item_id}');
// ('/sell');
// ('/mypage');
// ('/mypage/profile');
// ('/mypage?page=buy');
// ('/mypage?page=sell');
