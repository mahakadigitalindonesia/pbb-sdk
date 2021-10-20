<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Kelurahan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'ref_kelurahan';
    public const kodeKelurahan = self::table . '.kd_kelurahan';
    public const namaKelurahan = self::table . '.nm_kelurahan';
    public const kodeKecamatan = self::table . '.kd_kecamatan';

    protected $table = self::table;


}