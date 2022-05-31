<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "LaundrySystem";
$port       = "3307";

$connection    = mysqli_connect($host, $user, $pass, $db, $port);
if (!$connection) { //cek koneksi
    die("Cannot Connect to Database");
}
$I_OrderDate    = "";
$I_EndDate      = "";
$I_Pickup       = "";
$I_Quantity     = "";
$I_Status       = "";
// $I_ShelfCode    = "";
$timestamp   = date('Y-m-d H:i:s');
$random      = rand(001, 999);
$success     = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
$op = '';
// if($op == 'delete'){
//     $id         = $_GET['id'];
//     $sql1       = "delete from Customers where id = '$id'";
//     $q1         = mysqli_query($koneksi,$sql1);
//     if($q1){
//         $sukses = "Berhasil hapus data";
//     }else{
//         $error  = "Gagal melakukan delete data";
//     }
// }
// if ($op == 'edit') {
//     $id         = $_GET['C_NO'];
//     $sql1       = "select * from Customers where id = '$id'";
//     $q1         = mysqli_query($connection, $sql1);
//     $r1         = mysqli_fetch_array($q1);
//     $C_Name      = $r1['C_Name'];
//     $C_Sex       = $r1['C_Sex'];
//     $C_DOB       = $r1['C_DOB'];
//     $C_Address   = $r1['C_Address'];
//     $C_Telp      = $r1['C_Telp'];

//     if ($C_Name == '') {
//         $error = "Cannot find the data!";
//     }
// }

if (isset($_POST['simpan'])) { //untuk create
    // $simpan       = $_POST['simpan'];
    $I_OrderDate    = $_POST['I_OrderDate'];
    $I_EndDate      = $_POST['I_EndDate'];
    $I_Pickup       = $_POST['I_Pickup'];
    $I_Quantity     = $_POST['I_Quantity'];
    $I_Status       = $_POST['I_Status'];
    // $I_ShelfCode    = $_POsST['I_ShelfCode'];
    if ($I_OrderDate && $I_EndDate && $I_Pickup && $I_Quantity && $I_Status) {
        // die("Yes");
        $sql1   = "INSERT INTO Invoice(I_OrderDate,I_EndDate,I_Pickup,I_Quantity,I_Status, I_ShelfCode) VALUE ('$I_OrderDate','$I_EndDate','$I_Pickup','$I_Quantity','$I_Status', '$random');";
        // $sql2   = "SELECT SUM ";
        // die($sql1);
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
    <link rel="stylesheet" href="style.css">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 150px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Laundry System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Customers </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Employee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="invoice.php">Invoice</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
  </div>
</nav>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create Invoice
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
                        <label for="C_Name" class="col-sm-2 col-form-label">Order Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="I_OrderDate" name="I_OrderDate" value="<?php echo $I_OrderDate ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="I_EndDate" name="I_EndDate" value="<?php echo $I_EndDate ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Pickup</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="I_Pickup" name="I_Pickup" value="<?php echo $I_Pickup ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="I_Quantity" name="I_Quantity" value="<?php echo $I_Quantity ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="I_Status" name="I_Status" value="<?php echo $I_Status ?>">
                        </div>
                    </div>

                    <!-- <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Shelf Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="I_ShelfCode" name="I_ShelfCode" value="<?php echo $I_ShelfCode ?>">
                        </div>
                    </div> -->

                    <!-- <div class="mb-3 row">
                        <label for="C_Name" class="col-sm-2 col-form-label">Total Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="I_Status" name="I_Status" value="<?php echo $I_Status ?>">
                        </div>
                    </div> -->

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Input" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
</body>

</html>