<?php


namespace Mdigi\PBB\Dtos;

class Kecamatan
{
    public $kode;
    public $nama;

    public function __construct($model = null)
    {
        if($model)
        {
            $this->kode = $model->kd_kecamatan;
            $this->nama = $model->nm_kecamatan;
        }
    }
}