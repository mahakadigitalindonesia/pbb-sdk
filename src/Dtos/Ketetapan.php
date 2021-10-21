<?php


namespace Mdigi\PBB\Dtos;


class Ketetapan extends TransaksiKeys
{
    public $nop;
    public $namaWP;
    public $alamatWP;
    public $alamatOP;
    public $luasTanah;
    public $luasBangunan;
    public $njopTanah;
    public $njopBangunan;
    public $totalNjop;
    public $totalNjopTidakKenaPajak;
    public $pajakTerhutang;
    public $faktorPengurang;
    public $totalTagihanPajak;
    public $tanggalPenetapan;
    public $tanggalJatuhTempo;
    public $isPaid;
    public $denda;

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
            $this->namaWP = $model->nm_wp_sppt;
            $this->alamatWP = $this->formatAlamatWP($model);
            $this->alamatOP = $this->formatAlamatOP($model);
            $this->luasTanah = $model->luas_bumi_sppt;
            $this->luasBangunan = $model->luas_bng_sppt ?? '0';
            $this->njopTanah = $model->njop_bumi_sppt;
            $this->njopBangunan = $model->njop_bng_sppt ?? '0';
            $this->totalNjop = $model->njop_sppt;
            $this->totalNjopTidakKenaPajak = $model->njoptkp_sppt;
            $this->pajakTerhutang = $model->pbb_terhutang_sppt;
            $this->totalTagihanPajak = $model->pbb_yg_harus_dibayar_sppt;
            $this->faktorPengurang = $model->faktor_pengurang_sppt ?? '0';
            $this->tanggalPenetapan = $model->tgl_terbit_sppt;
            $this->tanggalJatuhTempo = $model->tgl_jatuh_tempo_sppt;
            $this->isPaid = $model->is_paid;
            $this->denda = $model->is_paid ? '0' : $model->denda;
        }
    }

    private function formatAlamatWP($model)
    {
        $rt = $model->rt_wp ?? '000';
        $rw = $model->rw_wp ?? '00';
        return $model->jln_wp_sppt . ' RT ' . $rt . ' RW ' . $rw . ', KEL/DESA ' . $model->kelurahan_wp_sppt . ', KABUPATEN/KOTA ' . $model->kota_wp_sppt;
    }

    private function formatAlamatOP($model)
    {
        $rt = $model->rt_op ?? '000';
        $rw = $model->rw_op ?? '00';
        return $model->jalan_op . ' RT ' . $rt . ' RW ' . $rw . ', KEL/DESA ' . $model->nm_kelurahan . ', KEC ' . $model->nm_kecamatan;
    }
}