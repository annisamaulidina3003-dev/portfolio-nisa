<?php

namespace App\Providers;

use App\Models\Certificate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
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
        ViewFacade::composer(['index', 'cv', 'cv-pdf'], function (View $view): void {
            $view->with('certificates', Certificate::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Certificate $certificate) => $certificate->toPortfolioArray()));
        });
    }
}
