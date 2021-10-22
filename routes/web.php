<?php
use Illuminate\Support\Facades\Route;
use Mdigi\PBB\Http\Controllers\KecamatanController;

Route::prefix('kecamatan')->group(function (){
    Route::get('', [KecamatanController::class, 'index'])->name('pbb.kecamatan.index');
    Route::get('/{kodeKecamatan}', [KecamatanController::class, 'detail'])->name('pbb.kecamatan.detail');
    Route::get('/{kodeKecamatan}/kelurahan', [KecamatanController::class, 'kelurahan'])->name('pbb.kecamatan.kelurahan');
});

