<?php

namespace App\Listeners;

use App\Events\ConsistentSearchWithRelationEvent;
use App\Models\Car;
use App\Models\ConsistentSearch;
use App\Models\Email;
use App\Models\Phone;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsistentSearchWithRelationListener
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
     * @param ConsistentSearchWithRelationEvent $event
     */
    public function handle(ConsistentSearchWithRelationEvent $event)
    {
        if($event->table == 'organization_has_car') {
            self::forCar(ConsistentSearch::SEARCH_TYPES['ORGANIZATION'], $event->id, $event->type);
        }

        if($event->table == 'man_has_car' or $event->table == 'man_use_car') {
            self::forCar(ConsistentSearch::SEARCH_TYPES['MAN'], $event->id, $event->type);
        }

        if($event->table == 'man_has_phone') {
            self::forPhone(ConsistentSearch::SEARCH_TYPES['MAN'], $event->id, $event->type);
        }

        if($event->table == 'man_has_email') {
            self::forEmail(ConsistentSearch::SEARCH_TYPES['MAN'], $event->id, $event->type);
        }
    }


    /**
     * @param $field
     * @param $id
     * @param $type
     */
    public function forCar($field, $id, $type)
    {
        $car = Car::query()->with(['car_category', 'car_mark', 'car_color'])->find($id);
        if($car) {
            if($car->number) {
                ConsistentSearchService::search($field, $car->number, $type);
            }

            if($car->car_category) {
                ConsistentSearchService::search($field, $car->car_category->name, $type);
            }

            if($car->car_mark) {
                ConsistentSearchService::search($field, $car->car_mark->name, $type);
            }

            if($car->car_color) {
                ConsistentSearchService::search($field, $car->car_color->name, $type);
            }
        }
    }


    /**
     * @param $field
     * @param $id
     * @param $type
     */
    public function forPhone($field, $id, $type)
    {
        $phone = Phone::query()->find($id);
        if($phone) {
            ConsistentSearchService::search($field, $phone->number, $type);
        }
    }


    /**
     * @param $field
     * @param $id
     * @param $type
     */
    public function forEmail($field, $id, $type)
    {
        $email = Email::query()->find($id);
        if($email) {
            ConsistentSearchService::search($field, $email->address, $type);
        }
    }


}
