<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['field' => 'man'],
            ['field' => 'organization'],
            ['field' => 'phone_number'],
            ['field' => 'for_cars'],
            ['field' => 'product'],
            ['field' => 'brand'],
        ];

        Library::query()->insert($data);
    }
}
