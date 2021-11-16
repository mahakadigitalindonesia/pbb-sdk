<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\DatabaseSwitch;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Kantor extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public function getTable()
    {
        return DatabaseSwitch::refKantor() ?? parent::getTable();
    }
}