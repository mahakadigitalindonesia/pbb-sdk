<?php


namespace Mdigi\PBB\Services;


use Mdigi\PBB\Contracts\KelurahanService;
use Mdigi\PBB\Dtos\Kelurahan as KelurahanDto;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;

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
}