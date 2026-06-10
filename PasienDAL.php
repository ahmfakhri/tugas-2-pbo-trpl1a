<?php

// Menghubungkan file DAL dengan file koneksi database
require_once __DIR__ . "/../koneksi.php";

// Menghubungkan file DAL dengan seluruh class model pasien
require_once __DIR__ . "/../models/pasienBPJS.php";
require_once __DIR__ . "/../models/pasienasuransiswasta.php";
require_once __DIR__ . "/../models/pasienumum.php";

/*
    Class PasienDAL
    DAL = Data Access Layer

    Tugas class ini:
    1. Mengambil data dari database
    2. Melakukan JOIN tabel pasien dengan tabel detail
    3. Mengubah data database menjadi object subclass:
       - PasienBPJS
       - PasienAsuransiSwasta
       - PasienUmum
*/
class PasienDAL extends Koneksi
{
    public function __construct()
    {
        // Memanggil constructor dari class Koneksi
        // agar $this->conn aktif dan bisa dipakai untuk query database
        parent::__construct();
    }

    /*
        Method getSemuaPasien()
        Digunakan untuk mengambil seluruh data pasien dari database.
        Data dari tabel utama pasien digabung dengan tabel detail:
        - pasien_bpjs
        - pasien_asuransi
        - pasien_umum
    */
    public function getSemuaPasien()
    {
        $query = "
            SELECT 
                pasien.id_pasien,
                pasien.nama,
                pasien.usia,
                pasien.lama_rawat,
                pasien.biaya_kamar_per_hari,
                pasien.jenis_pasien,

                pasien_bpjs.nomor_pbi,
                pasien_bpjs.faskes_asal,
                pasien_bpjs.kelas_kamar,

                pasien_asuransi.nama_provider,
                pasien_asuransi.nomor_polis,
                pasien_asuransi.limit_cover,

                pasien_umum.nik,
                pasien_umum.metode_pembayaran

            FROM pasien

            LEFT JOIN pasien_bpjs
                ON pasien.id_pasien = pasien_bpjs.id_pasien

            LEFT JOIN pasien_asuransi
                ON pasien.id_pasien = pasien_asuransi.id_pasien

            LEFT JOIN pasien_umum
                ON pasien.id_pasien = pasien_umum.id_pasien

            ORDER BY pasien.id_pasien ASC
        ";

        // Menjalankan query
        $result = $this->conn->query($query);

        // Jika query gagal, tampilkan pesan error
        if (!$result) {
            die("Query gagal: " . $this->conn->error);
        }

        // Array untuk menyimpan kumpulan object pasien
        $daftarPasien = [];

        // Mengambil data satu per satu dari hasil query
        while ($row = $result->fetch_assoc()) {
            // Mengubah baris data database menjadi object subclass
            $pasien = $this->ubahKeObjekPasien($row);

            // Jika object berhasil dibuat, masukkan ke array
            if ($pasien !== null) {
                $daftarPasien[] = $pasien;
            }
        }

        // Mengembalikan array berisi object PasienBPJS, PasienAsuransiSwasta, dan PasienUmum
        return $daftarPasien;
    }

    /*
        Method ubahKeObjekPasien()
        Digunakan untuk mengubah data array dari database
        menjadi object sesuai jenis pasien.

        Bagian ini penting untuk polymorphism.
    */
    private function ubahKeObjekPasien($row)
    {
        // jenis_pasien dari database berisi BPJS, ASURANSI, atau UMUM
        $jenisPasien = strtoupper($row["jenis_pasien"]);

        // Jika jenis pasien BPJS, buat object PasienBPJS
        if ($jenisPasien == "BPJS") {
            return new PasienBPJS(
                $row["id_pasien"],
                $row["nama"],
                $row["usia"],
                $row["lama_rawat"],
                $row["biaya_kamar_per_hari"],
                $row["nomor_pbi"] ?? "-",
                $row["faskes_asal"] ?? "-",
                $row["kelas_kamar"] ?? "-"
            );
        }

        // Jika jenis pasien ASURANSI, buat object PasienAsuransiSwasta
        if ($jenisPasien == "ASURANSI") {
            return new PasienAsuransiSwasta(
                $row["id_pasien"],
                $row["nama"],
                $row["usia"],
                $row["lama_rawat"],
                $row["biaya_kamar_per_hari"],
                $row["nama_provider"] ?? "-",
                $row["nomor_polis"] ?? "-",
                $row["limit_cover"] ?? 0
            );
        }

        // Jika jenis pasien UMUM, buat object PasienUmum
        if ($jenisPasien == "UMUM") {
            return new PasienUmum(
                $row["id_pasien"],
                $row["nama"],
                $row["usia"],
                $row["lama_rawat"],
                $row["biaya_kamar_per_hari"],
                $row["nik"] ?? "-",
                $row["metode_pembayaran"] ?? "-"
            );
        }

        // Jika jenis pasien tidak sesuai, tidak membuat object
        return null;
    }
}