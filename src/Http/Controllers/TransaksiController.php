<?php

namespace Mdigi\PBB\Http\Controllers;

use Mdigi\PBB\Contracts\TransaksiService;
use Mdigi\PBB\Dtos\NOP;

class TransaksiController
{
    public function nop(string $nop, TransaksiService $transaksiService)
    {
        return response()->json($transaksiService->findByNOP(NOP::parse($nop)));
    }

    public function nopTahun(string $nop, int $tahun, TransaksiService $transaksiService)
    {
        return response()->json($transaksiService->findByNOPAndTahun(NOP::parse($nop), $tahun));
    }
}