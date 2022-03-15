<?php

namespace Mdigi\PBB\Services;

use Illuminate\Support\Str;
use Mdigi\PBB\Contracts\PelayananService;
use Mdigi\PBB\Helpers\DatabaseSwitch;
use Mdigi\PBB\Models\Kantor;
use Mdigi\PBB\Models\NomorPelayanan;

class PelayananServiceImpl implements PelayananService
{
    private const MAX_URUT_PERBUNDEL = 200;

    public function updateMaxNomor($year)
    {
        $maxNomor = NomorPelayanan::query()->where('thn_pelayanan', $year)->lockForUpdate()->first();
        if ($maxNomor) {
            $nomorUrut = Str::padLeft(((int)$maxNomor->no_urut_pelayanan + 1), 3, '0');
            if ($nomorUrut > self::MAX_URUT_PERBUNDEL) {
                $maxNomor->bundel_pelayanan = Str::padLeft(((int)$maxNomor->bundel_pelayanan + 1), 4, '0');
                $nomorUrut = '001';
            }
            $maxNomor->no_urut_pelayanan = $nomorUrut;
            $maxNomor->save();
            return $maxNomor->thn_pelayanan . '.' . $maxNomor->bundel_pelayanan . '.' . $maxNomor->no_urut_pelayanan;
        } else {
            $kantor = Kantor::query()->first();
            $kodeKantorColumn = 'kd_' . DatabaseSwitch::getKantor();
            $bundelPelayanan = '0001';
            $nomorUrutPelayanan = '001';
            NomorPelayanan::query()->create([
                'kd_kanwil' => $kantor->kd_kanwil,
                $kodeKantorColumn => $kantor->{$kodeKantorColumn},
                'thn_pelayanan' => $year,
                'bundel_pelayanan' => $bundelPelayanan,
                'no_urut_pelayanan' => $nomorUrutPelayanan,
            ]);
            return $year . '.' . $bundelPelayanan . '.' . $nomorUrutPelayanan;
        }
    }
}