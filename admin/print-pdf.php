<?php

require_once '../vendor/autoload.php';
require_once '../php/koneksi.php';

$mpdf = new \Mpdf\Mpdf();

$id = $_GET['idPrint'];
$select = mysqli_query($conn, "SELECT * FROM resume WHERE id = '$id'");
$row = mysqli_fetch_assoc($select);

$html =
    '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Resume</title>
</head>

<body>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Year</th>
                                    <th>Skill</th>
                                    <th>Agency</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['year'] . '</td>
                                    <td>' . $row['skill'] . '</td>
                                    <td>' . $row['agency'] . '</td>
                                    <td>' . $row['description'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>';


$mpdf->WriteHTML($html);
$mpdf->Output();
