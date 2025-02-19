<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WinemakerController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'welcome')->name('root');
Route::view('/about', 'about')->name('about');
Route::get('/food-list', [FoodController::class, 'index'])->name('food.index');
Route::get('/food/{food}', [FoodController::class, 'show'])->name('food.show');
Route::get('/wine-list', [WineController::class, 'index'])->name('wine.index');
Route::get('/wine/{wine}', [WineController::class, 'show'])->name('wine.show');
Route::get('/wizard', [WineController::class, 'wizard'])->name('wine.wizard');
Route::get('/winemaker-list', [WinemakerController::class, 'index'])->name('winemaker.index');
Route::get('/winemaker/{winemaker}', [WinemakerController::class, 'show'])->name('winemaker.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
