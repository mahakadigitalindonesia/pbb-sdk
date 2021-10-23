<?php


namespace Mdigi\PBB\Helpers;


use Illuminate\Support\Carbon;

class DateFormatter
{
    public static function format(string $date, string $format = DateFormat::dFY)
    {
        return Carbon::parse($date)->translatedFormat($format);
    }
}