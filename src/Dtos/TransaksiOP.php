<?php


namespace Mdigi\PBB\Dtos;


use Mdigi\PBB\Helpers\DateFormat;
use Mdigi\PBB\Helpers\DateFormatter;

class TransaksiOP extends TransaksiKeys
{
    public $nop;
    public $namaWP;
    public $alamatOP;
    public $alamatWP;
    public $jumlahKetetapan;
    public $dendaKetetapan;
    public $tanggalJatuhTempo;
    public $totalTunggakan;

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
            $this->alamatOP = $model->alamat_op ?? '-';
            $this->namaWP = $model->nm_wp_sppt ?? '-';
            $this->alamatWP = $model->jln_wp_sppt . ' RT.'.$model->rt_wp_sppt. ' RW.'.$model->rw_wp_sppt;
            $this->tanggalJatuhTempo = $model->tgl_jatuh_tempo_sppt ? $model->tgl_jatuh_tempo_sppt->format(DateFormat::dFY) : '-';
            $this->jumlahKetetapan = $model->pbb_yg_harus_dibayar_sppt;
            $this->dendaKetetapan = $model->denda_ketetapan ?? '0';
            $this->totalTunggakan = (string) ($model->pbb_yg_harus_dibayar_sppt + $model->denda_ketetapan);
        }
    }
}