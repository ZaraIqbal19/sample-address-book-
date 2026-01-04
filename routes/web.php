<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\GenieMiddleware;

// ----------------------------
// Public routes
// ----------------------------
Route::get('/', function () {
    return view('welcome');
});

// Sample page (public)
Route::get('/sample', function () {
    return view('genie.sample insertion');
});
Route::middleware([GenieMiddleware::class])->group(function () {

    // Genie Dashboard
    Route::get('/geniedashboard', function () {
        return view('Genie.dashboard'); // Main admin dashboard
    })->name('geniedashboard');

    // User Management
    Route::get('/genie/users', [GenieController::class, 'users'])
        ->name('genie.user');

    Route::post('/genie/users/update-role', [GenieController::class, 'updateUserRole'])
        ->name('genie.user.updateRole');

    Route::delete('/genie/users/{id}', [GenieController::class, 'deleteUser'])
        ->name('genie.user.delete');

    // Category
    Route::get('/genie/category', [GenieController::class, 'categoryForm']);
    Route::post('/genie/category', [GenieController::class, 'saveCategory'])
        ->name('genie.category.save');

    // Subcategory
    Route::get('/genie/subcategory/create/{category_id}', [GenieController::class, 'create'])
        ->name('genie.subcategory.create');
    Route::post('/genie/subcategory/store', [GenieController::class, 'storeSubCategory']);

    // Products
    Route::get('/genie/product/{subcategory}', [GenieController::class, 'productForm'])
        ->name('genie.product.form');

    Route::post('/genie/product/store', [GenieController::class, 'storeProduct']);
    Route::get('/genie/product/create/{subcategory_id}', [GenieController::class, 'productForm'])
        ->name('genie.product.form');

    Route::prefix('genie')->controller(GenieController::class)->group(function () {
        Route::get('/products', 'productList')->name('genie.product_info');
        Route::post('/best-seller/toggle', [GenieController::class, 'toggleBestSeller']);
        Route::post('/new-arrival/toggle', [GenieController::class, 'toggleNewArrival']);
    });
  Route::get('/genie/vendor/add', [GenieController::class, 'vendorAdd'])
         ->name('genie.vendor.add');

    Route::post('/genie/vendor/store', [GenieController::class, 'vendorStore'])
         ->name('genie.vendor.store');
           Route::get('/genie/vendorshow', [GenieController::class, 'vendorshow'])
        ->name('genie.vendorshow');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('geniedashboard');
        }
        return redirect()->route('user.home');
    })->name('dashboard');

    // User home page
    Route::get('/home', function () {
        return view('user.index');
    })->name('user.home');

    // User products
    Route::get('/user/products', [UserController::class, 'userProducts'])->name('user.products');
    Route::post('/cart/add', [UserController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/increase', [UserController::class, 'increaseCart'])->name('cart.increase');
    Route::post('/cart/decrease', [UserController::class, 'decreaseCart'])->name('cart.decrease');
    Route::delete('/cart/remove', [UserController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [UserController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [UserController::class, 'removeCart'])->name('cart.remove');
Route::get('/product-description/{product}', 
    [UserController::class, 'productDescription']
)->name('product.description');
Route::post('/wishlist/toggle', [UserController::class, 'toggleWishlist']);
Route::get('/cart', [UserController::class, 'cart'])->name('cart.view');
Route::get('/checkout', [App\Http\Controllers\UserController::class, 'checkout'])
     ->name('checkout.index');
     Route::post('/place-order', [UserController::class, 'placeOrder'])
     ->name('place.order');
     
});
