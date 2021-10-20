<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class LookupItem extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $table = 'lookup_item';
}