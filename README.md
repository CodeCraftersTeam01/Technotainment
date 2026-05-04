# 🚀 Technotainment 2026

**Technotainment** adalah platform manajemen event modern yang dirancang untuk mengelola berbagai kompetisi teknologi dan hiburan dalam satu ekosistem yang terintegrasi. Dibangun dengan estetika **Apple-style Futuristic UI**, platform ini menawarkan pengalaman pengguna yang premium, sangat cepat, dan responsif.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=for-the-badge&logo=vite)
![Performance](https://img.shields.io/badge/Performance-Optimized-success?style=for-the-badge)

## ✨ Fitur Utama

### 🛠 Manajemen Event (Multi-Event)
*   **Dukungan Multi-Tahun:** Kelola event Technotainment dari tahun ke tahun dalam satu dashboard.
*   **Kontrol Dinamis:** Pengaturan tema, deskripsi, logo, dan status event langsung dari panel admin.

### 🏆 Kompetisi & Pendaftaran
*   **Kategori Luas:** Mendukung kompetisi E-Sports (MLBB, PES, dll) dan Non-E-Sports (UI/UX, Web Design).
*   **Alur Pendaftaran Smooth:** Form registrasi multi-step yang intuitif dengan validasi otomatis.
*   **Token-Based Access:** Peserta masuk ke dashboard menggunakan token unik untuk keamanan dan kemudahan.

### 👤 Dashboard Peserta
*   **Manajemen Tim:** Kelola data anggota dan unggah karya secara langsung.
*   **Deadline Tracking:** Pantau batas waktu pengumpulan karya (Proposal, PPT, Link Demo).

### 🛡 Panel Admin (Powerful)
*   Manajemen lengkap untuk: **Event, Kompetisi, Tim Peserta, Pengumuman, Sponsor, dan Media Partner.**

## ⚡ Optimasi Performa (V3.1)

Kami melakukan perombakan besar untuk memastikan website ini berjalan secepat kilat:
*   **Bundle Splitting:** Memisahkan library berat (seperti Toast UI Editor) dari bundle utama guest. Ukuran JS utama turun dari **603kB menjadi <1kB**.
*   **Database-to-File Driver:** Mengalihkan *Session* dan *Cache* ke sistem file untuk mengurangi beban *query* database pada setiap *request*.
*   **Lazy Loading Assets:** Penggunaan `with()` pada Eloquent untuk mencegah masalah *N+1 Query*.
*   **Non-Blocking Fonts:** Optimasi pemuatan Google Fonts agar tidak menahan proses *rendering* halaman.

## 🎨 Teknologi yang Digunakan

*   **Backend:** PHP 8.2+ & Laravel 11.x
*   **Frontend:** Tailwind CSS (Futuristic Dark Theme) & Alpine.js
*   **Build Tool:** Vite 6.x
*   **UI Components:** Blade Components, SweetAlert2, Toast UI Editor (Admin Only)

## 🚀 Cara Instalasi

1.  **Clone Repository**
    ```bash
    git clone https://github.com/CodeCraftersTeam01/Technotainment.git
    cd Technotainment
    ```

2.  **Instal Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Sesuaikan pengaturan database di file `.env`.*

4.  **Migrasi & Seed**
    ```bash
    php artisan migrate --seed
    ```

5.  **Build Assets & Jalankan Server**
    ```bash
    npm run dev
    # atau untuk produksi
    npm run build
    php artisan serve
    ```

---

Dibuat dengan ❤️ oleh **Code Crafters Team 01**.
