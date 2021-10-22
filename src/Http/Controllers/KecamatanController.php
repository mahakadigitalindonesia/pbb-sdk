<?php

namespace Mdigi\PBB\Http\Controllers;

use Illuminate\Routing\Controller;
use Mdigi\PBB\Contracts\KecamatanService;
use Mdigi\PBB\Contracts\KelurahanService;
use Mdigi\PBB\Dtos\Kecamatan;
use Mdigi\PBB\Dtos\Kelurahan;

class KecamatanController extends Controller
{
    public function index(KecamatanService $kecamatanService)
    {
        return response()->json($kecamatanService->findAll());
    }

    public function detail(string $kodeKecamatan, KecamatanService $kecamatanService)
    {
        $kecamatan = new Kecamatan;
        $kecamatan->kode = $kodeKecamatan;
        return response()->json($kecamatanService->findByKecamatan($kecamatan));
    }

    public function kelurahan(string $kodeKecamatan, KelurahanService $kelurahanService)
    {
        $kelurahan = new Kelurahan;
        $kelurahan->kodeKecamatan = $kodeKecamatan;
        return response()->json($kelurahanService->findByKelurahan($kelurahan));
    }
}