<?php

use App\Http\Controllers\DiariesController;
use App\Http\Controllers\DiaryEntriesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Auth/Login', [
		'canResetPassword' => Route::has('password.request'),
		'status' => session('status'),
	]);
});

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/dashboard', [DiariesController::class, 'index'])->name('dashboard');
	Route::resource('diaries', DiariesController::class);

	Route::get('diary-entries/{diary}', [DiaryEntriesController::class,'index'])->name('diary-entries');
	Route::get('diary-entries/{diary}/create', [DiaryEntriesController::class,'create'])->name('diary-entries.create');
	Route::get('diary-entries/{diary_entry}/edit', [DiaryEntriesController::class,'edit'])->name('diary-entries.edit');
	Route::post('diary-entries', [DiaryEntriesController::class,'store'])->name('diary-entries.store');
	Route::put('diary-entries/{diary_entry}', [DiaryEntriesController::class,'update'])->name('diary-entries.update');
	Route::delete('diary-entries/{diary_entry}', [DiaryEntriesController::class,'destroy'])->name('diary-entries.destroy');

});

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
