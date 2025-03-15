<?php
session_start();
require_once "../php/koneksi.php";

if (empty($_SESSION['Email'])) {
    header("location:../login.php");
}

if (isset($_POST['save'])) {
    $services_name = $_POST['services_name'];
    $photo = $_FILES['photo'];

    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "../assets/uploads/" . $fileName;
        move_uploaded_file($photo['tmp_name'], $filePath);

        $insert = mysqli_query($conn, "INSERT INTO services (services_name, photo) VALUES ('$services_name', '$fileName')");
        if ($insert) {
            header("location:services.php");
        }
    }
}
if (isset($_GET['Edit'])) {
    $id = $_GET['Edit'];
    $qEdit = mysqli_query($conn, "SELECT * FROM services WHERE id = $id");
    $rowEdt = mysqli_fetch_assoc($qEdit);
}

if (isset($_POST['edit'])) {
    $id = $_GET['Edit'];
    $services_name = $_POST['services_name'];
    $photo = $_FILES['photo'];

    $fillQupdate = '';
    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "../assets/uploads/" . $fileName;
        if (move_uploaded_file($photo['tmp_name'], $filePath)) {
            $checkPhoto = mysqli_query($conn, "SELECT photo FROM services WHERE id = $id");
            $oldPhoto = mysqli_fetch_assoc($checkPhoto);
            if ($oldPhoto && file_exists("../assets/uploads/" . $oldPhoto['photo'])) {
                unlink("../assets/uploads/" . $oldPhoto['photo']);
            }
            $fillQupdate = "photo = '$fileName',";
        } else {
            echo "Failed to upload photo";
        }
    }

    $qUpdate = mysqli_query($conn, "UPDATE services SET $fillQupdate services_name='$services_name' WHERE id = $id");
    if ($qUpdate) {
        header("location:services.php");
    }
}

// if (isset($_GET['idDel'])) {
//     $id = $_GET['idDel'];

//     if ($rowEdt['logo']) {
//         unlink("../assets/img/services/" . $rowEdt['logo']);
//         $delete = mysqli_query($conn, "DELETE FROM setting WHERE id = '$id'");
//         $alterAI = mysqli_query($conn, "ALTER TABLE setting AUTO_INCREMENT = 1");
//         if ($delete && $alterAI) {
//             header("location:services.php");
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
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
                            <h5 class="card-title">Services</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Service Name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="services_name" value="<?= isset($_GET['Edit']) ? $rowEdt['services_name'] : "" ?>"
                                            placeholder="Input your service" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Photo</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 offset-md-2">
                                        <?php
                                        if (isset($_GET['Edit'])) {
                                        ?>
                                            <button class="btn btn-primary" name="edit" type="submit" width="200">Edit</button>

                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-primary" name="save" type="submit">Save</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
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

</body>

</html>