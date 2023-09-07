<!-- Pemanggilan file header yang ada di dalam folder view  -->
<?php include 'view/head.php' ?>

<!-- Pemanggilan file menu navbar yang ada di dalam folder view  -->
<?php include 'view/navbar.php' ?>

<?php
    include 'koneksi.php';
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Alternative</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Matriks X</h4>
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
                                        <td><?= $no += 1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td><?= $row['ram']; ?></td>
                                        <td><?= $row['memori']; ?></td>
                                        <td><?= $row['processor']; ?></td>
                                        <td><?= $row['kamera']; ?></td>
                                    </tr>
                                    <?php } 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vektor S</h4>
                        </div>

                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Vektor S</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $no = 0;
                                    $b1 = '';
                                    $b2 = '';
                                    $b3 = '';
                                    $b4 = '';
                                    $b5 = '';

                                    // Mengambil Bobot Dari Kriteria
                                    $hasil = $conn->query("SELECT * FROM kriteria");
                                    if ($hasil -> num_rows > 0) {
                                        $row = $hasil->fetch_assoc();
                                        $b1 = ($row['harga'] / 12.5) * -1;
                                        $b2 = ($row['ram'] / 12.5) * 1;
                                        $b3 = ($row['memori'] / 12.5) * 1;
                                        $b4 = ($row['processor'] / 12.5) * 1;
                                        $b5 = ($row['kamera'] / 12.5) * 1;
                                    }

                                    // Mengosongkan Nilai Pada Tabel Perengkingan
                                    $hasil = $conn->query("TRUNCATE TABLE perhitungan");

                                    // Mengambil Data Penilaian
                                    $hasil = $conn->query("SELECT * FROM penilaian");
                                    if ($hasil->num_rows > 0) {
                                        while ($row= $hasil->fetch_assoc()) {
                                            // Mencari Nilai Vektor S
                                            $nilai_vektors = (
                                                pow($row['harga'], $b1)*
                                                pow($row['ram'], $b2)*
                                                pow($row['memori'], $b3)*
                                                pow($row['processor'], $b4)*
                                                pow($row['kamera'], $b5)
                                            );
                                            $merek = $row['merek'];
                                            $hasil_hitung = $conn->query("INSERT INTO perhitungan(merek, vektors) VALUES ('$merek', '$nilai_vektors')");
                                        }
                                    }

                                    // Mengambil Data Hasil Perengkingan
                                    $hasil = $conn->query("SELECT * FROM perhitungan");
                                    if($hasil->num_rows>0){
                                        while ($row= $hasil->fetch_assoc()) {
                                        ?>

                                    <tr>
                                        <td><?= $no += 1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['vektors']; ?></td>
                                    </tr>
                                    <?php }
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vektor V</h4>
                        </div>

                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Vektor V</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $no = 0;
                                    
                                    $hasil = $conn->query("SELECT SUM(vektors) FROM perhitungan");
                                    $row = $hasil->fetch_array();
                                    $total = $row[0];

                                    // Mengosongkan Nilai Pada Tabel Perengkingan
                                    $hasil = $conn->query("TRUNCATE TABLE perangkingan");

                                    // Mencari Hasil Vektor V
                                    $hasil = $conn->query("SELECT * FROM perhitungan");
                                    if ($hasil->num_rows > 0) {
                                        while ($row= $hasil->fetch_assoc()) {
                                            $nilai = $row['vektors'] / $total;
                                            $merek = $row['merek'];

                                            $hasil_perengkingan = $conn->query("INSERT INTO perangkingan(merek, hasil) VALUES ('$merek', '$nilai')");
                                        }
                                    }

                                    $hasil = $conn->query("SELECT * FROM perangkingan");
                                    if ($hasil -> num_rows > 0) {
                                        while ($row= $hasil->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?= $no += 1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['hasil']; ?></td>
                                    </tr>
                                    <?php }
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hasil Rangking</h4>
                        </div>

                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Perengkingan</th>
                                        <th scope="col">Merek / Alternative</th>
                                        <th scope="col">Nilai Vektor</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $hasil = $conn->query("SELECT * FROM perangkingan ORDER BY hasil DESC");
                                    if ($hasil->num_rows > 0) {
                                        while ($row= $hasil->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?= $no += 1 ?></td>
                                        <td><?= $row['merek']; ?></td>
                                        <td><?= $row['hasil']; ?></td>
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