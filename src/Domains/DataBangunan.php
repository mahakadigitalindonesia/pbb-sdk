<?php


namespace Mdigi\PBB\Domains;


class DataBangunan
{
    private $kodeProvinsi;
    private $kodeDati;
    private $kodeKecamatan;
    private $kodeKelurahan;
    private $kodeBlok;
    private $nomorUrut;
    private $kodeJenis;
    private $nomor;
    private $kodeJPB;
    private $nomorFormulirLSPOP;
    private $tahunDibangun;
    private $tahunDirenovasi;
    private $luas;
    private $jumlahLantai;
    private $kondisi;
    private $konstruksi;
    private $atap;
    private $dinding;
    private $lantai;
    private $langit;

    /* FASILITAS */
    private $listrik;
    private $jumlahAcSplit;
    private $jumlahAcWindow;
    private $acCentral;
    private $luasKolam;
    private $plesterKolam;
    private $luasPerkerasanHalaman;
    private $panjangPagar;
    private $bahanPagar;
    private $kedalamanSumur;
    /* END OF FASILITAS */

    private $jenisTransaksi;
    private $tanggalPendataan;
    private $nipPendata;
    private $tanggalPemeriksaan;
    private $nipPemeriksa;
    private $nipPerekam;

    /**
     * DataBangunan constructor.
     * @param $kodeProvinsi
     * @param $kodeDati
     * @param $kodeKecamatan
     * @param $kodeKelurahan
     * @param $kodeBlok
     * @param $nomorUrut
     * @param $kodeJenis
     * @param $nomor
     * @param $kodeJPB
     * @param $nomorFormulirLSPOP
     * @param $tahunDibangun
     * @param $tahunDirenovasi
     * @param $luas
     * @param $jumlahLantai
     * @param $kondisi
     * @param $konstruksi
     * @param $atap
     * @param $dinding
     * @param $lantai
     * @param $langit
     * @param $listrik
     * @param $jumlahAcSplit
     * @param $jumlahAcWindow
     * @param $acCentral
     * @param $luasKolam
     * @param $plesterKolam
     * @param $luasPerkerasanHalaman
     * @param $panjangPagar
     * @param $bahanPagar
     * @param $kedalamanSumur
     * @param $jenisTransaksi
     * @param $tanggalPendataan
     * @param $nipPendata
     * @param $tanggalPemeriksaan
     * @param $nipPemeriksa
     * @param $nipPerekam
     */
    public function __construct($kodeProvinsi, $kodeDati, $kodeKecamatan, $kodeKelurahan, $kodeBlok, $nomorUrut, $kodeJenis, $nomor, $kodeJPB, $nomorFormulirLSPOP, $tahunDibangun, $tahunDirenovasi, $luas, $jumlahLantai, $kondisi, $konstruksi, $atap, $dinding, $lantai, $langit, $listrik, $jumlahAcSplit, $jumlahAcWindow, $acCentral, $luasKolam, $plesterKolam, $luasPerkerasanHalaman, $panjangPagar, $bahanPagar, $kedalamanSumur, $jenisTransaksi, $tanggalPendataan, $nipPendata, $tanggalPemeriksaan, $nipPemeriksa, $nipPerekam)
    {
        $this->kodeProvinsi = $kodeProvinsi;
        $this->kodeDati = $kodeDati;
        $this->kodeKecamatan = $kodeKecamatan;
        $this->kodeKelurahan = $kodeKelurahan;
        $this->kodeBlok = $kodeBlok;
        $this->nomorUrut = $nomorUrut;
        $this->kodeJenis = $kodeJenis;
        $this->nomor = $nomor;
        $this->kodeJPB = $kodeJPB;
        $this->nomorFormulirLSPOP = $nomorFormulirLSPOP;
        $this->tahunDibangun = $tahunDibangun;
        $this->tahunDirenovasi = $tahunDirenovasi;
        $this->luas = $luas;
        $this->jumlahLantai = $jumlahLantai;
        $this->kondisi = $kondisi;
        $this->konstruksi = $konstruksi;
        $this->atap = $atap;
        $this->dinding = $dinding;
        $this->lantai = $lantai;
        $this->langit = $langit;
        $this->listrik = $listrik;
        $this->jumlahAcSplit = $jumlahAcSplit;
        $this->jumlahAcWindow = $jumlahAcWindow;
        $this->acCentral = $acCentral;
        $this->luasKolam = $luasKolam;
        $this->plesterKolam = $plesterKolam;
        $this->luasPerkerasanHalaman = $luasPerkerasanHalaman;
        $this->panjangPagar = $panjangPagar;
        $this->bahanPagar = $bahanPagar;
        $this->kedalamanSumur = $kedalamanSumur;
        $this->jenisTransaksi = $jenisTransaksi;
        $this->tanggalPendataan = $tanggalPendataan;
        $this->nipPendata = $nipPendata;
        $this->tanggalPemeriksaan = $tanggalPemeriksaan;
        $this->nipPemeriksa = $nipPemeriksa;
        $this->nipPerekam = $nipPerekam;
    }

