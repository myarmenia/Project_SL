<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate( [
            'id'=>1,
            'name'=>'Armenia',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Country::updateOrCreate( [
            'id'=>2,
            'name'=>'Russian',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Country::updateOrCreate( [
            'id'=>3,
            'name'=>'Italy',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Country::updateOrCreate( [
            'id'=>4,
            'name'=>'Ispania',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );


    }
}
