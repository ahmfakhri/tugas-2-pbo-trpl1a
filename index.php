<?php
// Dashboard/index.php

// Panggil file controller
require_once 'pasien_RumahSakit.php';

$controller = new PasienController();
$pesan = "";

// Cek jika ada aksi tambah data dari form/modal
if (isset($_GET['action']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $sukses = $controller->tambahPasien($_POST);
    if ($sukses) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='bi bi-check-circle-fill me-2'></i> <strong>Berhasil!</strong> Data pasien baru telah disimpan ke database.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
    } else {
        $pesan = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='bi bi-exclamation-triangle-fill me-2'></i> <strong>Gagal!</strong> Terjadi kesalahan saat menyimpan data.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
    }
}

// Ambil semua objek data pasien untuk menghitung statistik total asli
// GANTI MENJADI INI:
$semuaPasienKlaim = $controller->tampilkanSemuaPasien();
$daftarPasien = $semuaPasienKlaim;

// Hitung statistik ringkas awal untuk card dashboard
$totalPasien = count($semuaPasienKlaim);
$totalBPJS = 0;
$totalUmum = 0;
$totalAsuransi = 0;

foreach ($semuaPasienKlaim as $p) {
    if ($p->getJenisPasien() === "BPJS") $totalBPJS++;
    if ($p->getJenisPasien() === "Umum") $totalUmum++;
    if ($p->getJenisPasien() === "Asuransi Swasta") $totalAsuransi++;
}

// --- LOGIKA FILTER KETIKA CARD DIKLIK ---
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$daftarPasien = [];

