<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupItem extends Model
{
    use HasFactory;

    protected $table = 'lookup_item';

    public function getConnectionName()
    {
        return config('pbb.database.connection', parent::getConnectionName());
    }
}