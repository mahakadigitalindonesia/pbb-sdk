<?php


namespace Mdigi\PBB\Dtos;


class LookupItem
{
    public $group;
    public $kode;
    public $nama;

    public function __construct($model)
    {
        $this->group = $model->kd_lookup_group;
        $this->kode = $model->kd_lookup_item;
        $this->nama = $model->nm_lookup_item;
    }
}