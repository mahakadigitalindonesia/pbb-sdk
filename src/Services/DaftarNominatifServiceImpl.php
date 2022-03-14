<?php

namespace Mdigi\PBB\Services;

use Mdigi\PBB\Contracts\DaftarNominatifService;
use Mdigi\PBB\Domains\DataObjekPajak;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\DaftarNominatif;

class DaftarNominatifServiceImpl implements DaftarNominatifService
{

    public function save(DataObjekPajak $objekPajak)
    {
        DaftarNominatif::create([
            OPColumns::kodeProvinsi => $objekPajak->getKodeProvinsi(),
            OPColumns::kodeDati => $objekPajak->getKodeDati(),
            OPColumns::kodeKecamatan => $objekPajak->getKodeKecamatan(),
            OPColumns::kodeKelurahan => $objekPajak->getKodeKelurahan(),
            OPColumns::kodeBlok => $objekPajak->getKodeBlok(),
            OPColumns::nomorUrut => $objekPajak->getNomorUrut(),
            OPColumns::kodeJenis => $objekPajak->getKodeJenis(),
            'jalan_op' => $objekPajak->getJalan(),
            'blok_kav_no_op' => $objekPajak->getBlokKavlingNomor(),
            'rw_op' => $objekPajak->getRw()
        ]);
    }
}