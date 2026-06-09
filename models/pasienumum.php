<?php

require_once 'Pasien.php';

class PasienUmum extends Pasien
{
    private $nik;
    private $metodePembayaran;

    public function __construct(
        $idPasien,
        $nama,
        $usia,
        $lamaRawat,
        $biayaKamarPerHari,
        $nik,
        $metodePembayaran
    ) {
        parent::__construct(
            $idPasien,
            $nama,
            $usia,
            $lamaRawat,
            $biayaKamarPerHari,
            "Umum"
        );

        $this->nik = $nik;
        $this->metodePembayaran = $metodePembayaran;
    }

    public function getNik()
    {
        return $this->nik;
    }

    public function getMetodePembayaran()
    {
        return $this->metodePembayaran;
    }

    public function hitungTotalBiaya()
    {
        return $this->hitungBiayaDasar() + 150000;
    }

    public function cetakKlaimLayanan()
    {
        return "
        <b>Pasien Umum</b><br>
        Nama : {$this->nama}<br>
        NIK : {$this->nik}<br>
        Metode Pembayaran : {$this->metodePembayaran}<br>
        Total Tagihan : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.');
    }
}