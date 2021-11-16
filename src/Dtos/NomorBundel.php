<?php


namespace Mdigi\PBB\Dtos;


class NomorBundel
{
    public $formatted;
    public $year;
    public $bundel;
    public $nomor;

    public function __construct($model)
    {
        $this->formatted = $model->temp_thn_bundel . '' . $model->temp_no_bundel . '' . $model->temp_urut_bundel;
        $this->year = $model->temp_thn_bundel;
        $this->bundel = $model->temp_no_bundel;
        $this->nomor = $model->temp_urut_bundel;
    }
}