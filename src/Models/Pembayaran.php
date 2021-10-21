<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Pembayaran extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'pembayaran_sppt';

    protected $table = self::table;

}