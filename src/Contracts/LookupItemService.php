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

    public function pekerjaan($kodeItem = null);
    public function kepemilikan($kodeItem = null);
    public function tanah($kodeItem = null);
    public function transaksiLSPOP($kodeItem = null);
    public function kondisiUmum($kodeItem = null);
    public function konstruksi($kodeItem = null);
    public function atap($kodeItem = null);
    public function lantai($kodeItem = null);
    public function langit($kodeItem = null);
    public function kolamRenang($kodeItem = null);
    public function bahanPagar($kodeItem = null);
    public function dinding($kodeItem = null);
}