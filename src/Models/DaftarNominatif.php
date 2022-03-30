<?php

namespace Mdigi\PBB\Models;

use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class DaftarNominatif extends Model
{
    use ConfigurableDatabaseConnection;

    protected $table = 'dafnom_op';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'no_urut';
    public $incrementing = false;
    public $timestamps = false;
}