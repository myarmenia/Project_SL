<?php

namespace App\Providers;

use App\Contracts\IFileTextInterface;
use App\Repositories\FileTextRepository;
use Illuminate\Support\ServiceProvider;

class FileTextServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IFileTextInterface::class, FileTextRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
