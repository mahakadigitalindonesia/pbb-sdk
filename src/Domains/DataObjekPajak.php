<?php

namespace Mdigi\PBB\Domains;

class DataObjekPajak
{
    private $kodeProvinsi;
    private $kodeDati;
    private $kodeKecamatan;
    private $kodeKelurahan;
    private $kodeBlok;
    private $nomorUrut;
    private $kodeJenis;
    private $wajibPajakId;
    private $nomorFormulirSPOP;
    private $nomorSertifikat;
    private $jalan;
    private $blokKavlingNomor;
    private $rw;
    private $rt;
    private $kodeKepemilikan;
    private $luasTanah;
    private $kodeZonaNilaiTanah;
    private $jenisTanah;
    private $jenisTransaksi;
    private $nipPendata;
    private $nipPemeriksa;
    private $nipPerekam;
    private $tanggalPendataan;
    private $tanggalPemeriksaan;

    /**
     * DataObjekPajak constructor.
     * @param $kodeProvinsi
     * @param $kodeDati
     * @param $kodeKecamatan
     * @param $kodeKelurahan
     * @param $kodeBlok
     * @param $nomorUrut
     * @param $kodeJenis
     * @param $wajibPajakId
     * @param $nomorFormulirSPOP
     * @param $nomorSertifikat
     * @param $jalan
     * @param $blokKavlingNomor
     * @param $rw
     * @param $rt
     * @param $kodeKepemilikan
     * @param $luasTanah
     * @param $jenisTransaksi
     * @param $nipPendata
     * @param $nipPemeriksa
     * @param $nipPerekam
     * @param $tanggalPendataan
     * @param $tanggalPemeriksaan
     */
    public function __construct($kodeProvinsi, $kodeDati, $kodeKecamatan, $kodeKelurahan, $kodeBlok, $nomorUrut, $kodeJenis, $wajibPajakId, $nomorFormulirSPOP, $nomorSertifikat, $jalan, $blokKavlingNomor, $rw, $rt, $kodeKepemilikan, $luasTanah, $kodeZonaNilaiTanah, $jenisTanah, $jenisTransaksi, $nipPendata, $nipPemeriksa, $nipPerekam, $tanggalPendataan, $tanggalPemeriksaan)
    {
        $this->kodeProvinsi = $kodeProvinsi;
        $this->kodeDati = $kodeDati;
        $this->kodeKecamatan = $kodeKecamatan;
        $this->kodeKelurahan = $kodeKelurahan;
        $this->kodeBlok = $kodeBlok;
        $this->nomorUrut = $nomorUrut;
        $this->kodeJenis = $kodeJenis;
        $this->wajibPajakId = $wajibPajakId;
        $this->nomorFormulirSPOP = $nomorFormulirSPOP;
        $this->nomorSertifikat = $nomorSertifikat;
        $this->jalan = $jalan;
        $this->blokKavlingNomor = $blokKavlingNomor;
        $this->rw = $rw;
        $this->rt = $rt;
        $this->kodeKepemilikan = $kodeKepemilikan;
        $this->luasTanah = $luasTanah;
        $this->kodeZonaNilaiTanah = $kodeZonaNilaiTanah;
        $this->jenisTanah = $jenisTanah;
        $this->jenisTransaksi = $jenisTransaksi;
        $this->nipPendata = $nipPendata;
        $this->nipPemeriksa = $nipPemeriksa;
        $this->nipPerekam = $nipPerekam;
        $this->tanggalPendataan = $tanggalPendataan;
        $this->tanggalPemeriksaan = $tanggalPemeriksaan;
    }


    /**
     * @return mixed
     */
    public function getKodeProvinsi()
    {
        return $this->kodeProvinsi;
    }

    /**
     * @return mixed
     */
    public function getKodeDati()
    {
        return $this->kodeDati;
    }

    /**
     * @return mixed
     */
    public function getKodeKecamatan()
    {
        return $this->kodeKecamatan;
    }

    /**
     * @return mixed
     */
    public function getKodeKelurahan()
    {
        return $this->kodeKelurahan;
    }

    /**
     * @return mixed
     */
    public function getKodeBlok()
    {
        return $this->kodeBlok;
    }

    /**
     * @return mixed
     */
    public function getNomorUrut()
    {
        return $this->nomorUrut;
    }

    /**
     * @return mixed
     */
    public function getKodeJenis()
    {
        return $this->kodeJenis;
    }

    /**
     * @return mixed
     */
    public function getWajibPajakId()
    {
        return $this->wajibPajakId;
    }

    /**
     * @return mixed
     */
    public function getNomorFormulirSPOP()
    {
        return $this->nomorFormulirSPOP;
    }

    /**
     * @return mixed
     */
    public function getNomorSertifikat()
    {
        return $this->nomorSertifikat;
    }

    /**
     * @return mixed
     */
    public function getJalan()
    {
        return $this->jalan;
    }

    /**
     * @return mixed
     */
    public function getBlokKavlingNomor()
    {
        return $this->blokKavlingNomor;
    }

    /**
     * @return mixed
     */
    public function getRw()
    {
        return $this->rw;
    }

    /**
     * @return mixed
     */
    public function getRt()
    {
        return $this->rt;
    }

    /**
     * @return mixed
     */
    public function getKodeKepemilikan()
    {
        return $this->kodeKepemilikan;
    }

    /**
     * @return mixed
     */
    public function getLuasTanah()
    {
        return $this->luasTanah;
    }

    /**
     * @return mixed
     */
    public function getJenisTransaksi()
    {
        return $this->jenisTransaksi;
    }

    /**
     * @return mixed
     */
    public function getNipPendata()
    {
        return $this->nipPendata;
    }

