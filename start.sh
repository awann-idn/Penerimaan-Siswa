#!/bin/bash
# Jalankan migrasi
php artisan migrate --force

# Jalankan server bawaan Laravel (Artisan Serve) dengan host yang benar
php artisan serve --host=0.0.0.0 --port=$PORT
