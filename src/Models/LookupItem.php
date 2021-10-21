<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class LookupItem extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'lookup_item';
    public const kodeGroup = self::table . '.kd_lookup_group';
    public const kodeItem = self::table . '.kd_lookup_item';
    public const namaItem = self::table . '.nm_lookup_item';

    protected $table = self::table;
}