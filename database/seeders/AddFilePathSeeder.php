<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File\File;


class AddFilePathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::all();

        foreach ($files as $file) {
            $exploded =  explode("/", $file->path);
            if($exploded[0]=="uploads"){
                $file->update([
                    'path'=> 'public/'. $file->path
                ]);
            }
        }
    }
}
