<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\TransaksiService;
use Mdigi\PBB\Dtos\NOP;
use Mdigi\PBB\Dtos\PaginatedCollection;
use Mdigi\PBB\Dtos\Transaksi;
use Mdigi\PBB\Dtos\TransaksiOP;
use Mdigi\PBB\Helpers\DatabaseRaw;
use Mdigi\PBB\Helpers\TahunKetetapan;
use Mdigi\PBB\Models\Ketetapan;
use Mdigi\PBB\Models\ObjekPajak;
use Mdigi\PBB\Models\Pembayaran;

class TransaksiServiceImpl implements TransaksiService
{
    private const NOP_SEPARATOR = '||.||';

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

    public function findAll($search)
    {
        $transaksi = Ketetapan::query()->select([
            Ketetapan::allColumns,
            DB::raw(DatabaseRaw::hitungDenda() . ' as denda_ketetapan'),
            DB::raw(ObjekPajak::jalan . "|| ' RT.'||" . ObjekPajak::rt . "|| ' RW.'||" . ObjekPajak::rw . ' as alamat_op'),
        ])->join(ObjekPajak::table, function ($join) {
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
            ->where(Ketetapan::tahun, '>', TahunKetetapan::maxYear())
            ->when(isset($search['kodeKecamatan']), function ($q) use ($search) {
                $q->where(Ketetapan::kodeKecamatan, $search['kodeKecamatan']);
            })->when(isset($search['kodeKelurahan']), function ($q) use ($search) {
                $q->where(Ketetapan::kodeKelurahan, $search['kodeKelurahan']);
            })->when(isset($search['alamatOP']), function ($q) use ($search) {
                $q->whereRaw('lower(' . ObjekPajak::jalan . "|| ' RT.'||" . ObjekPajak::rt . "|| ' RW.'||" . ObjekPajak::rw . ") LIKE '%" . strtolower($search['alamatOP']) . "%'");
            })->when(isset($search['NOP']), function ($q) use ($search) {
                $q->whereRaw(Ketetapan::kodeProvinsi . self::NOP_SEPARATOR . Ketetapan::kodeDati . self::NOP_SEPARATOR . Ketetapan::kodeKecamatan . self::NOP_SEPARATOR . Ketetapan::kodeKelurahan . self::NOP_SEPARATOR . Ketetapan::kodeBlok . self::NOP_SEPARATOR . Ketetapan::nomorUrut . self::NOP_SEPARATOR . Ketetapan::kodeJenis . " LIKE '%" . $search['NOP'] . "%'");
            })->orderByDesc(Ketetapan::tahun);
        if (isset($search['pageSize']) && isset($search['pageNumber'])) {
            $transaksi = $transaksi->paginate($search['pageSize'], ['*'], 'page', $search['pageNumber']);
            $data = $transaksi->getCollection()->mapInto(TransaksiOP::class);
            return PaginatedCollection::map($data, $transaksi);
        }
        return $transaksi->get()->mapInto(TransaksiOP::class);
    }

    public function findTagihanByNop(NOP $nop)
    {
        return Ketetapan::query()->select([
            Ketetapan::allColumns,
            DB::raw(DatabaseRaw::hitungDenda() . ' as denda_ketetapan'),
            DB::raw(ObjekPajak::jalan . "|| ' RT.'||" . ObjekPajak::rt . "|| ' RW.'||" . ObjekPajak::rw . ' as alamat_op'),
        ])->join(ObjekPajak::table, function ($join) {
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
            ->orderByDesc(Ketetapan::tahun)->get()->mapInto(TransaksiOP::class);
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