    /**
     * @return mixed
     */
    public function getKodeProvinsi()
    {
        return $this->kodeProvinsi;
    }

    /**
     * @return mixed
     */
    public function getKodeDati()
    {
        return $this->kodeDati;
    }

    /**
     * @return mixed
     */
    public function getKodeKecamatan()
    {
        return $this->kodeKecamatan;
    }

    /**
     * @return mixed
     */
    public function getKodeKelurahan()
    {
        return $this->kodeKelurahan;
    }

    /**
     * @return mixed
     */
    public function getKodeBlok()
    {
        return $this->kodeBlok;
    }

    /**
     * @return mixed
     */
    public function getNomorUrut()
    {
        return $this->nomorUrut;
    }

    /**
     * @return mixed
     */
    public function getKodeJenis()
    {
        return $this->kodeJenis;
    }

    /**
     * @return mixed
     */
    public function getNomor()
    {
        return $this->nomor;
    }

    /**
     * @return mixed
     */
    public function getKodeJPB()
    {
        return $this->kodeJPB;
    }

    /**
     * @return mixed
     */
    public function getNomorFormulirLSPOP()
    {
        return $this->nomorFormulirLSPOP;
    }

    /**
     * @return mixed
     */
    public function getTahunDibangun()
    {
        return $this->tahunDibangun;
    }

    /**
     * @return mixed
     */
    public function getTahunDirenovasi()
    {
        return $this->tahunDirenovasi;
    }

    /**
     * @return mixed
     */
    public function getLuas()
    {
        return $this->luas;
    }

    /**
     * @return mixed
     */
    public function getJumlahLantai()
    {
        return $this->jumlahLantai;
    }

    /**
     * @return mixed
     */
    public function getKondisi()
    {
        return $this->kondisi;
    }

    /**
     * @return mixed
     */
    public function getKonstruksi()
    {
        return $this->konstruksi;
    }

    /**
     * @return mixed
     */
    public function getAtap()
    {
        return $this->atap;
    }

    /**
     * @return mixed
     */
    public function getDinding()
    {
        return $this->dinding;
    }

    /**
     * @return mixed
     */
    public function getLantai()
    {
        return $this->lantai;
    }

    /**
     * @return mixed
     */
    public function getLangit()
    {
        return $this->langit;
    }

    /**
     * @return mixed
     */
    public function getListrik()
    {
        return $this->listrik;
    }

    /**
     * @return mixed
     */
    public function getJumlahAcSplit()
    {
        return $this->jumlahAcSplit;
    }

    /**
     * @return mixed
     */
    public function getJumlahAcWindow()
    {
        return $this->jumlahAcWindow;
    }

    /**
     * @return mixed
     */
    public function getAcCentral()
    {
        return $this->acCentral;
    }

