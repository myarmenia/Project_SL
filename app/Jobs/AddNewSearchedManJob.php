<?php

namespace App\Jobs;

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

    protected $newManArray;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newManArray)
    {
        $this->newManArray = $newManArray;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SearchService $searchService)
    {
        foreach ($this->newManArray as $key => $item) {
            $dataOrId = ['fileItemId' => $item];
            $searchService->newFileDataItem($dataOrId);
        }
    }
}
