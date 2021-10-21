<?php


namespace Mdigi\PBB\Services;


use Illuminate\Support\Facades\DB;
use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Contracts\WajibPajakService;
use Mdigi\PBB\Dtos\WajibPajak as WajibPajakDto;
use Mdigi\PBB\Models\Kecamatan;
use Mdigi\PBB\Models\Kelurahan;
use Mdigi\PBB\Models\LookupItem;
use Mdigi\PBB\Models\WajibPajak;

class WajibPajakServiceImpl implements WajibPajakService
{
    public function findById($id)
    {
        $data = $this->getQuery()
            ->where(DB::raw('trim(subjek_pajak_id)'), $id)->firstOrFail();
        return new WajibPajakDto($data);
    }

    private function getQuery()
    {
        return WajibPajak::select([
            WajibPajak::allColumns,
            Kecamatan::namaKecamatan,
            LookupItem::namaItem . ' as pekerjaan',
        ])->join(LookupItem::table, function ($join) {
            $join->on(LookupItem::kodeItem, '=', WajibPajak::statusPekerjaan)
                ->where(LookupItem::kodeGroup, LookupItemService::PEKERJAAN);
        })->leftJoin(Kelurahan::table, Kelurahan::namaKelurahan, '=', WajibPajak::kelurahan)
            ->leftJoin(Kecamatan::table, Kecamatan::kodeKecamatan, '=', Kelurahan::kodeKecamatan);
    }
}