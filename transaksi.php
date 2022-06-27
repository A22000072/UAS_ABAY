<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

?>
<!DOCTYPE html>
<html>

<head>
  <title>TRANSAKSI</title>

</head>

<body>

  <?php

  include('tampilan/header.php');
  include('tampilan/footer.php');
  include('tampilan/sidebar.php');
  ?>

  <!-- main content -->
  <div class="main-content bg-primary">
    <section class="section">
      <div class="section-header">
        <h1>TRANSAKSI</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item text-primary">Transaksi</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>TRANSAKSI PEMBAYARAN</h3>
              <div class="card-header-form">
                <form action="proses_transaksi.php" method="post">
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">id Petugas</span>
              </div>
              <input type="text" name="id_petugas" class="form-control" placeholder="id petugas" aria-label="masukkan id petugas" aria-describedby="basic-addon1" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">NIM</span>
              </div>
              <input type="text" name="nim" class="form-control" placeholder="nim" aria-label="masukkan nim" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Tanggal Bayar</span>
              </div>
              <input type="text" name="tgl_bayar" class="form-control" placeholder="" aria-label="tanggal" aria-describedby="basic-addon1" value="<?= date("Y/m/d"); ?>">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Bulan Bayar</label>
              </div>
              <select class="custom-select" name="bulan_dibayar" id="inputGroupSelect01">
                <option selected>--pilih bulan--</option>
                <option value="januari">Januari</option>
                <option value="februari">Februari</option>
                <option value="maret">Maret</option>
                <option value="januari">April</option>
                <option value="februari">Mei</option>
                <option value="maret">Juni</option>
                <option value="januari">Juli</option>
                <option value="februari">Agustus</option>
                <option value="maret">September</option>
                <option value="januari">oktober</option>
                <option value="februari">november</option>
                <option value="maret">desember</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Tahun Bayar</label>
              </div>
              <select class="custom-select" name="tahun_dibayar" id="tahun_dibayar">
                <option selected>--pilih tahun--</option>
                <?php
                // jalankan query untuk menampilkan semua data diurutkan berdasarkan id
                $query = "SELECT * FROM spp where nominal";
                $result = mysqli_query($koneksi, $query);
                //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row["nominal"] . ' ">' . $row['tahun'] . '</option>';
                } ?>
              </select>
            </div>



            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">jumlah</span>
              </div>
              <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" placeholder="jumlah bayar" aria-label="masukkan nominal" aria-describedby="basic-addon1" required readonly>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">bayar</span>
              </div>
              <input type="text" name="bayar" id="bayar" class="form-control" placeholder="bayar" aria-label="masukkan nominal" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">kembalian</span>
              </div>
              <input type="text" name="kembalian" id="kembalian" class="form-control" placeholder="jumlah bayar" aria-label="masukkan nominal" aria-describedby="basic-addon1" readonly>
            </div>

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-success">Bayar</button>


              </form>
            </div>







            <br />




            <form action="" method="get">
              <h2>DATA BAYAR MAHASISWA SESUAI NIM</h2>
              <table class="table">
                <tr>
                  <td>NIM</td>
                  <td>:</td>
                  <td>
                    <input class="form-control" type="text" name="nim" placeholder="--Data NIM Lihat Di Form Siswa--">
                  </td>
                  <td>
                    <button class="btn btn-success" type="submit" name="cari">Cari</button>
                  </td>
                </tr>

              </table>
            </form>
            <?php
            if (isset($_GET['nim']) && $_GET['nim'] != '') {
              $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_GET[nim]'");
              $data = mysqli_fetch_array($query);
              $nim = $data['nim'];

            ?>

              <h2>DATA SISWA</h2>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">NAMA MAHASISWA</th>
                    <th scope="col">ID KELAS</th>

                  </tr>
                </thead>
                <tbody>
                  <td><?php echo $data['nim']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['id_kelas']; ?></td>
                </tbody>
              </table>

              <h2>DATA SPP MAHASISWA</h2>
              <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <!-- <th scope="col">Id Pembayaran</th> -->
                    <th scope="col">id petugas</th>
                    <th scope="col"> NIM</th>
                    <th scope="col">Tgl Bayar</th>
                    <th scope="col">Bulan Bayar</th>
                    <th scope="col">Tahun Bayar</th>
                    <th scope="col">Jumlah</th>

                  </tr>
                </thead>

                <tbody>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nim='$data[nim]' ORDER BY bulan_dibayar ASC");


                  while ($data = mysqli_fetch_array($query)) {
                    echo " <tr>
                          
                          <td>$data[id_petugas]</td>
                          <td>$data[nim]</td>
                          <td>$data[tgl_bayar]</td>
                          <td>$data[bulan_dibayar]</td>
                          <td>$data[tahun_dibayar]</td>
                          <td>$data[jumlah_bayar]</td>

                        </tr>";
                  }

                  ?>

                </tbody>

              </table>

            <?php
            }
            ?>

          </div>
          <script>
            $(document).ready(function() {

              $("#tahun_dibayar").change(function() {
                var jumlah_bayar = $(this).val();
                $("#jumlah_bayar").val(jumlah_bayar);
              });

              $("#bayar").keyup(function() {
                var jumlah_bayar = $("#jumlah_bayar").val();
                var bayar = $("#bayar").val();
                $("#kembalian ").val(bayar - jumlah_bayar);
                // $("#total").val(biaya);
              });

            });
          </script>
</body>

</html>