<?php


namespace Mdigi\PBB\Services;


use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\ObjekPajak as ObjekPajakDto;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Bangunan;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Models\LookupItem;
use Mdigi\PBB\Models\ObjekPajak;
use Mdigi\PBB\Models\Tanah;

class ObjekPajakServiceImpl implements ObjekPajakService
{

    public function findByNOP(NOP $nop)
    {
        $data = ObjekPajak::select([
            ObjekPajak::allColumns,
            Kecamatan::namaKecamatan,
            Kelurahan::namaKelurahan,
            't_kepemilikan.nm_lookup_item as kepemilikan',
            't_jenis_tanah.nm_lookup_item as jenis_tanah',
            Tanah::kodeZonaNilaiTanah,
            Tanah::kodeTanah,
            DB::raw($this->getCountBangunan($nop) . ' as jumlah_bangunan'),
        ])->join(Tanah::table, function ($join) {
            $join->on(Tanah::kodePropinsi, '=', ObjekPajak::kodeProvinsi)
                ->on(Tanah::kodeDati, '=', ObjekPajak::kodeDati)
                ->on(Tanah::kodeKecamatan, '=', ObjekPajak::kodeKecamatan)
                ->on(Tanah::kodeKelurahan, '=', ObjekPajak::kodeKelurahan)
                ->on(Tanah::kodeBlok, '=', ObjekPajak::kodeBlok)
                ->on(Tanah::nomorUrut, '=', ObjekPajak::nomorUrut)
                ->on(Tanah::kodeJenis, '=', ObjekPajak::kodeJenis);
        })->join(Kecamatan::table, Kecamatan::kodeKecamatan, '=', ObjekPajak::kodeKecamatan)
            ->join(Kelurahan::table, function ($join) {
                $join->on(Kelurahan::kodeKecamatan, '=', ObjekPajak::kodeKecamatan)
                    ->on(Kelurahan::kodeKelurahan, '=', ObjekPajak::kodeKelurahan);
            })->join(LookupItem::table . ' as t_kepemilikan', function ($join) {
                $join->on('t_kepemilikan.kd_lookup_item', '=', ObjekPajak::kodeKepemilikan)
                    ->where('t_kepemilikan.kd_lookup_group', '=', LookupItemService::KEPEMILIKAN);
            })->join(LookupItem::table . ' as t_jenis_tanah', function ($join) {
                $join->on('t_jenis_tanah.kd_lookup_item', '=', Tanah::kodeTanah)
                    ->where('t_jenis_tanah.kd_lookup_group', '=', LookupItemService::TANAH);
            })->where(ObjekPajak::kodeProvinsi, $nop->kodeProvinsi)
            ->where(ObjekPajak::kodeDati, $nop->kodeDati)
            ->where(ObjekPajak::kodeKecamatan, $nop->kodeKecamatan)
            ->where(ObjekPajak::kodeKelurahan, $nop->kodeKelurahan)
            ->where(ObjekPajak::kodeBlok, $nop->kodeBlok)
            ->where(ObjekPajak::nomorUrut, $nop->nomorUrut)
            ->where(ObjekPajak::kodeJenis, $nop->kodeJenis);
        return $data->count() > 1 ? $data->get()->mapInto(ObjekPajakDto::class) : new ObjekPajakDto($data->firstOrFail());

    }

    private function getCountBangunan(NOP $nop)
    {
        $data = Bangunan::query()->where(OPColumns::kodeProvinsi, $nop->kodeProvinsi)
            ->where(OPColumns::kodeDati, $nop->kodeDati)
            ->where(OPColumns::kodeKecamatan, $nop->kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $nop->kodeKelurahan)
            ->where(OPColumns::kodeBlok, $nop->kodeBlok)
            ->where(OPColumns::nomorUrut, $nop->nomorUrut)
            ->where(OPColumns::kodeJenis, $nop->kodeJenis);
        return (int)$data->count();
    }
}