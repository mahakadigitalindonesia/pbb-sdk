<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class WajibPajak extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;
    public const table = 'dat_subjek_pajak';
    public const allColumns = self::table . '.*';
    public const kelurahan = self::table. '.kelurahan_wp';
    public const statusPekerjaan = self::table. '.status_pekerjaan_wp';
    public const nama = self::table. '.nm_wp';
    protected $table = self::table;

    protected $guarded = [];
}