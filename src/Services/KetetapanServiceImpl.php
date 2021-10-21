<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\KetetapanService;
use Mdigi\PBB\Dtos\Ketetapan as KetetapanDto;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\TransaksiColumns;
use Mdigi\PBB\Helpers\DatabaseRaw;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Models\Ketetapan;
use Mdigi\PBB\Models\ObjekPajak;

class KetetapanServiceImpl implements KetetapanService
{

    public function findByNOP(NOP $nop)
    {
        $data = $this->getQuery($nop);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->mapInto(KetetapanDto::class);
    }

    public function findByNOPAndTahun(NOP $nop, $tahun)
    {
        $data = $this->getQuery($nop)->where(TransaksiColumns::tahun, $tahun);
        return new KetetapanDto($data->firstOrFail());
    }

    private function getQuery(NOP $nop)
    {
        return Ketetapan::select([
            Ketetapan::allColumns,
            ObjekPajak::jalan,
            ObjekPajak::rt,
            ObjekPajak::rw,
            Kecamatan::namaKecamatan,
            Kelurahan::namaKelurahan,
            DB::raw(DatabaseRaw::hitungDenda() . ' as denda')
        ])->join(ObjekPajak::table, function ($join) {
            $join->on(ObjekPajak::kodeProvinsi, Ketetapan::kodeProvinsi)
                ->on(ObjekPajak::kodeDati, Ketetapan::kodeDati)
                ->on(ObjekPajak::kodeKecamatan, Ketetapan::kodeKecamatan)
                ->on(ObjekPajak::kodeKelurahan, Ketetapan::kodeKelurahan)
                ->on(ObjekPajak::kodeBlok, Ketetapan::kodeBlok)
                ->on(ObjekPajak::nomorUrut, Ketetapan::nomorUrut)
                ->on(ObjekPajak::kodeJenis, Ketetapan::kodeJenis);
        })->join(Kecamatan::table, Kecamatan::kodeKecamatan, '=', Ketetapan::kodeKecamatan)
            ->join(Kelurahan::table, function ($join) {
                $join->on(Kelurahan::kodeKecamatan, '=', Kecamatan::kodeKecamatan)
                    ->on(Kelurahan::kodeKelurahan, '=', Ketetapan::kodeKelurahan);
            })->where(Ketetapan::kodeProvinsi, $nop->kodeProvinsi)
            ->where(Ketetapan::kodeDati, $nop->kodeDati)
            ->where(Ketetapan::kodeKecamatan, $nop->kodeKecamatan)
            ->where(Ketetapan::kodeKelurahan, $nop->kodeKelurahan)
            ->where(Ketetapan::kodeBlok, $nop->kodeBlok)
            ->where(Ketetapan::nomorUrut, $nop->nomorUrut)
            ->where(Ketetapan::kodeJenis, $nop->kodeJenis);
    }
}