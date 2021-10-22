<?php
namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Tanah extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_op_bumi';
    public const kodePropinsi = self::table. '.'. OPColumns::kodeProvinsi;
    public const kodeDati = self::table. '.'. OPColumns::kodeDati;
    public const kodeKecamatan = self::table. '.'.OPColumns::kodeKecamatan;
    public const kodeKelurahan = self::table. '.'.OPColumns::kodeKelurahan;
    public const kodeBlok = self::table . '.'. OPColumns::kodeBlok;
    public const nomorUrut = self::table. '.'. OPColumns::nomorUrut;
    public const kodeJenis = self::table. '.'. OPColumns::kodeJenis;
    public const kodeZonaNilaiTanah = self::table. '.kd_znt';
    public const luas = self::table. '.luas_bumi';
    public const kodeTanah = self::table. '.jns_bumi';

    protected $table = self::table;


}