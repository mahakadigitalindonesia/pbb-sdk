<?php


namespace Mdigi\PBB\Services;


use Mdigi\PBB\Contracts\KecamatanService as KecamatanContract;
use Mdigi\PBB\Dtos\Kecamatan as KecamatanDto;
use Mdigi\PBB\Models\Kecamatan;

class KecamatanServiceImpl implements KecamatanContract
{

    public function findAll()
    {
        return Kecamatan::all()->mapInto(KecamatanDto::class);
    }

    public function findByKecamatan(KecamatanDto $kecamatan)
    {
        $data = Kecamatan::query();
        $data = $kecamatan->kode ? $data->where('kd_kecamatan', $kecamatan->kode) : $data;
        $data = $kecamatan->nama ? $data->where('nm_kecamatan', $kecamatan->nama) : $data;
        return $kecamatan->kode ? new KecamatanDto($data->firstOrFail()) : $data->get()->mapInto(KecamatanDto::class);
    }
}