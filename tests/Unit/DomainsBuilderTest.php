<?php


namespace Mdigi\PBB\Tests\Unit;


use Mdigi\PBB\Domains\DataBangunan;
use Mdigi\PBB\Domains\DataObjekPajak;
use Mdigi\PBB\Domains\DataSubjekPajak;
use Mdigi\PBB\Tests\TestCase;

class DomainsBuilderTest extends TestCase
{
    public function test_create_objek_using_builder()
    {
        $objekPajak = DataObjekPajak::builder()
            ->kodeProvinsi('00')
            ->kodeDati('00')
            ->kodeKecamatan('000')
            ->kodeKelurahan('000')
            ->kodeBlok('000')
            ->nomorUrut('0000')
            ->kodeJenis('0')
            ->build();
        $this->assertNotNull($objekPajak);
        $this->assertEquals('00', $objekPajak->getKodeProvinsi());
        $this->assertEquals('00', $objekPajak->getKodeDati());
        $this->assertEquals('000', $objekPajak->getKodeKecamatan());
        $this->assertEquals('000', $objekPajak->getKodeKelurahan());
        $this->assertEquals('000', $objekPajak->getKodeBlok());
        $this->assertEquals('0000', $objekPajak->getNomorUrut());
        $this->assertEquals('0', $objekPajak->getKodeJenis());
    }

    public function test_create_subjek_pajak_using_builder()
    {
        $wajibPajak = DataSubjekPajak::builder()
            ->nama('TEST')
            ->jalan('TEST')
            ->build();
        $this->assertNotNull($wajibPajak);
        $this->assertEquals('TEST', $wajibPajak->getNama());
        $this->assertEquals('TEST', $wajibPajak->getJalan());
    }

    public function test_create_data_bangunan_using_builder()
    {
        $bangunan = DataBangunan::builder()
            ->nipPerekam('12345')
            ->nipPemeriksa('2837')
            ->nipPendata('019010')
            ->build();
        $this->assertNotNull($bangunan);
        $this->assertEquals('12345', $bangunan->getNipPerekam());
        $this->assertEquals('2837', $bangunan->getNipPemeriksa());
        $this->assertEquals('019010', $bangunan->getNipPendata());
    }
}