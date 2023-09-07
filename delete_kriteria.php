<?php
    include 'koneksi.php';
    $id = $_GET['id_kriteria'];

    $hasil = $conn-> query("DELETE FROM kriteria WHERE id_kriteria='$id'");
    
    // Hasil Data
    if ($hasil) {
    echo "<script>
    alert('Data Berhasil Di Hapus.');
    window.location.href= 'kriteria.php';
    </script>";
    } else {
    echo "<script>
    alert('Opps, Data Gagal Di Hapus !');
    window.location.href= 'kriteria.php';
    </script>";
    }
?>