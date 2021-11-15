<?php


namespace Mdigi\PBB\Domains;


class DataSubjekPajak
{
    private $id;
    private $nama;
    private $jalan;
    private $blokKavlingNomor;
    private $rw;
    private $rt;
    private $kelurahan;
    private $kota;
    private $kodePos;
    private $telepon;
    private $npwp;
    private $statusPekerjaan;

    /**
     * DataSubjekPajak constructor.
     * @param $id
     * @param $nama
     * @param $jalan
     * @param $blokKavlingNomor
     * @param $rw
     * @param $rt
     * @param $kelurahan
     * @param $kota
     * @param $kodePos
     * @param $telepon
     * @param $npwp
     * @param $statusPekerjaan
     */
    public function __construct($id, $nama, $jalan, $blokKavlingNomor, $rw, $rt, $kelurahan, $kota, $kodePos, $telepon, $npwp, $statusPekerjaan)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->jalan = $jalan;
        $this->blokKavlingNomor = $blokKavlingNomor;
        $this->rw = $rw;
        $this->rt = $rt;
        $this->kelurahan = $kelurahan;
        $this->kota = $kota;
        $this->kodePos = $kodePos;
        $this->telepon = $telepon;
        $this->npwp = $npwp;
        $this->statusPekerjaan = $statusPekerjaan;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
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
    public function getKelurahan()
    {
        return $this->kelurahan;
    }

    /**
     * @return mixed
     */
    public function getKota()
    {
        return $this->kota;
    }

    /**
     * @return mixed
     */
    public function getKodePos()
    {
        return $this->kodePos;
    }

    /**
     * @return mixed
     */
    public function getTelepon()
    {
        return $this->telepon;
    }

    /**
     * @return mixed
     */
    public function getNpwp()
    {
        return $this->npwp;
    }

    /**
     * @return mixed
     */
    public function getStatusPekerjaan()
    {
        return $this->statusPekerjaan;
    }

    public static function builder()
    {
        return new DataSubjekPajakBuilder();
    }
}

class DataSubjekPajakBuilder
{
    private $id;
    private $nama;
    private $jalan;
    private $blokKavlingNomor;
    private $rw;
    private $rt;
    private $kelurahan;
    private $kota;
    private $kodePos;
    private $telepon;
    private $npwp;
    private $statusPekerjaan;

    public function id($id)
    {
        $this->id = $id;
        return $this;
    }

    public function nama($nama)
    {
        $this->nama = $nama;
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

    public function kelurahan($kelurahan)
    {
        $this->kelurahan = $kelurahan;
        return $this;
    }

    public function kota($kota)
    {
        $this->kota = $kota;
        return $this;
    }

    public function kodePos($kodePos)
    {
        $this->kodePos = $kodePos;
        return $this;
    }

    public function telepon($telepon)
    {
        $this->telepon = $telepon;
        return $this;
    }

    public function npwp($npwp)
    {
        $this->npwp = $npwp;
        return $this;
    }

    public function statusPekerjaan($statusPekerjaan)
    {
        $this->statusPekerjaan = $statusPekerjaan;
        return $this;
    }

    public function build()
    {
        return new DataSubjekPajak(
            $this->id,
            $this->nama,
            $this->jalan,
            $this->blokKavlingNomor,
            $this->rw,
            $this->rt,
            $this->kelurahan,
            $this->kota,
            $this->kodePos,
            $this->telepon,
            $this->npwp,
            $this->statusPekerjaan
        );
    }
}

;