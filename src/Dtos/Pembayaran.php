<?php


namespace Mdigi\PBB\Dtos;


class Pembayaran extends TransaksiKeys
{
    public $nop;
    public $denda;
    public $jumlahDibayar;
    public $pembayaranKe;
    public $tanggalPembayaran;

    public function __construct($model = null)
    {
        if ($model) {
            $this->setKeys($model);
            $this->nop = (string)new NOP($this->kodeProvinsi, $this->kodeDati, $this->kodeKecamatan, $this->kodeKelurahan, $this->kodeBlok, $this->nomorUrut, $this->kodeJenis);
            $this->denda = $model->denda_sppt ?? '0';
            $this->jumlahDibayar = $model->jml_sppt_yg_dibayar ?? '0';
            $this->pembayaranKe = $model->pembayaran_sppt_ke;
            $this->tanggalPembayaran = $model->tgl_pembayaran_sppt;
        }
    }
}