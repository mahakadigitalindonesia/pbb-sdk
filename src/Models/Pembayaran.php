<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Helpers\TransaksiColumns;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Pembayaran extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'pembayaran_sppt';
    public const kodeProvinsi = self::table . '.' . OPColumns::kodeProvinsi;
    public const kodeDati = self::table . '.' . OPColumns::kodeDati;
    public const kodeKecamatan = self::table . '.' . OPColumns::kodeKecamatan;
    public const kodeKelurahan = self::table . '.' . OPColumns::kodeKelurahan;
    public const kodeBlok = self::table . '.' . OPColumns::kodeBlok;
    public const nomorUrut = self::table . '.' . OPColumns::nomorUrut;
    public const kodeJenis = self::table . '.' . OPColumns::kodeJenis;
    public const tahun = self::table . '.' . TransaksiColumns::tahun;
    public const pembayaranKe = self::table. '.pembayaran_sppt_ke';
    public const tanggalPembayaran = self::table. '.tgl_pembayaran_sppt';
    public const jumlahPembayaran = self::table. '.jml_sppt_yg_dibayar';
    public const denda = self::table. '.denda_sppt';

    protected $table = self::table;

    protected $dates = [
        'tgl_pembayaran_sppt'
    ];

}