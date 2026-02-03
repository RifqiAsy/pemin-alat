CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','petugas','peminjam') NOT NULL,
  status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE kategori (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE alat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kategori_id INT NOT NULL,
  nama VARCHAR(150) NOT NULL,
  kode VARCHAR(50) NOT NULL UNIQUE,
  stok INT NOT NULL DEFAULT 0,
  kondisi ENUM('baik','rusak','perbaikan') NOT NULL DEFAULT 'baik',
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_alat_kategori FOREIGN KEY (kategori_id) REFERENCES kategori(id)
);

CREATE TABLE peminjaman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  peminjam_id INT NOT NULL,
  alat_id INT NOT NULL,
  jumlah INT NOT NULL DEFAULT 1,
  tanggal_pinjam DATE NOT NULL,
  tanggal_rencana_kembali DATE NOT NULL,
  status ENUM('menunggu','disetujui','ditolak','dikembalikan') NOT NULL DEFAULT 'menunggu',
  catatan TEXT,
  petugas_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_peminjaman_user FOREIGN KEY (peminjam_id) REFERENCES users(id),
  CONSTRAINT fk_peminjaman_alat FOREIGN KEY (alat_id) REFERENCES alat(id),
  CONSTRAINT fk_peminjaman_petugas FOREIGN KEY (petugas_id) REFERENCES users(id)
);

CREATE TABLE pengembalian (
  id INT AUTO_INCREMENT PRIMARY KEY,
  peminjaman_id INT NOT NULL,
  tanggal_kembali DATE NOT NULL,
  kondisi_kembali ENUM('baik','rusak','hilang') NOT NULL,
  denda DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  catatan TEXT,
  petugas_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_pengembalian_peminjaman FOREIGN KEY (peminjaman_id) REFERENCES peminjaman(id),
  CONSTRAINT fk_pengembalian_petugas FOREIGN KEY (petugas_id) REFERENCES users(id)
);

CREATE TABLE log_aktivitas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  aksi VARCHAR(150) NOT NULL,
  detail TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_log_user FOREIGN KEY (user_id) REFERENCES users(id)
);
