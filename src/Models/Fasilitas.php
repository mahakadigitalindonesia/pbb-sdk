<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    public const table = 'fasilitas';
    protected $table = self::table;
    protected $keyType = 'string';
    protected $primaryKey = 'kd_fasilitas';

    public $incrementing = false;
    public $timestamps = false;
}