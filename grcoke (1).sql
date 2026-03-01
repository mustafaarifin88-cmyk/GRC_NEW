-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2026 at 06:20 AM
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
-- Database: `grcoke`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_logs`
--

CREATE TABLE `approval_logs` (
  `id` int(11) NOT NULL,
  `report_type` varchar(100) NOT NULL,
  `report_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `processed_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_bonds`
--

CREATE TABLE `audit_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `area_id` int(11) NOT NULL,
  `audit_date` date NOT NULL,
  `item_1_status` varchar(50) DEFAULT NULL,
  `item_1_note` text DEFAULT NULL,
  `item_2_status` varchar(50) DEFAULT NULL,
  `item_2_note` text DEFAULT NULL,
  `item_3_status` varchar(50) DEFAULT NULL,
  `item_3_note` text DEFAULT NULL,
  `finding_description` text DEFAULT NULL,
  `finding_category` varchar(100) DEFAULT NULL,
  `impact` varchar(50) DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) DEFAULT 'KEPALA UNIT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compliance_bonds`
--

CREATE TABLE `compliance_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `area_id` int(11) NOT NULL,
  `assessment_period` varchar(50) NOT NULL,
  `assessment_date` date NOT NULL,
  `req_1_status` varchar(50) DEFAULT NULL,
  `req_1_note` text DEFAULT NULL,
  `req_2_status` varchar(50) DEFAULT NULL,
  `req_2_note` text DEFAULT NULL,
  `req_3_status` varchar(50) DEFAULT NULL,
  `req_3_note` text DEFAULT NULL,
  `gap_description` text DEFAULT NULL,
  `impact` varchar(50) DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) DEFAULT 'KEPALA UNIT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_data`
--

