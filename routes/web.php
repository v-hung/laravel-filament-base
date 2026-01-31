<?php

use App\Http\Controllers\Content\PostController;
use App\Http\Controllers\Purchase\CartController;
use App\Http\Controllers\Purchase\PaymentController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

// home & pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

// products
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/products/{product_slug}', [ProductController::class, 'detail'])->name('products.detail');

// content
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post_slug}', [PostController::class, 'show'])->name('posts.detail');
Route::get('/pages/{page_slug}', [HomeController::class, 'index'])->name('pages.detail');

// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// payment
Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout');
Route::post('/checkout', [PaymentController::class, 'process'])->name('checkout.process');

// Common routes
Route::get('/greeting/{locale}', function (string $locale) {
	if (! in_array($locale, ['en', 'vi'])) {
		abort(400, 'Unsupported locale');
	}

	session(['locale' => $locale]);

	App::setLocale($locale);

	return redirect()->back();
})->name('lang.switch');

require __DIR__ . '/settings.php';
