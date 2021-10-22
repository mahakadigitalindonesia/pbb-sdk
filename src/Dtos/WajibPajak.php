<?php


namespace Mdigi\PBB\Dtos;


class WajibPajak
{
    public $id;
    public $nama;
    public $jalan;
    public $rt;
    public $rw;
    public $blokKavlingNomor;
    public $kelurahan;
    public $kecamatan;
    public $kota;
    public $kodePos;
    public $telepon;
    public $npwp;
    public $statusPekerjaan;
    public $pekerjaan;

    public function __construct($model = null)
    {
        if ($model) {
            $this->id = trim($model->subjek_pajak_id);
            $this->nama = $model->nm_wp;
            $this->jalan = $model->jalan_wp;
            $this->rt = $model->rt_wp ?? '000';
            $this->rw = $model->rw_wp ?? '00';
            $this->blokKavlingNomor = $model->blok_kav_no_wp ?? '-';
            $this->kelurahan = $model->kelurahan_wp;
            $this->kecamatan = $model->nm_kecamatan ?? '-';
            $this->kota = $model->kota_wp;
            $this->telepon = $model->telp_wp ?? '-';
            $this->npwp = $model->npwp ?? '-';
            $this->statusPekerjaan = $model->status_pekerjaan_wp;
            $this->kodePos = $model->kd_pos_wp ?? '0';
            $this->pekerjaan = $model->pekerjaan ?? '-';
        }
    }
}