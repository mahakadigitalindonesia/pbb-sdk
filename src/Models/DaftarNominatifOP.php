<?php

namespace Mdigi\PBB\Models;

use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class DaftarNominatifOP extends Model
{
    use ConfigurableDatabaseConnection;

    protected $table = 'dafnom_op';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'thn_pembentukan';
    public $incrementing = false;
    public $timestamps = false;
}