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
use Mdigi\PBB\Helpers\BahanPagar;
use Mdigi\PBB\Helpers\Fasilitas;
use Mdigi\PBB\Helpers\KolamRenang;
use Mdigi\PBB\Helpers\LookupItemType;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Bangunan;
use Mdigi\PBB\Models\FasilitasBangunan;
use Mdigi\PBB\Models\Kota;
use Mdigi\PBB\Models\LookupItem;
use Mdigi\PBB\Models\PenggunaanBangunan;

class BangunanServiceImpl implements BangunanService
{
    public function findByNOP(NOP $nop)
    {
        $data = $this->getQuery($nop);
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->get()->map(function ($item) use ($nop) {
            return $this->mapBangunan($nop, $item);
        });
    }

    public function findByNOPAndNomor(NOP $nop, int $nomor)
    {
        $data = $this->getQuery($nop)->where('no_bng', $nomor);
        return $this->mapBangunan($nop, $data->firstOrFail());
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

    private function getFasilitas(NOP $nop, int $nomor, $kodeFasilitas = null)
    {
        $data = FasilitasBangunan::query()
            ->where(OPColumns::kodeProvinsi, $nop->kodeProvinsi)
            ->where(OPColumns::kodeDati, $nop->kodeDati)
            ->where(OPColumns::kodeKecamatan, $nop->kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $nop->kodeKelurahan)
            ->where(OPColumns::kodeBlok, $nop->kodeBlok)
            ->where(OPColumns::nomorUrut, $nop->nomorUrut)
            ->where(OPColumns::kodeJenis, $nop->kodeJenis)
            ->where('no_bng', $nomor);
        if (is_array($kodeFasilitas)) {
            $data = $data->whereIn('kd_fasilitas', $kodeFasilitas);
        } else {
            $data = ($kodeFasilitas) ? $data->where('kd_fasilitas', $kodeFasilitas) : $data;
        }
        return $data->get();
    }

    public function save(DataBangunan $bangunan)
    {
        $kota = Kota::query()->first();
        DB::connection(config('pbb.database.connection'))->transaction(function () use ($bangunan, $kota) {
            $keys = [
                OPColumns::kodeProvinsi => $bangunan->getKodeProvinsi() ?? $kota->kd_propinsi,
                OPColumns::kodeDati => $bangunan->getKodeDati() ?? $kota->kd_dati2,
                OPColumns::kodeKecamatan => $bangunan->getKodeKecamatan(),
                OPColumns::kodeKelurahan => $bangunan->getKodeKelurahan(),
                OPColumns::kodeBlok => $bangunan->getKodeBlok(),
                OPColumns::nomorUrut => $bangunan->getNomorUrut(),
                OPColumns::kodeJenis => $bangunan->getKodeJenis() ?? '0',
                'no_bng' => $bangunan->getNomor(),
            ];

            DB::connection(config('pbb.database.connection'))->table(Bangunan::table)
                ->updateOrInsert($keys, [
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
        DB::connection(config('pbb.database.connection'))->table(FasilitasBangunan::table)
            ->updateOrInsert(Arr::add($keys, 'kd_fasilitas', $kodeFasilitas), [
                'jml_satuan' => $jumlahSatuan
            ]);
    }

    /**
     * @param NOP $nop
     * @param $item
     * @return BangunanDto
     */
    private function mapBangunan(NOP $nop, $item): BangunanDto
    {
        // Populate Data Fasilitas
        $listrik = $this->getFasilitas($nop, $item->no_bng, Fasilitas::LISTRIK)->first();
        $item->listrik = ($listrik) ? $listrik->jml_satuan : '-';

        $acSplit = $this->getFasilitas($nop, $item->no_bng, Fasilitas::AC_SPLIT)->first();
        $item->ac_split = $acSplit ? $acSplit->jml_satuan : '-';

        $acWindow = $this->getFasilitas($nop, $item->no_bng, Fasilitas::AC_WINDOWS)->first();
        $item->ac_window = $acWindow ? $acWindow->jml_satuan : '-';

        $luasKolam = $this->getFasilitas($nop, $item->no_bng, [
            Fasilitas::KOLAM_RENANG[KolamRenang::PLESTER],
            Fasilitas::KOLAM_RENANG[KolamRenang::PLESTER],
        ])->first();
        $item->luas_kolam = $luasKolam ? $luasKolam->jml_satuan : '-';

        $panjangPagar = $this->getFasilitas($nop, $item->no_bng, [
            Fasilitas::PAGAR[BahanPagar::BAJA_BESI],
            Fasilitas::PAGAR[BahanPagar::BATA_BATAKO],
        ])->first();

        // Populate Data JPB
        $item->panjang_pagar = $panjangPagar ? $panjangPagar->jml_satuan : '-';
        $jpb = PenggunaanBangunan::query()->where('kd_jpb_jpt', $item->kd_jpb)->first();
        $item->nama_jpb = $jpb ? $jpb->nm_jpb_jpt : '-';

        // Populate Data Lookup Items
        $kondisi = $this->getLookupItem(LookupItemType::KONDISI_UMUM, $item->kondisi_bng);
        $item->kondisi = $kondisi ? $kondisi->nm_lookup_item : '-';

        $konstruksi = $this->getLookupItem(LookupItemType::KONSTRUKSI, $item->jns_konstruksi_bng);
        $item->konstruksi = $konstruksi ? $konstruksi->nm_lookup_item : '-';

        $atap = $this->getLookupItem(LookupItemType::ATAP, $item->jns_atap_bng);
        $item->atap = $atap ? $atap->nm_lookup_item : '-';

        $dinding = $this->getLookupItem(LookupItemType::DINDING, $item->kd_dinding);
        $item->dinding = $dinding ? $dinding->nm_lookup_item : '-';

        $lantai = $this->getLookupItem(LookupItemType::LANTAI, $item->kd_lantai);
        $item->lantai = $lantai ? $lantai->nm_lookup_item : '-';

        $langit = $this->getLookupItem(LookupItemType::LANGIT, $item->kd_langit_langit);
        $item->langit = $langit ? $langit->nm_lookup_item : '-';
        return new BangunanDto($item);
    }

    private function getLookupItem($kodeGroup, $kodeItem)
    {
        return LookupItem::query()->where(LookupItem::kodeGroup, $kodeGroup)
            ->where(LookupItem::kodeItem, $kodeItem)->first();
    }
}