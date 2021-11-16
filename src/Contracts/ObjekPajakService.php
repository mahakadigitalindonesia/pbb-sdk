<?php


namespace Mdigi\PBB\Contracts;

use Mdigi\PBB\Domains\DataObjekPajak;
use Mdigi\PBB\Dtos\NOP;

interface ObjekPajakService
{
    public function findByNOP(NOP $nop);

    public function save(DataObjekPajak $objekPajak);

    public function delete(NOP $nop);
}