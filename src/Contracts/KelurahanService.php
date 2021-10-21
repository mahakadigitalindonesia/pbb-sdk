<?php


namespace Mdigi\PBB\Contracts;

use Mdigi\PBB\Dtos\Kelurahan as KelurahanDto;

interface KelurahanService extends Repository
{
    public function findByKelurahan(KelurahanDto $kelurahan);

    public function blok($kodeKecamatan, $kodeKelurahan);

    public function blokZonaNilaiTanah($kodeKecamatan, $kodeKelurahan, $kodeBlok);
}