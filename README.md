🚀 Instalasi

1. Clone Repository

git clone https://github.com/FaridzAhmad/AplikasiPengelolaanAir
cd repository

2. Konfigurasi .env

Salin file .env.example menjadi .env lalu ubah konfigurasi database:

cp env.example .env

Sesuaikan dengan database kamu:

database.default.hostname = localhost
database.default.database = nama_database
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

3. Install Dependencies

composer install

4. Import Database

Import database yang sudah tertera

5. Jalankan Aplikasi

php spark serve

Akses aplikasi di http://localhost:8080