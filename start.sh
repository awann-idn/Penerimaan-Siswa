#!/bin/bash

# Pastikan folder storage dan cache bisa ditulisi
chmod -R 775 storage bootstrap/cache
php artisan storage:link

# Jalankan migrasi
php artisan migrate --force

# Jalankan optimasi (opsional tapi bagus untuk production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan server dengan router index.php (Cara paling stabil)
php -S 0.0.0.0:$PORT -t public public/index.php
