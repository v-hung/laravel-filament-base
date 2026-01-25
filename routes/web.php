<?php

use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Content\PostController;
use App\Http\Controllers\Purchase\CartController;
use App\Http\Controllers\Purchase\OrderController;
use App\Http\Controllers\Purchase\PaymentController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');

    // order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{code}', [OrderController::class, 'show'])->name('orders.show');
});

// home & pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

// shop / collections / products
Route::get('/collections', [HomeController::class, 'index'])->name('collections');
Route::get('/collections/{collection_slug}', [HomeController::class, 'index'])->name('collections.show');
Route::get('/collections/{collection_slug}/products/{product_slug}', [HomeController::class, 'index'])->name('collections.products.show');

Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/products/{product_slug}', [ProductController::class, 'detail'])->name('products.detail');

// content
Route::get('/blogs', [PostController::class, 'index'])->name('blogs');
Route::get('/blogs/{blog_slug}', [PostController::class, 'index'])->name('blogs.show');
Route::get('/posts/{post_slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/pages/{page_slug}', [HomeController::class, 'index'])->name('page.show');

// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// payment
Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout');
Route::post('/checkout', [PaymentController::class, 'process'])->name('checkout.process');

// wishlist
// Route::get('/wishlist', [HomeController::class, 'index'])->name('wishlist');

// Route::middleware(['auth', 'verified.optional'])->group(function () {
//     Route::get('/', [CartController::class, 'index'])->name('index');
//     Route::post('add/{id}', [CartController::class, 'add'])->name('add');
//     Route::delete('remove/{id}', [CartController::class, 'remove'])->name('remove');
// });


// common
Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'vi'])) {
        abort(400, 'Unsupported locale');
    }

    session(['locale' => $locale]);

    App::setLocale($locale);

    return redirect()->back();
})->name('lang.switch');


// Route::get('/clear', function () {
//     Artisan::call('filament:optimize-clear');
//     Artisan::call('optimize:clear');

//     return 'All caches cleared!';
// });

// Route::get('/optimize', function () {
//     Artisan::call('filament:optimize');
//     Artisan::call('optimize');
//     return 'Application optimized!';
// });

// Route::get('/filament-optimize', function () {
//     Artisan::call('filament:optimize');
//     return 'Application optimized!';
// });

// Route::get('/filament-clear', function () {
//     Artisan::call('filament:optimize-clear');
//     return 'All caches cleared!';
// });

// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
//     return 'Storage linked!';
// });

require __DIR__ . '/auth.php';
