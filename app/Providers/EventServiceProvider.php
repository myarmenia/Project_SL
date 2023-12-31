<?php

namespace App\Providers;

use App\Events\ConsistentSearchEvent;
use App\Events\ConsistentSearchRelationsEvent;
use App\Listeners\ConsistentSearchListener;
use App\Listeners\ConsistentSearchRelationsListener;
use App\Observers\File\FileObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\File\File;
use App\Models\Signal;
use App\Observers\SignalObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ConsistentSearchEvent::class => [
            ConsistentSearchListener::class
        ],
        ConsistentSearchRelationsEvent::class => [
            ConsistentSearchRelationsListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        File::observe(FileObserver::class);

        // Signal::observe(SignalObserver::class);

    }
}
