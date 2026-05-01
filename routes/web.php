<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;

// Home / Redirect
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'Administrator') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('customer.dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // Menu
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    });

    // Wallet
    Route::prefix('wallet')->group(function () {
        Route::get('/', [WalletController::class, 'show'])->name('wallet.show');
        Route::post('/add-balance', [WalletController::class, 'addBalance'])->name('wallet.addBalance');
        Route::get('/verify/{orderId}', [WalletController::class, 'verifyWallet'])->name('wallet.verify');
        Route::post('/pay/{orderId}', [WalletController::class, 'processPayment'])->name('wallet.pay');
    });

    // Tickets
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/{id}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'adminIndex'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'adminShow'])->name('orders.show');
        Route::post('/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // Items
    Route::prefix('items')->group(function () {
        Route::get('/', [MenuController::class, 'adminIndex'])->name('items.index');
        Route::get('/create', [MenuController::class, 'create'])->name('items.create');
        Route::post('/', [MenuController::class, 'store'])->name('items.store');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('items.edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('items.update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('items.destroy');
    });

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('users.index');
        Route::get('/{id}', [AdminController::class, 'showUser'])->name('users.show');
        Route::post('/{id}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
        Route::post('/{id}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');
    });

    // Tickets
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'adminIndex'])->name('tickets.index');
        Route::get('/{id}', [TicketController::class, 'adminShow'])->name('tickets.show');
        Route::post('/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
        Route::post('/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    });
});