if ($filter === 'bpjs') {
    foreach ($semuaPasienKlaim as $p) {
        if ($p->getJenisPasien() === "BPJS") $daftarPasien[] = $p;
    }
} elseif ($filter === 'umum') {
    foreach ($semuaPasienKlaim as $p) {
        if ($p->getJenisPasien() === "Umum") $daftarPasien[] = $p;
    }
} elseif ($filter === 'asuransi') {
    foreach ($semuaPasienKlaim as $p) {
        if ($p->getJenisPasien() === "Asuransi Swasta") $daftarPasien[] = $p;
    }
} else {
    $daftarPasien = $semuaPasienKlaim; // Menampilkan seluruh data urat 1-48
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Klaim Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
        .card-stat { border: none; border-radius: 12px; transition: transform 0.2s; cursor: pointer; text-decoration: none; display: block; }
        .card-stat:hover { transform: translateY(-5px); filter: brightness(95%); }
        .table-container { background: #ffffff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="bi bi-hospital-fill me-2 fs-3"></i>
                <div>
                    <span class="fw-bold d-block lh-1">MEDIKA KLAIM</span>
                    <small style="font-size: 11px; color: #e0e0e0;">Sistem Informasi Manajemen Jaminan Layanan Kesehatan</small>
                </div>
            </a>
            <span class="navbar-text text-white-50 d-none d-sm-inline">
                <i class="bi bi-shield-check me-1"></i> Sistem Terintegrasi
            </span>
        </div>
    </nav>

    <div class="container mb-5">
        
        <?php echo $pesan; ?>

        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <a href="index.php?filter=all" class="card card-stat bg-primary text-white shadow-sm <?php echo $filter === 'all' ? 'border border-2 border-dark' : ''; ?>">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-1" style="font-size: 12px;">Total Pasien</h6>
                            <h3 class="fw-bold mb-0"><?php echo $totalPasien; ?></h3>
                        </div>
                        <i class="bi bi-people-fill fs-1 text-white-50"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="index.php?filter=bpjs" class="card card-stat bg-success text-white shadow-sm <?php echo $filter === 'bpjs' ? 'border border-2 border-dark' : ''; ?>">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-1" style="font-size: 12px;">Pasien BPJS</h6>
                            <h3 class="fw-bold mb-0"><?php echo $totalBPJS; ?></h3>
                        </div>
                        <i class="bi bi-card-checklist fs-1 text-white-50"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="index.php?filter=umum" class="card card-stat bg-warning text-dark shadow-sm <?php echo $filter === 'umum' ? 'border border-2 border-dark' : ''; ?>">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-dark-50 text-uppercase mb-1" style="font-size: 12px;">Pasien Umum</h6>
                            <h3 class="fw-bold mb-0"><?php echo $totalUmum; ?></h3>
                        </div>
                        <i class="bi bi-cash-stack fs-1 text-dark-50"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-3">
                <a href="index.php?filter=asuransi" class="card card-stat bg-info text-white shadow-sm <?php echo $filter === 'asuransi' ? 'border border-2 border-dark' : ''; ?>">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white-50 text-uppercase mb-1" style="font-size: 12px;">Asuransi Swasta</h6>
                            <h3 class="fw-bold mb-0"><?php echo $totalAsuransi; ?></h3>
                        </div>
                        <i class="bi bi-shield-check fs-1 text-white-50"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark m-0">
                        Daftar Rekapitulasi Klaim Pasien 
                        <?php 
                            if($filter === 'bpjs') echo '<span class="text-success">(Kategori BPJS)</span>';
                            elseif($filter === 'umum') echo '<span class="text-warning-emphasis">(Kategori Umum)</span>';
                            elseif($filter === 'asuransi') echo '<span class="text-info">(Kategori Asuransi)</span>';
                        ?>
                    </h4>
                    <p class="text-muted small m-0">Menampilkan rangkuman data administrasi rawat inap dan rincian pembiayaan pasien.</p>
                </div>
                
                <div class="d-flex gap-2">
                    <?php if ($filter !== 'all'): ?>
                        <a href="index.php?filter=all" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bi bi-x-circle"></i> Bersihkan Filter
                        </a>
                    <?php endif; ?>
                    
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border-light">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th width="5%">ID</th>
                            <th>Nama Pasien</th>
                            <th width="8%">Usia</th>
                            <th width="12%">Lama Rawat</th>
                            <th>Tarif Kamar/Hari</th>
                            <th>Kategori Jaminan</th>
                            <th class="text-end">Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarPasien)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2"></i> Tidak ada data pasien untuk kategori ini.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftarPasien as $key => $p): ?>
                                <tr>
                                    <td class="text-muted fw-bold">#<?php echo $key + 1; ?></td>
                                    <td>
                                        <span class="d-block fw-bold text-dark"><?php echo htmlspecialchars($p->getNama()); ?></span>
                                        <small class="text-muted" style="font-size: 11px;">
                                            <?php 
                                                if ($p instanceof PasienBPJS) {
                                                    echo "<i class='bi bi-info-circle'></i> Faskes: " . htmlspecialchars($p->getFaskesAsal()) . " | " . htmlspecialchars($p->getKelasKamar());
                                                } elseif ($p instanceof PasienUmum) {
                                                    echo "<i class='bi bi-person-vcard'></i> NIK: " . htmlspecialchars($p->getNik()) . " | Bayar: " . htmlspecialchars($p->getMetodePembayaran());
                                                } elseif ($p instanceof PasienAsuransiSwasta) {
                                                    echo "<i class='bi bi-building'></i> Provider: " . htmlspecialchars($p->getNamaProvider()) . " | Polis: " . htmlspecialchars($p->getNomorPolis());
                                                }
                                            ?>
                                        </small>
                                    </td>
                                    <td><?php echo $p->getUsia(); ?> Th</td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $p->getLamaRawat(); ?> Hari</span></td>
                                    <td>Rp <?php echo number_format($p->getBiayaKamarPerHari(), 0, ',', '.'); ?></td>
                                    <td>
                                        <?php 
                                            $jenis = $p->getJenisPasien();
                                            if ($jenis === "BPJS") echo "<span class='badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3'>BPJS</span>";
                                            elseif ($jenis === "Umum") echo "<span class='badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3'>UMUM</span>";
                                            else echo "<span class='badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3'>ASURANSI</span>";
                                        ?>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        Rp <?php echo number_format($p->hitungTotalBiaya(), 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-labelledby="modalTambahPasienLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header navbar-custom text-white">
                    <h5 class="modal-title fw-bold" id="modalTambahPasienLabel"><i class="bi bi-person-plus-fill me-2"></i>Formulir Registrasi Pasien</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="?action=tambah" method="POST">
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap Pasien</label>
                                <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahmad Fauzi" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Usia (Tahun)</label>
                                <input type="number" name="usia" class="form-control" placeholder="Contoh: 30" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Lama Rawat (Hari)</label>
                                <input type="number" name="lama_rawat" class="form-control" placeholder="Contoh: 4" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Biaya Kamar Per Hari (Rp)</label>
                                <input type="number" name="biaya_kamar" class="form-control" placeholder="Contoh: 500000" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kategori Jaminan Layanan</label>
                                <select id="jenis_pasien" name="jenis_pasien" class="form-select" onchange="toggleFormSpesifik()" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <option value="UMUM">Pasien Umum</option>
                                    <option value="BPJS">Pasien BPJS</option>
                                    <option value="ASURANSI">Asuransi Swasta</option>
                                </select>
                            </div>
                        </div>

                        <hr class="text-muted">

                        <div id="form-umum" class="form-spesifik d-none">
                            <h6 class="fw-bold text-warning mb-3"><i class="bi bi-arrow-right-short"></i> Detail Pasien Umum</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" name="nik" class="form-control" placeholder="Masukkan 16 digit NIK">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" class="form-select">
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                        <option value="QRIS">QRIS</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="form-bpjs" class="form-spesifik d-none">
                            <h6 class="fw-bold text-success mb-3"><i class="bi bi-arrow-right-short"></i> Detail Jaminan BPJS</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nomor Kartu BPJS</label>
                                    <input type="text" name="nomor_pbi" class="form-control" placeholder="Contoh: BPJS001">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Faskes Rujukan Asal</label>
                                    <input type="text" name="faskes_asal" class="form-control" placeholder="Contoh: Puskesmas Jetis">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kelas Kamar</label>
                                    <select name="kelas_kamar" class="form-select">
                                        <option value="Kelas 1">Kelas 1</option>
                                        <option value="Kelas 2">Kelas 2</option>
                                        <option value="Kelas 3">Kelas 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="form-asuransi" class="form-spesifik d-none">
                            <h6 class="fw-bold text-info mb-3"><i class="bi bi-arrow-right-short"></i> Detail Asuransi Swasta</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nama Perusahaan Provider</label>
                                    <input type="text" name="nama_provider" class="form-control" placeholder="Contoh: Prudential / Allianz">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nomor Polis Proteksi</label>
                                    <input type="text" name="nomor_polis" class="form-control" placeholder="Contoh: POL1001">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Limit Cover Plafon (Rp)</label>
                                    <input type="number" name="limit_cover" class="form-control" placeholder="Contoh: 3000000">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm"><i class="bi bi-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleFormSpesifik() {
            let jenis = document.getElementById('jenis_pasien').value;
            document.querySelectorAll('.form-spesifik').forEach(function(el) {
                el.classList.add('d-none');
            });

            if (jenis === "UMUM") {
                document.getElementById('form-umum').classList.remove('d-none');
            } else if (jenis === "BPJS") {
                document.getElementById('form-bpjs').classList.remove('d-none');
            } else if (jenis === "ASURANSI") {
                document.getElementById('form-asuransi').classList.remove('d-none');
            }
        }
    </script>
</body>
</html>