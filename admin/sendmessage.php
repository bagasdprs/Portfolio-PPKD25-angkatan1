<?php
session_start();
require_once "../php/koneksi.php";

if (empty($_SESSION['Email'])) {
    header("location:../login.php");
}

$id = $_GET['idMessage'];
$selectContact = mysqli_query($conn, "SELECT * FROM contact WHERE id = $id");
$row = mysqli_fetch_assoc($selectContact);
var_dump($row);

if (isset($_POST['sent'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $headers = "From : bagasdprs@gmail.com" . "\r\n" .
        "Reply-To: bagasdprs@gmail.com" . "\r\n" .
        "Content-Type: text/plain;charset=utf-8" . "\r\n" .
        "MIME-Version: 1.0" . "\r\n";

    if (mail($email, $subject, $message, $headers)) {
        echo "<script>('Email sent successfully')</script>";
        $del = mysqli_query($conn, "DELETE FROM contact WHERE id = $id");
        header("location:contact.php");
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
                            <h5 class="card-title">Reply Message</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row-mb-3">
                                    <div class="col-8">
                                        <pre>Name : <?= $row['name'] ?></pre>
                                        <pre>Email : <?= $row['email'] ?></pre>
                                        <pre>Subject : <?= $row['subject'] ?></pre>
                                        <pre>Message : <?= $row['message'] ?></pre>
                                    </div>
                                </div>
                                <div class="row-mb-3">
                                    <div class="col-sm-8">
                                        <label for="" class="form-label">Subject</label>
                                        <input type="hidden" name="email" value="<?= $row['email'] ?>">
                                        <input type="text" class="form-control" name="subject">
                                    </div>
                                </div>
                                <div class="row-mb-3">
                                    <div class="col-sm-8">
                                        <label for="" class="form-label">Reply's Message</label>
                                        <textarea name="message" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row-mb-3">
                                    <div class="col-md-2 offset-md-2">
                                        <button type="submit" class="btn btn-primary" name="sent">Send</button>
                                    </div>
                                </div>
                            </form>

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

</body>

</html>