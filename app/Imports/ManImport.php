<?php

namespace App\Imports;

use App\Models\Man;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// class ManImport implements ToModel
class ManImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        // return new Man([
        //     //
        // ]);
    }
}
