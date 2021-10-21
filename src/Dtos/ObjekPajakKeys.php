<?php


namespace Mdigi\PBB\Dtos;


abstract class ObjekPajakKeys
{
    public $kodeProvinsi;
    public $kodeDati;
    public $kodeKecamatan;
    public $kodeKelurahan;
    public $kodeBlok;
    public $nomorUrut;
    public $kodeJenis;

    protected function setKeys($model)
    {
        $this->kodeProvinsi = $model->kd_propinsi;
        $this->kodeDati = $model->kd_dati2;
        $this->kodeKecamatan = $model->kd_kecamatan;
        $this->kodeKelurahan = $model->kd_kelurahan;
        $this->kodeBlok = $model->kd_blok;
        $this->nomorUrut = $model->no_urut;
        $this->kodeJenis = $model->kd_jns_op;
    }
}