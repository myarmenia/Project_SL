<?php

namespace App\Services;
use App\Models\File\File;

class FileReaderComponentService
{


    public  static function get_column_name($column_name)
    {
        $column_name['number']-=1;
        $column_name['first_name']-=1;
        $column_name['last_name']-=1;
        $column_name['middle_name']-=1;
        $column_name['birthday']-=1;
        $column_name['address']-=1;
        $column_name['first_name-middle_name-last_name'] -=1;
        $column_name['first_name-last_name-middle_name']-=1;
        $column_name['last_name-first_name-middle_name'] -=1;
        $column_name['family_mamber']-=1;
        $column_name['passport_credentials']-=1;
        $column_name['birthday-address']-=1;
        $column_name['date']-=1;
        $column_name['embassy']-=1;
        $column_name['document_number']-=1;

        return $column_name;
    }
}
