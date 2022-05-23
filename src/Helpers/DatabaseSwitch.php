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

    static $TABLE_REF_JPB_MAP = [
        self::SIMPBB => 'ref_jpb',
        self::SISMIOP => 'jpb_jpt',
    ];

    static $COLUMN_KD_JPB_MAP = [
        self::SIMPBB => 'kd_jpb',
        self::SISMIOP => 'kd_jpb_jpt',
    ];

    static $COLUMN_NM_JPB_MAP = [
        self::SIMPBB => 'nm_jpb',
        self::SISMIOP => 'nm_jpb_jpt',
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

    public static function tableRefJPB()
    {
        return self::$TABLE_REF_JPB_MAP[config('pbb.database.type', self::SIMPBB)];
    }

    public static function columnKodeJPB()
    {
        return self::$COLUMN_KD_JPB_MAP[config('pbb.database.type', self::SIMPBB)];
    }

    public static function columnNamaJPB()
    {
        return self::$COLUMN_NM_JPB_MAP[config('pbb.database.type', self::SIMPBB)];
    }
}