<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class FasilitasBangunan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $table = 'dat_fasilitas_bangunan';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'no_bng';
    public $timestamps = false;
    public $incrementing = false;
}