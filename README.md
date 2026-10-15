<p align="center">
  <h1 align="center">💀 INFOMUSIKCADAS PORTAL 💀</h1>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/SCENE-BANDUNG-red?style=for-the-badge" alt="Scene Bandung">
  <img src="https://img.shields.io/badge/STACK-LARAVEL%2013-blue?style=for-the-badge" alt="Laravel">
  <img src="https://img.shields.io/badge/VIBE-DIY%20%2F%20BRUTALIST-black?style=for-the-badge" alt="DIY">
</p>

---

## ⚡ ABOUT THE PROJECT

**INFOMUSIKCADAS** adalah portal independen, zine digital, dan pusat kendali skena musik cadas underground. Dibangun tanpa kompromi untuk mewadahi arus deras rilisan album, kabar skena, direktori band, gig radar, hingga lapak *lost & found* moshpit skena lokal.

Misi utama kita simpel: **No Compromise, Support Local Scene, Keep It DIY!**

---

## 🎸 CORE FEATURES

- 📰 **Zine & News Publishing:** Artikel, review album, interview band, dan editorial lengkap dengan editor visual Quill.js & stabilo kustom.
- ⚡ **Gig Radar:** Direktori jadwal gig, konser, dan gig kecil-kecilan lengkap dengan poster acara dan sistem moderasi.
- 💀 **Scene Index:** Direktori roster band underground lokal dari berbagai subgenre (Metal, Grindcore, Hardcore, Sludge, dll).
- 🏷️ **The Vault & Pit Board:** Arsip rilisan fisik kaset/CD serta papan informasi kehilangan barang di tengah moshpit.
- 🛡️ **Role-Based Control Center:** Panel admin & kontributor (`super-admin`, `editor`, `contributor`) buat moderasi konten secara real-time.

---

## 🛠️ TECH STACK

- **Framework:** Laravel 13
- **Frontend & Styling:** Tailwind CSS, Alpine.js, Blade Templates
- **Rich Text Editor:** Quill.js
- **Database:** MySQL

---

## 🚀 GETTING STARTED (LOCAL SETUP)

Kloning repositori ini dan jalankan ritual lokal lo:

```bash
# 1. Install dependencies PHP & JavaScript
composer install
npm install && npm run build

# 2. Salin file environment & generate key
cp .env.example .env
php artisan key:generate

# 3. Konfigurasi database di .env, lalu jalankan migrasi & seeder
php artisan migrate --seed

# 4. Link storage publik untuk gambar cover & poster
php artisan storage:link

# 5. Nyalakan server lokal
php artisan serve
