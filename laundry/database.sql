CREATE DATABASE IF NOT EXISTS laundry;
USE laundry;

-- Table `outlet`
CREATE TABLE `outlet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `member`
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tlp` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `user`
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `role` enum('admin','kasir','owner') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_outlet` (`id_outlet`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data
INSERT INTO `outlet` (nama, alamat, tlp) VALUES ('Outlet Utama', 'Jl. Merdeka No. 1', '08123456789');

-- Default admin user (password: admin123)
-- Hash generated earlier: $2y$10$9hYQZak5v3y/n4rV79z1qujnsUtjHNA.7FomGSaHlgS4DZwXoa92K
INSERT INTO `user` (nama, username, password, id_outlet, role) VALUES ('Administrator', 'admin', '$2y$10$9hYQZak5v3y/n4rV79z1qujnsUtjHNA.7FomGSaHlgS4DZwXoa92K', 1, 'admin');
