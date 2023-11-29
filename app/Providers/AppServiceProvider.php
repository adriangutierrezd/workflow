<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.app', function($view){
            $locale = str_replace('_', '-', app()->getLocale());
            $translationFile = "../lang/$locale.json";
        
            if (file_exists($translationFile)) {
                $translations = file_get_contents($translationFile);
                $view->with('translations', json_decode($translations, true));
            } else {
                $view->with('translations', []);
            }
        });
    }
}
