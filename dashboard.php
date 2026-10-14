<?php
session_start();

// Proteksi: Wajib Verifikasi
if (!isset($_SESSION['pasien_id'])) {
    header("Location: index.php");
    exit();
}

$nama_pasien = $_SESSION['nama_lengkap'];
$asal_kota   = $_SESSION['asal_kota'];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Layanan Digital BNNP Kaltara</title>
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#0b132b] text-slate-100 min-h-screen flex flex-col">

    <!-- Header Navbar Sticky -->
    <header class="bg-[#1c2541]/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-800">
        <div class="max-w-2xl mx-auto px-4 py-3.5 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-blue-600/20 border border-blue-500/40 rounded-xl flex items-center justify-center text-blue-400 font-bold">
                    <i class="fa-solid fa-shield-halved text-base"></i>
                </div>
                <h1 class="font-bold text-sm md:text-base text-white tracking-wide">Portal Layanan Digital BNNP Kaltara</h1>
            </div>

            <!-- Tombol Navigasi Garis 3 (Hamburger Menu) -->
            <button onclick="toggleMenu()" class="w-10 h-10 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-200 flex items-center justify-center border border-slate-700 transition-colors">
                <i class="fa-solid fa-bars text-lg" id="menuIcon"></i>
            </button>
        </div>

        <!-- Menu Navigasi Drawer -->
        <div id="navDrawer" class="hidden bg-[#1c2541] border-b border-slate-800 px-4 py-3 space-y-2 max-w-2xl mx-auto">
            <a href="#call-center" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-solid fa-phone text-rose-400 w-4"></i>
                <span>Call Center 184</span>
            </a>
            <a href="#wa-konselor" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-brands fa-whatsapp text-emerald-400 w-4"></i>
                <span>WhatsApp Konselor</span>
            </a>
            <a href="#skhpn" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-solid fa-vial w-4 text-blue-400"></i>
                <span>Layanan Tes Urine (SKHPN)</span>
            </a>
            <a href="#rehab" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-solid fa-hand-holding-medical text-amber-400 w-4"></i>
                <span>Pendaftaran Rehabilitasi</span>
            </a>
            <a href="#tes-adiksi" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-solid fa-clipboard-list text-purple-400 w-4"></i>
                <span>Skrining Mandiri Adiksi</span>
            </a>
            <a href="#direktori" onclick="toggleMenu()" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white text-xs font-medium">
                <i class="fa-solid fa-building text-cyan-400 w-4"></i>
                <span>Direktori Kantor BNN</span>
            </a>
            <div class="pt-2 border-t border-slate-800/80">
                <a href="logout.php" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-rose-400 hover:bg-rose-500/20 text-xs font-medium">
                    <i class="fa-solid fa-right-from-bracket w-4"></i>
                    <span>Reset / Ganti Data Pengunjung</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-xl mx-auto px-4 py-6 w-full space-y-4 flex-grow">

        <!-- Banner Informasi Bebas Pidana (Sesuai Gambar) -->
        <div class="bg-[#151c33] border border-slate-800 rounded-2xl p-4 text-center text-xs text-slate-300 leading-relaxed shadow-lg">
            Bagi masyarakat atau keluarga yang melaporkan diri secara voluntary 
            <strong class="text-amber-400 font-bold">DIJAMIN BEBAS DARI SANKSI PIDANA</strong> 
            dan identitas dirahasiakan penuh.
        </div>

        <!-- Pill Status Pengunjung (Sesuai Gambar) -->
        <div class="bg-[#151c33]/80 border border-slate-800 rounded-2xl px-4 py-2.5 flex items-center justify-between text-xs text-slate-300">
            <div class="flex items-center space-x-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Pengunjung: <strong class="text-white"><?= htmlspecialchars($nama_pasien); ?></strong> (<?= htmlspecialchars($asal_kota); ?>)</span>
            </div>
            <a href="logout.php" class="text-amber-400 hover:underline font-medium text-[11px] flex items-center space-x-1">
                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                <span>Ubah Data</span>
            </a>
        </div>

        <!-- LIST STACKED CARDS / LINKTREE STYLE (Sesuai Gambar) -->

        <!-- 1. CALL CENTER DARURAT BNN (KOTAK MERAH) -->
        <a id="call-center" href="tel:184" 
            class="group block bg-gradient-to-r from-rose-700 via-red-600 to-rose-700 hover:from-rose-600 hover:to-red-500 text-white rounded-2xl p-4 shadow-xl border border-rose-500/30 transition-all transform hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 bg-white/10 rounded-xl flex items-center justify-center text-xl text-white group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-sm uppercase tracking-wide">Call Center Darurat BNN</h2>
                        <p class="text-lg font-black tracking-tight text-white flex items-center gap-2">
                            <span>184</span>
                            <span class="text-[11px] font-normal text-rose-100">(Bebas Pulsa 24 Jam)</span>
                        </p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right text-rose-200 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- 2. WHATSAPP KONSELOR REHABILITASI -->
        <a id="wa-konselor" href="https://wa.me/6281234567890?text=Halo%20BNNP%20Kaltara,%20saya%20<?= urlencode($nama_pasien); ?>%20dari%20<?= urlencode($asal_kota); ?>%20ingin%20konsultasi" target="_blank" 
            class="group block bg-[#1c2541]/90 hover:bg-[#232e52] border border-slate-700/70 rounded-2xl p-4 shadow-lg transition-all transform hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-sm text-white">WhatsApp Konselor Rehabilitasi</h2>
                        <p class="text-xs text-slate-400">Konsultasi rahasia via WA langsung dengan konselor BNNP Kaltara</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right text-slate-500 group-hover:text-slate-300 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- 3. LAYANAN TES URINE (SKHPN) -->
        <div id="skhpn" class="bg-[#1c2541]/90 border border-slate-700/70 rounded-2xl p-4 shadow-lg space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 bg-blue-500/20 border border-blue-500/30 text-blue-400 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-vial"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-sm text-white">Layanan Tes Urine (SKHPN)</h2>
                        <p class="text-xs text-slate-400">Syarat, checklist berkas, & jadwal tes bebas narkoba</p>
                    </div>
                </div>
            </div>
            <a href="https://wa.me/6281234567890?text=Daftar%20SKHPN%20Atas%20Nama:%20<?= urlencode($nama_pasien); ?>" target="_blank" 
                class="block w-full text-center bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 rounded-xl text-xs transition-colors">
                Daftar Jadwal SKHPN Via WA
            </a>
        </div>

        <!-- 4. PENDAFTARAN REHABILITASI SUKARELA -->
        <div id="rehab" class="bg-[#1c2541]/90 border border-slate-700/70 rounded-2xl p-4 shadow-lg space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 bg-amber-500/20 border border-amber-500/30 text-amber-400 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-hand-holding-medical"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-sm text-white">Pendaftaran Rehabilitasi Sukarela</h2>
                        <p class="text-xs text-slate-400">Rawat jalan / inap gratis & dijamin aman hukum</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="https://wa.me/6281234567890?text=Daftar%20Rehab%20Rawat%20Jalan" target="_blank" class="text-center bg-slate-800 hover:bg-slate-700 border border-slate-600 text-xs py-2 rounded-xl text-slate-200">Rawat Jalan</a>
                <a href="https://wa.me/6281234567890?text=Daftar%20Rehab%20Rawat%20Inap" target="_blank" class="text-center bg-emerald-600 hover:bg-emerald-500 text-xs py-2 rounded-xl text-white font-semibold">Rawat Inap (Gratis)</a>
            </div>
        </div>

        <!-- 5. SKRINING MANDIRI ADIKSI -->
        <div id="tes-adiksi" class="bg-[#1c2541]/90 border border-slate-700/70 rounded-2xl p-4 shadow-lg space-y-3">
            <div class="flex items-center space-x-3.5">
                <div class="w-11 h-11 bg-purple-500/20 border border-purple-500/30 text-purple-400 rounded-xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <div>
                    <h2 class="font-bold text-sm text-white">Skrining Mandiri Adiksi</h2>
                    <p class="text-xs text-slate-400">Tes kuesioner tingkat adiksi mandiri</p>
                </div>
            </div>

            <div class="space-y-2 pt-2 border-t border-slate-800">
                <label class="block text-xs text-slate-300">Apakah Anda merasa dorongan kuat untuk mengonsumsi zat/narkoba dalam sebulan terakhir?</label>
                <select id="q1" class="w-full bg-[#0b132b] border border-slate-700 text-xs text-white rounded-xl p-2.5 focus:outline-none">
                    <option value="0">Tidak Pernah (0 Point)</option>
                    <option value="1">Kadang-kadang (1 Point)</option>
                    <option value="2">Sering / Setiap Hari (2 Point)</option>
                </select>
                <button type="button" onclick="hitungAdiksi()" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-semibold py-2 rounded-xl text-xs transition-colors">
                    Cek Hasil Tingkat Adiksi
                </button>
                <div id="hasilAdiksi" class="hidden p-3 rounded-xl text-xs border"></div>
            </div>
        </div>

        <!-- 6. DIREKTORI KLINIK & KANTOR BNN -->
        <div id="direktori" class="bg-[#1c2541]/90 border border-slate-700/70 rounded-2xl p-4 shadow-lg space-y-3">
            <div class="flex items-center space-x-3.5 border-b border-slate-800 pb-3">
                <div class="w-11 h-11 bg-cyan-500/20 border border-cyan-500/30 text-cyan-400 rounded-xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h2 class="font-bold text-sm text-white">Direktori Klinik & Kantor BNN</h2>
                    <p class="text-xs text-slate-400">Lokasi BNN & Konselor di Kalimantan Utara</p>
                </div>
            </div>

            <div class="space-y-2 text-xs">
                <div class="p-2.5 bg-[#0b132b] rounded-xl border border-slate-800">
                    <strong class="text-blue-400">BNNP Kalimantan Utara</strong><br>
                    <span class="text-slate-300">Konselor: Dr. Aris Setiawan (0812-3456-7890)</span><br>
                    <span class="text-slate-400 text-[11px]">Jl. Trans Kalimantan, Tanjung Selor, Bulungan</span>
                </div>
                <div class="p-2.5 bg-[#0b132b] rounded-xl border border-slate-800">
                    <strong class="text-blue-400">BNNK Tarakan</strong><br>
                    <span class="text-slate-300">Konselor: Siti Rahma, M.Psi (0813-9876-5432)</span><br>
                    <span class="text-slate-400 text-[11px]">Jl. Mulawarman, Kota Tarakan</span>
                </div>
                <div class="p-2.5 bg-[#0b132b] rounded-xl border border-slate-800">
                    <strong class="text-blue-400">BNNK Nunukan</strong><br>
                    <span class="text-slate-300">Konselor: Budi Santoso, S.Tr.Kes (0811-2233-4455)</span><br>
                    <span class="text-slate-400 text-[11px]">Jl. TVRI, Kabupaten Nunukan</span>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="text-center text-[11px] text-slate-500 py-4 border-t border-slate-800/80">
        <p>© 2026 BNNP Kalimantan Utara. All Rights Reserved.</p>
    </footer>

    <!-- Script Interaktif -->
    <script>
        function toggleMenu() {
            const nav = document.getElementById('navDrawer');
            const icon = document.getElementById('menuIcon');
            nav.classList.toggle('hidden');
            
            if (nav.classList.contains('hidden')) {
                icon.className = 'fa-solid fa-bars text-lg';
            } else {
                icon.className = 'fa-solid fa-xmark text-lg';
            }
        }

        function hitungAdiksi() {
            const val = document.getElementById('q1').value;
            const res = document.getElementById('hasilAdiksi');
            res.classList.remove('hidden', 'bg-emerald-500/20', 'bg-amber-500/20', 'bg-rose-500/20', 'border-emerald-500/40', 'border-amber-500/40', 'border-rose-500/40', 'text-emerald-300', 'text-amber-300', 'text-rose-300');

            if (val === "0") {
                res.classList.add('bg-emerald-500/20', 'border-emerald-500/40', 'text-emerald-300');
                res.innerHTML = "<strong>Tingkat Adiksi: Rendah</strong><br>Tetap jaga pola hidup sehat dan jauhi narkoba.";
            } else if (val === "1") {
                res.classList.add('bg-amber-500/20', 'border-amber-500/40', 'text-amber-300');
                res.innerHTML = "<strong>Tingkat Adiksi: Sedang</strong><br>Disarankan konsultasi ringan bersama konselor BNNP.";
            } else {
                res.classList.add('bg-rose-500/20', 'border-rose-500/40', 'text-rose-300');
                res.innerHTML = "<strong>Tingkat Adiksi: Tinggi</strong><br>Sangat disarankan segera mendaftar Rehabilitasi Rawat Jalan/Inap.";
            }
        }
    </script>
</body>
</html>