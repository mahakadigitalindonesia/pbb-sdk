<?php


namespace Mdigi\PBB\Dtos;


class Blok
{
    public $kodeKecamatan;
    public $kodeKelurahan;
    public $kode;

    public function __construct($model = null)
    {
        if ($model) {
            $this->kodeKecamatan = $model->kd_kecamatan;
            $this->kodeKelurahan = $model->kd_kelurahan;
            $this->kode = $model->kd_blok;
        }
    }
}