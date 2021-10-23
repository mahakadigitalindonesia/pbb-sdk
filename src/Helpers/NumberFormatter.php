<?php


namespace Mdigi\PBB\Helpers;


class NumberFormatter
{
    public static function format($number, $decimal = 0)
    {
        return number_format($number, $decimal, ',', '.');
    }
}