    /**
     * @return mixed
     */
    public function getLuasKolam()
    {
        return $this->luasKolam;
    }

    /**
     * @return mixed
     */
    public function getPlesterKolam()
    {
        return $this->plesterKolam;
    }

    /**
     * @return mixed
     */
    public function getLuasPerkerasanHalaman()
    {
        return $this->luasPerkerasanHalaman;
    }

    /**
     * @return mixed
     */
    public function getPanjangPagar()
    {
        return $this->panjangPagar;
    }

    /**
     * @return mixed
     */
    public function getBahanPagar()
    {
        return $this->bahanPagar;
    }

    /**
     * @return mixed
     */
    public function getKedalamanSumur()
    {
        return $this->kedalamanSumur;
    }

    /**
     * @return mixed
     */
    public function getJenisTransaksi()
    {
        return $this->jenisTransaksi;
    }

    /**
     * @return mixed
     */
    public function getTanggalPendataan()
    {
        return $this->tanggalPendataan;
    }

    /**
     * @return mixed
     */
    public function getNipPendata()
    {
        return $this->nipPendata;
    }

    /**
     * @return mixed
     */
    public function getTanggalPemeriksaan()
    {
        return $this->tanggalPemeriksaan;
    }

    /**
     * @return mixed
     */
    public function getNipPemeriksa()
    {
        return $this->nipPemeriksa;
    }

    /**
     * @return mixed
     */
    public function getNipPerekam()
    {
        return $this->nipPerekam;
    }

    public static function builder()
    {
        return new DataBangunanBuilder();
    }

}

class DataBangunanBuilder
{
    private $kodeProvinsi;
    private $kodeDati;
    private $kodeKecamatan;
    private $kodeKelurahan;
    private $kodeBlok;
    private $nomorUrut;
    private $kodeJenis;
    private $nomor;
    private $kodeJPB;
    private $nomorFormulirLSPOP;
    private $tahunDibangun;
    private $tahunDirenovasi;
    private $luas;
    private $jumlahLantai;
    private $kondisi;
    private $konstruksi;
    private $atap;
    private $dinding;
    private $lantai;
    private $langit;

    /* FASILITAS */
    private $listrik;
    private $jumlahAcSplit;
    private $jumlahAcWindow;
    private $acCentral;
    private $luasKolam;
    private $plesterKolam;
    private $luasPerkerasanHalaman;
    private $panjangPagar;
    private $bahanPagar;
    private $kedalamanSumur;
    /* END OF FASILITAS */

    private $jenisTransaksi;
    private $tanggalPendataan;
    private $nipPendata;
    private $tanggalPemeriksaan;
    private $nipPemeriksa;
    private $nipPerekam;

    /**
     * @param mixed $kodeProvinsi
     * @return DataBangunanBuilder
     */
    public function kodeProvinsi($kodeProvinsi)
    {
        $this->kodeProvinsi = $kodeProvinsi;
        return $this;
    }

    /**
     * @param mixed $kodeDati
     * @return DataBangunanBuilder
     */
    public function kodeDati($kodeDati)
    {
        $this->kodeDati = $kodeDati;
        return $this;
    }

    /**
     * @param mixed $kodeKecamatan
     * @return DataBangunanBuilder
     */
    public function kodeKecamatan($kodeKecamatan)
    {
        $this->kodeKecamatan = $kodeKecamatan;
        return $this;
    }

    /**
     * @param mixed $kodeKelurahan
     * @return DataBangunanBuilder
     */
    public function kodeKelurahan($kodeKelurahan)
    {
        $this->kodeKelurahan = $kodeKelurahan;
        return $this;
    }

    /**
     * @param mixed $kodeBlok
     * @return DataBangunanBuilder
     */
    public function kodeBlok($kodeBlok)
    {
        $this->kodeBlok = $kodeBlok;
        return $this;
    }

    /**
     * @param mixed $nomorUrut
     * @return DataBangunanBuilder
     */
    public function nomorUrut($nomorUrut)
    {
        $this->nomorUrut = $nomorUrut;
        return $this;
    }

