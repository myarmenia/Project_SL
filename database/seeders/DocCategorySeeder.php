<?php

namespace Database\Seeders;

use App\Models\DocCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocCategory::create( [
            'id'=>1,
            'name'=>'category 1',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Doccategory::create( [
            'id'=>2,
            'name'=>'catagory 2',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Doccategory::create( [
            'id'=>3,
            'name'=>'Kategory 3',
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
    }
}
