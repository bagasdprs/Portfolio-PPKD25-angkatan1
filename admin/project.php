<?php
session_start();
require_once "../php/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM project");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryProject = mysqli_query($conn, "SELECT * FROM project WHERE id = '$id'");
    $rowProject = mysqli_fetch_assoc($queryProject);
    unlink("../assets/uploads/" . $rowProject['photo']);

    $delete = mysqli_query($conn, "DELETE FROM project WHERE id = '$id'");
    if ($delete) {
        header('location: project.php?hapus=success');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Data Project</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">



</head>

<body>

    <!-- ======= Header ======= -->
    <?php
    include '../inc/navbar.php';
    ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php
    include '../inc/sidebar.php';
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Project</h5>
                            <div class="table table-responsive">
                                <a href="add_project.php" class="btn btn-primary mb-2">Create</a>
                                <table class="table table-bordered text-center" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name Project</th>
                                            <th>Category</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rows as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['name_project'] ?></td>
                                                <td><?= $row['category'] ?></td>
                                                <td><img width="200" src="../assets/uploads/<?= $row['photo'] ?>" alt=""></td>
                                                <td>
                                                    <a href="add_project.php?edit=<?= $row['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are u sure delete this one?')" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
    include '../inc/footer.php';
    ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        let dataTable = new DataTable("#myTable");
    </script>

</body>

</html>