    /**
     * @param mixed $kodeJenis
     * @return DataBangunanBuilder
     */
    public function kodeJenis($kodeJenis)
    {
        $this->kodeJenis = $kodeJenis;
        return $this;
    }

    /**
     * @param mixed $nomor
     * @return DataBangunanBuilder
     */
    public function nomor($nomor)
    {
        $this->nomor = $nomor;
        return $this;
    }

    /**
     * @param mixed $kodeJPB
     * @return DataBangunanBuilder
     */
    public function kodeJPB($kodeJPB)
    {
        $this->kodeJPB = $kodeJPB;
        return $this;
    }

    /**
     * @param mixed $nomorFormulirLSPOP
     * @return DataBangunanBuilder
     */
    public function nomorFormulirLSPOP($nomorFormulirLSPOP)
    {
        $this->nomorFormulirLSPOP = $nomorFormulirLSPOP;
        return $this;
    }

    /**
     * @param mixed $tahunDibangun
     * @return DataBangunanBuilder
     */
    public function tahunDibangun($tahunDibangun)
    {
        $this->tahunDibangun = $tahunDibangun;
        return $this;
    }

    /**
     * @param mixed $tahunDirenovasi
     * @return DataBangunanBuilder
     */
    public function tahunDirenovasi($tahunDirenovasi)
    {
        $this->tahunDirenovasi = $tahunDirenovasi;
        return $this;
    }

    /**
     * @param mixed $luas
     * @return DataBangunanBuilder
     */
    public function luas($luas)
    {
        $this->luas = $luas;
        return $this;
    }

    /**
     * @param mixed $jumlahLantai
     * @return DataBangunanBuilder
     */
    public function jumlahLantai($jumlahLantai)
    {
        $this->jumlahLantai = $jumlahLantai;
        return $this;
    }

    /**
     * @param mixed $kondisi
     * @return DataBangunanBuilder
     */
    public function kondisi($kondisi)
    {
        $this->kondisi = $kondisi;
        return $this;
    }

    /**
     * @param mixed $konstruksi
     * @return DataBangunanBuilder
     */
    public function konstruksi($konstruksi)
    {
        $this->konstruksi = $konstruksi;
        return $this;
    }

    /**
     * @param mixed $atap
     * @return DataBangunanBuilder
     */
    public function atap($atap)
    {
        $this->atap = $atap;
        return $this;
    }

    /**
     * @param mixed $dinding
     * @return DataBangunanBuilder
     */
    public function dinding($dinding)
    {
        $this->dinding = $dinding;
        return $this;
    }

    /**
     * @param mixed $lantai
     * @return DataBangunanBuilder
     */
    public function lantai($lantai)
    {
        $this->lantai = $lantai;
        return $this;
    }

    /**
     * @param mixed $langit
     * @return DataBangunanBuilder
     */
    public function langit($langit)
    {
        $this->langit = $langit;
        return $this;
    }

    /**
     * @param mixed $listrik
     * @return DataBangunanBuilder
     */
    public function listrik($listrik)
    {
        $this->listrik = $listrik;
        return $this;
    }

    /**
     * @param mixed $jumlahAcSplit
     * @return DataBangunanBuilder
     */
    public function jumlahAcSplit($jumlahAcSplit)
    {
        $this->jumlahAcSplit = $jumlahAcSplit;
        return $this;
    }

    /**
     * @param mixed $jumlahAcWindow
     * @return DataBangunanBuilder
     */
    public function jumlahAcWindow($jumlahAcWindow)
    {
        $this->jumlahAcWindow = $jumlahAcWindow;
        return $this;
    }

    /**
     * @param mixed $acCentral
     * @return DataBangunanBuilder
     */
    public function acCentral($acCentral)
    {
        $this->acCentral = $acCentral;
        return $this;
    }

