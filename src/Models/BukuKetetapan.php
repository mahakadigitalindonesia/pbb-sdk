<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class BukuKetetapan extends Model
{
    use  HasFactory, ConfigurableDatabaseConnection;

    public const table = 'ref_buku';
    protected $table = self::table;
}