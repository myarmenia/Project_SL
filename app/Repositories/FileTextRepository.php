<?php

namespace App\Repositories;

use App\Models\File\FileText;
use Illuminate\Support\Facades\DB;
use App\Contracts\IFileTextInterface;
use Illuminate\Support\LazyCollection;

class FileTextRepository implements IFileTextInterface
{

    public function __construct(private FileText $fileText) {

        $this->fileText = $fileText;
    }

    public function getFileTextSimilary(): LazyCollection
    {
      return  $this->fileText->with('file')
                ->orderBy('file_id')
                ->where('status',0)
                ->lazy();

    }

    function getFileTextContent($data): LazyCollection
    {
        return $this->fileText->with('file')
                    ->where('status',0)
                    ->whereFullText('content', "'$data'", ['mode' => 'boolean'])
                    ->orderBy('id','asc')
                    ->lazy();
    }

    function getFileTextRegexp($data): LazyCollection|array
    {
        if (!empty($data)) {

            $listing = $this->fileText->with('file')->whereRaw("content LIKE '%$data[0]%'");

            foreach ($data as $value) {

                    $listing->orWhereRaw("content LIKE '%$value%'");
            }
            $results = $listing->where('status',0)
            ->orderBy('id','asc')
            ->lazy();

            return $results;
        }

        return [];

    }


    function getFileTextLike($data): LazyCollection
    {
        return $this->fileText->with('file')
                    ->where('content','LIKE',"%$data%")
                    ->where('status',0)
                    ->orderBy('id','asc')
                    ->lazy();

    }

    function getDataSynonims($data): array
    {
        return DB::select('select `word` FROM `synonims`
                           WHERE id IN (
                                select syn from `synonims`
                                inner join `word_has_synonym` on `synonims`.`id` = `word_has_synonym`.`word`
                                and `synonims`.`word` = ?)', [$data]);
    }

}

