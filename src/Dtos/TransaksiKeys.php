<?php


namespace Mdigi\PBB\Dtos;


class TransaksiKeys extends ObjekPajakKeys
{
    public $tahun;

    public function setKeys($model)
    {
        $this->tahun = $model->thn_pajak_sppt;
        parent::setKeys($model);
    }
}