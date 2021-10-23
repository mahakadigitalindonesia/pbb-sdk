<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Dtos\NOP;

interface TransaksiService
{
    public function findByNOP(NOP $nop);
    public function findByNOPAndTahun(NOP $nop, $tahun);
}