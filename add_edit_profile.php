<?php
require_once "php/koneksi.php";
session_start();
session_regenerate_id();

if (empty($_SESSION["Email"])) {
    header("Location: login.php");
}

if (isset($_POST['add-profile'])) {
    $photo = $_FILES['photo'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];

    if ($photo["error"] == 0) {
        $fillName = uniqid() . "_" . basename($photo['name']);
        $fillPath = "assets/uploads/" . $fillName;
        move_uploaded_file($photo['tmp_name'], $fillPath);

        $q_insert = mysqli_query($conn, "INSERT INTO profiles (photo, nama, jabatan, deskripsi) VALUES ('$fillName', '$nama', '$jabatan', '$deskripsi')");
        if ($q_insert) {
            header("Location: profile.php");
        } else {
            header("Location: add_edit_profile.php");
        }
    }
}

if (isset($_GET['Edit'])) {
    $idEdt = base64_decode($_GET['Edit']);

    $edit = mysqli_query($conn, "SELECT * FROM profiles WHERE id = $idEdt");
    $row = mysqli_fetch_assoc($edit);
}

if (isset($_POST['edit-profile'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];
    $photo = $_FILES['photo'];

    if ($photo["error"] == 0) {
        $fillName = uniqid() . "_" . basename($photo['name']);
        $fillPath = "assets/uploads/" . $fillName;

        if (move_uploaded_file($photo['tmp_name'], $fillPath)) {
            // CEK FOTO
            $cekFoto = mysqli_query($conn, "SELECT photo FROM profiles WHERE id = $idEdt");
            $rowPhoto = mysqli_fetch_assoc($cekFoto);

            if ($rowPhoto && file_exists("assets/uploads" . $rowPhoto['photo'])) {
                unlink("assets/uploads" . $rowPhoto['photo']);
            }
            $fieldPhoto = "photo='$fillName',";
        } else {
            echo "FAIL TO UPLOAD";
        }
    }

    $update = mysqli_query($conn, "UPDATE profiles SET nama = '$nama', jabatan='$jabatan', deskripsi='$deskripsi' WHERE id = $idEdt");
    if ($update) {
        header("Location: profile.php");
    } else {
        header("Location: add_edit_profile.php?Edit=$idEdt");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Person</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php require_once "inc/navbar.php" ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-center fw-bold"><?= isset($_GET['Edit']) ? 'Edit' : 'ADD' ?> Profile</div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-1">
                        <label for="" class="form-lable">Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="mt-1">
                        <label for="" class="form-lable">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= isset($_GET['Edit']) ? $row['nama'] : '' ?>" required>
                    </div>
                    <div class="mt-1">
                        <label for="" class="form-lable">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="<?= isset($_GET['Edit']) ? $row['jabatan'] : '' ?>" required>
                    </div>
                    <div class="mt-1">
                        <label for="" class="form-lable">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" cols="10" rows="10"><?= isset($_GET['Edit']) ? $row['deskripsi'] : '' ?></textarea>
                    </div>
                    <div class="mt-1">
                        <a href="profile.php" class="btn btn-secondary">Back</a>
                        <button type="submit" name="<?= isset($_GET['Edit']) ? 'edit-profile' : 'add-profile' ?>" class="btn btn-success"><?= isset($_GET['Edit']) ? 'EDIT' : 'ADD' ?></button>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <!-- Selamat datang, <?php echo $_SESSION["Email"] ?></h1>

    <a href="php/logout.php">Logout</a> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>