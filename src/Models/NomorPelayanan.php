<?php

namespace Mdigi\PBB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class NomorPelayanan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    protected $keyType = 'string';
    protected $primaryKey = 'no_urut_pelayanan';
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'max_urut_pst';

    protected $guarded = [];
}