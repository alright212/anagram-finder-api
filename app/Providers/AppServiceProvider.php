<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentWordRepository;
use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\AnagramAlgorithmInterface;
use App\Services\AnagramAlgorithm\SortingAnagramAlgorithm;
use App\Services\AnagramService;
use App\Services\WordbaseImportService;
use App\Services\AdvancedWordbaseImportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repository interfaces to concrete implementations
        $this->app->bind(
            WordRepositoryInterface::class,
            EloquentWordRepository::class
        );

        // Bind AnagramAlgorithm interface to concrete implementation
        // Using UnicodeOptimizedAnagramAlgorithm for better Estonian word handling
        $this->app->bind(
            AnagramAlgorithmInterface::class,
            \App\Services\AnagramAlgorithm\UnicodeOptimizedAnagramAlgorithm::class
        );

        // Register AnagramService as singleton for better performance
        $this->app->singleton(AnagramService::class, function ($app) {
            return new AnagramService(
                $app->make(WordRepositoryInterface::class),
                $app->make(AnagramAlgorithmInterface::class)
            );
        });

        // Register WordbaseImportService
        $this->app->singleton(WordbaseImportService::class, function ($app) {
            return new WordbaseImportService(
                $app->make(WordRepositoryInterface::class),
                $app->make(AnagramAlgorithmInterface::class)
            );
        });

        // Register AdvancedWordbaseImportService
        $this->app->singleton(AdvancedWordbaseImportService::class, function ($app) {
            return new AdvancedWordbaseImportService(
                $app->make(WordRepositoryInterface::class),
                $app->make(AnagramAlgorithmInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
