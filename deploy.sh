#!/usr/bin/env bash
# ==========================================================================
# Update website di server (VPS) dengan satu perintah:   bash deploy.sh
#
# Yang dilakukan: mode pemeliharaan -> ambil kode terbaru -> pasang paket
# (tanpa alat developer) -> build CSS/JS -> migrasi database -> cache Laravel
# -> website dibuka lagi. Jika ada langkah gagal, website tetap dibuka lagi.
# ==========================================================================
set -euo pipefail
cd "$(dirname "$0")"

echo "==> Mode pemeliharaan (pengunjung melihat halaman 503)"
php artisan down --retry=15 || true
trap 'echo "==> Membuka website kembali"; php artisan up' EXIT

echo "==> Ambil kode terbaru"
git pull --ff-only

echo "==> Pasang paket PHP (tanpa alat developer)"
composer install --no-dev --optimize-autoloader --no-interaction

if command -v npm >/dev/null 2>&1; then
    echo "==> Build CSS & JS"
    npm ci --no-audit --no-fund
    npm run build
else
    echo "!!  npm tidak ada di server: pastikan folder public/build ikut di-upload dari komputer Anda."
fi

echo "==> Migrasi database"
php artisan migrate --force

echo "==> Cache konfigurasi, route, view & event"
php artisan optimize:clear
php artisan optimize

echo "==> Selesai"
