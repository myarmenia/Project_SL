<?php

namespace App\Listeners;

use App\Events\ConsistentSearchRelationsEvent;
use App\Models\Car;
use App\Models\ConsistentSearch;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsistentSearchRelationsListener
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
     * @param ConsistentSearchRelationsEvent $event
     */
    public function handle(ConsistentSearchRelationsEvent $event)
    {
        if($event->table == 'first_name'
            || $event->table == 'last_name'
            || $event->table == 'middle_name'
            || $event->table == 'nickname'
            || $event->table == 'passport'
            || $event->table == 'man_has_email'
            || $event->table == 'man_has_phone') {
            ConsistentSearchService::search(ConsistentSearch::SEARCH_TYPES['MAN'], $event->text, ConsistentSearch::NOTIFICATION_TYPES['INCOMING'], $event->id);
        }

        if($event->table == 'organization') {
            ConsistentSearchService::search(ConsistentSearch::SEARCH_TYPES['ORGANIZATION'], $event->text, ConsistentSearch::NOTIFICATION_TYPES['INCOMING'], $event->id);
        }

        if($event->table == 'organization_has_car') {
            self::forCar(ConsistentSearch::SEARCH_TYPES['ORGANIZATION'], $event->tableId, ConsistentSearch::NOTIFICATION_TYPES['INCOMING'], $event->id);
        }

        if($event->table == 'man_has_car' or $event->table == 'man_use_car') {
            self::forCar(ConsistentSearch::SEARCH_TYPES['MAN'], $event->tableId, ConsistentSearch::NOTIFICATION_TYPES['INCOMING'], $event->id);
        }


    }


    /**
     * @param $field
     * @param $carId
     * @param $type
     * @param $id
     */
    public function forCar($field, $carId, $type, $id)
    {
        $car = Car::query()->with(['car_category', 'car_mark', 'car_color'])->find($carId);
        if($car) {
            if($car->number) {
                ConsistentSearchService::search($field, $car->number, $type, $id);
            }

            if($car->car_category) {
                ConsistentSearchService::search($field, $car->car_category->name, $type, $id);
            }

            if($car->car_mark) {
                ConsistentSearchService::search($field, $car->car_mark->name, $type, $id);
            }

            if($car->car_color) {
                ConsistentSearchService::search($field, $car->car_color->name, $type, $id);
            }
        }
    }


}
