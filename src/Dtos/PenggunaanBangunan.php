<?php


namespace Mdigi\PBB\Dtos;


class PenggunaanBangunan
{
    public $kode;
    public $nama;

    public function __construct($model = null)
    {
        if ($model) {
            $this->kode = $model->kd_jpb_jpt;
            $this->nama = $model->nm_jpb_jpt;
        }
    }
}