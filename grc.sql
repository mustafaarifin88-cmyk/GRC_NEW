-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grc`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_audit_bond`
--

CREATE TABLE `form_audit_bond` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_report` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `area_audit` varchar(150) NOT NULL,
  `tanggal_audit` date NOT NULL,
  `chk_kebijakan` int(11) DEFAULT 0,
  `file_kebijakan` text DEFAULT NULL,
  `catatan_kebijakan` text DEFAULT NULL,
  `chk_akses` int(11) DEFAULT 0,
  `file_akses` text DEFAULT NULL,
  `catatan_akses` text DEFAULT NULL,
  `chk_cctv` int(11) DEFAULT 0,
  `file_cctv` text DEFAULT NULL,
  `catatan_cctv` text DEFAULT NULL,
  `deskripsi_temuan` text DEFAULT NULL,
  `kategori_temuan` varchar(100) DEFAULT NULL,
  `dampak` varchar(50) DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL,
  `bukti_lainnya` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_compliance_bond`
--

CREATE TABLE `form_compliance_bond` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_report` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `area_penilaian` varchar(150) NOT NULL,
  `periode_penilaian` varchar(50) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `chk_izin` int(11) DEFAULT 0,
  `file_izin` text DEFAULT NULL,
  `catatan_izin` text DEFAULT NULL,
  `chk_keselamatan` int(11) DEFAULT 0,
  `file_keselamatan` text DEFAULT NULL,
  `catatan_keselamatan` text DEFAULT NULL,
  `chk_pajak` int(11) DEFAULT 0,
  `file_pajak` text DEFAULT NULL,
  `catatan_pajak` text DEFAULT NULL,
  `deskripsi_celah` text DEFAULT NULL,
  `dampak` varchar(50) DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_incident_bond`
--

CREATE TABLE `form_incident_bond` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_report` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal_waktu_kejadian` datetime NOT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `deskripsi_kejadian` text NOT NULL,
  `jenis_insiden` varchar(100) DEFAULT NULL,
  `dampak` varchar(50) DEFAULT NULL,
  `pihak_terlibat` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran_bukti` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_risk_bond`
--

CREATE TABLE `form_risk_bond` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_report` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi_risiko` text NOT NULL,
  `kategori_risiko` varchar(100) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `penyebab` text DEFAULT NULL,
  `dampak` text DEFAULT NULL,
  `kemungkinan_terjadi` varchar(50) DEFAULT NULL,
  `metode_penilaian` varchar(50) DEFAULT NULL,
  `skala_penilaian` varchar(50) DEFAULT NULL,
  `nilai_risiko` decimal(10,2) DEFAULT NULL,
  `tingkat_risiko` varchar(50) DEFAULT NULL,
  `mitigasi_sudah` text DEFAULT NULL,
  `mitigasi_tambahan` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_area`
--

CREATE TABLE `master_area` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_area` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_perusahaan`
--

CREATE TABLE `profil_perusahaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nama_pimpinan` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'logo.png',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_submissions`
--

CREATE TABLE `report_submissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user_staff` int(11) UNSIGNED NOT NULL,
  `jenis_form` varchar(50) NOT NULL,
  `id_dokumen` int(11) UNSIGNED NOT NULL,
  `status_approval` enum('PROSES','APPROVED','REJECTED') NOT NULL DEFAULT 'PROSES',
  `posisi_approval` enum('KEPALA UNIT','SUPERVISOR','MANAGERIAL','PIMPINAN TINGGI') NOT NULL DEFAULT 'KEPALA UNIT',
  `alasan_tolak` text DEFAULT NULL,
  `ditolak_oleh` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','PIMPINAN TINGGI','MANAGERIAL','SUPERVISOR','KEPALA UNIT','STAFF') NOT NULL,
  `foto` varchar(255) DEFAULT 'default.png',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `level`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$O0pQ.N3J6/hL8d/bH2H/E.B5o/Xl6rQe.C2.1o.Vw4uH5f8Q6E7yq', 'ADMIN', 'default.png', '2026-02-28 16:03:28', '2026-02-28 16:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_hierarchy`
--

CREATE TABLE `user_hierarchy` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_atasan` int(11) UNSIGNED NOT NULL,
  `id_bawahan` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_audit_bond`
--
ALTER TABLE `form_audit_bond`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_report` (`id_report`);

--
-- Indexes for table `form_compliance_bond`
--
ALTER TABLE `form_compliance_bond`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_report` (`id_report`);

--
-- Indexes for table `form_incident_bond`
--
ALTER TABLE `form_incident_bond`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_report` (`id_report`);

--
-- Indexes for table `form_risk_bond`
--
ALTER TABLE `form_risk_bond`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_report` (`id_report`);

--
-- Indexes for table `master_area`
--
ALTER TABLE `master_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_submissions`
--
ALTER TABLE `report_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_staff` (`id_user_staff`),
  ADD KEY `id_dokumen` (`id_dokumen`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_hierarchy`
--
ALTER TABLE `user_hierarchy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atasan` (`id_atasan`),
  ADD KEY `id_bawahan` (`id_bawahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_audit_bond`
--
ALTER TABLE `form_audit_bond`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_compliance_bond`
--
ALTER TABLE `form_compliance_bond`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_incident_bond`
--
ALTER TABLE `form_incident_bond`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_risk_bond`
--
ALTER TABLE `form_risk_bond`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_area`
--
ALTER TABLE `master_area`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_submissions`
--
ALTER TABLE `report_submissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_hierarchy`
--
ALTER TABLE `user_hierarchy`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
