<?php
session_start();
require_once "../php/koneksi.php";

if (isset($_POST['save'])) {

    $id_category = $_POST['id_category'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $author = $_SESSION['Fullname'];

    $photo = $_FILES['photo'];

    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "../assets/uploads/" . $fileName;
        move_uploaded_file($photo['tmp_name'], $filePath);
        $insert = mysqli_query($conn, "INSERT INTO blog (id_category, title, content, tags, photo, author, status) VALUES ('$id_category', '$title', '$content', '$tags', '$fileName', '$author', '$status')");

        if ($insert) {
            header("location:blog.php?send=success");
        } else {
            header("location:add_blog.php?send=error");
        }
    }
}


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($conn, "SELECT * FROM blog WHERE id = $id");
    $row = mysqli_fetch_assoc($queryEdit);
}

// if (isset($_POST['edit'])) {
//     $id = $_GET['edit'];
//     $name_project = $_POST['name_project'];
//     $category = $_POST['category'];

//     $photo = $_FILES['photo'];
//     if (file_exists("../assets/uploads/" . $row['photo'])) {
//         unlink("../assets/uploads/" . $row['photo']);
//     }

//     if ($photo['error'] == 0) {
//         $fileName = uniqid() . "_" . basename($photo['name']);
//         $filePath = "../assets/uploads/" . $fileName;
//         move_uploaded_file($photo['tmp_name'], $filePath);
//     }

//     $q_update = mysqli_query($conn, "UPDATE project SET name_project = '$name_project', category = '$category', photo = '$fileName' WHERE id = $id");

//     if ($q_update) {
//         header("location:project.php?edit=success");
//     }
// }

// if (isset($_POST['edit'])) {
//     $id = $_GET['edit'];
//     $name_category = $_POST['name_project'];
//     $category = $_POST['category'];
//     $photo = $_FILES['photo'];
// }

// Kategori
$queryCat = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
$rowsCat = mysqli_fetch_all($queryCat, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Project</title>
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

    <!-- Template CSS Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">



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
                            <h5 class="card-title"><?= isset($_GET['edit']) ? 'EDIT' : 'ADD' ?> BLOG</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Name Category</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="id_category" id="" class="form-control">
                                            <option value="">Choose Category</option>
                                            <?php foreach ($rowsCat as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Title</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" value="<?= isset($_GET['edit']) ? $row['title'] : '' ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Content</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control summernote" name="content" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Tags</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tags" value="<?= isset($_GET['edit']) ? $row['tags'] : '' ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Status</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="status" id="" class="form-control">
                                            <option value="1" selected>Publish</option>
                                            <option value="0">Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Photo</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 offset-md-2">
                                        <?php if (isset($_GET['edit'])) { ?>
                                            <button class="btn btn-primary" name="edit" type="submit">Edit</button>
                                        <?php } else { ?>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $('.summernote').summernote({
            height: 200,
        });
    </script>
</body>

</html>