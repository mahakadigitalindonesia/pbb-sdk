<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Kantor extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $table = 'ref_kantor';
}