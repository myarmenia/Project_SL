<?php

namespace App\Services;
use App\Models\File\File;

class PdfFileReaderService
{


    public function get()
    {
        dd(File::search('Հունվարի 16-ին հաղորդվել')->get());
    }
}


