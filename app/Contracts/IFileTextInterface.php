<?php

namespace App\Contracts;

interface IFileTextInterface
{
    public function getFileTextSimilary();
    public function getFileTextContent($data);
    public function getFileTextLike($data);
    public function getFileTextRegexp($data);
    public function getDataSynonims($data);


}
