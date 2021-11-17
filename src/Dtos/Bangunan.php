<?php


namespace Mdigi\PBB\Dtos;


class Bangunan extends ObjekPajakKeys
{
    public $nop;
    public $nomor;
    public $kodeJPB;
    public $jenisPenggunaan;
    public $nomorFormulirLPOP;
    public $tahunDibangun;
    public $tahunRenovasi;
    public $luas;
    public $jumlahLantai;
    public $kodeKondisi;
    public $kondisi;
    public $kodeKonstruksi;
    public $konstruksi;
    public $kodeAtap;
    public $atap;
    public $kodeDinding;
    public $dinding;
    public $kodeLantai;
    public $lantai;
    public $kodeLangit;
    public $langit;
    public $listrik;
    public $acSplit;
    public $acWindow;
    public $luasKolam;
    public $panjangPagar;
    public $jenisTransaksi;

    public function __construct($model = null)
    {
        $this->setKeys($model);
        $this->nop = (string)new NOP($model->kd_propinsi, $model->kd_dati2, $model->kd_kecamatan, $model->kd_kelurahan, $model->kd_blok, $model->no_urut, $model->kd_jns_op);
        $this->nomor = $model->no_bng;
        $this->kodeJPB = $model->kd_jpb;
        $this->jenisPenggunaan = $model->nama_jpb;
        $this->nomorFormulirLPOP = $model->no_formulir_lspop;
        $this->tahunDibangun = $model->thn_dibangun_bng;
        $this->tahunRenovasi = $model->thn_renovasi_bng;
        $this->luas = $model->luas_bng;
        $this->jumlahLantai = $model->jml_lantai_bng;
        $this->kodeKondisi = $model->kondisi_bng;
        $this->kondisi = $model->kondisi;
        $this->kodeKonstruksi = $model->jns_konstruksi_bng;
        $this->konstruksi = $model->konstruksi;
        $this->kodeAtap = $model->jns_atap_bng;
        $this->atap = $model->atap;
        $this->kodeDinding = $model->kd_dinding;
        $this->dinding = $model->dinding;
        $this->kodeLantai = $model->kd_lantai;
        $this->lantai = $model->lantai;
        $this->kodeLangit = $model->kd_langit_langit;
        $this->langit = $model->langit;
        $this->listrik = $model->listrik;
        $this->acSplit = $model->ac_split;
        $this->acWindow = $model->ac_window;
        $this->luasKolam = $model->luas_kolam;
        $this->panjangPagar = $model->panjang_pagar;
        $this->jenisTransaksi = $model->jns_transaksi_bng;
    }
}