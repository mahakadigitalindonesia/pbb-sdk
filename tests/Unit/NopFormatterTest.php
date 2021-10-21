<?php


namespace Mdigi\PBB\Tests\Unit;


use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Exceptions\FormatNopNotValidException;
use Mdigi\PBB\Tests\TestCase;

class NopFormatterTest extends TestCase
{
    function test_parse_nop_from_correct_string()
    {
        $formattedNOP = '33.72.010.001.001.0001.0';
        $objectNOP = NOP::parse($formattedNOP);
        $this->assertEquals('33', $objectNOP->kodeProvinsi);
        $this->assertEquals('72', $objectNOP->kodeDati);
        $this->assertEquals('010', $objectNOP->kodeKecamatan);
        $this->assertEquals('001', $objectNOP->kodeKelurahan);
        $this->assertEquals('001', $objectNOP->kodeBlok);
        $this->assertEquals('0001', $objectNOP->nomorUrut);
        $this->assertEquals('0', $objectNOP->kodeJenis);
    }

    function test_parse_nop_from_invalid_string()
    {
        $this->expectException(FormatNopNotValidException::class);
        $formattedNOP = '123213j123';
        NOP::parse($formattedNOP);
    }

    function test_nop_to_string()
    {
        $formattedNOP = '33.72.010.001.001.0001.0';
        $objectNOP = NOP::parse($formattedNOP);
        $this->assertEquals($formattedNOP, (string)$objectNOP);
    }
}