<?php


namespace Mdigi\PBB\Helpers;


abstract class DatabaseSwitch
{
    private const SIMPBB = 'SIMPBB';
    private const SISMIOP = 'SISMIOP';

    static $KANTOR_MAP = [
        self::SIMPBB => 'kantor',
        self::SISMIOP => 'kppbb',
    ];

    public static function refKantor()
    {
        return 'ref_' . self::getKantor();
    }

    public static function kodeKantor()
    {
        return 'kd_' . self::getKantor();
    }

    public static function namaKantor()
    {
        return 'nm_' . self::getKantor();
    }

    public static function getKantor()
    {
        return self::$KANTOR_MAP[config('pbb.database.type', self::SIMPBB)];
    }
}