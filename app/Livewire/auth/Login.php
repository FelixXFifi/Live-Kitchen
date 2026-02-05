<?php
// Cek jika form dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil input dari user
    $userIn = $_POST['username'] ?? '';
    $passIn = $_POST['password'] ?? '';

    // Pengecekan Kredensial sesuai kode asli Anda
    if ($userIn === "salsabilla" && $passIn === "2007") {
        // Jika berhasil, arahkan ke dashboard
        header("Location: dashboard.html");
        exit();
    } else {
        // Jika gagal, tampilkan alert dan kembali ke halaman login
        echo "<script>
                alert('Akses ditolak. Silakan periksa kembali username dan password Anda.');
                window.location.href = 'login.blade.php'; 
              </script>";
    }
} else {
    // Jika mencoba akses langsung file ini tanpa POST, kembalikan ke login
    header("Location: login.blade.php");
    exit();
}
?>