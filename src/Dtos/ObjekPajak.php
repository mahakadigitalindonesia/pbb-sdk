<?php


namespace Mdigi\PBB\Dtos;


class ObjekPajak extends ObjekPajakKeys
{
    public $nop;
    public $wajibPajakId;
    public $jalan;
    public $rt;
    public $rw;
    public $nomorSertifikat;
    public $nomorFormulirSPOP;
    public $kodeKepemilikan;
    public $kepemilikan;
    public $kelurahan;
    public $kecamatan;
    public $luasTanah;
    public $luasBangunan;
    public $njopTanah;
    public $njopBangunan;
    public $jenisTransaksi;


    public function __construct($model = null)
    {
        if ($model) {
            $this->setKeys($model);
            $this->nop = (string) new NOP($model->kd_propinsi, $model->kd_dati2, $model->kd_kecamatan, $model->kd_kelurahan, $model->kd_blok, $model->no_urut, $model->kd_jns_op);
            $this->wajibPajakId = trim($model->subjek_pajak_id);
            $this->jalan = $model->jalan_op;
            $this->rt = $model->rt ?? '000';
            $this->rw = $model->rw ?? '00';
            $this->nomorSertifikat = $model->no_persil ?? '-';
            $this->nomorFormulirSPOP = $model->no_formulir_spop;
            $this->kodeKepemilikan = $model->kd_status_wp;
            $this->kepemilikan = $model->kepemilikan;
            $this->luasTanah = $model->total_luas_bumi ?? '0';
            $this->luasBangunan = $model->total_luas_bng ?? '0';
            $this->njopTanah = $model->njop_bumi ?? '0';
            $this->njopBangunan = $model->njop_bangunan ?? '0';
            $this->jenisTransaksi = $model->jns_transaksi_op;
            $this->kecamatan = $model->nm_kecamatan;
            $this->kelurahan = $model->nm_kelurahan;
        }
    }
}