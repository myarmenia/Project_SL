<?php

namespace App\Listeners;

use App\Events\ConsistentSearchEvent;
use App\Models\Car;
use App\Models\Email;
use App\Models\Phone;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsistentSearchListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * @param ConsistentSearchEvent $event
     */
    public function handle(ConsistentSearchEvent $event)
    {
        if($event->table == 'organization_has_car') {
            self::forCar('organization', $event->id);
        }

        if($event->table == 'man_has_car' or $event->table == 'man_use_car') {
            self::forCar('man', $event->id);
        }

        if($event->table == 'man_has_phone') {
            self::forPhone('man', $event->id);
        }

        if($event->table == 'man_has_email') {
            self::forEmail('man', $event->id);
        }
    }


    /**
     * @param $field
     * @param $id
     */
    public function forCar($field, $id)
    {
        $car = Car::query()->with(['car_category', 'car_mark', 'car_color'])->find($id);
        if($car) {
            if($car->number) {
                ConsistentSearchService::search($field, $car->number);
            }

            if($car->car_category) {
                ConsistentSearchService::search($field, $car->car_category->name);
            }

            if($car->car_mark) {
                ConsistentSearchService::search($field, $car->car_mark->name);
            }

            if($car->car_color) {
                ConsistentSearchService::search($field, $car->car_color->name);
            }
        }
    }


    /**
     * @param $field
     * @param $id
     */
    public function forPhone($field, $id)
    {
        $phone = Phone::query()->find($id);
        if($phone) {
            ConsistentSearchService::search($field, $phone->number);
        }
    }


    /**
     * @param $field
     * @param $id
     */
    public function forEmail($field, $id)
    {
        $email = Email::query()->find($id);
        if($email) {
            ConsistentSearchService::search($field, $email->address);
        }
    }


}
