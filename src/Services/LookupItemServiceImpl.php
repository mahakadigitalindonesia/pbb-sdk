<?php


namespace Mdigi\PBB\Services;


use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Dtos\LookupItem as LookupItemDto;
use Mdigi\PBB\Models\LookupItem;

class LookupItemServiceImpl implements LookupItemService
{
    public function pekerjaan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::PEKERJAAN, $kodeItem);
    }

    public function kepemilikan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::KEPEMILIKAN, $kodeItem);
    }

    public function tanah($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::TANAH, $kodeItem);
    }

    public function transaksiLSPOP($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::TRANSAKSI_LSPOP, $kodeItem);
    }

    public function kondisiUmum($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::KONDISI_UMUM, $kodeItem);
    }

    public function konstruksi($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::KONSTRUKSI, $kodeItem);
    }

    public function atap($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::ATAP, $kodeItem);
    }

    public function lantai($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::LANTAI, $kodeItem);
    }

    public function langit($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::LANGIT, $kodeItem);
    }

    public function kolamRenang($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::KOLAM_RENANG, $kodeItem);
    }

    public function bahanPagar($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::BAHAN_PAGAR, $kodeItem);
    }

    public function dinding($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemService::DINDING, $kodeItem);
    }

    private function getLookUpItem($kodeGroup, $kodeItem = null)
    {
        $lookupItem = LookupItem::where('kd_lookup_group', $kodeGroup);
        $lookupItem = $kodeItem !== null ? $lookupItem->where('kd_lookup_item', $kodeItem) : $lookupItem;
        return $lookupItem->get()->count() > 1 ? $lookupItem->get()->mapInto(LookupItemDto::class) : new LookupItemDto($lookupItem->firstOrFail());
    }
}