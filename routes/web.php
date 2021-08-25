<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VnPayController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ProductComponent as CustomerProductComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\Auth\LoginAndRegisterComponent;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\ArticleComponent;
use App\Http\Livewire\Auth\EmailVerificationPromptComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\EmptyCartComponent;
use App\Http\Livewire\MyAccountComponent;
use App\Http\Livewire\OrderHistoryComponent;
use App\Http\Livewire\ThankForPaymentComponent;
use App\Http\Livewire\WishListComponent;

Route::get('/', HomeComponent::class);
Route::get('/home', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/contact-us', ContactComponent::class)->name('contact_us');
Route::get('/about-us', AboutComponent::class)->name('about_us');
Route::get('/product-detail/{slug}', CustomerProductComponent::class)->name('product_detail');
Route::get('/order-history/{orderNumber}', OrderHistoryComponent::class)->middleware('auth')
    ->name('order_history');
Route::get('/articles', BlogComponent::class)->name('article');
Route::get('/articles/{slug}', ArticleComponent::class)->name('article_detail');

Route::get('/empty-cart', EmptyCartComponent::class)->middleware('cart.empty')->name('empty_cart');
Route::get('/thank-for-payment/{orderNumber}', ThankForPaymentComponent::class)
    ->middleware('checkout_success')->name('thank_for_payment');

Route::get('/wish-list', WishListComponent::class)->name('wish_list');
Route::get('/cart', CartComponent::class)->middleware('cart.not_empty')->name('cart');
Route::get('/checkout', CheckoutComponent::class)
    ->middleware(['cart.not_empty', 'auth'])->name('checkout');

Route::prefix('paypal')->as('paypal.')->group(function () {
    Route::get('create/{order}', [PayPalController::class, 'expressCheckout'])->name('create');
    Route::get('success/{order}', [PayPalController::class, 'expressCheckoutSuccess'])->name('success');
    Route::get('cancel/{order}', [PayPalController::class, 'cancelCheckout'])->name('cancel');
});

Route::prefix('vnpay')->as('vnpay.')->group(function () {
    Route::get('return', [VnPayController::class, 'return'])->name('return');
    // production
    Route::get('notification', [VnPayController::class, 'notification'])->name('notification');
});

Route::prefix('auth/login')->middleware('guest')->group(function () {
    Route::get('/', LoginAndRegisterComponent::class)->name('login');
    Route::get('/{provider}', [SocialController::class, 'redirect']);
    Route::get('/{provider}/callback', [SocialController::class, 'Callback']);
});

Route::get('/reset-password/{token}', LoginAndRegisterComponent::class)
    ->prefix('/auth')
    ->middleware('guest')
    ->name('password.reset');

Route::prefix('auth')->middleware('auth')->group(function () {
    Route::get('/my-account', MyAccountComponent::class)->name('my_account');
    // verify-email
    Route::get('/verify-email', EmailVerificationPromptComponent::class)
        ->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});
