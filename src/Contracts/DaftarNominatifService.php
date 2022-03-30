<?php

namespace Mdigi\PBB\Contracts;

use Mdigi\PBB\Dtos\NOP;

interface DaftarNominatifService
{
    public function save(NOP $nop, string $nip);
}