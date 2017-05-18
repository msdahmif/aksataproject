# Aksata Project 0.9
Sistem Informasi Manajemen Anggota HMIF ITB :: Versi 0.9

## Garis Besar Proyek
Proyek ini bertujuan untuk mendata diri dan aktivitas internal maupun eksternal dari setiap anggota HMIF ITB.

## Permasalahan yang Dihadapi
* Masih terdapat banyak fitur pada Aksata Project yang belum bisa dijalankan (Untuk detail lebih lengkapnya dapat dilihat di bawah).

## Initiate Laravel Program

### How to Use it:
1. install dependencies dengan menggunakan command sebagai berikut:  
   `sudo apt install php7.0-mysql php7.0-mcrypt php7.0-mbstring php7.0-xml`
2. `composer install`  
3. `npm install`  
4. `cp .env.example .env`  
5. `php artisan key:generate`  
6. `php artisan migrate`
7. `php artisan vendor:publish`
8. `php artisan db:seed`

### How to Serve
`php artisan serve`

## Catatan Tambahan untuk Pembelajaran
* Apabila belum terbiasa dengan git, cobalah belajar terlebih dahulu di [sini](https://try.github.io). Dokumentasinya dapat dilihat di [sini](https://git-scm.com/docs/gittutorial).

## Lampiran

### Recent Bugs
1. Jenis Kelamin masih bug
2. Database bug (jumlah kolom yang tidak sama pada satu atribut)
3. Search bug (pencarian dengan __empty needle__)

### To Do List (Technical)
1. Mengubah seeder DatabaseSeeder
2. Mengubah isi dari database awal beserta fixing bugnya
    1. Password dirandom, jangan 'password'.
    2. Setting private attribute
3. Fixing some bugs
4. Menambah DB Ang: kolom keanggotaan, kolom wali, dan catatan msda
5. Menambah skema Datif

7. Tambahkan __status keanggotaan__, dan dapat di-_check_ apakah sudah lulus atau belum. (Jika sudah, ubah status ke anggota kehormatan apabila awalnya adalah anggota biasa).

8. Menambahkan __kolom divisi__.
9. Merefaktor menjadi *clean code* untuk setiap kode program. 
10. Deploy di server dan dapat digunakan oleh seluruh massa HMIF.
11. Tambahkan fitur batch baru
15. Menambah fitur forgot password

### Catatan Database
1. kolom keanggotaan (terdiri dari enum("Muda", "Biasa", "Kehormatan", "Other"))
2. Datif:
    1. kepengurusan (tahun, mulai, selesai, divisi)
    2. keanggotaan_kepengurusan (many to many) (nim, id_kepengurusan, jabatan (ketua/anggota))
    3. kepanitiaan (mulai, selesai, title, dieskripsi, scope)
    4. keanggotaan_kepanitiaan (Many to many)(sama kayak nomer 2)
    5. prestasi (tanggal, title, deskripsi, tingkat)
    6. keanggotaan_prestasi (many to many) (nim, id_kepengurusan, prestasi)

#### Pembagian Tugas

**N.B**: Untuk pembagian tugas ini, mohon dilakukan di **branch masing-masing** sebelum melakukan merge ke master. 

### Authorization for Different User
1. UMUM:
  * Dapat melakukan *searching*.
2. ANGGOTA HMIF:
  * Dapat melakukan *searching*.
  * Dapat memodifikasi keseluruhan data saja, dengan suatu restriksi (contoh: status keanggotaan, NIM, Nama Lengkap. __Khusus Nama Lengkap, kalo mau diubah request ke MSDA__).
  * Menambah data internal dan eksternal (keaktifan, prestasi dipisah untuk setiap internal maupun eksternal).
  * Tidak dapat melihat data **private** orang lain.
  * Dapat melihat **last update** diri sendiri.]
3. ANGGOTA MSDA HMIF:
  * Dapat melakukan *searching*.
  * Dapat mengakses semua data yang ada pada website.
  * Dapat mengupdate data setiap anggota.
  * Dapat melihat **last update** dan **last login** dari setiap orang.
  * KHUSUS ANGGOTA MSDA, *privilege*-nya akan diupdate secara manual, untuk masalah keamanan.

## Future Update
1. Fitur Search yang dioptimasi
2. Fitur untuk dapat mengimpor dan mengekspor ke CSV.
3. Optimasi Database

## Last Updated:
25 Januari 2017 07:00:00 WIB

## License
Copyright © 2017 Himpunan Mahasiswa Informatika Institut Teknologi Bandung (HMIF ITB)
