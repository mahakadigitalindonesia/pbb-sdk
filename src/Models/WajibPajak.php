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
    public const kelurahan = self::table . '.kelurahan_wp';
    public const statusPekerjaan = self::table . '.status_pekerjaan_wp';
    public const nama = self::table . '.nm_wp';
    public const nik = self::table . '.subjek_pajak_id';
    public const jalan = self::table . '.jalan_wp';
    public const rt = self::table . '.rt_wp';
    public const rw = self::table . '.rw_wp';
    protected $table = self::table;

    protected $fillable = [
        'subjek_pajak_id',
        'nm_wp',
        'jalan_wp',
        'blok_kav_no_wp',
        'rw_wp',
        'rt_wp',
        'kelurahan_wp',
        'kota_wp',
        'kd_pos_wp',
        'telp_wp',
        'npwp',
        'status_pekerjaan_wp'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'subjek_pajak_id';
    public $incrementing = false;
    public $timestamps = false;
}