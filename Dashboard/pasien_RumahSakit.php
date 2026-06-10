<?php
// pasien_RumahSakit.php

// 1. Koneksi.php berada langsung di folder utama (naik 1 tingkat)
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Koneksi.php'; 

// 2. File model berada di dalam folder 'models' (naik 1 tingkat, lalu masuk ke folder models)
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'pasien.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'pasienumum.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'pasienBPJS.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'pasienasuransiswasta.php';

// Melakukan extends ke class Koneksi agar bisa menggunakan atribut database ($this->conn)
class PasienController extends Koneksi
{
    public function __construct()
    {
        // Memanggil constructor milik class Koneksi untuk mengaktifkan objek mysqli
        parent::__construct();
    }

    /**
     * Menampilkan semua data pasien dari database menggunakan mysqli dan menjadikannya Objek OOP
     */
   public function tampilkanSemuaPasien()
    {
        $daftarPasien = [];

        // Query tunggal menggabungkan semua tabel jaminan dan diurutkan berdasarkan ID Pasien utama
        $query = "SELECT p.*, 
                         b.nomor_pbi, b.faskes_asal, b.kelas_kamar,
                         a.nama_provider, a.nomor_polis, a.limit_cover,
                         u.nik, u.metode_pembayaran
                  FROM pasien p
                  LEFT JOIN pasien_bpjs b ON p.id_pasien = b.id_pasien
                  LEFT JOIN pasien_asuransi a ON p.id_pasien = a.id_pasien
                  LEFT JOIN pasien_umum u ON p.id_pasien = u.id_pasien
                  ORDER BY p.id_pasien ASC";

        $result = $this->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Identifikasi instansiasi objek berdasarkan kolom data yang tersedia
                if (!empty($row['nomor_pbi'])) {
                    $daftarPasien[] = new PasienBPJS(
                        $row['id_pasien'], $row['nama'], $row['usia'], 
                        $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                        $row['nomor_pbi'], $row['faskes_asal'], $row['kelas_kamar']
                    );
                } elseif (!empty($row['nama_provider'])) {
                    $daftarPasien[] = new PasienAsuransiSwasta(
                        $row['id_pasien'], $row['nama'], $row['usia'], 
                        $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                        $row['nama_provider'], $row['nomor_polis'], $row['limit_cover']
                    );
                } elseif (!empty($row['nik'])) {
                    $daftarPasien[] = new PasienUmum(
                        $row['id_pasien'], $row['nama'], $row['usia'], 
                        $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                        $row['nik'], $row['metode_pembayaran']
                    );
                }
            }
        }

        return $daftarPasien;
    }
    /**
     * Memanggil fungsi cetak klaim dari seluruh objek pasien hasil database
     */
    public function cetakSemuaKlaim()
    {
        $daftarPasien = $this->tampilkanSemuaPasien();

        if (empty($daftarPasien)) {
            return "<p>Tidak ada data pasien di database dbrumahsakit.</p>";
        }

        $html = "";
        foreach ($daftarPasien as $pasien) {
            $html .= "<div style='border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 6px; background-color: #fafafa;'>";
            // Polymorphism: mencetak sesuai tipe objek anak masing-masing
            $html .= $pasien->cetakKlaimLayanan();
            $html .= "</div>";
        }
        return $html;
    }
}