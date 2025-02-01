<?php

namespace App\Providers;

use App\Models\DiaryEntries;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Diaries;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		Route::model('diary', Diaries::class);
		Route::model('diary_entry', DiaryEntries::class);
        Vite::prefetch(concurrency: 3);
    }
}
