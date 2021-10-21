<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Blok extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_peta_blok';

    protected $table = self::table;

}