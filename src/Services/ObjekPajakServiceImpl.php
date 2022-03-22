<?php


namespace Mdigi\PBB\Services;


use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Domains\DataObjekPajak;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\ObjekPajak as ObjekPajakDto;
use Mdigi\PBB\Dtos\ObjekPajakSubjek;
use Mdigi\PBB\Dtos\PaginatedCollection;
use Mdigi\PBB\Helpers\LookupItemType;
use Mdigi\PBB\Helpers\NopHelper;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Bangunan;
use Mdigi\PBB\Models\BukuKetetapan;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Models\Kota;
use Mdigi\PBB\Models\LookupItem;
use Mdigi\PBB\Models\ObjekBumi;
use Mdigi\PBB\Models\ObjekPajak;
use Mdigi\PBB\Models\Tanah;
use Mdigi\PBB\Models\WajibPajak;

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
                    ->where('t_kepemilikan.kd_lookup_group', '=', LookupItemType::KEPEMILIKAN);
            })->join(LookupItem::table . ' as t_jenis_tanah', function ($join) {
                $join->on('t_jenis_tanah.kd_lookup_item', '=', Tanah::kodeTanah)
                    ->where('t_jenis_tanah.kd_lookup_group', '=', LookupItemType::TANAH);
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

    public function save(DataObjekPajak $objekPajak)
    {
        $kota = Kota::query()->first();
        DB::connection(config('pbb.database.connection'))->transaction(function () use ($objekPajak, $kota) {
            $keys = [
                OPColumns::kodeProvinsi => $objekPajak->getKodeProvinsi() ?? $kota->kd_propinsi,
                OPColumns::kodeDati => $objekPajak->getKodeDati() ?? $kota->kd_dati2,
                OPColumns::kodeKecamatan => $objekPajak->getKodeKecamatan(),
                OPColumns::kodeKelurahan => $objekPajak->getKodeKelurahan(),
                OPColumns::kodeBlok => $objekPajak->getKodeBlok(),
                OPColumns::nomorUrut => $objekPajak->getNomorUrut(),
                OPColumns::kodeJenis => $objekPajak->getKodeJenis() ?? '0',
            ];
            DB::connection(config('pbb.database.connection'))->table(ObjekPajak::table)->updateOrInsert($keys, [
                'subjek_pajak_id' => Str::padRight($objekPajak->getWajibPajakId(), 30),
                'no_formulir_spop' => $objekPajak->getNomorFormulirSPOP(),
                'no_persil' => Str::limit($objekPajak->getNomorSertifikat(), 5, ''),
                'jalan_op' => Str::limit($objekPajak->getJalan(), 30, ''),
                'blok_kav_no_op' => Str::limit($objekPajak->getBlokKavlingNomor(), 15, ''),
                'rw_op' => Str::limit($objekPajak->getRw(), 2, ''),
                'rt_op' => Str::limit($objekPajak->getRt(), 3, ''),
                'kd_status_cabang' => 0,
                'kd_status_wp' => $objekPajak->getKodeKepemilikan(),
                'total_luas_bumi' => $objekPajak->getLuasTanah(),
                'total_luas_bng' => 0,
                'njop_bumi' => 0,
                'njop_bng' => 0,
                'status_peta_op' => 0,
                'jns_transaksi_op' => $objekPajak->getJenisTransaksi(),
                'tgl_pendataan_op' => $objekPajak->getTanggalPendataan(),
                'nip_pendata' => $objekPajak->getNipPendata(),
                'tgl_pemeriksaan_op' => $objekPajak->getTanggalPemeriksaan(),
                'nip_pemeriksa_op' => $objekPajak->getNipPemeriksa(),
                'tgl_perekaman_op' => Carbon::now(),
                'nip_perekam_op' => $objekPajak->getNipPerekam(),
            ]);

            DB::connection(config('pbb.database.connection'))->table(ObjekBumi::table)
                ->updateOrInsert(Arr::add($keys, 'no_bumi', 1), [
                    'kd_znt' => Str::limit($objekPajak->getKodeZonaNilaiTanah(), 2, ''),
                    'luas_bumi' => $objekPajak->getLuasTanah(),
                    'jns_bumi' => $objekPajak->getJenisTanah(),
                ]);
        });

        return $this->findByNOP(new NOP($objekPajak->getKodeProvinsi() ?? $kota->kd_propinsi, $objekPajak->getKodeDati() ?? $kota->kd_dati2, $objekPajak->getKodeKecamatan(), $objekPajak->getKodeKelurahan(), $objekPajak->getKodeBlok(), $objekPajak->getNomorUrut(), $objekPajak->getKodeJenis()));
    }

    public function delete(NOP $nop)
    {
        DB::connection(config('pbb.database.connection'))->table(ObjekPajak::table)
            ->where(OPColumns::kodeProvinsi, $nop->kodeProvinsi)
            ->where(OPColumns::kodeDati, $nop->kodeDati)
            ->where(OPColumns::kodeKecamatan, $nop->kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $nop->kodeKelurahan)
            ->where(OPColumns::kodeBlok, $nop->kodeBlok)
            ->where(OPColumns::nomorUrut, $nop->nomorUrut)
            ->where(OPColumns::kodeJenis, $nop->kodeJenis)
            ->delete();
    }

    public function findLastNOPinBlok($kodeKecamatan, $kodeKelurahan, $kodeBlok)
    {
        $lastNOP = (int)ObjekPajak::query()
            ->where(OPColumns::kodeKecamatan, $kodeKecamatan)
            ->where(OPColumns::kodeKelurahan, $kodeKelurahan)
            ->where(OPColumns::kodeBlok, $kodeBlok)
            ->lockForUpdate()
            ->get()
            ->max(OPColumns::nomorUrut);
        return Str::padLeft((string)($lastNOP + 1), 4, '0');
    }

    public function findAll($search)
    {
        $data = ObjekPajak::query()->select([
            ObjekPajak::allColumns,
            Kecamatan::namaKecamatan,
            Kelurahan::namaKelurahan,
            't_kepemilikan.nm_lookup_item as kepemilikan',
            't_jenis_tanah.nm_lookup_item as jenis_tanah',
            Tanah::kodeZonaNilaiTanah,
            Tanah::kodeTanah,
            DB::raw('0' . ' as jumlah_bangunan'),
            DB::raw(ObjekPajak::jalan . "|| ' RT.'||" . ObjekPajak::rt . "|| ' RW.'||" . ObjekPajak::rw . ' as alamat_op'),
            WajibPajak::nama,
            DB::raw(WajibPajak::jalan . "|| ' RT.'||" . WajibPajak::rt . "|| ' RW.'||" . WajibPajak::rw . ' as alamat_wp'),
            WajibPajak::kota,
        ])->join(WajibPajak::table, WajibPajak::nik, '=', ObjekPajak::idWP)
            ->join(Tanah::table, function ($join) {
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
                    ->where('t_kepemilikan.kd_lookup_group', '=', LookupItemType::KEPEMILIKAN);
            })->join(LookupItem::table . ' as t_jenis_tanah', function ($join) {
                $join->on('t_jenis_tanah.kd_lookup_item', '=', Tanah::kodeTanah)
                    ->where('t_jenis_tanah.kd_lookup_group', '=', LookupItemType::TANAH);
            })->when(isset($search['kodeKecamatan']), function ($q) use ($search) {
                $q->where(ObjekPajak::kodeKecamatan, $search['kodeKecamatan']);
            })->when(isset($search['kodeKelurahan']), function ($q) use ($search) {
                $q->where(ObjekPajak::kodeKelurahan, $search['kodeKelurahan']);
            })->when(isset($search['alamatOP']), function ($q) use ($search) {
                $q->whereRaw('lower(' . ObjekPajak::jalan . "|| ' RT.'||" . ObjekPajak::rt . "|| ' RW.'||" . ObjekPajak::rw . ") LIKE '%" . strtolower($search['alamatOP']) . "%'");
            })->when(isset($search['NOP']), function ($q) use ($search) {
                $q->whereRaw(ObjekPajak::kodeProvinsi . NopHelper::SEPARATOR . ObjekPajak::kodeDati . NopHelper::SEPARATOR . ObjekPajak::kodeKecamatan . NopHelper::SEPARATOR . ObjekPajak::kodeKelurahan . NopHelper::SEPARATOR . ObjekPajak::kodeBlok . NopHelper::SEPARATOR . ObjekPajak::nomorUrut . NopHelper::SEPARATOR . ObjekPajak::kodeJenis . " LIKE '%" . $search['NOP'] . "%'");
            })->when(isset($search['bukuKetetapan']), function ($q) use ($search) {
                $bukuKetetapan = BukuKetetapan::query()->whereIn('kd_buku', $search['bukuKetetapan'])
                    ->where('thn_awal', '<=', date('Y'))
                    ->where('thn_akhir', '>=', date('Y'))->get();
                foreach ($bukuKetetapan as $buku) {
                    $q->whereRaw(ObjekPajak::kodeProvinsi . '||' . ObjekPajak::kodeDati . '||' . ObjekPajak::kodeKecamatan . '||' . ObjekPajak::kodeKelurahan . '||' . ObjekPajak::kodeBlok . '||' . ObjekPajak::nomorUrut . '||' . ObjekPajak::kodeJenis . ' EXISTS (SELECT KD_PROPINSI||KD_DATI2||KD_KECAMATAN||KD_KELURAHAN||KD_BLOK||NO_URUT||KD_JNS_OP) 
                    FROM SPPT WHERE SPPT.KD_PROPINSI=DAT_OBJEK_PAJAK.KD_PROPINSI 
                    AND SPPT.KD_DATI2=DAT_OBJEK_PAJAK.KD_DATI2 
                    AND SPPT.KD_KECAMATAN=DAT_OBJEK_PAJAK.KD_KECAMATAN
                    AND SPPT.KD_KELURAHAN=DAT_OBJEK_PAJAK.KD_KELURAHAN
                    AND SPPT.KD_BLOK=DAT_OBJEK_PAJAK.KD_BLOK
                    AND SPPT.NO_URUT=DAT_OBJEK_PAJAK.NO_URUT
                    AND SPPT.KD_JNS_OP=DAT_OBJEK_PAJAK.KD_JNS_OP
                    AND SPPT.PBB_YG_HARUS_DIBAYAR_SPPT BETWEEN ' . $buku->nilai_min_buku . ' AND ' . $buku->nilai_max_buku);
                }
            });
        if (isset($search['pageSize']) && isset($search['pageNumber'])) {
            $data = $data->paginate($search['pageSize'], ['*'], 'page', $search['pageNumber']);
            return PaginatedCollection::map($data->getCollection()->mapInto(ObjekPajakSubjek::class), $data);
        }
        return $data->get()->mapInto(ObjekPajakSubjek::class);
    }
}