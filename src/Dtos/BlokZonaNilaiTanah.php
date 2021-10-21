<?php


namespace Mdigi\PBB\Dtos;


class BlokZonaNilaiTanah
{
    public $kodeKecamatan;
    public $kodeKelurahan;
    public $kodeBlok;
    public $kode;

    public function __construct($model=null)
    {
        if($model)
        {
            $this->kodeKecamatan = $model->kd_kecamatan;
            $this->kodeKelurahan = $model->kd_kelurahan;
            $this->kodeBlok = $model->kd_blok;
            $this->kode = $model->kd_znt;
        }
    }
}