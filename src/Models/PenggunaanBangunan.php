<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class PenggunaanBangunan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const TANAH_DIBANGUN = '00';
    public const PERUMAHAN = '01';
    public const PERKANTORAN_SWASTA = '02';
    public const PABRIK = '03';
    public const TOKO_APOTIK_PASAR_RUKO = '04';
    public const RUMAH_SAKIT_KLINIK = '05';
    public const OLAHRAGA_REKREASI = '06';
    public const HOTEL_WISMA = '07';
    public const BENGKEL_GUDANG_PERTANIAN = '08';
    public const GEDUNG_PEMERINTAHAN = '09';
    public const LAIN_LAIN = '10';
    public const BANGUNAN_TIDAK_KENA_PAJAK = '11';
    public const BANGUNAN_PARKIR = '12';
    public const APARTEMENT = '13';
    public const POMPA_BENSIN = '14';
    public const TANGKI_MINYAK = '15';
    public const GEDUNG_SEKOLAH = '16';
    public const TANAH_KOSONG = '50';

    public const table = 'jpb_jpt';
    protected $table = self::table;

}