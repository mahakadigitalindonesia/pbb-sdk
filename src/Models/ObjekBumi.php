<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class ObjekBumi extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $table = 'dat_op_bumi';
}