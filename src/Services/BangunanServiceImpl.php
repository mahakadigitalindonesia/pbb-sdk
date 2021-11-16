<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\BangunanService;
use Mdigi\PBB\Domains\DataBangunan;
use Mdigi\PBB\Dtos\Bangunan as BangunanDto;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\PenggunaanBangunan as PenggunaanBangunanDto;
use Mdigi\PBB\Helpers\Fasilitas;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Bangunan;
use Mdigi\PBB\Models\FasilitasBangunan;
use Mdigi\PBB\Models\PenggunaanBangunan;

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

    public function save(DataBangunan $bangunan)
    {
        DB::connection(config('pbb.database.connection'))->transaction(function () use ($bangunan) {
            $keys = [
                OPColumns::kodeProvinsi => $bangunan->getKodeProvinsi(),
                OPColumns::kodeDati => $bangunan->getKodeDati(),
                OPColumns::kodeKecamatan => $bangunan->getKodeKecamatan(),
                OPColumns::kodeKelurahan => $bangunan->getKodeKelurahan(),
                OPColumns::kodeBlok => $bangunan->getKodeBlok(),
                OPColumns::nomorUrut => $bangunan->getNomorUrut(),
                OPColumns::kodeJenis => $bangunan->getKodeJenis(),
                'no_bng' => $bangunan->getNomor(),
            ];

            DB::connection(config('pbb.database.connection'))->table(Bangunan::table)->updateOrInsert($keys, [
                'kd_jpb' => $bangunan->getKodeJPB(),
                'no_formulir_lspop' => $bangunan->getNomorFormulirLSPOP(),
                'thn_dibangun_bng' => $bangunan->getTahunDibangun(),
                'thn_renovasi_bng' => $bangunan->getTahunDirenovasi(),
                'luas_bng' => $bangunan->getLuas(),
                'jml_lantai_bng' => $bangunan->getJumlahLantai(),
                'kondisi_bng' => $bangunan->getKondisi(),
                'jns_konstruksi_bng' => $bangunan->getKonstruksi(),
                'jns_atap_bng' => $bangunan->getAtap(),
                'kd_dinding' => $bangunan->getDinding(),
                'kd_lantai' => $bangunan->getLantai(),
                'kd_langit_langit' => $bangunan->getLangit(),
                'nilai_sistem_bng' => 0,
                'jns_transaksi_bng' => $bangunan->getJenisTransaksi(),
                'tgl_pendataan_bng' => $bangunan->getTanggalPendataan(),
                'nip_pendata_bng' => $bangunan->getNipPendata(),
                'tgl_pemeriksaan_bng' => $bangunan->getTanggalPemeriksaan(),
                'nip_pemeriksa_bng' => $bangunan->getNipPemeriksa(),
                'tgl_perekaman_bng' => Carbon::now(),
                'nip_perekam_bng' => $bangunan->getNipPerekam()
            ]);

            if ($bangunan->getListrik()) {
                $this->saveFasilitas($keys, Fasilitas::LISTRIK, $bangunan->getListrik());
            }
            if ($bangunan->getJumlahAcSplit() > 0) {
                $this->saveFasilitas($keys, Fasilitas::AC_SPLIT, $bangunan->getJumlahAcSplit());
            }
            if ($bangunan->getJumlahAcWindow() > 0) {
                $this->saveFasilitas($keys, Fasilitas::AC_WINDOWS, $bangunan->getJumlahAcWindow());
            }
            if ($bangunan->getLuasKolam() > 0 && $bangunan->getPlesterKolam()) {
                $this->saveFasilitas($keys, Fasilitas::KOLAM_RENANG[$bangunan->getPlesterKolam()], $bangunan->getLuasKolam());
            }
            if ($bangunan->getPanjangPagar() > 0 && $bangunan->getBahanPagar()) {
                $this->saveFasilitas($keys, Fasilitas::PAGAR[$bangunan->getBahanPagar()], $bangunan->getPanjangPagar());
            }
        });
    }

    private function saveFasilitas($keys, $kodeFasilitas, $jumlahSatuan)
    {
        DB::connection(config('pbb.database.connection'))->table(FasilitasBangunan::table)->updateOrInsert(Arr::add($keys, 'kd_fasilitas', $kodeFasilitas), [
            'jml_satuan' => $jumlahSatuan
        ]);
    }
}