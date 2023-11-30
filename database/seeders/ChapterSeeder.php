<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chapter::updateOrCreate([
            'content' => 'Անուն',
        ]);

        Chapter::updateOrCreate([
            'content' => 'Ազգանուն',
        ]);

        Chapter::updateOrCreate([
            'content' => 'Հայրանուն',
        ]);

        Chapter::updateOrCreate([
            'content' => 'Այլ',
        ]);
    }
}
