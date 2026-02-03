# Peminjaman Alat (PHP Native + MySQL)

Dokumentasi singkat untuk aplikasi Peminjaman Alat berbasis PHP native dengan sistem login session dan role (Admin, Petugas, Peminjam). Cocok untuk kebutuhan UKK SMK.

## Struktur Folder
```
/app
  /config        -> konfigurasi database & auth
  /controllers   -> logika login & CRUD
  /middleware    -> pengecekan role
  /models        -> akses database
/public
  /admin         -> halaman khusus admin
  dashboard-*.php
  login.php
  logout.php
  forbidden.php
/database
  schema.sql     -> struktur tabel MySQL
```

## Alur Kerja Aplikasi (Ringkas)
1. **User membuka `/login.php`** dan mengisi username/password.
2. **AuthController** memverifikasi password dengan `password_verify()` dan menyimpan data user ke session.
3. Setelah login, user diarahkan ke **dashboard sesuai role**.
4. Setiap halaman penting memanggil `require_login()`/`require_role()` agar akses dibatasi sesuai hak.
5. **Peminjam** mengajukan peminjaman (status `menunggu`).
6. **Petugas** menolak/menyetujui (status `ditolak`/`disetujui`).
7. **Pengembalian** dicatat, status peminjaman berubah menjadi `dikembalikan`.
8. **Admin** hanya mengelola data master dan laporan (tidak melakukan peminjaman).

## Keamanan & Otorisasi
- Semua halaman penting **wajib** memanggil helper `require_login()` dan `require_role()`.
- Aksi CRUD/approve/cetak laporan **wajib** dicek role user.
- Password disimpan menggunakan `password_hash()`.

## Struktur Database
Lihat file `database/schema.sql` untuk definisi tabel:
- **users**: data akun + role
- **kategori**: kategori alat
- **alat**: data alat + relasi kategori
- **peminjaman**: transaksi peminjaman
- **pengembalian**: transaksi pengembalian
- **log_aktivitas**: audit trail sederhana

### Contoh Insert User Admin
```sql
INSERT INTO users (nama, username, password_hash, role)
VALUES ('Admin', 'admin', '<hash_password>', 'admin');
```
Untuk membuat hash:
```php
<?php echo password_hash('admin123', PASSWORD_DEFAULT); ?>
```

## Contoh Kode (Singkat)

### 1) Login & Session
File: `app/controllers/AuthController.php`
```php
if (!password_verify($password, $user['password_hash'])) {
    return false;
}
$_SESSION['user'] = [
    'id' => $user['id'],
    'nama' => $user['nama'],
    'username' => $user['username'],
    'role' => $user['role']
];
```

### 2) Middleware Cek Role
File: `app/config/auth.php`
```php
function require_role(array $roles): void
{
    require_login();
    $user = current_user();
    if (!in_array($user['role'], $roles, true)) {
        header('Location: /forbidden.php');
        exit;
    }
}
```

### 3) CRUD Sederhana (Tambah Alat)
File: `public/admin/alat-create.php`
```php
$data = [
    'kategori_id' => (int)($_POST['kategori_id'] ?? 0),
    'nama' => trim($_POST['nama'] ?? ''),
    'kode' => trim($_POST['kode'] ?? ''),
    'stok' => (int)($_POST['stok'] ?? 0),
    'kondisi' => $_POST['kondisi'] ?? 'baik',
    'deskripsi' => trim($_POST['deskripsi'] ?? ''),
];
AlatController::store($data);
```

## Catatan untuk Siswa SMK
- **Fokus UKK**: role & hak akses harus jelas dan sesuai ketentuan.
- **Session**: pastikan setiap halaman memanggil `require_login()`.
- **Rapi**: pisahkan kode ke controller, model, dan halaman.
- **Aman**: selalu gunakan `password_hash()` & `password_verify()`.

Selamat belajar dan semoga sukses UKK!
