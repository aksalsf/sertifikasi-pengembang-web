<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Tentang Project Ini
Project ini merupakan sistem Pendaftaran Siswa Baru sederhana yang menggunakan filament dan laravel

## Instalasi
1. Clone repositori ini
   ```
    git clone git@github.com:aksalsf/sertifikasi-pengembang-web.git
   ```
2. Copy file .env.example ke .env
    ```
     cp .env.example .env
    ```
3. Install semua package yang diperlukan
    ```
     composer install
    ```
4. Buat database dengan nama database yang diinginkan
5. Sesuaikan konfigurasi database di .env
6. Generate app key
    ```
     php artisan key:generate
    ```
7. Generate migration
    ```
     php artisan migrate
    ```
8. Generate seeder
    ```
     php artisan db:seed
    ```
9. Buka aplikasi melalui browser!
