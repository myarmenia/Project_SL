<?php

namespace App\Jobs;

use App\Services\FindDataService;
use App\Services\SearchService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddNewSearchedManJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataToInsert;
    protected $fileDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataToInsert, $fileDetails)
    {
        $this->dataToInsert = $dataToInsert;
        $this->fileDetails = $fileDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FindDataService $findDataService, SearchService $searchService)
    {
        $findDataService->addFindDataToInsertAct($this->dataToInsert, $this->fileDetails);
    }
}
