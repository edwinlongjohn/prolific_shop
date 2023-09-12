<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/view-product-details/{id}', [WelcomeController::class, 'viewProduct'])->name('view_product');


Route::get('/dashboard', function () {
    $user = Auth::user();
    if($user->role == 'user'){
        return redirect()->route('user');
    }elseif ($user->role == 'admin') {
        return redirect()->route('admin');
    }else{
        return redirect()->route('welcome');
    }
})->middleware(['auth', 'verified'])->name('dashboard');



Route::prefix('user')->middleware(['auth'])->group(function () {
 Route::get('/', [UserController::class, 'index'])->name('user');
 Route::get('/add-to-cart/{id}',[CartController::class, 'addToCart'])->name('user.add_to_cart');
 Route::get('/view-cart', [CartController::class, 'viewCartItems'])->name('user.view_cart');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/create-product', [AdminController::class, 'createProduct'])->name('admin.create_product');
    Route::resource('/category', CategoryController::class);
    Route::post('/submit-product', [ProductController::class, 'addProduct'])->name('admin.submit_product');
    Route::get('/view-products', [ProductController::class, 'viewProducts'])->name('admin.show_products');
    Route::get('/product-details/{id}', [ProductController::class, 'productDetails'])->name('admin.view_product_details');
    Route::get('/edit-product/{name}/{id}', [ProductController::class, 'edit'])->name('admin.edit_product');
    Route::post('/submit-editted-product/{product}', [ProductController::class, 'submitEdittedProduct'])->name('admin.submit_editted_product');


});








Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
