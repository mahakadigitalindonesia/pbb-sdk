<?php


namespace Mdigi\PBB\Helpers;


interface Fasilitas
{
    const AC_SPLIT = '01';
    const AC_WINDOWS = '02';
    const LISTRIK = '44';
    const KOLAM_RENANG = [
        KolamRenang::PLESTER => '12',
        KolamRenang::PELAPIS => '13',
    ];
    const PAGAR = [
        BahanPagar::BAJA_BESI => '35',
        BahanPagar::BATA_BATAKO => '36',
    ];

}