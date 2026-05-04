#!/bin/bash

# Pastikan folder storage bisa ditulisi
chmod -R 775 storage bootstrap/cache

# Jalankan migrasi
php artisan migrate --force

# PAKSA dengerin di port 8000 sesuai settingan Dashboard Railway Anda
exec php artisan serve --host=0.0.0.0 --port=8000
