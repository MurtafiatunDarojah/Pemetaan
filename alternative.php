<!-- Pemanggilan file header yang ada di dalam folder view  -->
<?php include 'view/head.php' ?>

<!-- Pemanggilan file menu navbar yang ada di dalam folder view  -->
<?php include 'view/navbar.php' ?>

<?php
    include 'koneksi.php';

    if (isset($_POST['simpan'])) {
        $merek = $_POST['merek'];
        $tipe = $_POST['tipe'];

        // Hasil Data
        $hasil = $conn-> query("SELECT * FROM alternative WHERE merek='$merek'");

        // Cek Apakah Data Sudah Sudah Ada Di Dalam Database Atau Tidak
        if ($hasil->num_rows>0) {
            echo "<script>
            alert('Data Dengan Merek $merek Sudah Ada !');
            </script>";
        } else {
        $hasil = $conn-> query("INSERT INTO alternative(merek, tipe) VALUES ('$merek', '$tipe') ");
        if ($hasil) {
            echo "<script>
            alert('Data Alternative Berhasil Di Tambahkan.');
            </script>";
        } else 
            echo "<script>
            alert('Opps, Data Alternative Gagal Di Tambahkan !');
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
                    <h4>Input Data Alternative</h4>
                </div>

                <div class="card-body">

                    <form action="alternative.php" method="POST">
                        <div class="form-group">
                            <label>Merek Handphone</label>
                            <input type="text" class="form-control" name="merek" required>
                        </div>

                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" class="form-control">
                                <option>--Silahkan Pilih--</option>
                                <option value="android">Android</option>
                                <option value="ios">IOS</option>
                            </select>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Table Data Alternative</h4>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $no = 0;
                                        $hasil = $conn->query("SELECT * FROM alternative");
                                        if ($hasil -> num_rows > 0) {
                                            while ($row = $hasil-> fetch_assoc()){
                                        ?>
                                    <tr>
                                        <td><?= $no +=1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['tipe']; ?></td>
                                        <td><a class="btn btn-danger" onclick="return confirm ('Data Ingin Di Hapus?');"
                                                href="delete_alternative.php?id_handphone=<?= $row['id_handphone']; ?>">Delete</a>
                                            <a href="edit_alternative.php?id_handphone=<?= $row['id_handphone']; ?>"
                                                class="btn btn-info">Edit
                                                Data</a>
                                        </td>
                                    </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<?php include 'view/footer.php' ?>