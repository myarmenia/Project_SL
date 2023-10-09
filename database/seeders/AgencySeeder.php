<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agency::updateOrCreate( [
            'id'=>1,
            'name'=>'Տեղեկատվությունը տրամադրող մարմին',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>2,
            'name'=>'Ստորաբաժանում, որն աշխատել է կազմակերպությամբ',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>3,
            'name'=>'Հարուցվել է վարչության նյութերով\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>4,
            'name'=>'Հարուցվել է բաժնի նյութերով\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>5,
            'name'=>'Հարուցվել է ստորաբաժանման նյութերով\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>6,
            'name'=>'Ահազանգն ստուգող վարչություն',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>7,
            'name'=>'Ահազանգն ստուգող բաժին\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>8,
            'name'=>'Ահազանգն ստուգող ստորաբաժանում',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>9,
            'name'=>'Ահազանգը բացող վարչություն',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>10,
            'name'=>'Ահազանգը բացող բաժին\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>11,
            'name'=>'Ահազանգը բացող ստորաբաժանում',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>12,
            'name'=>'ստորաբաժանում 1',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>13,
            'name'=>'Կատարող ստորաբաժանում',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );

            Agency::updateOrCreate( [
            'id'=>14,
            'name'=>'Համատեղ կատարող ստորաբաժանում\r\n',
            'parent_id'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
    }
}
