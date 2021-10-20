<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Kecamatan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'ref_kecamatan';
    public const kodeKecamatan = self::table . '.kd_kecamatan';
    public const namaKecamatan = self::table . '.nm_kecamatan';

    protected $table = self::table;


}