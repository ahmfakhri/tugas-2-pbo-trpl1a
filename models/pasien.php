<?php

// Abstract Class: menerapkan Abstraction
abstract class Pasien
{
    // Encapsulation: atribut dibuat protected agar hanya bisa diakses class induk dan subclass
    protected $idPasien;
    protected $nama;
    protected $usia;
    protected $lamaRawat;
    protected $biayaKamarPerHari;
    protected $jenisPasien;

    // Constructor
    public function __construct($idPasien, $nama, $usia, $lamaRawat, $biayaKamarPerHari, $jenisPasien = null)
    {
        $this->idPasien = $idPasien;
        $this->nama = $nama;
        $this->usia = $usia;
        $this->lamaRawat = $lamaRawat;
        $this->biayaKamarPerHari = $biayaKamarPerHari;
        $this->jenisPasien = $jenisPasien;
    }

    // Getter
    public function getIdPasien()
    {
        return $this->idPasien;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getUsia()
    {
        return $this->usia;
    }

    public function getLamaRawat()
    {
        return $this->lamaRawat;
    }

    public function getBiayaKamarPerHari()
    {
        return $this->biayaKamarPerHari;
    }

    public function getJenisPasien()
    {
        return $this->jenisPasien;
    }

    // Setter
    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function setUsia($usia)
    {
        $this->usia = $usia;
    }

    public function setLamaRawat($lamaRawat)
    {
        $this->lamaRawat = $lamaRawat;
    }

    public function setBiayaKamarPerHari($biayaKamarPerHari)
    {
        $this->biayaKamarPerHari = $biayaKamarPerHari;
    }

    public function setJenisPasien($jenisPasien)
    {
        $this->jenisPasien = $jenisPasien;
    }

    // Method umum untuk menghitung biaya dasar rawat inap
    public function hitungBiayaDasar()
    {
        return $this->lamaRawat * $this->biayaKamarPerHari;
    }

    // Abstract Method: wajib dioverride oleh subclass
    abstract public function hitungTotalBiaya();

    abstract public function cetakKlaimLayanan();
}