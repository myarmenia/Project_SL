<?php
namespace App\Services\SimpleSearch;

enum LengthDataFormat: int
{
    case MOBILE_PHONE = 9;
    case HOME_PHONE = 6;
    case INTER_PHONE = 11;
    case DATE_LENGTH = 8;
    case CAR_NUMBER_LENGTH = 7;
}
