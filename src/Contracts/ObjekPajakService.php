<?php


namespace Mdigi\PBB\Contracts;

use Mdigi\PBB\Dtos\NOP;

interface ObjekPajakService
{
    public function findByNOP(NOP $nop);
}