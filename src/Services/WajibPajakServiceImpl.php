<?php


namespace Mdigi\PBB\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Contracts\WajibPajakService;
use Mdigi\PBB\Domains\DataSubjekPajak;
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

    public function save(DataSubjekPajak $subjekPajak)
    {
        $saved = WajibPajak::updateOrCreate([
            'subjek_pajak_id' => $subjekPajak->getId(),
        ], [
            'nm_wp' => Str::limit($subjekPajak->getNama(), 30, ''),
            'jalan_wp' => Str::limit($subjekPajak->getJalan(), 30, ''),
            'blok_kav_no_wp' => Str::limit($subjekPajak->getBlokKavlingNomor(), 15, ''),
            'rw_wp' => Str::limit($subjekPajak->getRw(), 2, ''),
            'rt_wp' => Str::limit($subjekPajak->getRw(), 3, ''),
            'kelurahan' => Str::limit($subjekPajak->getKelurahan(), 30, ''),
            'kota_wp' => Str::limit($subjekPajak->getKota(), 30, ''),
            'kd_pos_wp' => Str::limit($subjekPajak->getKodePos(), 5, ''),
            'telp_wp' => Str::limit($subjekPajak->getTelepon(), 20, ''),
            'npwp' => Str::limit($subjekPajak->getNpwp(), 15, ''),
            'status_pekerjaan_wp' => Str::limit($subjekPajak->getStatusPekerjaan(), 1, '')
        ]);
        return $this->findById($saved->id);
    }
}