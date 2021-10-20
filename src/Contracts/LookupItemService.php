<?php


namespace Mdigi\PBB\Contracts;


interface LookupItemService
{
    const PEKERJAAN = "08";
    const KEPEMILIKAN = "10";
    const TANAH = "20";
    const TRANSAKSI_LSPOP = "33";
    const KONDISI_UMUM = "21";
    const KONSTRUKSI = "22";
    const ATAP = "41";
    const LANTAI = "43";
    const LANGIT = "44";
    const KOLAM_RENANG = "39";
    const BAHAN_PAGAR = "40";
    const DINDING = "42";

    public function pekerjaan($kodeItem);
    public function kepemilikan($kodeItem);
    public function tanah($kodeItem);
    public function transaksiLSPOP($kodeItem);
    public function kondisiUmum($kodeItem);
    public function konstruksi($kodeItem);
    public function atap($kodeItem);
    public function lantai($kodeItem);
    public function langit($kodeItem);
    public function kolamRenang($kodeItem);
    public function bahanPagar($kodeItem);
    public function dinding($kodeItem);
}