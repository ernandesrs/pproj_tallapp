<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

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
        TallStackUi::personalize()
            ->card()

            ->block('wrapper.first')
            ->append('h-full')

            ->block('wrapper.second')
            ->replace('dark:bg-dark-700', 'dark:bg-dark-800')

            ->block('header.text')
            ->replace('text-secondary-700', 'text-dark-500')
            ->replace('dark:text-dark-300', 'dark:text-dark-300')

            ->block('body')
            ->replace('text-secondary-700', 'text-dark-400')
            ->replace('dark:text-dark-300', 'dark:text-dark-400')

            ->block('footer.wrapper')
            ->replace('text-secondary-700', 'text-dark-600')
            ->replace('dark:text-dark-300', 'dark:text-dark-300');

        TallStackUi::personalize()
            ->table()

            ->block('wrapper')
            ->replace('dark:ring-dark-600', 'dark:ring-dark-700')

            ->block('table.tbody')
            ->replace('dark:bg-dark-700', 'dark:bg-dark-800')

            ->block('table.thead.normal')
            ->replace('dark:bg-dark-600', 'dark:bg-dark-700')

            ->block('table.thead.striped')
            ->replace('dark:bg-dark-700', 'dark:bg-dark-800');
    }
}
