<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Domains\DataBangunan;
use Mdigi\PBB\Dtos\NOP;

interface BangunanService
{
    public function findByNOP(NOP $nop);

    public function findByNOPAndNomor(NOP $nop, int $nomor);

    public function penggunaanBangunan($kodeJPB = null);

    public function save(DataBangunan $bangunan);
}