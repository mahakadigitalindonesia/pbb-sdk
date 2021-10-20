<?php


namespace Mdigi\PBB\Dtos;


class Kelurahan
{
    public $kode;
    public $nama;
    public $kodeKecamatan;
    public $namaKecamatan;

    public function __construct($model = null)
    {
        if ($model) {
            $this->kode = $model->kd_kelurahan;
            $this->nama = $model->nm_kelurahan;
            $this->kodeKecamatan = $model->kd_kecamatan;
            $this->namaKecamatan = $model->nm_kecamatan;
        }
    }
}