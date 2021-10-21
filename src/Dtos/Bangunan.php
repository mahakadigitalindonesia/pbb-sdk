<?php


namespace Mdigi\PBB\Dtos;


class Bangunan extends ObjekPajakKeys
{
    public $nop;
    public $nomor;
    public $kodeJPB;
    public $nomorFormulirSPOP;
    public $tahunDibangun;
    public $tahunRenovasi;
    public $luas;
    public $jumlahLantai;
    public $kodeKondisi;
    public $kodeKonstruksi;
    public $kodeAtap;
    public $kodeDinding;
    public $kodeLantai;
    public $kodeLangit;
    public $jenisTransaksi;

    public function __construct($model = null)
    {
        $this->setKeys($model);
        $this->nop = (string)new NOP($model->kd_propinsi, $model->kd_dati2, $model->kd_kecamatan, $model->kd_kelurahan, $model->kd_blok, $model->no_urut, $model->kd_jns_op);
        $this->nomor = $model->no_bng;
        $this->kodeJPB = $model->kd_jpb;
        $this->nomorFormulirSPOP = $model->no_formulir_lspop;
        $this->tahunDibangun = $model->thn_dibangun_bng;
        $this->tahunRenovasi = $model->thn_renovasi_bng;
        $this->luas = $model->luas_bng;
        $this->jumlahLantai = $model->jml_lantai_bng;
        $this->kodeKondisi = $model->kondisi_bng;
        $this->kodeKonstruksi = $model->jns_konstruksi_bng;
        $this->kodeAtap = $model->jns_atap_bng;
        $this->kodeDinding = $model->kd_dinding;
        $this->kodeLantai = $model->kd_lantai;
        $this->kodeLangit = $model->kd_langit_langit;
        $this->jenisTransaksi = $model->jns_transaksi_bng;
    }
}