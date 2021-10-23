<?php


namespace Mdigi\PBB\Tests\Unit;


use Illuminate\Support\Carbon;
use Mdigi\PBB\Helpers\TahunKetetapan;
use Mdigi\PBB\Tests\TestCase;

class TahunKetetapanHelperTest extends TestCase
{
    function test_max_year()
    {
        $expected = Carbon::now()->year - 10;
        dump($expected);
        $this->assertEquals($expected, TahunKetetapan::maxYear());
    }
}