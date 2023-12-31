<?php


namespace Mdigi\PBB\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mdigi\PBB\Helpers\OPColumns;
use Mdigi\PBB\Helpers\TransaksiColumns;
use Mdigi\PBB\Models\Traits\ConfigurableDatabaseConnection;

class Ketetapan extends Model
{
    use HasFactory, ConfigurableDatabaseConnection;

    public const table = 'sppt';
    public const allColumns = self::table . '.*';
    public const kodeProvinsi = self::table . '.' . OPColumns::kodeProvinsi;
    public const kodeDati = self::table . '.' . OPColumns::kodeDati;
    public const kodeKecamatan = self::table . '.' . OPColumns::kodeKecamatan;
    public const kodeKelurahan = self::table . '.' . OPColumns::kodeKelurahan;
    public const kodeBlok = self::table . '.' . OPColumns::kodeBlok;
    public const nomorUrut = self::table . '.' . OPColumns::nomorUrut;
    public const kodeJenis = self::table . '.' . OPColumns::kodeJenis;
    public const tahun = self::table . '.' . TransaksiColumns::tahun;
    public const tanggalJatuhTempo = self::table . '.tgl_jatuh_tempo_sppt';
    public const totalTagihanPajak = self::table . '.pbb_yg_harus_dibayar_sppt';
    public const statusPembayaran = self::table. '.status_pembayaran_sppt';


    protected $table = self::table;

    protected $appends = ['is_paid'];

    protected $dates = [
        'tgl_jatuh_tempo_sppt',
    ];

    public function getIsPaidAttribute()
    {
        return $this->status_pembayaran_sppt > 0;
    }

}