<?php
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('home'); // Blade homepage
});

// Complaints routes
Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])
    ->middleware('auth')
    ->name('complaints.destroy');

// ✅ Dashboard route
Route::get('/dashboard', [ComplaintController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');


// ✅ Toggle status route
Route::post('/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('complaints.updateStatus');

// ✅ History route
Route::get('/history', [ComplaintController::class, 'history'])
    ->middleware('auth')
    ->name('complaints.history');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes (optional)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
