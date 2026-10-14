<?php
session_start();
require_once 'koneksi.php';

// Jika pasien sudah verifikasi sebelumnya, langsung ke Dashboard
if (isset($_SESSION['pasien_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error_msg = "";

if (isset($_POST['verifikasi'])) {
    $nama = trim(mysqli_real_escape_string($conn, $_POST['nama_lengkap']));
    $kota = trim(mysqli_real_escape_string($conn, $_POST['asal_kota']));

    if (!empty($nama) && !empty($kota)) {
        $sql = "INSERT INTO pasien (nama_lengkap, asal_kota) VALUES ('$nama', '$kota')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['pasien_id']    = mysqli_insert_id($conn);
            $_SESSION['nama_lengkap'] = $nama;
            $_SESSION['asal_kota']    = $kota;

            header("Location: dashboard.php");
            exit();
        } else {
            $error_msg = "Gagal menyimpan ke database: " . mysqli_error($conn);
        }
    } else {
        $error_msg = "Silakan lengkapi semua kolom!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi - Portal BNNP Kaltara</title>
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#0b132b] text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-[#1c2541]/90 backdrop-blur-md rounded-3xl p-6 shadow-2xl border border-slate-700/60">
        <!-- Badge Logo Top -->
        <div class="text-center space-y-2 mb-6">
            <div class="w-14 h-14 bg-blue-600/20 border border-blue-500/40 text-blue-400 rounded-2xl flex items-center justify-center mx-auto text-2xl shadow-inner">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="text-xl font-extrabold tracking-wide text-white">Portal Layanan Digital</h1>
            <p class="text-xs text-amber-400 font-semibold tracking-wider uppercase">BNNP Kalimantan Utara</p>
        </div>

        <?php if (!empty($error_msg)): ?>
            <div class="mb-4 p-3 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-xs flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span><?= $error_msg; ?></span>
            </div>
        <?php endif; ?>

        <!-- Form Verifikasi -->
        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nama Lengkap Pasien</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-user text-sm"></i>
                    </span>
                    <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required 
                        class="w-full pl-10 pr-4 py-3 bg-[#0b132b] border border-slate-700 rounded-xl text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Asal Kota / Kabupaten (Kaltara)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-location-dot text-sm"></i>
                    </span>
                    <select name="asal_kota" required 
                        class="w-full pl-10 pr-4 py-3 bg-[#0b132b] border border-slate-700 rounded-xl text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="" class="bg-[#0b132b]">-- Pilih Wilayah Domisili --</option>
                        <option value="Kab. Malinau" class="bg-[#0b132b]">Kabupaten Malinau</option>
                        <option value="Kab. Bulungan" class="bg-[#0b132b]">Kabupaten Bulungan / Tanjung Selor</option>
                        <option value="Kota Tarakan" class="bg-[#0b132b]">Kota Tarakan</option>
                        <option value="Kab. Nunukan" class="bg-[#0b132b]">Kabupaten Nunukan</option>
                        <option value="Kab. Tana Tidung" class="bg-[#0b132b]">Kabupaten Tana Tidung</option>
                    </select>
                </div>
            </div>

            <button type="submit" name="verifikasi" 
                class="w-full mt-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-3.5 px-4 rounded-xl text-sm shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center space-x-2">
                <span>Verifikasi & Masuk Portal</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>

        <p class="mt-6 text-[11px] text-slate-400 text-center leading-relaxed">
            Identitas dan verifikasi Anda dijamin <strong class="text-amber-400">RAHASIA</strong> & <strong class="text-amber-400">BEBAS SANSI PIDANA</strong> sesuai UU Narkotika.
        </p>
    </div>

</body>
</html>