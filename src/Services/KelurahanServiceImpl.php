<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mdigi\PBB\Contracts\KelurahanService;
use Mdigi\PBB\Dtos\Blok as BlokDto;
use Mdigi\PBB\Dtos\Kelurahan as KelurahanDto;
use Mdigi\PBB\Dtos\OPKeys;
use Mdigi\PBB\Models\Blok;
use Mdigi\PBB\Models\BlokZonaNilaiTanah;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Dtos\BlokZonaNilaiTanah as BlokZonaNilaiTanahDto;

class KelurahanServiceImpl implements KelurahanService
{

    public function findByKelurahan(KelurahanDto $kelurahan)
    {
        $data = $this->getQuery();
        $data = $kelurahan->kode ? $data->where(Kelurahan::kodeKelurahan, $kelurahan->kode) : $data;
        $data = $kelurahan->kodeKecamatan ? $data->where(Kelurahan::kodeKecamatan, $kelurahan->kodeKecamatan) : $data;
        $data = $kelurahan->nama ? $data->where(Kelurahan::namaKelurahan, $kelurahan->nama) : $data;
        $data = $kelurahan->namaKecamatan ? $data->where(Kecamatan::namaKecamatan, $kelurahan->namaKecamatan) : $data;
        return $data->count() > 1 ? $data->get()->mapInto(KelurahanDto::class) : new KelurahanDto($data->firstOrFail());
    }

    public function findAll()
    {
        return $this->getQuery()->get()->mapInto(KelurahanDto::class);
    }

    public function blok($kodeKecamatan, $kodeKelurahan, $kodeBlok = null)
    {
        $data = Blok::query()->where(OPKeys::kodeKecamatan, $kodeKecamatan)
            ->where(OPKeys::kodeKelurahan, $kodeKelurahan);
        $data = $kodeBlok ? $data->where(OPKeys::kodeBlok, $kodeBlok) : $data;
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->count() > 1 ? $data->get()->mapInto(BlokDto::class) : new BlokDto($data->firstOrFail());
    }

    private function getQuery()
    {
        return Kelurahan::select([
            Kelurahan::kodeKelurahan,
            Kelurahan::kodeKecamatan,
            Kelurahan::namaKelurahan,
            Kecamatan::namaKecamatan,
        ])->join(Kecamatan::table,
            Kecamatan::kodeKecamatan,
            '=',
            Kelurahan::kodeKecamatan)->orderByRaw(Kelurahan::kodeKecamatan)->orderBy(Kelurahan::kodeKelurahan);
    }

    public function blokZonaNilaiTanah($kodeKecamatan, $kodeKelurahan, $kodeBlok, $kode = null)
    {
        $data = BlokZonaNilaiTanah::query()->where(OPKeys::kodeKecamatan, $kodeKecamatan)
            ->where(OPKeys::kodeKelurahan, $kodeKelurahan)
            ->where(OPKeys::kodeBlok, $kodeBlok);
        $data = $kode ? $data->where('kd_znt', $kode) : $data;
        throw_if($data->get()->isEmpty(), new ModelNotFoundException());
        return $data->count() > 1 ? $data->get()->mapInto(BlokZonaNilaiTanahDto::class) : new BlokZonaNilaiTanahDto($data->firstOrFail());
    }
}