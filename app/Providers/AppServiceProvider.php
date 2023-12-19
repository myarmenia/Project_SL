<?php

namespace App\Providers;

use App\Builder\CustomQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // DB::macro('create', function ($table) {
        //     return new CustomQueryBuilder($table);
        // });

        // Paginator::useBootstrapFive();

        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $executionTime = $query->time;

            // do something with the above. Log it, stream it via pusher, etc
        });

    }
}
