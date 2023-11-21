<?php

namespace App\Providers;

use App\Models\Bibliography\Bibliography;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\ManHasCar;
use App\Models\MiddleName;
use App\Models\NickName;
use App\Models\Organization;
use App\Models\Passport;
use App\Observers\BibliographyObserver;
use App\Observers\File\FileObserver;
use App\Observers\FirstNameObserver;
use App\Observers\LastNameObserver;
use App\Observers\ManHasCarObserver;
use App\Observers\MiddleNameObserver;
use App\Observers\NickNameObserver;
use App\Observers\OrganizationObserver;
use App\Observers\PassportObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        File::observe(FileObserver::class);
        Bibliography::observe(BibliographyObserver::class);
        Organization::observe(OrganizationObserver::class);

        // Signal::observe(SignalObserver::class);

        FirstName::observe(FirstNameObserver::class);
        LastName::observe(LastNameObserver::class);
        MiddleName::observe(MiddleNameObserver::class);
        Passport::observe(PassportObserver::class);
        NickName::observe(NickNameObserver::class);
        ManHasCar::observe(ManHasCarObserver::class);

    }
}
