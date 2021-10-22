<?php
use Illuminate\Support\Facades\Route;
use Mdigi\PBB\Http\Controllers\KecamatanController;
use Mdigi\PBB\Http\Controllers\KelurahanController;
use Mdigi\PBB\Http\Controllers\ObjekPajakController;

Route::prefix('kecamatan')->group(function (){
    Route::get('', [KecamatanController::class, 'index'])->name('pbb.kecamatan.index');
    Route::get('/{kodeKecamatan}', [KecamatanController::class, 'detail'])->name('pbb.kecamatan.detail');
    Route::get('/{kodeKecamatan}/kelurahan', [KelurahanController::class, 'index'])->name('pbb.kelurahan.index');
    Route::get('/{kodeKecamatan}/kelurahan/{kodeKelurahan}', [KelurahanController::class, 'detail'])->name('pbb.kelurahan.detail');
    Route::get('/{kodeKecamatan}/kelurahan/{kodeKelurahan}/blok', [KelurahanController::class, 'blok'])->name('pbb.kelurahan.blok');
    Route::get('/{kodeKecamatan}/kelurahan/{kodeKelurahan}/blok/{kodeBlok}/znt', [KelurahanController::class, 'blokZonaNilaiTanah'])->name('pbb.kelurahan.blok.znt');
});

Route::prefix('objek-pajak')->group(function(){
    Route::get('/{nop}', [ObjekPajakController::class, 'nop'])->name('pbb.objek-pajak.nop');
});



