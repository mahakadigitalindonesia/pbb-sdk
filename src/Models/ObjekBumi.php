<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class ObjekBumi extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $table = 'dat_op_bumi';
    protected $guarded = [];
    protected $primaryKey = 'no_bumi';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}