    /**
     * @return mixed
     */
    public function getNipPemeriksa()
    {
        return $this->nipPemeriksa;
    }

    /**
     * @return mixed
     */
    public function getNipPerekam()
    {
        return $this->nipPerekam;
    }

    /**
     * @return mixed
     */
    public function getTanggalPendataan()
    {
        return $this->tanggalPendataan;
    }

    /**
     * @return mixed
     */
    public function getTanggalPemeriksaan()
    {
        return $this->tanggalPemeriksaan;
    }

    /**
     * @return mixed
     */
    public function getKodeZonaNilaiTanah()
    {
        return $this->kodeZonaNilaiTanah;
    }

    /**
     * @return mixed
     */
    public function getJenisTanah()
    {
        return $this->jenisTanah;
    }

    public static function builder()
    {
        return new DataObjekPajakBuilder();
    }
}

class DataObjekPajakBuilder
{
    private $kodeProvinsi;
    private $kodeDati;
    private $kodeKecamatan;
    private $kodeKelurahan;
    private $kodeBlok;
    private $nomorUrut;
    private $kodeJenis;
    private $wajibPajakId;
    private $nomorFormulirSPOP;
    private $nomorSertifikat;
    private $jalan;
    private $blokKavlingNomor;
    private $rw;
    private $rt;
    private $kodeKepemilikan;
    private $luasTanah;
    private $kodeZonaNilaiTanah;
    private $jenisTanah;
    private $jenisTransaksi;
    private $nipPendata;
    private $nipPemeriksa;
    private $nipPerekam;
    private $tanggalPendataan;
    private $tanggalPemeriksaan;

    public function kodeProvinsi($kodeProvinsi)
    {
        $this->kodeProvinsi = $kodeProvinsi;
        return $this;
    }

    public function kodeDati($kodeDati)
    {
        $this->kodeDati = $kodeDati;
        return $this;
    }

    public function kodeKecamatan($kodeKecamatan)
    {
        $this->kodeKecamatan = $kodeKecamatan;
        return $this;
    }

    public function kodeKelurahan($kodeKelurahan)
    {
        $this->kodeKelurahan = $kodeKelurahan;
        return $this;
    }

    public function kodeBlok($kodeBlok)
    {
        $this->kodeBlok = $kodeBlok;
        return $this;
    }

    public function nomorUrut($nomorUrut)
    {
        $this->nomorUrut = $nomorUrut;
        return $this;
    }

    public function kodeJenis($kodeJenis)
    {
        $this->kodeJenis = $kodeJenis;
        return $this;
    }

    public function wajibPajakId($wajibPajakId)
    {
        $this->wajibPajakId = $wajibPajakId;
        return $this;
    }

    public function nomorFormulirSPOP($nomorFormulirSPOP)
    {
        $this->nomorFormulirSPOP = $nomorFormulirSPOP;
        return $this;
    }

    public function nomorSertifikat($nomorSertifikat)
    {
        $this->nomorSertifikat = $nomorSertifikat;
        return $this;
    }

    public function jalan($jalan)
    {
        $this->jalan = $jalan;
        return $this;
    }

    public function blokKavlingNomor($blokKavlingNomor)
    {
        $this->blokKavlingNomor = $blokKavlingNomor;
        return $this;
    }

    public function rw($rw)
    {
        $this->rw = $rw;
        return $this;
    }

    public function rt($rt)
    {
        $this->rt = $rt;
        return $this;
    }

    public function kodeKepemilikan($kodeKepemilikan)
    {
        $this->kodeKepemilikan = $kodeKepemilikan;
        return $this;
    }

    public function luasTanah($luasTanah)
    {
        $this->luasTanah = $luasTanah;
        return $this;
    }

    public function kodeZonaNilaiTanah($kodeZonaNilaiTanah)
    {
        $this->kodeZonaNilaiTanah = $kodeZonaNilaiTanah;
        return $this;
    }

    public function jenisTanah($jenisTanah)
    {
        $this->jenisTanah = $jenisTanah;
        return $this;
    }

    public function jenisTransaksi($jenisTransaksi)
    {
        $this->jenisTransaksi = $jenisTransaksi;
        return $this;
    }

    public function nipPendata($nipPendata)
    {
        $this->nipPendata = $nipPendata;
        return $this;
    }

    public function nipPemeriksa($nipPemeriksa)
    {
        $this->nipPemeriksa = $nipPemeriksa;
        return $this;
    }

    public function nipPerekam($nipPerekam)
    {
        $this->nipPerekam = $nipPerekam;
        return $this;
    }

    public function tanggalPendataan($tanggalPendataan)
    {
        $this->tanggalPendataan = $tanggalPendataan;
        return $this;
    }

    public function tanggalPemeriksaan($tanggalPemeriksaan)
    {
        $this->tanggalPemeriksaan = $tanggalPemeriksaan;
        return $this;
    }

    public function build()
    {
        return new DataObjekPajak(
            $this->kodeProvinsi,
            $this->kodeDati,
            $this->kodeKecamatan,
            $this->kodeKelurahan,
            $this->kodeBlok,
            $this->nomorUrut,
            $this->kodeJenis,
            $this->wajibPajakId,
            $this->nomorFormulirSPOP,
            $this->nomorSertifikat,
            $this->jalan,
            $this->blokKavlingNomor,
            $this->rw,
            $this->rt,
            $this->kodeKepemilikan,
            $this->luasTanah,
            $this->kodeZonaNilaiTanah,
            $this->jenisTanah,
            $this->jenisTransaksi,
            $this->nipPendata,
            $this->nipPemeriksa,
            $this->nipPerekam,
            $this->tanggalPendataan,
            $this->tanggalPemeriksaan
        );
    }
}


