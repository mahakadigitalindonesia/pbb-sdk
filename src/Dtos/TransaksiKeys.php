<?php


namespace Mdigi\PBB\Dtos;


abstract class TransaksiKeys extends ObjekPajakKeys
{
    public $tahun;

    public function setKeys($model)
    {
        $this->tahun = $model->thn_pajak_sppt;
        parent::setKeys($model);
    }
}