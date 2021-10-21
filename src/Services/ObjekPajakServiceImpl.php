<?php


namespace Mdigi\PBB\Services;


use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\ObjekPajak as ObjekPajakDto;
use Mdigi\PBB\Dtos\OPColumns;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Models\ObjekPajak;

class ObjekPajakServiceImpl implements ObjekPajakService
{

    public function findByNOP(NOP $nop)
    {
        $data = ObjekPajak::select([
            ObjekPajak::allColumns,
            Kecamatan::namaKecamatan,
            Kelurahan::namaKelurahan
        ])->join(Kecamatan::table, Kecamatan::kodeKecamatan, '=', ObjekPajak::kodeKecamatan)
            ->join(Kelurahan::table, function ($join) {
                $join->on(Kelurahan::kodeKecamatan, '=', ObjekPajak::kodeKecamatan)
                    ->on(Kelurahan::kodeKelurahan, '=', ObjekPajak::kodeKelurahan);
            })->where(ObjekPajak::kodeProvinsi, $nop->kodeProvinsi)
            ->where(ObjekPajak::kodeDati, $nop->kodeDati)
            ->where(ObjekPajak::kodeKecamatan, $nop->kodeKecamatan)
            ->where(ObjekPajak::kodeKelurahan, $nop->kodeKelurahan)
            ->where(ObjekPajak::kodeBlok, $nop->kodeBlok)
            ->where(ObjekPajak::nomorUrut, $nop->nomorUrut)
            ->where(ObjekPajak::kodeJenis, $nop->kodeJenis);
        return $data->count() > 1 ? $data->get()->mapInto(ObjekPajakDto::class) : new ObjekPajakDto($data->firstOrFail());

    }
}