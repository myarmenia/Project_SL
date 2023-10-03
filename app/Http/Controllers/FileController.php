<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FileService;

class FileController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService){

        $this->fileService = $fileService;
    }
    public function indexingExistingFiles()
    {
        $indexingFiles = $this->fileService->indexingExistingFiles();
        dd($indexingFiles);
    }
}
