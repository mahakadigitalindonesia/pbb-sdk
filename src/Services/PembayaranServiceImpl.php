<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mdigi\PBB\Contracts\PembayaranService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Helpers\TransaksiColumns;
use Mdigi\PBB\Models\Pembayaran;
use Mdigi\PBB\Dtos\Pembayaran as PembayaranDto;

class PembayaranServiceImpl implements PembayaranService
{

    public function findByNOP(NOP $nop)
    {
        $data = $this->getQuery($nop);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->mapInto(PembayaranDto::class);
    }

    public function findByNOPAndTahun(NOP $nop, $tahun)
    {
        $data = $this->getQuery($nop)->where(TransaksiColumns::tahun, $tahun);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->mapInto(PembayaranDto::class);
    }

    private function getQuery(NOP $nop)
    {
        return Pembayaran::query()->where(OPColumns::kodeProvinsi, $nop->kodeProvinsi)
            ->where(OPColumns::kodeDati, $nop->kodeDati)
            ->where(OPColumns::kodeKecamatan, $nop->kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $nop->kodeKelurahan)
            ->where(OPColumns::kodeBlok, $nop->kodeBlok)
            ->where(OPColumns::nomorUrut, $nop->nomorUrut)
            ->where(OPColumns::kodeJenis, $nop->kodeJenis);
    }
}