# Plesir
### Sistem Informasi Geografis Pariwisata Tegal

## Install


1. **Clone Repository**

```bash
git clone https://github.com/faizalajiw/laravel-plesir.git
cd laravel-plesir
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

4. **Jalankan website**

```bash
php artisan serve
```
## Info Akun

**Super Admin**

-   username: superadmin
-   Password: password

**Admin Wisata**

-   username: adminwisata
-   Password: password

**Pengguna**

-   username: faizalajiw
-   Password: password

---