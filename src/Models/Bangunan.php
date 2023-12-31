<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Bangunan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;
    public const table = 'dat_op_bangunan';
    protected $table = self::table;
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'no_formulir_lspop';
    public $timestamps = false;
    public $incrementing = false;
}