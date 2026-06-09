<?php

abstract class Pasien
{
    // Encapsulation
    protected $id_pasien;
    protected $nama;
    protected $usia;
    protected $lama_rawat;
    protected $biaya_kamar_per_hari;
    protected $jenis_pasien;

    // Constructor
    public function __construct(
        $id_pasien,
        $nama,
        $usia,
        $lama_rawat,
        $biaya_kamar_per_hari,
        $jenis_pasien
    ) {
        $this->id_pasien = $id_pasien;
        $this->nama = $nama;
        $this->usia = $usia;
        $this->lama_rawat = $lama_rawat;
        $this->biaya_kamar_per_hari = $biaya_kamar_per_hari;
        $this->jenis_pasien = $jenis_pasien;
    }

    // Getter
    public function getIdPasien()
    {
        return $this->id_pasien;
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
        return $this->lama_rawat;
    }

    public function getBiayaKamarPerHari()
    {
        return $this->biaya_kamar_per_hari;
    }

    public function getJenisPasien()
    {
        return $this->jenis_pasien;
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

    public function setLamaRawat($lama_rawat)
    {
        $this->lama_rawat = $lama_rawat;
    }

    public function setBiayaKamarPerHari($biaya)
    {
        $this->biaya_kamar_per_hari = $biaya;
    }

    // Method biasa
    public function tampilkanData()
    {
        echo "ID Pasien : " . $this->id_pasien . "<br>";
        echo "Nama : " . $this->nama . "<br>";
        echo "Usia : " . $this->usia . "<br>";
        echo "Lama Rawat : " . $this->lama_rawat . " Hari<br>";
        echo "Biaya Kamar/Hari : Rp " . number_format($this->biaya_kamar_per_hari, 0, ',', '.') . "<br>";
        echo "Jenis Pasien : " . $this->jenis_pasien . "<br>";
    }

    // Abstraction
    abstract public function hitungTotalBiaya();

    abstract public function cetakKlaimLayanan();
}
?>