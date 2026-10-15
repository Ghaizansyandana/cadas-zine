<?php

use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\BandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GigController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/post/{slug}', [WebController::class, 'showPost'])->name('post.show');
Route::get('/gigs', [WebController::class, 'gigs'])->name('gigs');
Route::get('/submit-gig', [WebController::class, 'submitGigForm'])->name('gigs.create');
Route::post('/submit-gig', [WebController::class, 'storeGig'])->name('gigs.store');
Route::get('/vault', [WebController::class, 'vault'])->name('vault.index');
Route::get('/zines', [WebController::class, 'zines'])->name('zines.index');
Route::get('/zines/{id}', [WebController::class, 'showZine'])->name('zines.show');
Route::get('/bands', [WebController::class, 'bands'])->name('bands.index');
Route::get('/lost-and-found', [WebController::class, 'pitLostFound'])->name('pit.index');
Route::post('/lost-and-found', [WebController::class, 'storePitItem'])->name('pit.store');
Route::get('/guide', [WebController::class, 'guide'])->name('guide');

// Register Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Auth Routes
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah, sob!']);
})->middleware('throttle:5,1');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');

// Admin Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Band / Scene Index
    Route::get('/bands', [BandController::class, 'index'])->name('bands.index');
    Route::get('/bands/create', [BandController::class, 'create'])->name('bands.create');
    Route::post('/bands', [BandController::class, 'store'])->name('bands.store');
    Route::delete('/bands/{id}', [BandController::class, 'destroy'])->name('bands.destroy');

    // Posts & Gigs Management
    Route::resource('posts', PostController::class)->except(['show']);
    Route::get('/gigs/create', [GigController::class, 'create'])->name('gigs.create');
    Route::post('/gigs', [GigController::class, 'store'])->name('gigs.store');

    // Super Admin Approvals
    Route::patch('/posts/{post}/approve', [PostController::class, 'approve'])
        ->middleware('super-admin')
        ->name('posts.approve');
    Route::get('/approvals/posts', [PostController::class, 'pendingPosts'])
        ->middleware('super-admin')
        ->name('approvals.posts');

    Route::middleware('super-admin')->group(function () {
        Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
        Route::patch('/approvals/gigs/{id}', [ApprovalController::class, 'approveGig'])->name('approvals.gigs.approve');
        Route::delete('/approvals/gigs/{id}', [ApprovalController::class, 'rejectGig'])->name('approvals.gigs.reject');
        Route::patch('/approvals/pits/{id}', [ApprovalController::class, 'approvePit'])->name('approvals.pits.approve');
        Route::delete('/approvals/pits/{id}', [ApprovalController::class, 'rejectPit'])->name('approvals.pits.reject');
    });
});
