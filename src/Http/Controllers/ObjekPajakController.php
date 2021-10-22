<?php
namespace Mdigi\PBB\Http\Controllers;

use Illuminate\Routing\Controller;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Dtos\NOP;

class ObjekPajakController extends Controller
{
    public function nop(string $nop, ObjekPajakService $objekPajakService)
    {
        $parsedNOP = NOP::parse($nop);
        return response()->json($objekPajakService->findByNOP($parsedNOP));
    }
}