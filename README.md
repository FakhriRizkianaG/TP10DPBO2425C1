# TP10DPBO2425C1
TP 10 Frizkia (Fakhri Rizkiana)

# Janji
Saya Fakhri Rizkiana Sya'ban Kusnendar dengan NIM 2405534 mengerjakan<br> 
TP 10 dalam mata kuliah Desain dan Pemrograman<br>
Berorientasi Objek untuk keberkahanNya maka saya tidak<br>
melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.<br>

# Penjelasan Program
Program ini adalah program game store (kek steam) yang bisa menampilkan data games yang ada, juga bisa menampilkan user, developer, dan enginenya.

Struktur program ini menggunakan struktur MVVM dan mempunyai implementasi CRUD untuk setiap tabelnya.

<pre>
DPBO_MVVM/
├── config/
│   └── Database.php          # Konfigurasi Koneksi DB
├── database/
│   └── gamestore_db.sql      # Skema Database Awal (SQL Script)
├── models/
│   ├── User.php              # Model data untuk tabel Users
│   ├── Developer.php         # Model data untuk tabel Developers
│   ├── Engine.php            # Model data untuk tabel Engines
│   └── Game.php              # Model data untuk tabel Games
├── viewmodels/
│   ├── UserViewModel.php     # Logika CRUD dan Data Binding untuk Users
│   ├── DeveloperViewModel.php
│   ├── EngineViewModel.php
│   └── GameViewModel.php
├── views/
│   ├── template/             # Header dan Footer HTML
│   ├── user_list.php         # Tampilan daftar User (Read)
│   ├── user_form.php         # Tampilan form User (Create/Update)
│   ├── developer_list.php
│   ├── developer_form.php
│   ├── engine_list.php
│   ├── engine_form.php
│   ├── game_list.php
│   └── game_form.php
└── index.php                 # Front Controller / Router Utama
</pre>

<h2>🎯 Panduan Penggunaan</h2>
    <p>Aplikasi ini menggunakan URL yang berorientasi pada aksi:</p>
    <table>
        <thead>
            <tr>
                <th>Aksi</th>
                <th>URL Contoh</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Read</strong></td>
                <td><code>index.php?page=users</code></td>
                <td>Menampilkan semua data Users.</td>
            </tr>
            <tr>
                <td><strong>Create</strong></td>
                <td><code>index.php?page=games&amp;action=create</code></td>
                <td>Menampilkan form untuk Game baru.</td>
            </tr>
            <tr>
                <td><strong>Edit</strong></td>
                <td><code>index.php?page=developers&amp;action=edit&amp;id=5</code></td>
                <td>Mengambil data Developer dengan ID 5 ke ViewModel dan menampilkannya di form.</td>
            </tr>
            <tr>
                <td><strong>Delete</strong></td>
                <td><code>index.php?page=engines&amp;action=delete&amp;id=2</code></td>
                <td>Menghapus data Engine dengan ID 2.</td>
            </tr>
        </tbody>
    </table>
    <p>Gunakan menu navigasi di bagian atas halaman untuk berpindah antara halaman CRUD masing-masing tabel.</p>
    
# Dokumentasi


https://github.com/user-attachments/assets/67cc7b22-559f-4aa5-b576-1b8dd0c48f90



