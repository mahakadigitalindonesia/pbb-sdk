<?php

namespace Mdigi\PBB\Services;

use Carbon\Carbon;
use Mdigi\PBB\Contracts\DaftarNominatifService;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Contracts\WajibPajakService;
use Mdigi\PBB\Domains\DataObjekPajak;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Exceptions\DataOpNotFoundException;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\DaftarNominatif;
use Mdigi\PBB\Models\ObjekBumi;
use Mdigi\PBB\Models\ObjekPajak;

class DaftarNominatifServiceImpl implements DaftarNominatifService
{
    private ObjekPajakService $objekPajakService;

    public function __construct(ObjekPajakService $objekPajakService)
    {
        $this->objekPajakService = $objekPajakService;
    }

    public function save(NOP $nop, string $nip)
    {
        $objekPajak = $this->objekPajakService->findByNOP($nop);
        DaftarNominatif::query()->updateOrCreate([
            OPColumns::kodeProvinsi => $nop->kodeProvinsi,
            OPColumns::kodeDati => $nop->kodeDati,
            OPColumns::kodeKecamatan => $nop->kodeKecamatan,
            OPColumns::kodeKelurahan => $nop->kodeKelurahan,
            OPColumns::kodeBlok => $nop->kodeBlok,
            OPColumns::nomorUrut => $nop->nomorUrut,
            OPColumns::kodeJenis => $nop->kodeJenis,
            'thn_pembentukan' => date('Y')
        ], [
            'jalan_op' => $objekPajak->jalan,
            'blok_kav_no_op' => $objekPajak->blokKavlingNomor,
            'rw_op' => $objekPajak->rt,
            'rt_op' => $objekPajak->rw,
            'jns_bumi' => $objekPajak->kodeTanah,
            'kd_status_wp' => 1,
            'kategori_op' => 4,
            'tgl_pembentukan' => Carbon::now(),
            'nip_pembentuk' => $nip,
            'tgl_pemutakhiran' => Carbon::now(),
            'nip_pemutakhir' => $nip,
        ]);
    }
}