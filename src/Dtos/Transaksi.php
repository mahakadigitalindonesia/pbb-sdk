<?php


namespace Mdigi\PBB\Dtos;


use Mdigi\PBB\Helpers\DateFormat;
use Mdigi\PBB\Helpers\DateFormatter;

class Transaksi extends TransaksiKeys
{
    public $nop;
    public $jumlahKetetapan;
    public $dendaKetetapan;
    public $tanggalJatuhTempo;
    public $jumlahPembayaran;
    public $dendaPembayaran;
    public $tanggalPembayaran;
    public $totalPembayaran;
    public $totalTunggakan;
    public $isPaid;

    public function __construct($model = null)
    {
        if ($model) {
            $this->setKeys($model);
            $this->nop = (string)new NOP(
                $this->kodeProvinsi,
                $this->kodeDati,
                $this->kodeKecamatan,
                $this->kodeKelurahan,
                $this->kodeBlok,
                $this->nomorUrut,
                $this->kodeJenis
            );
            $this->tanggalJatuhTempo = $model->tgl_jatuh_tempo_sppt ? $model->tgl_jatuh_tempo_sppt->format(DateFormat::dFY) : '-';
            $this->jumlahKetetapan = $model->pbb_yg_harus_dibayar_sppt;
            $dendaKetetapan = $model->denda_ketetapan ?? '0';
            $dendaPembayaran = $model->denda_pembayaran ?? '0';
            $this->dendaKetetapan = ($model->is_paid) ? $dendaPembayaran : $dendaKetetapan;
            $this->jumlahPembayaran =$model->jumlah_pembayaran ?? '0';
            $this->dendaPembayaran = $model->denda_pembayaran ?? '0';
            $this->tanggalPembayaran = $model->tgl_pembayaran_sppt ? DateFormatter::format($model->tgl_pembayaran_sppt, DateFormat::dFY_His) : '-';
            $this->isPaid = $model->is_paid;
            $this->totalPembayaran = (string) ($model->denda_pembayaran + $model->jumlah_pembayaran);
            $this->totalTunggakan = $model->is_paid ? '0' : (string) ($model->pbb_yg_harus_dibayar_sppt + $model->denda_ketetapan);
        }
    }
}