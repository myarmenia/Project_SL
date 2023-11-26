<?php

namespace App\Providers;

use App\Events\ConsistentSearchEvent;
use App\Events\ConsistentSearchWithRelationEvent;
use App\Listeners\ConsistentSearchListener;
use App\Listeners\ConsistentSearchWithRelationListener;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\MiddleName;
use App\Models\NickName;
use App\Models\Organization;
use App\Models\Passport;
use App\Observers\File\FileObserver;
use App\Observers\FirstNameObserver;
use App\Observers\LastNameObserver;
use App\Observers\MiddleNameObserver;
use App\Observers\NickNameObserver;
use App\Observers\OrganizationObserver;
use App\Observers\PassportObserver;
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
        ConsistentSearchWithRelationEvent::class => [
            ConsistentSearchWithRelationListener::class
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
        Organization::observe(OrganizationObserver::class);

        // Signal::observe(SignalObserver::class);

        FirstName::observe(FirstNameObserver::class);
        LastName::observe(LastNameObserver::class);
        MiddleName::observe(MiddleNameObserver::class);
        Passport::observe(PassportObserver::class);
        NickName::observe(NickNameObserver::class);

    }
}
