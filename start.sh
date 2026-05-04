#!/bin/bash

# Pastikan folder storage bisa ditulisi
chmod -R 775 storage bootstrap/cache

# Jalankan migrasi
php artisan migrate --force

# Jalankan server lewat Artisan Serve (lebih akurat untuk routing Laravel)
php artisan serve --host=0.0.0.0 --port=$PORT
