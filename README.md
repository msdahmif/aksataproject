# Aksata Project 0.7
Sistem Informasi Manajemen Anggota HMIF ITB :: Versi 0.7

## Garis Besar Proyek
Proyek ini bertujuan untuk mendata diri dan aktivitas internal maupun eksternal dari setiap anggota HMIF ITB. 

## Permasalahan yang Dihadapi
* Masih terdapat banyak fitur pada Aksata Project yang belum bisa dijalankan (Untuk detail lebih lengkapnya dapat dilihat di bawah). 
* Kode akan dimigrasikan ke Framework Laravel yang terbaru, yaitu Laravel 5.3. 

## Kumpul Perdana
* Rilis		: 6 Desember 2016
* Deadline	: 6 Desember 2016
* Deliverables	: To Do List untuk keberjalanan Proyek.

Melakukan kumpul perdana dan mendata apa saja yang diperlukan untuk menyelesaikan proyek ini.  

## Milestone 1 : Belajar PHP & Framework Laravel 5.3
* Rilis		: 10 Desember 2016
* Deadline	: 18 Desember 2016
* Deliverables	: Dapat mengerti Framework Laravel dan dapat melakukan pemrograman dengan menggunakan Laravel.

Pada Milestone ini, harus sudah mengerti Pemrograman PHP 7.0 dan Laravel 5.3, dan lebih baik untuk belajar **TIDAK MENDEKATI DEADLINE** karena frameworknya yang cukup rumit dan perlu membiasakan diri dengan framework ini.  
Untuk belajar laravel, dapat dilihat di [Laravel 5 Fundamentals](https://laracasts.com/series/laravel-5-fundamentals), [Laravel Skill](https://laracasts.com/skills/laravel)(__direkomendasikan untuk dari step 1 sampai 4__). Dokumentasinya dapat dilihat di [sini](https://laravel.com).

## Milestone 2 : Migrasi ke Laravel 5.3
* Rilis		: 18 Desember 2016
* Deadline	: 21 Desember 2016
* Deliverables	: Aksata Project telah termigrasi ke Laravel 5.3

Pada Milestone ini, dilakukan migrasi dari Laravel 5.2 ke Laravel 5.3, dan membetulkan _bug_ yang terdapat pada proyek sekarang ini.  
Setelah membetulkan bug, diharapkan sudah bisa melakukan perkembangan lebih lanjut.

## Milestone 3 : Eksekusi
* Rilis		: 21 Desember 2016
* Deadline	: 4 Januari 2017
* Deliverables	: Aksata Project sudah siap untuk diintegrasikan

Pada Milestone ini, akan dilakukan pembagian tugas yang tepat dan melakukan pembetulan bug-bug dan fitur yang terdapat pada Aksata Project, untuk dapat dilakukan integrasi setelahnya. Notice that __pada milestone ini akan dipecah lagi menjadi bagian bagian yang lebih kecil__.

## Milestone 4 : Integrasi
* Rilis		: 4 Januari 2017
* Deadline	: 7 Januari 2017
* Deliverables	: Aksata Project telah diintegrasikan dan siap untuk _testing_

Pada Milestone ini, akan dilakukan integrasi antar bagian program dan diintegrasikan menjadi __Aksata Project 1.0-rc__, sehingga dapat dilakukan _testing_ setelahnya.

## Milestone 5 : Testing
* Rilis		: 7 Januari 2017
* Deadline	: 15 Januari 2017
* Deliverables	: Aksata Project telah di_testing_ dan siap untuk dirilis

Pada Milestone ini, akan dilakukan _testing_ seluruh bagian program, untuk dapat dilakukan dokumentasi secara penuh dan dapat dirilis dalam waktu dekat, menjadi __Aksata Project 1.0__.

## Milestone 6 : Dokumentasi
* Rilis		: 21 Desember 2016
* Deadline	: 22 Januari 2017
* Deliverables	: Aksata Project telah didokumentasikan secara penuh.

Pada Milestone ini, akan dilakukan dokumentasi seluruh Proyek. Notice that __Tanggal Rilisnya sedikit berbeda dengan Milestone 1-5__, dapat dilakukan pendokumentasian pada saat melakukan Eksekusi sekalipun.

## Milestone 7 : Rilis Versi 1.0
* Rilis		: 23 Januari 2017
* Deadline	: LPJ Kepengurusan HMIF 2016
* Deliverables	: Aksata Project versi stabil telah dirilis

Pada Milestone ini, yang dilakukan adalah merilis proyek secara utuh dan dapat digunakan oleh setiap anggota HMIF ITB.

## Initiate Laravel Program

### How to Use it:
composer install  
npm install  
cp .env.example .env  
php artisan key:generate  
php artisan migrate  

### How to Serve
php artisan serve

## Catatan Tambahan untuk Pembelajaran
* Apabila belum terbiasa dengan git, cobalah belajar terlebih dahulu di [sini](https://try.github.io). Dokumentasinya dapat dilihat di [sini](https://git-scm.com/docs/gittutorial).

## Lampiran

### Recent Bugs
1. Belum dapat dilakukan deploy karena standar laravel yang sedikit berbeda dari versi yang terdapat pada website.
2. Page setiap orang belum dapat diupdate pada saat ingin merubah data dari aplikasi.

### To Do List (Technical)
1. Menambahkan fitur __keaktifan__ untuk setiap anggota, baik __internal__ maupun __eksternal__.  
   Untuk fitur ini dilakukan penambahan tabel baru pada _database_(menambahkannya di dalam laravel).
2. Fitur media sosial dapat dipertimbangkan untuk dapat __dihapus sama sekali__ atau dapat di-__add__ maupun di-__remove__.
3. Tambahkan __status keanggotaan__, dan dapat di_check_ apakah sudah lulus atau belum. (Jika sudah, ubah status ke anggota kehormatan apabila awalnya adalah anggota biasa).
4. Tambahkan __timestamp__, baik __waktu masuk terakhir__ maupun __waktu modifikasi terakhir__.
5. Menentukan data yang __fix__ maupun yang bisa __multivalue__ (yang memakai JSON).
6. Menambahkan __kolom divisi__.
7. Menghilangan kolom yang **tidak diauthorisasi** oleh user (contoh : private information).
10. Deploy di server dan dapat digunakan oleh seluruh massa HMIF

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

### Lainnya
1. Dapat dipertimbangkan skema _database_ yang tepat, karena ada kemungkinan untuk berubah lagi untuk keperluan lebih lanjut.

## Future Update
1. Fitur Search yang dioptimasi

## Last Updated:
10 Desember 2016 00:00:00 WIB

## License
Copyright © 2016 Himpunan Mahasiswa Informatika Institut Teknologi Bandung (HMIF ITB)

