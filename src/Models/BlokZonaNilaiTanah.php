<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class BlokZonaNilaiTanah extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'dat_peta_znt';

    protected $table = self::table;

}