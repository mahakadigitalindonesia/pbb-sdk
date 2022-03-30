<?php

namespace Mdigi\PBB\Models;

use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class DaftarNominatifPiutang extends Model
{
    use ConfigurableDatabaseConnection;

    protected $table = 'dafnom_piutang';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'no_urut';
    public $incrementing = false;
    public $timestamps = false;
}