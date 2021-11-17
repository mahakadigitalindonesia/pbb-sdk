<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class FasilitasBangunan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_fasilitas_bangunan';

    protected $table = self::table;
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'no_bng';
    public $timestamps = false;
    public $incrementing = false;

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'kd_fasilitas', 'kd_fasilitas');
    }
}