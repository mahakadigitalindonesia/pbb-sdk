<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mdigi\PBB\Contracts\BangunanService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\OPColumns;
use Mdigi\PBB\Models\Bangunan;
use Mdigi\PBB\Dtos\Bangunan as BangunanDto;
use Mdigi\PBB\Models\PenggunaanBangunan;
use Mdigi\PBB\Dtos\PenggunaanBangunan as PenggunaanBangunanDto;

class BangunanServiceImpl implements BangunanService
{
    public function findByNOP(NOP $nop)
    {
        $data = $this->getQuery($nop);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->mapInto(BangunanDto::class);
    }

    public function findByNOPAndNomor(NOP $nop, int $nomor)
    {
        $data = $this->getQuery($nop)->where('no_bng', $nomor);
        return new BangunanDto($data->firstOrFail());
    }

    public function penggunaanBangunan($kodeJPB = null)
    {
        $data = PenggunaanBangunan::query();
        $data = $kodeJPB ? $data->where('kd_jpb_jpt', $kodeJPB) : $data;
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->count() > 1 ? $data->get()->mapInto(PenggunaanBangunanDto::class) : new PenggunaanBangunanDto($data->firstOrFail());
    }

    private function getQuery(NOP $nop)
    {
        return Bangunan::query()->where(OPColumns::kodeProvinsi, $nop->kodeProvinsi)
            ->where(OPColumns::kodeDati, $nop->kodeDati)
            ->where(OPColumns::kodeKecamatan, $nop->kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $nop->kodeKelurahan)
            ->where(OPColumns::kodeBlok, $nop->kodeBlok)
            ->where(OPColumns::nomorUrut, $nop->nomorUrut)
            ->where(OPColumns::kodeJenis, $nop->kodeJenis);
    }
}