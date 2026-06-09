<?php

require_once 'Pasien.php';

class PasienAsuransiSwasta extends Pasien
{
    private $namaProvider;
    private $nomorPolis;
    private $limitCover;

    public function __construct(
        $idPasien,
        $nama,
        $usia,
        $lamaRawat,
        $biayaKamarPerHari,
        $namaProvider,
        $nomorPolis,
        $limitCover
    ) {
        parent::__construct(
            $idPasien,
            $nama,
            $usia,
            $lamaRawat,
            $biayaKamarPerHari,
            "Asuransi Swasta"
        );

        $this->namaProvider = $namaProvider;
        $this->nomorPolis = $nomorPolis;
        $this->limitCover = $limitCover;
    }

    public function getNamaProvider()
    {
        return $this->namaProvider;
    }

    public function getNomorPolis()
    {
        return $this->nomorPolis;
    }

    public function getLimitCover()
    {
        return $this->limitCover;
    }

    public function hitungTotalBiaya()
    {
        $biayaDasar = $this->hitungBiayaDasar();

        if ($biayaDasar > $this->limitCover) {
            return $biayaDasar - $this->limitCover;
        }

        return 0;
    }

    public function cetakKlaimLayanan()
    {
        return "
        <b>Pasien Asuransi Swasta</b><br>
        Nama : {$this->nama}<br>
        Provider : {$this->namaProvider}<br>
        Nomor Polis : {$this->nomorPolis}<br>
        Limit Cover : Rp " . number_format($this->limitCover, 0, ',', '.') . "<br>
        Total Tagihan : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.');
    }
}