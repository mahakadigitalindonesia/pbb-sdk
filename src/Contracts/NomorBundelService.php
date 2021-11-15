<?php


namespace Mdigi\PBB\Contracts;


/**
 * Interface NomorBundelService
 * @package Mdigi\PBB\Contracts
 */
interface NomorBundelService
{
    /**
     * @param null $year
     * @return mixed
     */
    public function findOrCreate($year = null);

    /**
     * @param $year
     * @param $nomorBundel
     * @param $nomorUrut
     * @return mixed
     */
    public function updateOrCreate($year, $nomorBundel, $nomorUrut);
}