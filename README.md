
# siMonikaVer2

![Logo Kabupaten Mojokerto](assets/images/logo-mojokerto.png)

Aplikasi resmi dari **Dinas Jawa Timur Kabupaten Mojokerto** untuk mencatat pekerjaan programmer dan mahasiswa magang. 
Proyek ini bertujuan untuk meningkatkan transparansi dan efisiensi pengelolaan tugas.

---

## Fitur Utama
- **Pencatatan Tugas**: Dokumentasi pekerjaan harian programmer dan mahasiswa.
- **Laporan Kinerja**: Laporan pekerjaan mingguan atau bulanan.
- **Integrasi User Roles**: Hak akses berbeda untuk programmer dan mahasiswa magang.

---

## Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/NeoRamadhani93/siMonikaV2.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd siMonikaV2
   ```
3. Instal dependensi:
   ```bash
   composer install
   npm install
   ```
4. Konfigurasi `.env`:
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
6. Jalankan server:
   ```bash
   php artisan serve
   ```

---

## Cara Menggunakan

1. Login ke sistem menggunakan akun yang telah disediakan.
2. Pilih menu **Pencatatan Tugas** untuk mencatat pekerjaan harian.
3. Gunakan **Laporan Kinerja** untuk mengunduh laporan.

---

## Kontribusi

Kami membuka peluang untuk kontribusi dari programmer dan mahasiswa magang. Silakan ikuti langkah berikut:
1. Fork repository ini.
2. Buat branch baru:
   ```bash
   git checkout -b fitur-anda
   ```
3. Lakukan perubahan dan commit:
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
4. Kirim pull request ke repository utama.

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## Kontak

Untuk informasi lebih lanjut, hubungi:
- **Dinas Jawa Timur Kabupaten Mojokerto**
- Email: dinas@example.com
- Telepon: 123-456-789
