<?php


namespace Mdigi\PBB\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mdigi\PBB\Contracts\NomorBundelService;
use Mdigi\PBB\Dtos\NomorBundel as NomorBundelDto;
use Mdigi\PBB\Helpers\DatabaseSwitch;
use Mdigi\PBB\Models\Kantor;
use Mdigi\PBB\Models\NomorBundel;

class NomorBundelServiceImpl implements NomorBundelService
{
    public function findOrCreate($year = null)
    {
        $year = $year ?? Carbon::now()->year;
        $kantor = Kantor::query()->firstOrFail();
        $bundel = NomorBundel::query()->where('temp_thn_bundel', $year)
            ->orderByDesc('temp_no_bundel')
            ->orderByDesc('temp_urut_bundel')
            ->lockForUpdate()->firstOrCreate([
                'kd_kanwil' => $kantor->kd_kanwil,
                DatabaseSwitch::kodeKantor() => $kantor->{DatabaseSwitch::kodeKantor()},
                'temp_thn_bundel' => $year
            ], [
                'temp_no_bundel' => '0001',
                'temp_urut_bundel' => '001',
            ]);
        throw_if($bundel->get()->isEmpty(), new ModelNotFoundException());
        $bundel->temp_urut_bundel = ((int)$bundel->temp_urut_bundel === 1) ? $bundel->temp_urut_bundel : Str::padLeft((string)((int)$bundel->temp_urut_bundel + 1), 3, '0');
        if ((int)$bundel->temp_urut_bundel > 999) {
            $bundel->temp_no_bundel = Str::padLeft((string)((int)$bundel->temp_no_bundel + 1), 4, '0');
            $bundel->temp_urut_bundel = '001';
        }
        return new NomorBundelDto($bundel);
    }

    public function updateOrCreate($year, $nomorBundel, $nomorUrut)
    {
        $kantor = Kantor::query()->firstOrFail();
        $bundel = NomorBundel::updateOrCreate([
            'kd_kanwil' => $kantor->kd_kanwil,
            DatabaseSwitch::kodeKantor() => $kantor->{DatabaseSwitch::kodeKantor()},
            'temp_thn_bundel' => $year,
            'temp_no_bundel' => $nomorBundel
        ], [
            'temp_urut_bundel' => $nomorUrut
        ]);
        return new NomorBundelDto($bundel);
    }
}