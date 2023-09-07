<!-- Pemanggilan file header yang ada di dalam folder view  -->
<?php include 'view/head.php' ?>

<!-- Pemanggilan file menu navbar yang ada di dalam folder view  -->
<?php include 'view/navbar.php' ?>

<?php
    include 'koneksi.php';

    if (isset($_POST['edit'])) {
        $id = $_GET['id_handphone'];
        $merek = $_POST['merek'];
        $tipe = $_POST['tipe'];

        // Hasil Data
        $hasil = $conn-> query("UPDATE alternative SET merek='$merek', tipe='$tipe' WHERE id_handphone ='$id'");
        if ($hasil) {
            echo "<script>
            alert('Data Berhasil Di Ubah.');
            window.location.href= 'alternative.php';
            </script>";
        } else {
            echo "<script>
            alert('Opps, Data Gagal Di Edit !');
            </script>";
        }
    }
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Alternative</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Alternative</h4>
                </div>

                <div class="card-body">

                    <form action="" method="POST">

                        <?php
                        $id = $_GET['id_handphone'];
                        $hasil = $conn->query("SELECT * FROM alternative WHERE id_handphone='$id'");
                        if ($hasil->num_rows > 0) {
                            $row = $hasil->fetch_assoc();
                            $merek = $row['merek'];
                            $tipe = $row['tipe'];
                        ?>

                        <div class="form-group">
                            <label>Merek Handphone</label>
                            <input type="text" class="form-control" name="merek" required value="<?= $merek; ?>">
                        </div>

                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" class="form-control">
                                <option><?= $tipe; ?></option>
                                <option value="android">Android</option>
                                <option value="ios">IOS</option>
                            </select>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary">Ubah</button>
                        <?php } ?>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include 'view/footer.php' ?>