CREATE TABLE `file_data` (
  `id` int(11) NOT NULL,
  `related_table` varchar(100) NOT NULL,
  `related_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT 'general',
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_reports`
--

CREATE TABLE `incident_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `incident_datetime` datetime NOT NULL,
  `location_id` int(11) NOT NULL,
  `incident_description` text NOT NULL,
  `incident_type` varchar(100) DEFAULT NULL,
  `impact` varchar(50) DEFAULT NULL,
  `involved_parties` text DEFAULT NULL,
  `emergency_action` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) DEFAULT 'KEPALA UNIT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_audit_bonds`
--

CREATE TABLE `int_audit_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_compliance_bonds`
--

CREATE TABLE `int_compliance_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_continuity_bonds`
--

CREATE TABLE `int_continuity_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_control_bonds`
--

CREATE TABLE `int_control_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_cyber_bonds`
--

CREATE TABLE `int_cyber_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_fraud_bonds`
--

CREATE TABLE `int_fraud_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_incident_bonds`
--

CREATE TABLE `int_incident_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_risk_bonds`
--

CREATE TABLE `int_risk_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_third_party_bonds`
--

CREATE TABLE `int_third_party_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_areas`
--

CREATE TABLE `master_areas` (
  `id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_areas`
--

INSERT INTO `master_areas` (`id`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Pusat - Lantai 1', '2026-02-28 21:10:45', '2026-02-28 21:10:45'),
(2, 'Gudang Logistik Utama', '2026-02-28 21:10:45', '2026-02-28 21:10:45'),
(3, 'Cabang Sudirman', '2026-02-28 21:10:45', '2026-02-28 21:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `master_locations`
--

CREATE TABLE `master_locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_locations`
--

INSERT INTO `master_locations` (`id`, `location_name`, `created_at`, `updated_at`) VALUES
(1, 'Ruang Server', '2026-02-28 21:10:45', '2026-02-28 21:10:45'),
(2, 'Area Produksi Blok A', '2026-02-28 21:10:45', '2026-02-28 21:10:45'),
(3, 'Lobi Utama', '2026-02-28 21:10:45', '2026-02-28 21:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_bonds`
--

CREATE TABLE `risk_bonds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `risk_description` text NOT NULL,
  `risk_category` varchar(100) NOT NULL,
  `assessment_date` date NOT NULL,
  `cause` text DEFAULT NULL,
  `impact_description` text DEFAULT NULL,
  `likelihood` varchar(50) DEFAULT NULL,
  `assessment_method` varchar(50) DEFAULT NULL,
  `assessment_scale` varchar(20) DEFAULT NULL,
  `risk_value` int(11) DEFAULT NULL,
  `risk_level` varchar(50) DEFAULT NULL,
  `existing_mitigation` text DEFAULT NULL,
  `recommended_mitigation` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'PROSES',
  `current_level` varchar(50) DEFAULT 'KEPALA UNIT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `level` enum('ADMIN','STAFF','PIMPINAN TINGGI','MANAGERIAL','SUPERVISOR','KEPALA UNIT') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `level`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$zf6Z8FnV3pohBEPYtXSODugsPLU9F2LsXc75TQEqpX7YSPTCDvHSe', 'Administrator', 'ADMIN', NULL, '2026-03-01 10:20:38', '2026-03-01 10:20:38'),
(2, 'staff', '$2y$10$zf6Z8FnV3pohBEPYtXSODugsPLU9F2LsXc75TQEqpX7YSPTCDvHSe', 'Staff', 'STAFF', NULL, '2026-03-01 04:16:23', '2026-03-01 04:16:23'),
(3, 'kepalaunit', '$2y$10$/tJnyjHcvMzuFa..Zy8yCeqJTQSdOOal/McO9adUIsiRGIoe1Am5W', 'Kepala Unit', 'KEPALA UNIT', NULL, '2026-03-01 04:16:42', '2026-03-01 04:16:42'),
(4, 'supervisor', '$2y$10$AUXkNhf0oW3WnCA2ClXrA.tjPxTD1woxOXcoXKbmyOqQ5DKs9ie6y', 'Supervisor', 'SUPERVISOR', NULL, '2026-03-01 04:16:59', '2026-03-01 04:16:59'),
(5, 'manager', '$2y$10$wQJegw24ZfoOPvvINOV46ObLw3AHhIzCc7A4YeG39PYMzJRRMweeC', 'Maneger', 'MANAGERIAL', NULL, '2026-03-01 04:17:21', '2026-03-01 04:17:21'),
(6, 'pimpinan', '$2y$10$GHJIQZiskTHVZKe1kthW5O4rS7uOmAttTpPwzl3kvOdZ.2.sw.9F2', 'Pimpinan', 'PIMPINAN TINGGI', NULL, '2026-03-01 04:17:42', '2026-03-01 04:17:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_logs`
--
ALTER TABLE `approval_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_bonds`
--
ALTER TABLE `audit_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliance_bonds`
--
ALTER TABLE `compliance_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_data`
--
ALTER TABLE `file_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incident_reports`
--
ALTER TABLE `incident_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_audit_bonds`
--
ALTER TABLE `int_audit_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_compliance_bonds`
--
ALTER TABLE `int_compliance_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_continuity_bonds`
--
ALTER TABLE `int_continuity_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_control_bonds`
--
ALTER TABLE `int_control_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_cyber_bonds`
--
ALTER TABLE `int_cyber_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_fraud_bonds`
--
ALTER TABLE `int_fraud_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_incident_bonds`
--
ALTER TABLE `int_incident_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_risk_bonds`
--
ALTER TABLE `int_risk_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_third_party_bonds`
--
ALTER TABLE `int_third_party_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_areas`
--
ALTER TABLE `master_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_locations`
--
ALTER TABLE `master_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_bonds`
--
ALTER TABLE `risk_bonds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_logs`
--
ALTER TABLE `approval_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_bonds`
--
ALTER TABLE `audit_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliance_bonds`
--
ALTER TABLE `compliance_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_data`
--
ALTER TABLE `file_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_reports`
--
ALTER TABLE `incident_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_audit_bonds`
--
ALTER TABLE `int_audit_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_compliance_bonds`
--
ALTER TABLE `int_compliance_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_continuity_bonds`
--
ALTER TABLE `int_continuity_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_control_bonds`
--
ALTER TABLE `int_control_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_cyber_bonds`
--
ALTER TABLE `int_cyber_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_fraud_bonds`
--
ALTER TABLE `int_fraud_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_incident_bonds`
--
ALTER TABLE `int_incident_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_risk_bonds`
--
ALTER TABLE `int_risk_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_third_party_bonds`
--
ALTER TABLE `int_third_party_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_areas`
--
ALTER TABLE `master_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_locations`
--
ALTER TABLE `master_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risk_bonds`
--
ALTER TABLE `risk_bonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
