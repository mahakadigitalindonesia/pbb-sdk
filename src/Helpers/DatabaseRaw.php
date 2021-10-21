<?php


namespace Mdigi\PBB\Helpers;


use Mdigi\PBB\Models\Ketetapan;

class DatabaseRaw
{
    const HITUNG_DENDA = 'hitung_denda';

    public static function hitungDenda()
    {
        $params = implode(',', [
            Ketetapan::tanggalJatuhTempo,
            Ketetapan::totalTagihanPajak,
        ]);
        return self::HITUNG_DENDA . '(' . $params . ') ';
    }
}