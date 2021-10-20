<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Dtos\Kecamatan as KecamatanDto;

interface KecamatanService extends Repository
{
    public function findByKecamatan(KecamatanDto $kecamatan);
}