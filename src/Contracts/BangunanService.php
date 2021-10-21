<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Dtos\NOP;

interface BangunanService
{
    public function findByNOP(NOP $nop);
    public function findByNOPAndNomor(NOP $nop, int $nomor);
}