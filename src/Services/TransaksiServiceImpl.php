<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\TransaksiService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\Transaksi;
use Mdigi\PBB\Helpers\DatabaseRaw;
use Mdigi\PBB\Helpers\TahunKetetapan;
use Mdigi\PBB\Models\Ketetapan;
use Mdigi\PBB\Models\Pembayaran;

class TransaksiServiceImpl implements TransaksiService
{

    public function findByNOP(NOP $nop)
    {
        $data = $this->getQuery($nop);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->mapInto(Transaksi::class);
    }

    public function findByNOPAndTahun(NOP $nop, $tahun)
    {
        $data = $this->getQuery($nop)->where(Ketetapan::tahun, $tahun);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return new Transaksi($data->firstOrFail());
    }

    public function isNOPHasUnpaid(NOP $nop)
    {
        return $this->getQuery($nop)->whereNull(Pembayaran::tanggalPembayaran)->count() > 0;
    }

    public function getQuery(NOP $nop)
    {
        return Ketetapan::select([
            Ketetapan::allColumns,
            DB::raw(DatabaseRaw::hitungDenda() . ' as denda_ketetapan'),
            Pembayaran::denda . ' as denda_pembayaran',
            Pembayaran::jumlahPembayaran . ' as jumlah_pembayaran',
            Pembayaran::tanggalPembayaran
        ])->leftJoin(Pembayaran::table, function ($join) {
            $join->on(Pembayaran::kodeProvinsi, '=', Ketetapan::kodeProvinsi)
                ->on(Pembayaran::kodeDati, '=', Ketetapan::kodeDati)
                ->on(Pembayaran::kodeKecamatan, '=', Ketetapan::kodeKecamatan)
                ->on(Pembayaran::kodeKelurahan, '=', Ketetapan::kodeKelurahan)
                ->on(Pembayaran::kodeBlok, '=', Ketetapan::kodeBlok)
                ->on(Pembayaran::nomorUrut, '=', Ketetapan::nomorUrut)
                ->on(Pembayaran::kodeJenis, '=', Ketetapan::kodeJenis)
                ->on(Pembayaran::tahun, '=', Ketetapan::tahun);
        })->where(Ketetapan::kodeProvinsi, $nop->kodeProvinsi)
            ->where(Ketetapan::kodeDati, $nop->kodeDati)
            ->where(Ketetapan::kodeKecamatan, $nop->kodeKecamatan)
            ->where(Ketetapan::kodeKelurahan, $nop->kodeKelurahan)
            ->where(Ketetapan::kodeBlok, $nop->kodeBlok)
            ->where(Ketetapan::nomorUrut, $nop->nomorUrut)
            ->where(Ketetapan::kodeJenis, $nop->kodeJenis)
            ->where(Ketetapan::tahun, '>', TahunKetetapan::maxYear())->orderByDesc(Ketetapan::tahun);
    }
}