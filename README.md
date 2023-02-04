# Instruksi

Halo Semuanya. Ini adalah dokumentasi dari aplikasi CRUD sederhana yang telah saya buat. Ada beberapa materi yang dibahas yakni :

-   Setup Project
-   Setup env
-   Migrasi database
-   Menjalankan Aplikasi

# Setup Project

-   Pertama, buka direktori tempat project anda, lalu buka terminal.
-   Ketik perintah
    `git clone https://github.com/J-Jamal/kilau-app.git`
-   Jika sudah selesai clone, akses folder kilau-app lalu ketik perintah melalui terminal
    `composer install`
-   Kalo sudah selesai, jalankan perintah `cp .env.example .env` di direktori app laravelnya.
-   Terus `php artisan key:generate`.
-   Terakhir install paket composer untuk datatable.
    `composer require yajra/laravel-datatables-oracle`

# Setup env

Pada file .env cari bagian

`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_kilau
DB_USERNAME=root
DB_PASSWORD=`

sesuaikan nama database, username, dan passwordnya.

# Migrasi database

Kemudian jalankan perintah untuk migrasi database
`php artisan migrate`
Untuk isi databasenya saya sudah membuat 100 data random, pertama ketik `php artisan db:seed`, lalu `php artisan tinker`, dan terakhir ketik `\App\Models\Post::factory()->count(100)->create();`
lalu hasilnya bisa cek di database MySQL yang kalian miliki dan boom ada 100 data random.

# Menjalankan Aplikasi

Langkah terakhir yang paling mudah yaitu menjalankan aplikasi, kalian tinggal ketik `php artisan serve`, dan tinggal cek di browser kalian dengan port `http://127.0.0.1:8000`.
