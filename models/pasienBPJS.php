<?php

require_once 'Pasien.php';

class PasienBPJS extends Pasien
{
    private $nomorPBI;
    private $faskesAsal;
    private $kelasKamar;

    public function __construct(
        $idPasien,
        $nama,
        $usia,
        $lamaRawat,
        $biayaKamarPerHari,
        $nomorPBI,
        $faskesAsal,
        $kelasKamar
    ) {
        parent::__construct(
            $idPasien,
            $nama,
            $usia,
            $lamaRawat,
            $biayaKamarPerHari,
            "BPJS"
        );

        $this->nomorPBI = $nomorPBI;
        $this->faskesAsal = $faskesAsal;
        $this->kelasKamar = $kelasKamar;
    }

    public function getNomorPBI()
    {
        return $this->nomorPBI;
    }

    public function getFaskesAsal()
    {
        return $this->faskesAsal;
    }

    public function getKelasKamar()
    {
        return $this->kelasKamar;
    }

    public function hitungTotalBiaya()
    {
        return $this->hitungBiayaDasar() * 0.10;
    }

    public function cetakKlaimLayanan()
    {
        return "
        <b>Pasien BPJS</b><br>
        Nama : {$this->nama}<br>
        Nomor PBI : {$this->nomorPBI}<br>
        Faskes Asal : {$this->faskesAsal}<br>
        Kelas Kamar : {$this->kelasKamar}<br>
        Total Tagihan : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.');
    }
}