<?php
    include 'koneksi.php';
    $id = $_GET['id_handphone'];

    $hasil = $conn-> query("DELETE FROM alternative WHERE id_handphone='$id'");
    
    // Hasil Data
    if ($hasil) {
    echo "<script>
    alert('Data Berhasil Di Hapus.');
    window.location.href= 'alternative.php';
    </script>";
    } else {
    echo "<script>
    alert('Opps, Data Gagal Di Hapus !');
    window.location.href= 'alternative.php';
    </script>";
    }
?>