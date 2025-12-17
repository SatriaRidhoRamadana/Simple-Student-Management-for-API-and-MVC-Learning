/*
 * Database Schema untuk aplikasi Student Management
 * Jalankan SQL ini di database Anda
 */

-- Membuat table students
CREATE TABLE IF NOT EXISTS `students` (
  `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  `nim` VARCHAR(20) UNIQUE NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100),
  `prodi` VARCHAR(100),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_nim` (`nim`),
  INDEX `idx_nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO `students` (`nim`, `nama`, `email`, `prodi`) VALUES
('2024001', 'Budi Santoso', 'budi@example.com', 'Teknik Informatika'),
('2024002', 'Siti Nurhaliza', 'siti@example.com', 'Sistem Informasi'),
('2024003', 'Ahmad Wijaya', 'ahmad@example.com', 'Teknik Komputer');
