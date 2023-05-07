<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminCostController;
use App\Http\Controllers\Admin\AdminUserController;
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
    return view('top');
});

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//追加
//Route::get('/list', [TodoListController::class, 'index']);
//Route::resource('tasks', TaskController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('items', ItemController::class)->middleware('auth');
    Route::resource('costs', CostController::class)->middleware('auth');
});
require __DIR__ . '/auth.php';

//★追加
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');

        Route::resource('items', AdminItemController::class)->middleware('auth:admin');
        Route::resource('costs', AdminCostController::class)->middleware('auth:admin');
        Route::resource('users', AdminUserController::class)->middleware('auth:admin');
    });
    Route::get('welcome', function () {
        return view('admin.welcome');
    })->middleware('guest:admin');
    require __DIR__ . '/admin.php';
});
