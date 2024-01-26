<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$Judul_Buku = $Pengarang = $Tahun = $Jumlah = $Penerbit = "";
$Judul_Buku_err = $Pengarang_err = $Tahun_err = $Tahun_err = $Penerbit_err = "";

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Judul Buku
    $input_Judul_Buku = trim($_POST["Judul_Buku"]);
    if (empty($input_Judul_Buku)) {
        $Judul_Buku_err = "Masukkan Judul Buku.";
    } else {
        $Judul_Buku = $input_Judul_Buku;
    }

    // Validate Pengarang
    $input_Pengarang = trim($_POST["Pengarang"]);
    if (empty($input_Pengarang)) {
        $Pengarang_err = "Masukkan Nama Pengarang.";
    } else {
        $Pengarang = $input_Pengarang;
    }

    // Validate Tahun Terbit
    $input_Tahun = trim($_POST["Tahun"]);
    if (empty($input_Tahun)) {
        $Tahun_err = "Masukkan Tahun Terbit.";
    } else {
        $Tahun = $input_Tahun;
    }

    // Validate Jumlah Halaman
    $input_Jumlah = trim($_POST["Jumlah"]);
    if (empty($input_Jumlah)) {
        $Jumlah_err = "Masukkan Jumlah Halaman.";
    } else {
        $Jumlah = $input_Jumlah;
    }

    // Validate Penerbit
    $input_Penerbit = trim($_POST["Penerbit"]);
    if (empty($input_Penerbit)) {
        $Penerbit_err = "Masukkan Nama Penerbit.";
    } else {
        $Penerbit = $input_Penerbit;
    }

    // Check input errors before inserting into the database
    if (empty($Judul_Buku_err) && empty($Pengarang_err) && empty($Tahun_err) && empty($Jumlah_err) && empty($Penerbit_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO databuku (Judul_Buku, Pengarang, Tahun, Jumlah, Penerbit) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssis", $param_Judul_Buku, $param_Pengarang, $param_Tahun, $param_Jumlah, $param_Penerbit);

            // Set parameters
            $param_Judul_Buku = $Judul_Buku;
            $param_Pengarang = $Pengarang;
            $param_Tahun = $Tahun;
            $param_Jumlah = $Jumlah;
            $param_Penerbit = $Penerbit;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to the landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web/css/all.min.css">
    
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Record</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data pegawai ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($Judul_Buku_err)) ? 'has-error' : ''; ?>">
                            <label>Judul Buku</label>
                            <input type="text" name="Judul_Buku" class="form-control" value="<?php echo $Judul_Buku; ?>">
                            <span class="help-block"><?php echo $Judul_Buku_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Pengarang_err)) ? 'has-error' : ''; ?>">
                            <label>Pengarang</label>
                            <input type="text" name="Pengarang" class="form-control" value="<?php echo $Pengarang; ?>">
                            <span class="help-block"><?php echo $Pengarang_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Tahun_err)) ? 'has-error' : ''; ?>">
                            <label>Tahun Terbit</label>
                            <input type="text" name="Tahun" class="form-control" value="<?php echo $Tahun; ?>">
                            <span class="help-block"><?php echo $Tahun_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Jumlah_err)) ? 'has-error' : ''; ?>">
                            <label>Jumlah Halaman</label>
                            <input type="number" name="Jumlah" class="form-control" value="<?php echo $Jumlah; ?>">
                            <span class="help-block"><?php echo $Jumlah_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Penerbit_err)) ? 'has-error' : ''; ?>">
                            <label>Penerbit</label>
                            <input type="text" name="Penerbit" class="form-control" value="<?php echo $Penerbit; ?>">
                            <span class="help-block"><?php echo $Penerbit_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>