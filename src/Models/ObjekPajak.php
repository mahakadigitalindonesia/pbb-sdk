<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class ObjekPajak extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_objek_pajak';
    public const allColumns = self::table . '.*';
    public const kodeProvinsi = self::table . '.' . OPColumns::kodeProvinsi;
    public const kodeDati = self::table . '.' . OPColumns::kodeDati;
    public const kodeKecamatan = self::table . '.' . OPColumns::kodeKecamatan;
    public const kodeKelurahan = self::table . '.' . OPColumns::kodeKelurahan;
    public const kodeBlok = self::table . '.' . OPColumns::kodeBlok;
    public const nomorUrut = self::table . '.' . OPColumns::nomorUrut;
    public const kodeJenis = self::table . '.' . OPColumns::kodeJenis;
    public const jalan = self::table . '.jalan_op';
    public const rt = self::table . '.rt_op';
    public const rw = self::table . '.rw_op';
    public const kodeKepemilikan = self::table . '.kd_status_wp';

    protected $table = self::table;

    protected $guarded = [];

}