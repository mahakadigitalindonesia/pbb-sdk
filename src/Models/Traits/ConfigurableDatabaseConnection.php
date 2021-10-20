<?php


namespace Mdigi\PBB\Models\Traits;


trait ConfigurableDatabaseConnection
{
    public function getConnectionName()
    {
        return config('pbb.database.connection', parent::getConnectionName());
    }
}