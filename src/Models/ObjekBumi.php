<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class ObjekBumi extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_op_bumi';
    public const allColumns = self::table . '.*';
    public const kodeProvinsi = self::table . '.' . OPColumns::kodeProvinsi;
    public const kodeDati = self::table . '.' . OPColumns::kodeDati;
    public const kodeKecamatan = self::table . '.' . OPColumns::kodeKecamatan;
    public const kodeKelurahan = self::table . '.' . OPColumns::kodeKelurahan;
    public const kodeBlok = self::table . '.' . OPColumns::kodeBlok;
    public const nomorUrut = self::table . '.' . OPColumns::nomorUrut;
    public const kodeJenis = self::table . '.' . OPColumns::kodeJenis;
    public const nomorBumi = self::table . '.no_bumi';
    protected $table = self::table;
    protected $guarded = [];
    protected $primaryKey = 'no_bumi';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}