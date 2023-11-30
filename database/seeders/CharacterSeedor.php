<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeedor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::updateOrCreate([
            'name' => 'Անուն',
        ]);

        Character::updateOrCreate([
            'name' => 'Ազգանուն',
        ]);

        Character::updateOrCreate([
            'name' => 'Հայրանուն',
        ]);

        Character::updateOrCreate([
            'name' => 'Այլ',
        ]);
    }
}
