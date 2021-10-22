<?php


namespace Mdigi\PBB\Http\Controllers;


use Illuminate\Routing\Controller;
use Mdigi\PBB\Contracts\KelurahanService;
use Mdigi\PBB\Dtos\Kelurahan;

class KelurahanController extends Controller
{
    public function index(string $kodeKecamatan, KelurahanService $kelurahanService)
    {
        $kelurahan = new Kelurahan;
        $kelurahan->kodeKecamatan = $kodeKecamatan;
        return response()->json($kelurahanService->findByKelurahan($kelurahan));
    }

    public function detail(string $kodeKecamatan, string $kodeKelurahan, KelurahanService $kelurahanService)
    {
        $kelurahan = new Kelurahan;
        $kelurahan->kode = $kodeKelurahan;
        $kelurahan->kodeKecamatan = $kodeKecamatan;
        return response()->json($kelurahanService->findByKelurahan($kelurahan));
    }

    public function blok(string $kodeKecamatan, string $kodeKelurahan, KelurahanService $kelurahanService)
    {
        return response()->json($kelurahanService->blok($kodeKecamatan, $kodeKelurahan));
    }

    public function blokZonaNilaiTanah(string $kodeKecamatan, string $kodeKelurahan, string $kodeBlok, KelurahanService $kelurahanService)
    {
        return response()->json($kelurahanService->blokZonaNilaiTanah($kodeKecamatan, $kodeKelurahan, $kodeBlok));
    }
}