<?php


namespace Mdigi\PBB\Dtos;


use Mdigi\PBB\Exceptions\FormatNopNotValidException;

class NOP
{
    private const validNopLength = 24;

    public $kodeProvinsi;
    public $kodeDati;
    public $kodeKecamatan;
    public $kodeKelurahan;
    public $kodeBlok;
    public $nomorUrut;
    public $kodeJenis;

    public function __construct($kodeProvinsi, $kodeDati, $kodeKecamatan, $kodeKelurahan, $kodeBlok, $nomorUrut, $kodeJenis)
    {
        $this->kodeProvinsi = $kodeProvinsi;
        $this->kodeDati = $kodeDati;
        $this->kodeKecamatan = $kodeKecamatan;
        $this->kodeKelurahan = $kodeKelurahan;
        $this->kodeBlok = $kodeBlok;
        $this->nomorUrut = $nomorUrut;
        $this->kodeJenis = $kodeJenis;
    }

    public static function parse($nop)
    {
        $nopLength = strlen($nop);
        throw_if($nopLength <> self::validNopLength, new FormatNopNotValidException());
        list($kodeProvinsi, $kodeDati, $kodeKecamatan, $kodeKelurahan, $kodeBlok, $nomorUrut, $kodeJenis) = explode(".", $nop);
        return new NOP($kodeProvinsi, $kodeDati, $kodeKecamatan, $kodeKelurahan, $kodeBlok, $nomorUrut, $kodeJenis);
    }


    public function __toString()
    {
        $isNull = $this->kodeProvinsi == null || $this->kodeDati == null || $this->kodeKecamatan == null || $this->kodeKelurahan == null || $this->kodeBlok == null || $this->nomorUrut == null || !$this->kodeJenis == null;
        throw_if($isNull, new FormatNopNotValidException());
        return $this->kodeProvinsi . '.' . $this->kodeDati . '.' . $this->kodeKecamatan . '.' . $this->kodeKelurahan . '.' . $this->kodeBlok . '.' . $this->nomorUrut . '.' . $this->kodeJenis;
    }
}