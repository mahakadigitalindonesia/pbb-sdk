<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class NomorBundel extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'temp_max_bundel';
}