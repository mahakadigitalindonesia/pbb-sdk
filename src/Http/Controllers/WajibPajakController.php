<?php
namespace Mdigi\PBB\Http\Controllers;

use Illuminate\Routing\Controller;
use Mdigi\PBB\Contracts\WajibPajakService;

class WajibPajakController extends Controller
{
    public function detail(string $id, WajibPajakService $wajibPajakService)
    {
        return response()->json($wajibPajakService->findById($id));
    }
}