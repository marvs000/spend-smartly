<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeSourceController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\IncomeSetupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$controller_path = 'App\Http\Controllers';

Route::get('/', function () {
    return view('pages.dashboard.dashboards-analytics');
});

// authentication
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth-login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth-authenticate');

    Route::prefix('income')->group(function () {
        Route::get('/logs', [IncomeSourceController::class, 'index'])->name('income-logs');
        Route::get('/setup', [IncomeSetupController::class, 'index'])->name('income-setup');
        // Route::prefix('setup')->group(function () {
        //     Route::get('/category', [IncomeCategoryController::class, 'index'])->name('income-setup-category');
        //     Route::get('/type', [IncomeTypeController::class, 'index'])->name('income-setup-type');
        // });
    });
});
// Route::get('/auth/register-basic', $controller_path . '\Authentication\RegisterBasic@index')->name('auth-register-basic');
// Route::get('/auth/forgot-password-basic', $controller_path . '\Authentication\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// Main Page Route
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [AnalyticsController::class, 'index'])->name('dashboard-analytics');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth-logout');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users-index');
    });
});