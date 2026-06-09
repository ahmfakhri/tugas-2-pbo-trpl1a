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

        // 1. Ambil Data Pasien BPJS dengan Query JOIN
        $queryBPJS = "SELECT p.*, b.nomor_pbi, b.faskes_asal, b.kelas_kamar 
                      FROM pasien p 
                      JOIN pasien_bpjs b ON p.id_pasien = b.id_pasien";
        $result = $this->conn->query($queryBPJS);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $daftarPasien[] = new PasienBPJS(
                    $row['id_pasien'], $row['nama'], $row['usia'], 
                    $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                    $row['nomor_pbi'], $row['faskes_asal'], $row['kelas_kamar']
                );
            }
        }

        // 2. Ambil Data Pasien Asuransi Swasta dengan Query JOIN
        $queryAsuransi = "SELECT p.*, a.nama_provider, a.nomor_polis, a.limit_cover 
                          FROM pasien p 
                          JOIN pasien_asuransi a ON p.id_pasien = a.id_pasien";
        $result = $this->conn->query($queryAsuransi);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $daftarPasien[] = new PasienAsuransiSwasta(
                    $row['id_pasien'], $row['nama'], $row['usia'], 
                    $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                    $row['nama_provider'], $row['nomor_polis'], $row['limit_cover']
                );
            }
        }

        // 3. Ambil Data Pasien Umum dengan Query JOIN
        $queryUmum = "SELECT p.*, u.nik, u.metode_pembayaran 
                      FROM pasien p 
                      JOIN pasien_umum u ON p.id_pasien = u.id_pasien";
        $result = $this->conn->query($queryUmum);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $daftarPasien[] = new PasienUmum(
                    $row['id_pasien'], $row['nama'], $row['usia'], 
                    $row['lama_rawat'], $row['biaya_kamar_per_hari'], 
                    $row['nik'], $row['metode_pembayaran']
                );
            }
        }

        return $daftarPasien;
    }

    /**
     * Menyimpan data pasien baru menggunakan prepared statement mysqli (Database Transaction)
     */
    public function tambahPasien($data)
    {
        try {
            // Memulai transaksi database agar data konsisten di kedua tabel
            $this->conn->begin_transaction();

            // Insert ke tabel utama: pasien
            $queryPasien = "INSERT INTO pasien (nama, usia, lama_rawat, biaya_kamar_per_hari, jenis_pasien) 
                            VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($queryPasien);
            $stmt->bind_param(
                "siids", 
                $data['nama'], 
                $data['usia'], 
                $data['lama_rawat'], 
                $data['biaya_kamar'], 
                $data['jenis_pasien']
            );
            $stmt->execute();

            // Mengambil ID Pasien terakhir yang digenerate oleh Auto Increment
            $idPasienBaru = $this->conn->insert_id;

            // Insert ke tabel anak berdasarkan jenis_pasien
            if ($data['jenis_pasien'] == 'UMUM') {
                $querySub = "INSERT INTO pasien_umum (id_pasien, nik, metode_pembayaran) VALUES (?, ?, ?)";
                $stmtSub = $this->conn->prepare($querySub);
                $stmtSub->bind_param("iss", $idPasienBaru, $data['nik'], $data['metode_pembayaran']);
                $stmtSub->execute();
            } 
            elseif ($data['jenis_pasien'] == 'BPJS') {
                $querySub = "INSERT INTO pasien_bpjs (id_pasien, nomor_pbi, faskes_asal, kelas_kamar) VALUES (?, ?, ?, ?)";
                $stmtSub = $this->conn->prepare($querySub);
                $stmtSub->bind_param("isss", $idPasienBaru, $data['nomor_pbi'], $data['faskes_asal'], $data['kelas_kamar']);
                $stmtSub->execute();
            } 
            elseif ($data['jenis_pasien'] == 'ASURANSI') {
                $querySub = "INSERT INTO pasien_asuransi (id_pasien, nama_provider, nomor_polis, limit_cover) VALUES (?, ?, ?, ?)";
                $stmtSub = $this->conn->prepare($querySub);
                $stmtSub->bind_param("issd", $idPasienBaru, $data['nama_provider'], $data['nomor_polis'], $data['limit_cover']);
                $stmtSub->execute();
            }

            // Jika semua query berhasil, simpan permanen ke database
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            // Jika salah satu query gagal, batalkan semua perubahan
            $this->conn->rollback();
            echo "Gagal Tambah Data: " . $e->getMessage();
            return false;
        }
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