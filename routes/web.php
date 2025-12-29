<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// === 1. ROUTE PUBLIC (PELANGGAN) ===
Route::get('/menu-digital', [PublicMenuController::class, 'index'])->name('public.index');
Route::get('/menu-digital/{menu}', [PublicMenuController::class, 'show'])->name('public.show');

// Route untuk kirim Kritik & Saran (Baru)
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


// === 2. ROUTE LOGIN ===
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

// [FIX] Route ini yang tadi hilang/error
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');


// === 3. ROUTE ADMIN (WAJIB LOGIN) ===
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('menus', MenuController::class);

    // Route untuk baca Inbox Kritik Saran (Baru)
    Route::get('/inbox', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::delete('/inbox/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Tables Management
    Route::resource('tables', TableController::class);

    // Route Update Status Reservasi (Admin)
    Route::patch('/reservations/{reservation}', [ReservationController::class, 'updateStatus'])->name('reservations.update');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});