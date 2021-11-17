<?php


namespace Mdigi\PBB\Services;


use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Dtos\LookupItem as LookupItemDto;
use Mdigi\PBB\Helpers\LookupItemType;
use Mdigi\PBB\Models\LookupItem;

class LookupItemServiceImpl implements LookupItemService
{
    public function pekerjaan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::PEKERJAAN, $kodeItem);
    }

    public function kepemilikan($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::KEPEMILIKAN, $kodeItem);
    }

    public function tanah($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::TANAH, $kodeItem);
    }

    public function transaksiLSPOP($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::TRANSAKSI_LSPOP, $kodeItem);
    }

    public function kondisiUmum($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::KONDISI_UMUM, $kodeItem);
    }

    public function konstruksi($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::KONSTRUKSI, $kodeItem);
    }

    public function atap($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::ATAP, $kodeItem);
    }

    public function lantai($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::LANTAI, $kodeItem);
    }

    public function langit($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::LANGIT, $kodeItem);
    }

    public function kolamRenang($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::KOLAM_RENANG, $kodeItem);
    }

    public function bahanPagar($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::BAHAN_PAGAR, $kodeItem);
    }

    public function dinding($kodeItem = null)
    {
        return $this->getLookUpItem(LookupItemType::DINDING, $kodeItem);
    }

    private function getLookUpItem($kodeGroup, $kodeItem = null)
    {
        $lookupItem = LookupItem::where('kd_lookup_group', $kodeGroup);
        $lookupItem = $kodeItem !== null ? $lookupItem->where('kd_lookup_item', $kodeItem) : $lookupItem;
        return $lookupItem->get()->count() > 1 ? $lookupItem->get()->mapInto(LookupItemDto::class) : new LookupItemDto($lookupItem->firstOrFail());
    }
}