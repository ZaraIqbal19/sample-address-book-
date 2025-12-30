<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('user.index');
});
Route::get('/sample', function () {
    return view('genie.sample insertion');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'admin') {
            return redirect('/geniedashboard');
        }

        return view('User.index');

    })->name('dashboard');

    Route::get('/geniedashboard', function () {
        return view('genie.dashboard');
    });
    // User Management Page
    Route::get('/genie/users', [GenieController::class, 'users'])
        ->name('genie.user');

    // AJAX: Update role
    Route::post('/genie/users/update-role', [GenieController::class, 'updateUserRole'])
        ->name('genie.user.updateRole');

    // AJAX: Delete user
    Route::delete('/genie/users/{id}', [GenieController::class, 'deleteUser'])
        ->name('genie.user.delete');
    Route::get('/genie/category', [GenieController::class, 'categoryForm']);
Route::post('/genie/category', [GenieController::class, 'saveCategory'])->name('genie.category.save');
Route::post('/genie/subcategory/store', [GenieController::class, 'storeSubCategory']);
Route::get('/genie/subcategory/create/{category_id}', [GenieController::class, 'create'])
    ->name('genie.subcategory.create');
Route::get('/genie/product/{subcategory}', [GenieController::class, 'productForm'])
    ->name('genie.product.form');

Route::post('/genie/product/store', [GenieController::class, 'storeProduct']);
Route::get('/genie/product/create/{subcategory_id}', [GenieController::class, 'productForm'])
    ->name('genie.product.form');

});
