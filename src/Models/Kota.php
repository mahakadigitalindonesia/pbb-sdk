<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Kota extends Model
{
    use  HasFactory, ConfigurableDatabaseConnection;

    public const table = 'ref_dati2';
    protected $table = self::table;
}