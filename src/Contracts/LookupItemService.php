<?php


namespace Mdigi\PBB\Contracts;


interface LookupItemService
{
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