<?php
namespace Mdigi\PBB\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Mdigi\PBB\Contracts\WajibPajakService;

class WajibPajakController extends Controller
{
    public function detail(string $id, WajibPajakService $wajibPajakService)
    {
        return response()->json($wajibPajakService->findById($id));
    }

    public function detailById(Request $request, WajibPajakService $wajibPajakService)
    {
        $validated = $request->validate([
            'id' => ['required', 'string', 'max:30'],
        ]);
        return response()->json($wajibPajakService->findById($validated['id']));
    }
}