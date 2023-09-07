<?php
    include 'koneksi.php';
    $id = $_GET['id_penilaian'];

    $hasil = $conn-> query("DELETE FROM penilaian WHERE id_penilaian='$id'");
    
    // Hasil Data
    if ($hasil) {
    echo "<script>
    alert('Data Berhasil Di Hapus.');
    window.location.href= 'penilaian.php';
    </script>";
    } else {
    echo "<script>
    alert('Opps, Data Gagal Di Hapus !');
    window.location.href= 'penilaian.php';
    </script>";
    }
?>