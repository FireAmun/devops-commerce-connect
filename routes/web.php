<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VendorLoginController; // Import VendorLoginController
use App\Http\Controllers\AdminLoginController;  // Import AdminLoginController
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Route for login page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route for vendor login page
Route::get('/vendor/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
Route::post('/vendor/login', [VendorLoginController::class, 'login']);

// Route for admin login page
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);

// Route for registration page (if applicable)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request'); // Temporarily remove ->middleware('guest')
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Route for home page
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Route for UTM Mart Vendor page
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');

// Cart and checkout routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/check-out', [CartController::class, 'view'])->name('cart.view');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Wishlist routes
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');
Route::get('/wishlist', [WishlistController::class, 'view'])->name('wishlist.view');
Route::post('/wishlist/remove', function (\Illuminate\Http\Request $request) {
    $wishlist = session('wishlist', []);
    unset($wishlist[$request->product_id]);
    session(['wishlist' => $wishlist]);
    return back()->with('success', 'Item removed from wishlist.');
})->name('wishlist.remove');

// Additional static pages
Route::view('/about-us', 'About-us');
Route::view('/contact', 'Contact');
Route::view('/terms-con', 'Terms-con');
Route::view('/privacy-pol', 'Privacy-pol');
