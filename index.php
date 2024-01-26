<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Informasi Perpustakaan</h2>
                        <a href="create.php" class="btn btn-success pull-right">Tambah Baru</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $link = mysqli_connect($servername, $username, $password, $database);
                    if($link === false){ 
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM tabel_buku";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped' style='width: 120%; text-align: center'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>Judul</th>";
                                        echo "<th>Pengarang</th>";
                                        echo "<th>Penerbit</th>";
                                        echo "<th>Tahun</th>";
                                        echo "<th>Jumlah</th>";
                                        echo "<th>Harga</th>";
                                        echo "<th>Pengaturan</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Judul_Buku'] . "</td>";
                                        echo "<td>" . $row['Pengarang'] . "</td>";
                                        echo "<td>" . $row['Penerbit'] . "</td>";
                                        echo "<td>" . $row['Tahun'] . "</td>";
                                        echo "<td>" . $row['Jumlah'] . "</td>";
                                        echo "<td>" . $row['Harga'] . "</td>";
                                        echo "<td class='d-flex'>";
                                        echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a>";
                                        echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='far fa-edit'></i></a>";
                                        echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='far fa-trash-alt'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
                    }

                    // Close connection
                    mysqli_close($koneksi);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
