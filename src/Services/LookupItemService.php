<?php


namespace Mdigi\PBB\Services;


use Mdigi\PBB\Models\LookupItem;
use Mdigi\PBB\Dtos\LookupItem as LookupItemDto;
use Mdigi\PBB\Contracts\LookupItemService as LookupItemContract;

class LookupItemService implements LookupItemContract
{
    public function pekerjaan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::PEKERJAAN, $kodeItem);
    }

    public function kepemilikan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::KEPEMILIKAN, $kodeItem);
    }

    public function tanah($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::TANAH, $kodeItem);
    }

    public function transaksiLSPOP($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::TRANSAKSI_LSPOP, $kodeItem);
    }

    public function kondisiUmum($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::KONDISI_UMUM, $kodeItem);
    }

    public function konstruksi($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::KONSTRUKSI, $kodeItem);
    }

    public function atap($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::ATAP, $kodeItem);
    }

    public function lantai($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::LANTAI, $kodeItem);
    }

    public function langit($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::LANGIT, $kodeItem);
    }

    public function kolamRenang($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::KOLAM_RENANG, $kodeItem);
    }

    public function bahanPagar($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::BAHAN_PAGAR, $kodeItem);
    }

    public function dinding($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemContract::DINDING, $kodeItem);
    }

    private function getLookUpItem($kodeGroup, $kodeItem = null)
    {
        $lookupItem = LookupItem::where('kd_lookup_group', $kodeGroup);
        $lookupItem = $kodeItem ? $lookupItem->where('kd_lookup_item', $kodeItem) : $lookupItem;
        return $kodeItem ? new LookupItemDto($lookupItem->first()) : $lookupItem->get()->mapInto(LookupItemDto::class);
    }
}