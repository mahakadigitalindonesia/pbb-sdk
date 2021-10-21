<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Dtos\OPKeys;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class ObjekPajak extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_objek_pajak';
    public const allColumns = self::table. '.*';
    public const kodeProvinsi = self::table. '.'. OPKeys::kodeProvinsi;
    public const kodeDati = self::table. '.'. OPKeys::kodeDati;
    public const kodeKecamatan = self::table. '.'. OPKeys::kodeKecamatan;
    public const kodeKelurahan = self::table . '.' . OPKeys::kodeKelurahan;
    public const kodeBlok = self::table. '.'. OPKeys::kodeBlok;
    public const nomorUrut = self::table. '.'. OPKeys::nomorUrut;
    public const kodeJenis = self::table. '.'. OPKeys::kodeJenis;

    protected $table = self::table;

}