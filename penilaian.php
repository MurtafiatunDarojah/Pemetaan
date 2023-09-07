<!-- Pemanggilan file header yang ada di dalam folder view  -->
<?php include 'view/head.php' ?>

<!-- Pemanggilan file menu navbar yang ada di dalam folder view  -->
<?php include 'view/navbar.php' ?>

<?php
    include 'koneksi.php';

    if (isset($_POST['simpan'])) {
        $merek = $_POST['merek'];
        $harga = $_POST['harga'];
        $ram = $_POST['ram'];
        $memori = $_POST['memori'];
        $processor = $_POST['processor'];
        $kamera = $_POST['kamera'];

        // Hasil Data
        $hasil = $conn-> query("SELECT * FROM penilaian WHERE merek='$merek'");

        // Cek Apakah Data Sudah Sudah Ada Di Dalam Database Atau Tidak
        if ($hasil->num_rows>0) {
            echo "<script>
            alert('Data Dengan Merek $merek Sudah Terdaftar !');
            </script>";
        } else {
        $hasil = $conn-> query("INSERT INTO penilaian(merek, harga, ram, memori, processor, kamera) VALUES ('$merek', '$harga', '$ram', '$memori', '$processor', '$kamera') ");
        
        if ($hasil) {
            echo "<script>
            alert('Penilaian Berhasil Di Tambahkan.');
            </script>";
        } else {
            echo "<script>
            alert('Opps, Penilaian Gagal Di Tambahkan !');
            </script>";
        }
        }
    }
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penilaian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Input Data Penilaian</h4>
                        </div>

                        <div class="card-body">

                            <form action="" method="POST">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Merek Handphone</label>
                                    <div class="col-lg-10">
                                        <select name="merek" class="form-control">
                                            <?php
                                            $hasil = $conn->query("SELECT merek FROM alternative");
                                            while ($row = $hasil->fetch_assoc()) { ?>
                                            <option><?= $row['merek']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Harga</label>
                                    <div class="col-lg-10">
                                        <select name="harga" id="" class="form-control">
                                            <option>--Silahkan Pilih Harga--</option>
                                            <option value="1">Rp. 1.000.000</option>
                                            <option value="2">Diatas Rp. 2.000.000</option>
                                            <option value="3">Diatas Rp. 5.000.000</option>
                                            <option value="4">Diatas Rp. 8.000.000</option>
                                            <option value="5">Diatas Rp. 10.000.000</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Ram</label>
                                    <div class="col-lg-10">
                                        <select name="ram" id="" class="form-control">
                                            <option>--Silahkan Pilih Harga--</option>
                                            <option value="1">3 GB</option>
                                            <option value="2">4 GB</option>
                                            <option value="3">6 GB</option>
                                            <option value="4">8 GB</option>
                                            <option value="5">12 GB</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Memori Internal</label>
                                    <div class="col-lg-10">
                                        <select name="memori" id="" class="form-control">
                                            <option>--Silahkan Pilih Harga--</option>
                                            <option value="1">Diatas 16 GB</option>
                                            <option value="2">Diatas 32 GB</option>
                                            <option value="3">Diatas 64 GB</option>
                                            <option value="4">Diatas 128 GB</option>
                                            <option value="5">Diatas 256 GB</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Processor</label>
                                    <div class="col-lg-10">
                                        <select name="processor" id="" class="form-control">
                                            <option>--Silahkan Pilih Harga--</option>
                                            <option value="1">Helio P60</option>
                                            <option value="2">Snapdragon 632</option>
                                            <option value="3">Apple A9</option>
                                            <option value="4">Snapdragon 855</option>
                                            <option value="5">snapdragon 888</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Kamera</label>
                                    <div class="col-lg-10">
                                        <select name="kamera" id="" class="form-control">
                                            <option>--Silahkan Pilih Harga--</option>
                                            <option value="1">Diatas 3 Mp</option>
                                            <option value="2">Diatas 5 Mp</option>
                                            <option value="3">Diatas 8 Mp</option>
                                            <option value="4">Diatas 12 Mp</option>
                                            <option value="5">Diatas 16 Mp</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Table Data Penilaian</h4>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Ram</th>
                                        <th scope="col">Memori Internal</th>
                                        <th scope="col">Processor</th>
                                        <th scope="col">Kamera</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $no = 0;
                                        $hasil = $conn->query("SELECT * FROM penilaian");
                                        if ($hasil -> num_rows > 0) {
                                            while ($row = $hasil-> fetch_assoc()){
                                        ?>
                                    <tr>
                                        <td><?= $no +=1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td><?= $row['ram']; ?></td>
                                        <td><?= $row['memori']; ?></td>
                                        <td><?= $row['processor']; ?></td>
                                        <td><?= $row['kamera']; ?></td>
                                        <td><a class="btn btn-danger btn-flat rounded"
                                                onclick="return confirm ('Data Ingin Di Hapus?');"
                                                href="delete_penilaian.php?id_penilaian=<?= $row['id_penilaian']; ?>"><i
                                                    class="fa fa-trash"></i></a>

                                            <a href="edit_penilaian.php?id_penilaian=<?= $row['id_penilaian']; ?>"
                                                class="btn btn-info btn-flat rounded"><i class="fa fa-pen"></i></a>
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