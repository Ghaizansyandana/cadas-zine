<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\PostAdminController;

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/post/{slug}', [WebController::class, 'showPost'])->name('post.show');
Route::get('/gigs', [WebController::class, 'gigs'])->name('gigs.index');


// Route Submit Gig
Route::get('/submit-gig', [WebController::class, 'submitGigForm'])->name('gigs.create');
Route::post('/submit-gig', [WebController::class, 'storeGig'])->name('gigs.store');

Route::get('/vault', [WebController::class, 'vault'])->name('vault.index');

Route::get('/zines', [WebController::class, 'zines'])->name('zines.index');
Route::get('/zines/{id}', [WebController::class, 'showZine'])->name('zines.show');

Route::get('/bands', [WebController::class, 'bands'])->name('bands.index');

Route::get('/lost-and-found', [WebController::class, 'pitLostFound'])->name('pit.index');
Route::post('/lost-and-found', [WebController::class, 'storePitItem'])->name('pit.store');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Halaman Utam Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Simple Resource CRUD
    Route::resource('posts', PostAdminController::class);
    Route::resource('gigs', GigAdminController::class);
    Route::resource('bands', BandAdminController::class);
});

// Auth Route Simpel
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah, sob!']);
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Group Admin (Diproteksi Middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostAdminController::class);

    // Moderasi / Approval Routes
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::patch('/approvals/gigs/{id}', [ApprovalController::class, 'approveGig'])->name('approvals.gigs.approve');
    Route::delete('/approvals/gigs/{id}', [ApprovalController::class, 'rejectGig'])->name('approvals.gigs.reject');
    Route::patch('/approvals/pits/{id}', [ApprovalController::class, 'approvePit'])->name('approvals.pits.approve');
    Route::delete('/approvals/pits/{id}', [ApprovalController::class, 'rejectPit'])->name('approvals.pits.reject');
});

