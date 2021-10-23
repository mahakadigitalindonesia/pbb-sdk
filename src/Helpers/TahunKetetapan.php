<?php


namespace Mdigi\PBB\Helpers;


use Illuminate\Support\Carbon;

class TahunKetetapan
{
    public static function maxYear()
    {
        return Carbon::now()->year - config('pbb.transaksi.max_year_backward');
    }
}