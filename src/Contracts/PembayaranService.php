<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Dtos\NOP;

interface PembayaranService
{
    public function findByNOP(NOP $nop);
    public function findByNOPAndTahun(NOP $nop, $tahun);
}