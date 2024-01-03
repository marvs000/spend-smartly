<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetLogController;
use App\Http\Controllers\BudgetSetupController;
use App\Http\Controllers\IncomeSetupController;
use App\Http\Controllers\IncomeSourceController;
use App\Http\Controllers\BudgetAllocationController;
use App\Http\Controllers\Authentication\LoginController;

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
        Route::prefix('logs')->group(function () {
            Route::get('/', [IncomeSourceController::class, 'index'])->name('income-logs');
            Route::post('/store', [IncomeSourceController::class, 'store'])->name('income-logs-store');
            Route::get('/edit/{id}', [IncomeSourceController::class, 'edit'])->name('income-logs-edit');
            Route::put('/update/{id}', [IncomeSourceController::class, 'update'])->name('income-logs-update');
            Route::delete('/delete/{id}', [IncomeSourceController::class, 'delete'])->name('income-logs-delete');
        });
        Route::get('/setup', [IncomeSetupController::class, 'index'])->name('income-setup');
    });

    Route::prefix('budget')->group(function () {
        Route::prefix('logs')->group(function () {
            Route::get('/', [BudgetLogController::class, 'index'])->name('budget-logs');
        });
        Route::prefix('allocation')->group(function () {
            Route::get('/', [BudgetAllocationController::class, 'index'])->name('budget-allocation');
        });
        Route::prefix('setup')->group(function () {
            Route::get('/', [BudgetSetupController::class, 'index'])->name('budget-setup');
        });
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