<?php
require_once "php/koneksi.php";
session_start();
session_regenerate_id();

if (empty($_SESSION["Email"])) {
    header("Location: login.php");
}

$selectProfile = mysqli_query($conn, "SELECT * FROM profiles");
$rows = mysqli_fetch_all($selectProfile, MYSQLI_ASSOC);

if (isset($_GET['idDel'])) {
    $id = $_GET['idDel'];
    $checkFoto = mysqli_query($conn, "SELECT photo FROM profiles WHERE id = $id");
    $rowPhoto = mysqli_fetch_assoc($checkFoto);
    if ($rowPhoto) {
        unlink("assets/uploads" . $rowPhoto['photo']);
        $del = mysqli_query($conn, "DELETE FROM profiles WHERE id = $id");
    }
    if ($del) {
        header("Location: profile.php");
    }
}

// STATUS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['idSt'];

    $update_0 = mysqli_query($conn, "UPDATE profiles SET status = 0");
    $update_1 = mysqli_query($conn, "UPDATE profiles SET status = 1 WHERE id = $id");

    if ($update_1) {
        header("Location: profile.php");
    } else {
        header("Location: profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php require_once "inc/navbar.php" ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">Manage Profile</div>
                    <div class="card-body">
                        <div class="mt-1 mb-1">
                            <a href="add_edit_profile.php" class="btn btn-primary">Create</a>
                        </div>
                        <div class="table table-responsive">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jabatan</th>
                                    <th>Deskripsi</th>
                                    <th>Settings</th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($rows as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><img src="<?= "assets/uploads/" . $row['photo'] ?>" alt="" width="135"></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['jabatan'] ?></td>
                                        <td><?= $row['deskripsi'] ?></td>
                                        <td>
                                            <a href="add_edit_profile.php?Edit=<?= base64_encode($row['id']) ?>" class="btn btn-success btn-sm">EDIT</a>
                                            <a onclick="return confirm ('Yakin Ingin Menghapus ?')" href="profile.php?idDel=<?= $row['id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
                                            <form action="profile.php?idSt=<?= $row['id'] ?>" method="post">
                                                <input type="radio" name="status" <?= isset($row['status']) && $row['status'] == 1 ? 'checked' : '' ?> value="1">
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
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