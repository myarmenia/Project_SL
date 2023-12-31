<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            AgencySeeder::class,
            CountrySeeder::class,
            DocCategorySeeder::class,
            LibrarySeeder::class,
            AddRolesAndPermissionSeeder::class,
            ChapterSeeder::class,
        ]);
    }
}
