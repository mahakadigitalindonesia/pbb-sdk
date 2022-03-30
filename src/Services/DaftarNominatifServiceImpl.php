<?php

namespace Mdigi\PBB\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\DaftarNominatifService;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Helpers\TahunKetetapan;
use Mdigi\PBB\Helpers\TransaksiColumns;
use Mdigi\PBB\Models\DaftarNominatifOP;
use Mdigi\PBB\Models\DaftarNominatifPiutang;
use Mdigi\PBB\Models\Ketetapan;
use Mdigi\PBB\Models\ObjekPajak;
use Mdigi\PBB\Models\Pembayaran;

class DaftarNominatifServiceImpl implements DaftarNominatifService
{
    private ObjekPajakService $objekPajakService;

    public function __construct(ObjekPajakService $objekPajakService)
    {
        $this->objekPajakService = $objekPajakService;
    }

    public function save(NOP $nop, string $nip)
    {
        DB::connection(config('config.database.connection'))->transaction(function () use ($nop, $nip) {
            try {
                $objekPajak = $this->objekPajakService->findByNOP($nop);
                $listKetetapan = Ketetapan::query()->select(['*'])->join(ObjekPajak::table, function ($join) {
                    $join->on(ObjekPajak::kodeProvinsi, '=', Ketetapan::kodeProvinsi)
                        ->on(ObjekPajak::kodeDati, '=', Ketetapan::kodeDati)
                        ->on(ObjekPajak::kodeKecamatan, '=', Ketetapan::kodeKecamatan)
                        ->on(ObjekPajak::kodeKelurahan, '=', Ketetapan::kodeKelurahan)
                        ->on(ObjekPajak::kodeBlok, '=', Ketetapan::kodeBlok)
                        ->on(ObjekPajak::nomorUrut, '=', Ketetapan::nomorUrut)
                        ->on(ObjekPajak::kodeJenis, '=', Ketetapan::kodeJenis);
                })->leftJoin(Pembayaran::table, function ($join) {
                    $join->on(Pembayaran::kodeProvinsi, '=', Ketetapan::kodeProvinsi)
                        ->on(Pembayaran::kodeDati, '=', Ketetapan::kodeDati)
                        ->on(Pembayaran::kodeKecamatan, '=', Ketetapan::kodeKecamatan)
                        ->on(Pembayaran::kodeKelurahan, '=', Ketetapan::kodeKelurahan)
                        ->on(Pembayaran::kodeBlok, '=', Ketetapan::kodeBlok)
                        ->on(Pembayaran::nomorUrut, '=', Ketetapan::nomorUrut)
                        ->on(Pembayaran::kodeJenis, '=', Ketetapan::kodeJenis)
                        ->on(Pembayaran::tahun, '=', Ketetapan::tahun);
                })->whereNull(Pembayaran::kodeProvinsi)
                    ->where(Ketetapan::kodeProvinsi, $nop->kodeProvinsi)
                    ->where(Ketetapan::kodeDati, $nop->kodeDati)
                    ->where(Ketetapan::kodeKecamatan, $nop->kodeKecamatan)
                    ->where(Ketetapan::kodeKelurahan, $nop->kodeKelurahan)
                    ->where(Ketetapan::kodeBlok, $nop->kodeBlok)
                    ->where(Ketetapan::nomorUrut, $nop->nomorUrut)
                    ->where(Ketetapan::kodeJenis, $nop->kodeJenis)
                    ->where(Ketetapan::tahun, '>', TahunKetetapan::maxYear())
                    ->orderByDesc(Ketetapan::tahun)->get();

                DaftarNominatifOP::query()->updateOrCreate([
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
                    'rw_op' => $objekPajak->rw,
                    'rt_op' => $objekPajak->rt,
                    'jns_bumi' => $objekPajak->kodeTanah,
                    'kd_status_wp' => 1,
                    'kategori_op' => 4,
                    'tgl_pembentukan' => Carbon::now(),
                    'nip_pembentuk' => $nip,
                    'tgl_pemutakhiran' => Carbon::now(),
                    'nip_pemutakhir' => $nip,
                ]);

                foreach ($listKetetapan as $ketetapan) {
                    DaftarNominatifPiutang::query()->updateOrCreate([
                        OPColumns::kodeProvinsi => $nop->kodeProvinsi,
                        OPColumns::kodeDati => $nop->kodeDati,
                        OPColumns::kodeKecamatan => $nop->kodeKecamatan,
                        OPColumns::kodeKelurahan => $nop->kodeKelurahan,
                        OPColumns::kodeBlok => $nop->kodeBlok,
                        OPColumns::nomorUrut => $nop->nomorUrut,
                        OPColumns::kodeJenis => $nop->kodeJenis,
                        TransaksiColumns::tahun => $ketetapan->thn_pajak_sppt,
                        'thn_pembentukan' => date('Y')
                    ], [
                        'nm_wp_sppt' => $ketetapan->nm_wp_sppt,
                        'jln_wp_sppt' => $ketetapan->jln_wp_sppt,
                        'blok_kav_no_wp_sppt' => $ketetapan->blok_kav_no_wp_sppt,
                        'rw_wp_sppt' => $ketetapan->rw_wp_sppt,
                        'rt_wp_sppt' => $ketetapan->rt_wp_sppt,
                        'kelurahan_wp_sppt' => $ketetapan->kelurahan_wp_sppt,
                        'kota_wp_sppt' => $ketetapan->kota_wp_sppt,
                        'luas_bumi_sppt' => $ketetapan->luas_bumi_sppt,
                        'luas_bng_sppt' => $ketetapan->luas_bng_sppt,
                        'njop_bumi_sppt' => $ketetapan->njop_bumi_sppt,
                        'njop_bng_sppt' => $ketetapan->njop_bng_sppt,
                        'pbb_yg_harus_dibayar_sppt' => $ketetapan->pbb_yg_harus_dibayar_sppt,
                        'tgl_jatuh_tempo_sppt' => $ketetapan->tgl_jatuh_tempo_sppt,
                        'status_bayar' => $ketetapan->status_bayar,
                        'tgl_pembentukan' => Carbon::now(),
                        'nip_pembentuk' => $nip,
                        'tgl_pemutakhiran' => Carbon::now(),
                        'nip_pemutakhir' => $nip
                    ]);
                }
            } catch (\Exception $e) {
                report($e);
                throw new \Exception('Tidak dapat menyimpan daftar nominatif');
            }
        });


    }
}