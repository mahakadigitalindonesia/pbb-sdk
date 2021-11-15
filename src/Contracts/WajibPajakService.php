<?php


namespace Mdigi\PBB\Contracts;


use Mdigi\PBB\Domains\DataSubjekPajak;

interface WajibPajakService
{
    public function findById($id);

    public function save(DataSubjekPajak $subjekPajak);
}