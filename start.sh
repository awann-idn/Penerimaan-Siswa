#!/bin/bash

# Hapus link storage lama jika ada (agar tidak bentrok)
rm -rf public/storage

# Pastikan folder storage bisa ditulisi
chmod -R 775 storage bootstrap/cache

# Buat ulang link storage secara paksa
php artisan storage:link

# Jalankan migrasi
php artisan migrate --force

# Jalankan server
exec php artisan serve --host=0.0.0.0 --port=8000