    /**
     * @param mixed $luasKolam
     * @return DataBangunanBuilder
     */
    public function luasKolam($luasKolam)
    {
        $this->luasKolam = $luasKolam;
        return $this;
    }

    /**
     * @param mixed $plesterKolam
     * @return DataBangunanBuilder
     */
    public function plesterKolam($plesterKolam)
    {
        $this->plesterKolam = $plesterKolam;
        return $this;
    }

    /**
     * @param mixed $luasPerkerasanHalaman
     * @return DataBangunanBuilder
     */
    public function luasPerkerasanHalaman($luasPerkerasanHalaman)
    {
        $this->luasPerkerasanHalaman = $luasPerkerasanHalaman;
        return $this;
    }

    /**
     * @param mixed $panjangPagar
     * @return DataBangunanBuilder
     */
    public function panjangPagar($panjangPagar)
    {
        $this->panjangPagar = $panjangPagar;
        return $this;
    }

    /**
     * @param mixed $bahanPagar
     * @return DataBangunanBuilder
     */
    public function bahanPagar($bahanPagar)
    {
        $this->bahanPagar = $bahanPagar;
        return $this;
    }

    /**
     * @param mixed $kedalamanSumur
     * @return DataBangunanBuilder
     */
    public function kedalamanSumur($kedalamanSumur)
    {
        $this->kedalamanSumur = $kedalamanSumur;
        return $this;
    }

    /**
     * @param mixed $jenisTransaksi
     * @return DataBangunanBuilder
     */
    public function jenisTransaksi($jenisTransaksi)
    {
        $this->jenisTransaksi = $jenisTransaksi;
        return $this;
    }

    /**
     * @param mixed $tanggalPendataan
     * @return DataBangunanBuilder
     */
    public function tanggalPendataan($tanggalPendataan)
    {
        $this->tanggalPendataan = $tanggalPendataan;
        return $this;
    }

    /**
     * @param mixed $nipPendata
     * @return DataBangunanBuilder
     */
    public function nipPendata($nipPendata)
    {
        $this->nipPendata = $nipPendata;
        return $this;
    }

    /**
     * @param mixed $tanggalPemeriksaan
     * @return DataBangunanBuilder
     */
    public function tanggalPemeriksaan($tanggalPemeriksaan)
    {
        $this->tanggalPemeriksaan = $tanggalPemeriksaan;
        return $this;
    }

    /**
     * @param mixed $nipPemeriksa
     * @return DataBangunanBuilder
     */
    public function nipPemeriksa($nipPemeriksa)
    {
        $this->nipPemeriksa = $nipPemeriksa;
        return $this;
    }

    /**
     * @param mixed $nipPerekam
     * @return DataBangunanBuilder
     */
    public function nipPerekam($nipPerekam)
    {
        $this->nipPerekam = $nipPerekam;
        return $this;
    }

    public function build()
    {
        return new DataBangunan(
            $this->kodeProvinsi,
            $this->kodeDati,
            $this->kodeKecamatan,
            $this->kodeKelurahan,
            $this->kodeBlok,
            $this->nomorUrut,
            $this->kodeJenis,
            $this->nomor,
            $this->kodeJPB,
            $this->nomorFormulirLSPOP,
            $this->tahunDibangun,
            $this->tahunDirenovasi,
            $this->luas,
            $this->jumlahLantai,
            $this->kondisi,
            $this->konstruksi,
            $this->atap,
            $this->dinding,
            $this->lantai,
            $this->langit,
            $this->listrik,
            $this->jumlahAcSplit,
            $this->jumlahAcWindow,
            $this->acCentral,
            $this->luasKolam,
            $this->plesterKolam,
            $this->luasPerkerasanHalaman,
            $this->panjangPagar,
            $this->bahanPagar,
            $this->kedalamanSumur,
            $this->jenisTransaksi,
            $this->tanggalPendataan,
            $this->nipPendata,
            $this->tanggalPemeriksaan,
            $this->nipPemeriksa,
            $this->nipPerekam
        );
    }


}