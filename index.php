<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "LaundrySystem";

$connection    = mysqli_connect($host, $user, $pass, $db);
if (!$connection) { //cek koneksi
    die("Cannot Connect to Database");
}
$C_Name      = "";
$C_DOB       = "";
$C_Address   = "";
$C_Sex       = "";
$C_Telp      = "";
$success     = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from Customers where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['C_NO'];
    $sql1       = "select * from Customers where id = '$id'";
    $q1         = mysqli_query($connection, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $C_Name      = $r1['C_Name'];
    $C_Sex       = $r1['C_Sex'];
    $C_DOB       = $r1['C_DOB'];
    $C_Address   = $r1['C_Address'];
    $C_Telp      = $r1['C_Telp'];

    if ($C_Name == '') {
        $error = "Cannot find the data!";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $simpan       = $_POST['simpan'];
    $C_Name       = $_POST['C_Name'];
    $C_Sex        = $_POST['C_Sex'];
    $C_DOB        = $_POST['C_DOB'];
    $C_Address    = $_POST['C_Address'];
    $C_Telp       = $_POST['C_Telp'];

    if ($C_Name && $C_Sex && $C_DOB && $C_Address && $C_Telp) {
      $sql1   = "insert into Customers(C_Name,C_Sex,C_DOB,C_Address,C_Telp) values ('$C_Name','$C_Sex','$C_DOB','$C_Address','$C_Telp')";
      $q1     = mysqli_query($connection, $sql1);
      if ($q1) {
          $sukses     = "Success Inserted Data!";
      } else {
          $error      = "Error Insert Data";
      }
    } 
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data Customers
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="C_Name" name="C_Name" value="<?php echo $C_Name ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="C_Sex" class="col-sm-2 col-form-label">Sex</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="C_Sex" id="C_Sex">
                                <option value="">- Gender -</option>
                                <option value="saintek" <?php if ($C_Sex == "M") echo "selected" ?>>Male</option>
                                <option value="soshum" <?php if ($C_Sex == "F") echo "selected" ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">DOB</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="C_DOB" name="C_DOB" value="<?php echo $C_DOB ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="C_Address" name="C_Address" value="<?php echo $C_Address ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">No. Telp</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="C_Telp" name="C_Telp" value="<?php echo $C_Telp ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Input" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <!-- <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Fakultas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $fakultas   = $r2['fakultas'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div> -->
</body>

</html>