<?php

namespace Mdigi\PBB\Contracts;

use Mdigi\PBB\Domains\DataObjekPajak;

interface DaftarNominatifService
{
    public function save(DataObjekPajak $objekPajak);
}