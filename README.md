# Proyek "vito" - panduan pasang

Semua file di folder ini mengikuti struktur root proyek Laravel. Salin/timpa ke proyek `vito` Anda:

- routes/web.php
- app/Http/Controllers/PageController.php
- resources/views/ (layouts, partials termasuk icons.blade.php, welcome, about, gallery)
- public/css/style.css, public/js/*.js, public/images/galeri/*.svg

Jalankan: `php artisan serve` lalu buka http://127.0.0.1:8000

## Yang perlu Anda ganti (di PageController.php)
1. `whatsapp` -> nomor WhatsApp Anda (format 62812..., tanpa + dan tanpa 0 depan)
2. Foto: taruh foto asli di public/images/galeri/ lalu ubah nama file di method `albums()`
3. Persentase skill, deskripsi diri, dan caption adalah contoh isian
